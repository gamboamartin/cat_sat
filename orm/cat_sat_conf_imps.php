<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_conf_imps extends _modelo_parent {

    public function __construct(PDO $link){
        $tabla = 'cat_sat_conf_imps';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        $tipo_campos['codigo'] = 'cod_int_0_3_numbers';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Configuraciones de Impuestos';
        $this->id_code = true;

    }
}