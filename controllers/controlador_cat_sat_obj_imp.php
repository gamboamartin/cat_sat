<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use gamboamartin\cat_sat\models\cat_sat_obj_imp;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use html\cat_sat_obj_imp_html;
use gamboamartin\template\html;
use PDO;
use stdClass;

class controlador_cat_sat_obj_imp extends _cat_sat {

    public array $keys_selects = array();

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_obj_imp(link: $link);
        $html_ = new cat_sat_obj_imp_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id); 

        $columns["cat_sat_obj_imp_id"]["titulo"] = "Id";
        $columns["cat_sat_obj_imp_codigo"]["titulo"] = "Código";
        $columns["cat_sat_obj_imp_descripcion"]["titulo"] = "Objeto del Impuesto";

        $filtro = array("cat_sat_obj_imp.id","cat_sat_obj_imp.codigo","cat_sat_obj_imp.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Objeto del Impuesto';

        $propiedades = $this->inicializa_propiedades();
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
            print_r($error);
            die('Error');
        }
        $this->lista_get_data = true;
    }



    public function asignar_propiedad(string $identificador, mixed $propiedades)
    {
        if (!array_key_exists($identificador,$this->keys_selects)){
            $this->keys_selects[$identificador] = new stdClass();
        }

        foreach ($propiedades as $key => $value){
            $this->keys_selects[$identificador]->$key = $value;
        }
    }

    private function inicializa_propiedades(): array
    {
        $identificador = "codigo";
        $propiedades = array("place_holder" => "Código", "cols" => 4);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "descripcion";
        $propiedades = array("place_holder" => "Objeto del Impuesto", "cols" => 8);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $this->keys_selects;
    }


}
