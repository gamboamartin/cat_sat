<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use gamboamartin\cat_sat\models\cat_sat_regimen_fiscal;
use gamboamartin\errores\errores;

use gamboamartin\template_1\html;
use html\cat_sat_regimen_fiscal_html;
use links\secciones\link_cat_sat_regimen_fiscal;
use PDO;
use stdClass;

class controlador_cat_sat_regimen_fiscal extends _base {

    public array $keys_selects = array();

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_regimen_fiscal(link: $link);
        $html_base = new html();
        $html = new cat_sat_regimen_fiscal_html(html: $html_base);
        $obj_link = new link_cat_sat_regimen_fiscal(link: $link, registro_id: $this->registro_id);

        $columns["cat_sat_regimen_fiscal_id"]["titulo"] = "Id";
        $columns["cat_sat_regimen_fiscal_codigo"]["titulo"] = "Código";
        $columns["cat_sat_regimen_fiscal_descripcion"]["titulo"] = "Régimen Fiscal";

        $filtro = array("cat_sat_regimen.id","cat_sat_regimen.codigo","cat_sat_regimen.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Regímenes  Fiscales';

        $propiedades = $this->inicializa_propiedades();
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al inicializar propiedades',data:  $propiedades);
            print_r($error);
            die('Error');
        }

        $this->lista_get_data = true;

    }


    /**
     * @param string $identificador
     * @param array $propiedades
     * @return array
     */
    private function asignar_propiedad(string $identificador, array $propiedades): array
    {
        if (!array_key_exists($identificador,$this->keys_selects)){
            $this->keys_selects[$identificador] = new stdClass();
        }

        foreach ($propiedades as $key => $value){
            $this->keys_selects[$identificador]->$key = $value;
        }
        return $this->keys_selects;
    }



    private function inicializa_propiedades(): array
    {
        $identificador = "codigo";
        $propiedades = array("place_holder" => "Código", "cols" => 4);
        $result = $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar propiedad',data:  $result);
        }

        $identificador = "descripcion";
        $propiedades = array("place_holder" => "Régimen Fiscal", "cols" => 8);
        $result = $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar propiedad',data:  $result);
        }

        return $this->keys_selects;
    }



}
