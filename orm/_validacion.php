<?php
namespace gamboamartin\cat_sat\models;

use gamboamartin\errores\errores;
use PDO;
use stdClass;

class _validacion{
    private array $metodo_pago_permitido = array();
    private errores $error;


    public function __construct(){

        $this->error = new errores();

        $this->metodo_pago_permitido['PUE'] = array('01','02','03','04','05','06','08','12','13','14',
            '15','17','23','24','25','26','27','28','29','30','31');

        $this->metodo_pago_permitido['PPD'] = array('99');
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

    /**
     * Verifica que una forma de pago se valida en relacion al metodo de pago
     * @param stdClass $cat_sat_forma_pago Row de forma de pago
     * @param stdClass $cat_sat_metodo_pago Row de metodo de pago
     * @param array $registro Registro en proceso
     * @return bool|array
     */
    private function verifica_forma_pago(stdClass $cat_sat_forma_pago, stdClass $cat_sat_metodo_pago,
                                         array $registro): bool|array
    {
        $cat_sat_metodo_pago_codigo = trim($cat_sat_metodo_pago->codigo);
        if($cat_sat_metodo_pago_codigo === ''){
            return $this->error->error(mensaje: 'Error cat_sat_metodo_pago_codigo esta vacio',
                data: $cat_sat_metodo_pago_codigo);
        }
        if(!isset($this->metodo_pago_permitido[$cat_sat_metodo_pago_codigo])){
            return $this->error->error(mensaje: 'Error cat_sat_metodo_pago_codigo no existe en validacion',
                data: $cat_sat_metodo_pago_codigo);

        }
        if((!in_array($cat_sat_forma_pago->codigo, $this->metodo_pago_permitido[$cat_sat_metodo_pago_codigo]))){
            return $this->error->error(mensaje: 'Error al metodo o forma de pago incorrecto', data: $registro);
        }
        return true;
    }



}
