<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use base\controller\controlador_base;
use gamboamartin\errores\errores;
use models\cat_sat_tipo_persona;
use PDO;
use stdClass;

class controlador_cat_sat_tipo_persona extends controlador_base {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_tipo_persona(link: $link);
        parent::__construct(link: $link,modelo:  $modelo, paths_conf: $paths_conf);
    }

    public function opciones(bool $header, bool $ws){

    }




}
