<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\cat_sat\models\cat_sat_isn;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\cat_sat_isn_html;

use JsonException;

use PDO;
use stdClass;

class controlador_cat_sat_isn extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_isn(link: $link);
        $html_base = new html();
        $html = new cat_sat_isn_html(html: $html_base);
        $obj_link = new links_menu($this->registro_id);
        $this->rows_lista[] = 'dp_estado_id';
        $this->rows_lista[] = 'porcentaje';
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Impuesto sobre nomina';
    }

    /**
     * @param bool $header
     * @param bool $ws
     * @param string $breadcrumbs
     * @param bool $aplica_form
     * @param bool $muestra_btn
     * @return array|string
     */

}
