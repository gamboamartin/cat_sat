<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_tipo_nomina extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_tipo_nomina';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'descripcion_select';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;
    }


}