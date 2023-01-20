<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\cat_sat\controllers;

use gamboamartin\cat_sat\models\cat_sat_clase_producto;
use gamboamartin\cat_sat\models\cat_sat_producto;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\cat_sat_producto_html;
use PDO;
use stdClass;

class controlador_cat_sat_producto extends _cat_sat {

    public array $keys_selects = array();

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){

        $modelo = new cat_sat_producto(link: $link);
        $html_ = new cat_sat_producto_html(html: $html);
        $obj_link = new links_menu(link: $link, registro_id: $this->registro_id);

        $columns["cat_sat_producto_id"]["titulo"] = "Id";
        $columns["cat_sat_producto_codigo"]["titulo"] = "Código";
        $columns["cat_sat_tipo_producto_descripcion"]["titulo"] = "Tipo";
        $columns["cat_sat_division_producto_descripcion"]["titulo"] = "División";
        $columns["cat_sat_grupo_producto_descripcion"]["titulo"] = "Grupo";
        $columns["cat_sat_clase_producto_descripcion"]["titulo"] = "Clase";
        $columns["cat_sat_producto_descripcion"]["titulo"] = "Producto";

        $filtro = array("cat_sat_producto.id","cat_sat_grupo_producto.descripcion",
            "cat_sat_tipo_producto.descripcion","cat_sat_division_producto.descripcion","cat_sat_producto.codigo");

        $datatables = new stdClass();
        $datatables->columns = $columns;
        $datatables->filtro = $filtro;

        parent::__construct(html:$html_, link: $link,modelo:  $modelo, obj_link: $obj_link, datatables: $datatables,
            paths_conf: $paths_conf);

        $this->titulo_lista = 'Producto';

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

    public function get_productos(bool $header, bool $ws = true): array|stdClass
    {
        $keys['cat_sat_clase_producto'] = array('id','descripcion','codigo','codigo_bis');

        $salida = $this->get_out(header: $header,keys: $keys, ws: $ws);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar salida',data:  $salida,header: $header,ws: $ws);
        }

        return $salida;
    }

    private function inicializa_propiedades(): array
    {
        $identificador = "cat_sat_tipo_producto_id";
        $propiedades = array("label" => "Tipo");
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_division_producto_id";
        $propiedades = array("label" => "División", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_grupo_producto_id";
        $propiedades = array("label" => "Grupo", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_clase_producto_id";
        $propiedades = array("label" => "Clase", "con_registros" => false);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "codigo";
        $propiedades = array("place_holder" => "Código", "cols" => 4);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "descripcion";
        $propiedades = array("place_holder" => "Producto", "cols" => 8);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        return $this->keys_selects;
    }

    public function modifica(bool $header, bool $ws = false): array|stdClass
    {
        $r_modifica =  parent::modifica(header: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_modifica, header: $header,ws:$ws);
        }

        $clase = (new cat_sat_clase_producto($this->link))->get_clase($this->row_upd->cat_sat_clase_producto_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener clase',data:  $clase);
        }

        $identificador = "cat_sat_tipo_producto_id";
        $propiedades = array("id_selected" => $clase['cat_sat_tipo_producto_id']);
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_division_producto_id";
        $propiedades = array("id_selected" => $clase['cat_sat_division_producto_id'], "con_registros" => true,
            "filtro" => array('cat_sat_tipo_producto.id' => $clase['cat_sat_tipo_producto_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_grupo_producto_id";
        $propiedades = array("id_selected" => $clase['cat_sat_grupo_producto_id'], "con_registros" => true,
            "filtro" => array('cat_sat_division_producto.id' => $clase['cat_sat_division_producto_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $identificador = "cat_sat_clase_producto_id";
        $propiedades = array("id_selected" => $this->row_upd->cat_sat_clase_producto_id, "con_registros" => true,
            "filtro" => array('cat_sat_grupo_producto.id' => $clase['cat_sat_grupo_producto_id']));
        $this->asignar_propiedad(identificador:$identificador, propiedades: $propiedades);

        $inputs = $this->genera_inputs(keys_selects:  $this->keys_selects);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar inputs',data:  $inputs);
            print_r($error);
            die('Error');
        }

        return $r_modifica;
    }
}
