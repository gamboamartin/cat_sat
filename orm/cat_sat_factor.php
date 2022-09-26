<?php
namespace gamboamartin\cat_sat\models;
use base\orm\modelo;
use PDO;

class cat_sat_factor  extends modelo{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_factor';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'factor';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }
}