<?php
namespace gamboamartin\cat_sat\models;

use gamboamartin\errores\errores;
use PDO;
use stdClass;

class _validacion{
    public array $metodo_pago_permitido = array();
    private errores $error;


    public function __construct(){

        $this->error = new errores();

        $this->metodo_pago_permitido['PUE'] = array('01','02','03','04','05','06','08','12','13','14',
            '15','17','23','24','25','26','27','28','29','30','31');

        $this->metodo_pago_permitido['PPD'] = array('99');
        $this->metodo_pago_permitido['PRED'] = array('PRED');
    }

    /**
     * Obtiene el codigo de un metodo de pago
     * @param stdClass $data datos de obtencion de codigo
     * @return array|string
     */
    private function cat_sat_metodo_pago_codigo(stdClass $data): array|string
    {
        $cat_sat_metodo_pago_codigo = trim($data->cat_sat_metodo_pago->codigo);
        if($cat_sat_metodo_pago_codigo === ''){
            return $this->error->error(mensaje: 'Error cat_sat_metodo_pago_codigo esta vacio',
                data: $cat_sat_metodo_pago_codigo);
        }
        return $cat_sat_metodo_pago_codigo;
    }

    private function data(array|stdClass $cat_sat_forma_pago, array|stdClass $cat_sat_metodo_pago){
        $data = $this->init_data(cat_sat_forma_pago: $cat_sat_forma_pago,cat_sat_metodo_pago:  $cat_sat_metodo_pago);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar datos registro', data: $data);
        }

        $data = $this->init_codigo_metodo_pago(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar datos registro', data: $data);
        }

