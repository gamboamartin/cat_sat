<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use PDO;

class cat_sat_moneda extends modelo{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_moneda';
        $columnas = array($tabla=>false,"dp_pais"=>$tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'dp_pais_id';

        $tipo_campos = array();
        $tipo_campos['codigo'] = 'cod_3_letras_mayusc';
        $tipo_campos['dp_pais_id'] = 'id';


        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);
    }
}