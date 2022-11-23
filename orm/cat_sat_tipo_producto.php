<?php
namespace gamboamartin\cat_sat\models;

use base\orm\_modelo_parent;
use PDO;


class cat_sat_tipo_producto extends _modelo_parent {
    public function __construct(PDO $link){
        $tabla = 'cat_sat_tipo_producto';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        $campos_view['codigo'] = array('type' => 'inputs');
        $campos_view['descripcion'] = array('type' => 'inputs');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, campos_view: $campos_view);
        $this->NAMESPACE = __NAMESPACE__;
    }


}