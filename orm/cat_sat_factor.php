<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_factor  extends modelo {
    public function __construct(PDO $link){
        $tabla = 'cat_sat_factor';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'factor';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
        $this->NAMESPACE = __NAMESPACE__;
    }

    public function alta_bd(array $keys_integra_ds = array('codigo', 'factor')): array|stdClass
    {
        $this->registro = $this->inicializa_extras(data: $this->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campos',data: $this->registro);
        }

        $r_alta_bd = parent::alta_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al dar de alta factor',data: $r_alta_bd);
        }

        return $r_alta_bd;
    }

    private function inicializa_extras(array $data){

        if (isset($data['status'])){
            return  $data;
        }

        if (!isset($data['descripcion_select'])){
            $data['descripcion_select'] = $data['codigo']. ' ';
            $data['descripcion_select'] .= $data['factor'];
        }

        if (!isset($data['codigo_bis'])){
            $data['codigo_bis'] = $data['codigo'];
        }

        if (!isset($data['alias'])){
            $data['alias'] = $data['codigo'];
        }

        return $data;
    }

    public function modifica_bd(array $registro, int $id, bool $reactiva = false): array|stdClass
    {
        $registro = $this->inicializa_extras(data: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar campos',data: $registro);
        }

        $r_modifica_bd = parent::modifica_bd($registro, $id, $reactiva);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al modificar factor',data: $r_modifica_bd);
        }

        return $r_modifica_bd;
    }

}