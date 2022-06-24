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
use html\directivas\cat_sat_uso_cfdi_html;
use links\links_menu;
use models\cat_sat_uso_cfdi;
use PDO;
use stdClass;

class controlador_cat_sat_uso_cfdi extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_uso_cfdi(link: $link);
        $html = new cat_sat_uso_cfdi_html(controler: $this);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Usos CFDI';

    }




}
