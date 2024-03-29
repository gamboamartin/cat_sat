<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;



use PDO;
use stdClass;

class controlador_dp_estado extends \controllers\controlador_dp_estado {
    public function __construct(PDO $link, stdClass $paths_conf = new stdClass())
    {
        parent::__construct(link: $link,paths_conf:  $paths_conf);
        $this->childrens_data = array();
        $this->childrens_data['cat_sat_isn']['title'] = 'ISN';
    }
}
