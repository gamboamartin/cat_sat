<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class _impuestos extends _modelo_parent {
    public function alta_bd(array $keys_integra_ds = array('codigo', 'descripcion')): array|stdClass
    {
        $cat_sat_conf_imps = (new cat_sat_conf_imps(link: $this->link))->registro(
            registro_id: $this->registro['cat_sat_conf_imps_id'], retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_conf_imps',data:  $cat_sat_conf_imps);
        }

        $cat_sat_tipo_impuesto = (new cat_sat_tipo_impuesto(link: $this->link))->registro(
            registro_id: $this->registro['cat_sat_tipo_impuesto_id'], retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_tipo_impuesto',data:  $cat_sat_tipo_impuesto);
        }

        $cat_sat_tipo_factor = (new cat_sat_tipo_factor(link: $this->link))->registro(
            registro_id: $this->registro['cat_sat_tipo_factor_id'], retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_tipo_factor',data:  $cat_sat_tipo_factor);
        }

        $cat_sat_factor = (new cat_sat_factor(link: $this->link))->registro(
            registro_id: $this->registro['cat_sat_factor_id'], retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_factor',data:  $cat_sat_factor);
        }

        if(!isset($this->registro['descripcion'])){
            $descripcion = $cat_sat_conf_imps->cat_sat_conf_imps_descripcion;
            $descripcion .= ' '.$cat_sat_tipo_impuesto->cat_sat_tipo_impuesto_descripcion;
            $descripcion .= ' '.$cat_sat_tipo_factor->cat_sat_tipo_factor_descripcion;
            $descripcion .= ' '.$cat_sat_factor->cat_sat_factor_factor;

            $this->registro['descripcion'] = $descripcion;

        }

        $r_alta_bd = parent::alta_bd(keys_integra_ds: $keys_integra_ds); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar',data:  $r_alta_bd);
        }
        return $r_alta_bd;

    }

}