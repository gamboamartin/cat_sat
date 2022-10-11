<?php
namespace gamboamartin\cat_sat\tests;
use base\orm\modelo_base;
use gamboamartin\cat_sat\models\cat_sat_metodo_pago;
use gamboamartin\cat_sat\models\cat_sat_moneda;
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
                                        int $dp_pais_id = -1, bool $predeterminado = false): array|stdClass
    {

        $registro = (new test())->registro(codigo:$codigo,descripcion:  $descripcion, id: $id,
            predeterminado:  $predeterminado);
        if (errores::$error) {
            return (new errores())->error('Error al integrar predeterminado si existe', $registro);

        }

        if($dp_pais_id === -1) {


            $existe = (new dp_pais($link))->existe_predeterminado();
            if (errores::$error) {
                return (new errores())->error('Error al validar si existe', $existe);

            }
            if(!$existe) {

                $alta = (new \gamboamartin\direccion_postal\tests\base_test())->alta_dp_pais(link: $link, predeterminado: true);
                if (errores::$error) {
                    return (new errores())->error('Error al dar de alta', $alta);

                }
            }

        }
        if($dp_pais_id > 0){

            $registro['dp_pais_id'] = $dp_pais_id;

            $existe = (new dp_pais($link))->existe_by_id(registro_id: $dp_pais_id);
            if (errores::$error) {
                return (new errores())->error('Error al validar si existe', $existe);
            }

            if(!$existe) {
                $alta = (new \gamboamartin\direccion_postal\tests\base_test())->alta_dp_pais(link: $link, id: $dp_pais_id);
                if (errores::$error) {
                    return (new errores())->error('Error al dar de alta', $alta);
                }
            }

        }



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




}
