<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use PDO;

class cat_sat_tipo_de_comprobante extends modelo{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_tipo_de_comprobante';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';
        $tipo_campos['codigo'] = 'cod_1_letras_mayusc';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, tipo_campos: $tipo_campos);
    }
}