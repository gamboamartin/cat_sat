<?php
namespace gamboamartin\cat_sat\tests;
use base\orm\modelo_base;
use gamboamartin\cat_sat\models\cat_sat_tipo_nomina;
use gamboamartin\errores\errores;

use PDO;


class base_test{

    public function alta_cat_sat_tipo_nomina(PDO $link): array|\stdClass
    {
        $nom_periodo = array();
        $nom_periodo['id'] = 1;
        $nom_periodo['codigo'] = 1;
        $nom_periodo['descripcion'] = 1;
        $nom_periodo['descripcion_select'] = 1;

        $alta = (new cat_sat_tipo_nomina($link))->alta_registro($nom_periodo);
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