        $data = $this->init_codigo_forma_pago(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar datos registro', data: $data);
        }
        return $data;
    }

    private function get_data(array|stdClass $cat_sat_forma_pago, array|stdClass $cat_sat_metodo_pago){
        $data = $this->data(cat_sat_forma_pago: $cat_sat_forma_pago,cat_sat_metodo_pago:  $cat_sat_metodo_pago);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar datos registro', data: $data);
        }

        $cat_sat_metodo_pago_codigo = $this->cat_sat_metodo_pago_codigo(data: $data);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener codigo',
                data: $cat_sat_metodo_pago_codigo);
        }
        $data->cat_sat_metodo_pago_codigo = $cat_sat_metodo_pago_codigo;
        return $data;
    }

    private function init_codigo_forma_pago(stdClass $data): array|stdClass
    {
        if(!isset($data->cat_sat_forma_pago->codigo)){
            if(!isset($data->cat_sat_forma_pago->cat_sat_forma_pago_codigo)){
                return $this->error->error(mensaje: 'Error cat_sat_forma_pago_codigo no existe en validacion',
                    data: $data);
            }
            $data->cat_sat_forma_pago->codigo = $data->cat_sat_forma_pago->cat_sat_forma_pago_codigo;
        }
        return $data;
    }

    /**
     * asigna el codigo de un metodo de pago
     * @param stdClass $data Datos
     * @return array|stdClass
     */
    private function init_codigo_metodo_pago(stdClass $data): array|stdClass
    {
        if(!isset($data->cat_sat_metodo_pago->codigo)){
            if(!isset($data->cat_sat_metodo_pago->cat_sat_metodo_pago_codigo)){
                return $this->error->error(mensaje: 'Error cat_sat_metodo_pago_codigo no existe en validacion',
                    data: $data);
            }
            $data->cat_sat_metodo_pago->codigo = $data->cat_sat_metodo_pago->cat_sat_metodo_pago_codigo;
        }
        return $data;
    }

    /**
     * Inicializa los datos para la validacion de un metodo de pago
     * @param stdClass|array $cat_sat_forma_pago Forma de pago datos
     * @param stdClass|array $cat_sat_metodo_pago Metodo de pago datos
     * @return stdClass
     */
    private function init_data(stdClass|array $cat_sat_forma_pago, stdClass|array $cat_sat_metodo_pago): stdClass
    {
        if(is_array($cat_sat_metodo_pago)){
            $cat_sat_metodo_pago = (object)$cat_sat_metodo_pago;
        }
        if(is_array($cat_sat_forma_pago)){
            $cat_sat_forma_pago = (object)$cat_sat_forma_pago;
        }

        $data = new stdClass();
        $data->cat_sat_metodo_pago = $cat_sat_metodo_pago;
        $data->cat_sat_forma_pago = $cat_sat_forma_pago;
        return $data;
    }

    final public function valida_conf_tipo_persona(PDO $link, array $registro){
        $filtro['cat_sat_regimen_fiscal.id'] = $registro['cat_sat_regimen_fiscal_id'];
        $filtro['cat_sat_tipo_persona.id'] = $registro['cat_sat_tipo_persona_id'];

        $existe_conf = (new cat_sat_conf_reg_tp(link: $link))->existe(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al verificar si existe configuracion de regimen', data: $existe_conf);
        }
        if(!$existe_conf){
            return $this->error->error(mensaje: 'Error al no existe configuracion de regimen', data: $filtro);
        }
        return true;
    }



    final public function valida_metodo_pago(PDO $link, array $registro){
        $cat_sat_metodo_pago = (new cat_sat_metodo_pago(link: $link))->registro(
            registro_id: $registro['cat_sat_metodo_pago_id'], columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_metodo_pago', data: $cat_sat_metodo_pago);
        }

        $cat_sat_forma_pago = (new cat_sat_forma_pago(link: $link))->registro(
            registro_id: $registro['cat_sat_forma_pago_id'], columnas_en_bruto: true,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_forma_pago', data: $cat_sat_forma_pago);
        }

        $verifica = $this->verifica_forma_pago(cat_sat_forma_pago: $cat_sat_forma_pago,
            cat_sat_metodo_pago:  $cat_sat_metodo_pago,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al verifica registro', data: $verifica);
        }
        return $verifica;
    }

    private function valida_si_existe(string $cat_sat_metodo_pago_codigo): bool|array
    {
        if(!isset($this->metodo_pago_permitido[$cat_sat_metodo_pago_codigo])){
            return $this->error->error(mensaje: 'Error cat_sat_metodo_pago_codigo no existe en validacion',
                data: $cat_sat_metodo_pago_codigo);

        }
        return true;
    }

    private function valida_si_existe_en_array(string $cat_sat_metodo_pago_codigo, stdClass $data, array|stdClass $registro): bool|array
    {
        if((!in_array($data->cat_sat_forma_pago->codigo, $this->metodo_pago_permitido[$cat_sat_metodo_pago_codigo]))){
            return $this->error->error(mensaje: 'Error al metodo o forma de pago incorrecto', data: $registro);
        }
        return true;
    }

    /**
     * Verifica que una forma de pago se valida en relacion al metodo de pago
     * @param stdClass|array $cat_sat_forma_pago Row de forma de pago
     * @param stdClass|array $cat_sat_metodo_pago Row de metodo de pago
     * @param array|stdClass $registro Registro en proceso
     * @return bool|array
     */
    private function verifica_forma_pago(stdClass|array $cat_sat_forma_pago, stdClass|array $cat_sat_metodo_pago,
                                         array|stdClass $registro): bool|array
    {

        $data = $this->get_data(cat_sat_forma_pago: $cat_sat_forma_pago,cat_sat_metodo_pago:  $cat_sat_metodo_pago);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar datos registro', data: $data);
        }


        $valida = $this->valida_si_existe(cat_sat_metodo_pago_codigo: $data->cat_sat_metodo_pago_codigo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar metodo de pago', data: $valida);

        }
        $valida = $this->valida_si_existe_en_array(cat_sat_metodo_pago_codigo: $data->cat_sat_metodo_pago_codigo,
            data:  $data,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar metodo de pago', data: $valida);

        }

        return true;
    }



}
