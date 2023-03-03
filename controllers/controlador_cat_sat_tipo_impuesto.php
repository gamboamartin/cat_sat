<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use gamboamartin\cat_sat\models\cat_sat_tipo_impuesto;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_parent_sin_codigo;
use gamboamartin\system\links_menu;
use gamboamartin\template\html;
use html\cat_sat_tipo_impuesto_html;
use PDO;
use stdClass;

class controlador_cat_sat_tipo_impuesto extends _ctl_parent_sin_codigo {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_tipo_impuesto(link: $link);
        $html_ = new cat_sat_tipo_impuesto_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $columns["cat_sat_tipo_impuesto_id"]["titulo"] = "Id";
        $columns["cat_sat_tipo_impuesto_descripcion"]["titulo"] = "Tipo Impuesto";


        $filtro = array("cat_sat_tipo_impuesto.id", "cat_sat_tipo_impuesto.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html: $html_, link: $link, modelo: $modelo, obj_link: $obj_link, datatables: $datatables, paths_conf: $paths_conf);

        $this->titulo_lista = 'Tipo Impuesto';
        $this->lista_get_data = true;
    }

    protected function key_selects_txt(array $keys_selects): array
    {

        $keys_selects = (new \base\controller\init())->key_select_txt(cols: 12,key: 'descripcion',
            keys_selects:$keys_selects, place_holder: 'Tipo Impuesto');
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al maquetar key_selects',data:  $keys_selects);
        }

        return $keys_selects;
    }



}
