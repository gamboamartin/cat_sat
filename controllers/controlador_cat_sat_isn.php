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
use gamboamartin\direccion_postal\models\dp_estado;
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
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);
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

    private function dp_estado_descripcion_row(stdClass $row): array|stdClass
    {
        $keys = array('cat_sat_isn_id');
        $valida = $this->validacion->valida_ids(keys: $keys,registro:  $row);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al validar row',data:  $valida);
        }

        $dp_estado = new dp_estado($this->link);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al genera modelo',data:  $dp_estado);
        }

        $r_dp_estado = $dp_estado->registro(registro_id: $row->cat_sat_isn_dp_estado_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener el registro',data:  $r_dp_estado);
        }
        $row->dp_estado_descripcion = $r_dp_estado['dp_estado_descripcion'];

        return $row;
    }

    public function lista(bool $header, bool $ws = false): array
    {
        $r_lista = parent::lista($header, $ws); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar datos',data:  $r_lista, header: $header,ws:$ws);
        }

        $registros = $this->maqueta_registros_lista(registros: $this->registros);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar registros',data:  $registros, header: $header,ws:$ws);
        }
        $this->registros = $registros;

        return $r_lista;
    }

    private function maqueta_registros_lista(array $registros): array
    {
        foreach ($registros as $indice=> $row){
            $row = $this->dp_estado_descripcion_row(row: $row);
            if(errores::$error){
                return $this->errores->error(mensaje: 'Error al maquetar row',data:  $row);
            }
            $registros[$indice] = $row;
        }
        return $registros;
    }

}
