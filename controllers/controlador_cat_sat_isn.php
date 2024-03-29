<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use base\controller\init;
use gamboamartin\cat_sat\models\cat_sat_isn;
use gamboamartin\direccion_postal\models\dp_estado;
use gamboamartin\errores\errores;
use gamboamartin\system\_ctl_base;
use gamboamartin\system\links_menu;
use gamboamartin\template\html;
use html\cat_sat_isn_html;


use PDO;
use stdClass;

class controlador_cat_sat_isn extends _ctl_base {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_isn(link: $link);
        $html_ = new cat_sat_isn_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id:  $this->registro_id);
        $this->rows_lista[] = 'dp_estado_id';
        $this->rows_lista[] = 'porcentaje';

        $columns["cat_sat_isn_id"]["titulo"] = "Id";
        $columns["cat_sat_isn_codigo"]["titulo"] = "Codigo";
        $columns["cat_sat_isn_descripcion"]["titulo"] = "Descripcion";
        $columns["dp_estado_descripcion"]["titulo"] = "Periodicidad Pago";
        $columns["cat_sat_isn_porcentaje"]["titulo"] = "Cuota Fija";

        $filtro = array("cat_sat_isn.id","cat_sat_isn.codigo","cat_sat_isn.descripcion","cat_sat_isn.porcentaje",
            "dp_estado.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->lista_get_data = true;
    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        /*$r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }

        $keys_selects = array();
        $keys_selects['dp_estado_id'] = new stdClass();
        $keys_selects['dp_estado_id']->label = 'Estado';
        $keys_selects['dp_estado_id']->key_descripcion_select = 'dp_estado_descripcion';

        $keys_selects['porcentaje'] = new stdClass();
        $keys_selects['porcentaje']->place_holder = 'Porcentaje';


        $inputs = (new cat_sat_isn_html(html: $this->html_base))->genera_inputs_alta(controler: $this,
            modelo: $this->modelo, link: $this->link,keys_selects: $keys_selects);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar inputs',data:  $inputs);
            print_r($error);
            die('Error');
        }*/

        $r_alta = $this->init_alta();
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al inicializar alta', data: $r_alta, header: $header, ws: $ws);
        }

        $inputs = $this->data_form();
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al obtener inputs', data: $inputs, header: $header, ws: $ws);
        }

        return $r_alta;
    }

    protected function campos_view(): array
    {
        $keys = new stdClass();
        $keys->inputs = array('porcentaje_isn', 'factor_isn_adicional');
        $keys->selects = array();

        $init_data = array();
        $init_data['dp_estado'] = "gamboamartin\\direccion_postal";
        $campos_view = $this->campos_view_base(init_data: $init_data, keys: $keys);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al inicializar campo view', data: $campos_view);
        }

        return $campos_view;
    }

    public function init_selects_inputs(): array{
        $keys_selects = $this->init_selects(keys_selects: array(), key: "dp_estado_id", label: "Estado",
            cols: 12);
        $keys_selects['dp_estado_id']->key_descripcion_select = 'dp_estado_descripcion';

        return $keys_selects;
    }

    private function init_selects(array $keys_selects, string $key, string $label, int|null $id_selected = -1, int $cols = 6,
                                  bool  $con_registros = true, array $filtro = array()): array
    {
        $keys_selects = $this->key_select(cols: $cols, con_registros: $con_registros, filtro: $filtro, key: $key,
            keys_selects: $keys_selects, id_selected: $id_selected, label: $label);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        return $keys_selects;
    }

    private function data_form(): array|stdClass
    {
        $keys_selects = $this->init_selects_inputs();
        if (errores::$error) {return $this->errores->error(mensaje: 'Error al inicializar selects', data: $keys_selects);
        }

        $inputs = $this->inputs(keys_selects: $keys_selects);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al obtener inputs', data: $inputs);
        }

        return $inputs;
    }

    protected function key_selects_txt(array $keys_selects): array
    {
        $keys_selects = (new init())->key_select_txt(cols: 6, key: 'porcentaje_isn',
            keys_selects: $keys_selects, place_holder: 'Porcentaje ISN');
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        $keys_selects = (new init())->key_select_txt(cols: 6, key: 'factor_isn_adicional',
            keys_selects: $keys_selects, place_holder: 'Factor ISN Adicional');
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        return $keys_selects;
    }
    public function modifica(bool $header, bool $ws = false): stdClass|array
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
        $r_modifica =  parent::modifica(header: false); // TODO: Change the autogenerated stub
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
