<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use gamboamartin\cat_sat\models\cat_sat_nom_tipo_contrato;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\cat_sat_nom_tipo_contrato_html;
use PDO;
use stdClass;

class controlador_cat_sat_nom_tipo_contrato extends system {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){

        $modelo = new cat_sat_nom_tipo_contrato(link: $link);
        $html_ = new cat_sat_nom_tipo_contrato_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);
        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Nomina tipo contrato';

    }




}
