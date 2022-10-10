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

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }

        $keys_selects = array();
        $keys_selects['dp_estado_id'] = new stdClass();
        $keys_selects['dp_estado_id']->label = 'Estado';

        $keys_selects['porcentaje'] = new stdClass();
        $keys_selects['porcentaje']->place_holder = 'Porcentaje';


        $inputs = (new cat_sat_isn_html(html: $this->html_base))->genera_inputs_alta(controler: $this,
            modelo: $this->modelo, link: $this->link,keys_selects: $keys_selects);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar inputs',data:  $inputs);
            print_r($error);
            die('Error');
        }
        return $r_alta;
    }

    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '', bool $aplica_form = true,
                             bool $muestra_btn = true): array|string
    {
        $base = $this->base();
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar datos',data:  $base,
                header: $header,ws:$ws);
        }

        return $base->template;
    }

    private function base(stdClass $params = new stdClass()): array|stdClass
    {
        $r_modifica =  parent::modifica(header: false,aplica_form:  false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar template',data:  $r_modifica);
        }

        $inputs = (new cat_sat_isn_html(html: $this->html_base))->inputs_cat_sat_isn(
            controlador:$this, params: $params);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al inicializar inputs',data:  $inputs);
        }

        $data = new stdClass();
        $data->template = $r_modifica;
        $data->inputs = $inputs;

        return $data;
    }
}
