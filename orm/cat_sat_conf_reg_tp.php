<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_conf_reg_tp extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_conf_reg_tp';

        $columnas = array($tabla=>false,"cat_sat_regimen_fiscal" => $tabla,
            "cat_sat_tipo_persona" => $tabla);


        $campos_obligatorios[] = 'cat_sat_regimen_fiscal_id';
        $campos_obligatorios[] = 'cat_sat_tipo_persona_id';



        $parents_data['cat_sat_regimen_fiscal'] = array();
        $parents_data['cat_sat_regimen_fiscal']['namespace'] = 'gamboamartin\\cat_sat\\models';
        $parents_data['cat_sat_regimen_fiscal']['registro_id'] = -1;
        $parents_data['cat_sat_regimen_fiscal']['keys_parents'] = array('cat_sat_regimen_fiscal_descripcion');
        $parents_data['cat_sat_regimen_fiscal']['key_id'] = 'cat_sat_grupo_producto_id';

        $parents_data['cat_sat_tipo_persona'] = array();
        $parents_data['cat_sat_tipo_persona']['namespace'] = 'gamboamartin\\cat_sat\\models';
        $parents_data['cat_sat_tipo_persona']['registro_id'] = -1;
        $parents_data['cat_sat_tipo_persona']['keys_parents'] = array('cat_sat_tipo_persona_descripcion');
        $parents_data['cat_sat_tipo_persona']['key_id'] = 'cat_sat_tipo_persona_id';


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios, columnas: $columnas,
            columnas_extra: array(), tipo_campos: array(), parents_data: $parents_data);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Configuracion de regimenes fiscales';


    }

    public function alta_bd( array $keys_integra_ds = array()): array|stdClass
    {

        $cat_sat_regimen_fiscal = (new cat_sat_regimen_fiscal(link: $this->link))->registro(registro_id: $this->registro['cat_sat_regimen_fiscal_id']);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_regimen_fiscal',data: $cat_sat_regimen_fiscal);
        }

        $cat_sat_tipo_persona = (new cat_sat_tipo_persona(link: $this->link))->registro(registro_id: $this->registro['cat_sat_tipo_persona_id']);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener cat_sat_tipo_persona',data: $cat_sat_tipo_persona);
        }

        if(!isset($this->registro['descripcion'])){
            $this->registro['descripcion'] = $cat_sat_regimen_fiscal['cat_sat_regimen_fiscal_descripcion'];
            $this->registro['descripcion'] .= ' '.$cat_sat_tipo_persona['cat_sat_tipo_persona_descripcion'];
        }
        $this->registro = $this->campos_base(data:$this->registro,modelo: $this);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $this->registro);
        }


        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al insertar clase producto',data:  $r_alta_bd);
        }
        return $r_alta_bd;
    }


    public function modifica_bd(array $registro, int $id, bool $reactiva = false,
                                array $keys_integra_ds = array('codigo','descripcion')): array|stdClass
    {
        $registro = $this->campos_base(data: $registro, modelo: $this, id: $id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campo base',data: $registro);
        }


        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar clase producto',data:  $r_modifica_bd);
        }
        return $r_modifica_bd;
    }
}