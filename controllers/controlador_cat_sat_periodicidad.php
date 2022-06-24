<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use controllers\base\system;
use html\directivas\cat_sat_periodicidad_html;
use html\directivas\cat_sat_uso_cfdi_html;
use links\links_menu;
use models\cat_sat_periodicidad;
use models\cat_sat_uso_cfdi;
use PDO;
use stdClass;

class controlador_cat_sat_periodicidad extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_periodicidad(link: $link);
        $html = new cat_sat_periodicidad_html(controler: $this);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Periodicidades';

    }




}
