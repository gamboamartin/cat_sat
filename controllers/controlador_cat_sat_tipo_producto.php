<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */

namespace gamboamartin\cat_sat\controllers;

use base\controller\controler;
use gamboamartin\cat_sat\models\cat_sat_tipo_producto;
use gamboamartin\errores\errores;

use gamboamartin\system\_ctl_base;
use gamboamartin\system\links_menu;
use gamboamartin\template\html;
use html\cat_sat_tipo_producto_html;
use PDO;
use stdClass;

class controlador_cat_sat_tipo_producto extends _ctl_base
{
    public controlador_cat_sat_division_producto $controlador_cat_sat_division_producto;

    public string $link_cat_sat_division_producto_alta_bd = '';

    public function __construct(PDO      $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass())
    {
        $modelo = new cat_sat_tipo_producto(link: $link);
        $html_ = new cat_sat_tipo_producto_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $datatables = $this->init_datatable();
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar datatable', data: $datatables);
            print_r($error);
            die('Error');
        }

        parent::__construct(html: $html_, link: $link, modelo: $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $configuraciones = $this->init_configuraciones();
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar configuraciones', data: $configuraciones);
            print_r($error);
            die('Error');
        }

        $init_controladores = $this->init_controladores(paths_conf: $paths_conf);
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar controladores', data: $init_controladores);
            print_r($error);
            die('Error');
        }

        $init_links = $this->init_links();
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al inicializar links', data: $init_links);
            print_r($error);
            die('Error');
        }
    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta = $this->init_alta();
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al inicializar alta', data: $r_alta, header: $header, ws: $ws);
        }

        $inputs = $this->inputs(keys_selects: array());
        if (errores::$error) {
            return $this->retorno_error(
                mensaje: 'Error al obtener inputs', data: $inputs, header: $header, ws: $ws);
        }

        return $r_alta;
    }

    protected function campos_view(): array
    {
        $keys = new stdClass();
        $keys->inputs = array('codigo', 'descripcion');
        $keys->selects = array();

        $campos_view = $this->campos_view_base(init_data: array(), keys: $keys);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al inicializar campo view', data: $campos_view);
        }

        return $campos_view;
    }

    public function divisiones(bool $header = true, bool $ws = false): array|string
    {
        $seccion = "cat_sat_division_producto";

        $data_view = new stdClass();
        $data_view->names = array('Id', 'Cod', 'División', 'Acciones');
        $data_view->keys_data = array($seccion . "_id", $seccion . '_codigo', $seccion . '_descripcion');
        $data_view->key_actions = 'acciones';
        $data_view->namespace_model = 'gamboamartin\\cat_sat\\models';
        $data_view->name_model_children = $seccion;

        $contenido_table = $this->contenido_children(data_view: $data_view, next_accion: __FUNCTION__);
        if (errores::$error) {
            return $this->retorno_error(
                mensaje: 'Error al obtener tbody', data: $contenido_table, header: $header, ws: $ws);
        }

        return $contenido_table;
    }

    protected function key_selects_txt(array $keys_selects): array
    {
        $keys_selects = (new \base\controller\init())->key_select_txt(cols: 4, key: 'codigo',
            keys_selects: array(), place_holder: 'Código');
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        $keys_selects = (new \base\controller\init())->key_select_txt(cols: 8, key: 'descripcion',
            keys_selects: $keys_selects, place_holder: 'Descripción');
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al maquetar key_selects', data: $keys_selects);
        }

        return $keys_selects;
    }

    private function init_configuraciones(): controler
    {
        $this->seccion_titulo = 'SAT Tipos de Productos';
        $this->titulo_lista = 'Registro de Tipos de Productos';

        return $this;
    }

    private function init_controladores(stdClass $paths_conf): controler
    {
        $this->controlador_cat_sat_division_producto = new controlador_cat_sat_division_producto(link: $this->link,
            paths_conf: $paths_conf);

        return $this;
    }

    private function init_datatable(): stdClass
    {
        $columns["cat_sat_tipo_producto_id"]["titulo"] = "Id";
        $columns["cat_sat_tipo_producto_codigo"]["titulo"] = "Código";
        $columns["cat_sat_tipo_producto_descripcion"]["titulo"] = "Tipo";
        $columns["cat_sat_tipo_producto_n_divisiones"]["titulo"] = "Divisiones";

        $filtro = array("cat_sat_tipo_producto.id", "cat_sat_tipo_producto.codigo", "cat_sat_tipo_producto.descripcion");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        return $datatables;
    }

    private function init_links(): array|string
    {
        $this->link_cat_sat_division_producto_alta_bd = $this->obj_link->link_alta_bd(link: $this->link,
            seccion: 'cat_sat_division_producto');
        if (errores::$error) {
            $error = $this->errores->error(mensaje: 'Error al obtener link',
                data: $this->link_cat_sat_division_producto_alta_bd);
            print_r($error);
            exit;
        }

        return $this->link_cat_sat_division_producto_alta_bd;
    }

    protected function inputs_children(stdClass $registro): array|stdClass
    {

        $r_template = $this->controlador_cat_sat_division_producto->alta(header: false);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al obtener template', data: $r_template);
        }

        $keys_selects = $this->controlador_cat_sat_division_producto->init_selects_inputs();
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al inicializar selects', data: $keys_selects);
        }

        $keys_selects['cat_sat_tipo_producto_id']->id_selected = $this->registro_id;
        $keys_selects['cat_sat_tipo_producto_id']->filtro = array("cat_sat_tipo_producto.id" => $this->registro_id);
        $keys_selects['cat_sat_tipo_producto_id']->disabled = true;

        $inputs = $this->controlador_cat_sat_division_producto->inputs(keys_selects: $keys_selects);
        if (errores::$error) {
            return $this->errores->error(mensaje: 'Error al obtener inputs', data: $inputs);
        }

        $this->inputs = $inputs;

        return $this->inputs;
    }

    public function modifica(bool $header, bool $ws = false): array|stdClass
    {
        $r_modifica = $this->init_modifica();
        if (errores::$error) {
            return $this->retorno_error(
                mensaje: 'Error al generar salida de template', data: $r_modifica, header: $header, ws: $ws);
        }

        $base = $this->base_upd(keys_selects: array(), not_actions: array(__FUNCTION__), params: array(),
            params_ajustados: array());
        if (errores::$error) {
            return $this->retorno_error(mensaje: 'Error al integrar base', data: $base, header: $header, ws: $ws);
        }

        return $r_modifica;
    }

}
