<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use html\cat_sat_forma_pago_html;
use models\cat_sat_forma_pago;
use PDO;
use stdClass;

class controlador_cat_sat_forma_pago extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_forma_pago(link: $link);
        $html = new cat_sat_forma_pago_html();
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Formas de Pago';

    }




}
