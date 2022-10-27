<?php
namespace gamboamartin\cat_sat\tests;
use base\orm\modelo_base;
use gamboamartin\cat_sat\models\cat_sat_isn;
use gamboamartin\cat_sat\models\cat_sat_isr;
use gamboamartin\cat_sat\models\cat_sat_metodo_pago;
use gamboamartin\cat_sat\models\cat_sat_moneda;
use gamboamartin\cat_sat\models\cat_sat_periodicidad_pago_nom;
use gamboamartin\cat_sat\models\cat_sat_regimen_fiscal;
use gamboamartin\cat_sat\models\cat_sat_tipo_nomina;
use gamboamartin\direccion_postal\models\dp_pais;
use gamboamartin\errores\errores;

use gamboamartin\test\test;
use PDO;
use stdClass;


class base_test{

    public function alta_cat_sat_metodo_pago(PDO $link, string $codigo = '1', $descripcion = '1', int $id = 1,
                                             bool $predeterminado = false): array|stdClass
    {
        $registro = (new test())->registro(
            codigo:$codigo,descripcion: $descripcion,id: $id, predeterminado: $predeterminado);
        if (errores::$error) {
            return (new errores())->error('Error al integrar predeterminado si existe', $registro);

        }

        $alta = (new cat_sat_metodo_pago($link))->alta_registro($registro);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }

    public function alta_cat_sat_moneda(PDO $link, string $codigo = 'XSM', string $descripcion = '1', int $id = 1,
                                        int $dp_pais_id = 1, bool $predeterminado = false): array|stdClass
    {

        $registro = (new test())->registro(codigo:$codigo,descripcion:  $descripcion, id: $id,
            predeterminado:  $predeterminado);
        if (errores::$error) {
            return (new errores())->error('Error al integrar predeterminado si existe', $registro);

        }

        $existe = (new dp_pais($link))->existe_by_id(registro_id: $dp_pais_id);
        if (errores::$error) {
            return (new errores())->error('Error al validar si existe', $existe);

        }

        if(!$existe) {
            $alta = (new base_test())->alta_dp_pais(link: $link);
            if (errores::$error) {
                return (new errores())->error('Error al dar de alta', $alta);
            }

        }

        $registro['dp_pais_id'] = $dp_pais_id;

        $alta = (new cat_sat_moneda($link))->alta_registro($registro);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }

    public function alta_cat_sat_regimen_fiscal(PDO $link, string $codigo = '1', string $descripcion = '1',
                                                int $id = 1, bool $predeterminado = false): array|stdClass
    {
        $registro = (new test())->registro(
            codigo:$codigo,descripcion: $descripcion,id: $id, predeterminado: $predeterminado);
        if (errores::$error) {
            return (new errores())->error('Error al integrar predeterminado si existe', $registro);

        }


        $alta = (new cat_sat_regimen_fiscal($link))->alta_registro($registro);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }

    public function alta_cat_sat_tipo_nomina(PDO $link, string $codigo = '1', $descripcion = '1', int $id = 1,
                                             bool $predeterminado = false): array|stdClass
    {
        $registro = (new test())->registro(
            codigo:$codigo,descripcion: $descripcion,id: $id, predeterminado: $predeterminado);
        if (errores::$error) {
            return (new errores())->error('Error al integrar predeterminado si existe', $registro);

        }

        $alta = (new cat_sat_tipo_nomina($link))->alta_registro($registro);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }

    public function alta_dp_pais(PDO $link, string $codigo = '1', $descripcion = '1', int $id = 1,
                                 bool $predeterminado = false): array|stdClass
    {

        $alta = (new \gamboamartin\direccion_postal\tests\base_test())->alta_dp_pais(link: $link,
            codigo: $codigo, descripcion: $descripcion, id: $id, predeterminado: $predeterminado);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }



    public function del(PDO $link, string $name_model): array
    {

        $model = (new modelo_base($link))->genera_modelo(modelo: $name_model);
        $del = $model->elimina_todo();
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al eliminar '.$name_model, data: $del);
        }
        return $del;
    }

    public function del_cat_sat_metodo_pago(PDO $link): array
    {


        $del = $this->del($link, 'gamboamartin\\cat_sat\\models\\cat_sat_metodo_pago');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }

    public function del_cat_sat_moneda(PDO $link): array
    {

        $del = $this->del($link, 'gamboamartin\\cat_sat\\models\\cat_sat_moneda');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }

    public function del_cat_sat_tipo_nomina(PDO $link): array
    {

        $del = $this->del($link, 'gamboamartin\\cat_sat\\models\\cat_sat_tipo_nomina');
        if(errores::$error){
            return (new errores())->error('Error al eliminar', $del);
        }
        return $del;
    }

    public function del_dp_pais(PDO $link): array
    {
        $del = $this->del_cat_sat_moneda($link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al eliminar ', data: $del);
        }

        $del = (new \gamboamartin\direccion_postal\tests\base_test())->del_dp_pais(link: $link);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al eliminar ', data: $del);
        }
        return $del;
    }

    public function alta_cat_sat_periodicidad_pago_nom(PDO $link, $id = 1): array|\stdClass
    {
            $registro = array();
            $registro['id'] = $id;
            $registro['codigo'] = 1;
            $registro['descripcion'] = 1;
            $registro['descripcion_select'] = 1;
            $registro['codigo_bis'] = 1;
            $registro['alias'] = 1;
            $registro['n_dias'] = 1;

            $alta = (new cat_sat_periodicidad_pago_nom($link))->alta_registro($registro);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

            }
            return $alta;
    }

    public function alta_cat_sat_isr(PDO $link, int $cat_sat_periodicidad_pago_nom_id = 1): array|\stdClass
    {

        $existe = (new cat_sat_periodicidad_pago_nom($link))->existe_by_id(registro_id: $cat_sat_periodicidad_pago_nom_id);
        if(errores::$error){
            return (new errores())->error('Error al verificar si existe', $existe);

        }

        if(!$existe) {
            $alta = (new base_test())->alta_cat_sat_periodicidad_pago_nom(link: $link, id: $cat_sat_periodicidad_pago_nom_id);
            if (errores::$error) {
                return (new errores())->error('Error al dar de alta', $alta);
            }
        }

        $registro = array();
        $registro['id'] = 1;
        $registro['codigo'] = 1;
        $registro['descripcion'] = 1;
        $registro['descripcion_select'] = 1;
        $registro['codigo_bis'] = 1;
        $registro['alias'] = 1;
        $registro['limite_inferior'] = 0.01;
        $registro['limite_superior'] = 21.20;
        $registro['cuota_fija'] = 0;
        $registro['porcentaje_excedente'] = 1.92;
        $registro['cat_sat_periodicidad_pago_id'] = $cat_sat_periodicidad_pago_nom_id;
        $registro['fecha_inicio'] = '2020-01-01';
        $registro['fecha_fin'] = '2020-12-31';

        $alta = (new cat_sat_isr($link))->alta_registro($registro);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al insertar', data: $alta);

        }
        return $alta;
    }


}
