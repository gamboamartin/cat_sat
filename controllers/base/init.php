<?php
namespace controllers\base;
use base\mensajeria;
use gamboamartin\errores\errores;
use links\links_menu;
use stdClass;

class init{
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }

    private function data_key_row_lista(string $campo_puro, string $tabla): array|stdClass
    {
        $key_value = $this->key_value_campo(campo_puro: $campo_puro, tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar key value lista', data: $key_value);
        }

        $name_lista = $this->name_lista(campo_puro: $campo_puro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar $name_lista', data: $name_lista);
        }
        $data = new stdClass();
        $data->key_value = $key_value;
        $data->name_lista = $name_lista;
        return $data;
    }

    private function genera_key_row_lista(string $key_value, string $name_lista): stdClass
    {
        $keys_row_lista = new stdClass();
        $keys_row_lista->campo = $key_value;
        $keys_row_lista->name_lista = $name_lista;

        return $keys_row_lista;
    }

    private function init_acciones_base(system $controller): stdClass
    {
        $controller->acciones = new stdClass();
        $controller->acciones->modifica = new stdClass();
        $controller->acciones->elimina_bd = new stdClass();

        $controller->acciones->modifica->style = 'info';
        $controller->acciones->modifica->style_status = false;

        $controller->acciones->elimina_bd->style = 'danger';
        $controller->acciones->elimina_bd->style_status = false;

        return $controller->acciones;
    }

    public function init_controller(system $controller): array|stdClass
    {
        $init_msj = (new mensajeria())->init_mensajes(controler: $controller);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar mensajes', data: $init_msj);
        }

        $init_links = (new links_menu(registro_id: $controller->registro_id))->init_link_controller(
            controler: $controller);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar links', data: $init_links);
        }

        $init_acciones = $this->init_acciones_base(controller:$controller);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar acciones', data: $init_acciones);
        }


        $data = new stdClass();
        $data->msj = $init_msj;
        $data->links = $init_links;
        return $data;
    }

    public function key_row_lista(string $campo_puro, string $tabla): array|stdClass
    {
        $data_key_row_lista = $this->data_key_row_lista(campo_puro: $campo_puro, tabla: $tabla);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar $data_key_row_lista', data: $data_key_row_lista);
        }

        $key_row_lista = $this->genera_key_row_lista(key_value: $data_key_row_lista->key_value,name_lista:  $data_key_row_lista->name_lista);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar $keys_row_lista', data: $key_row_lista);
        }
        return $key_row_lista;
    }

    public function keys_row_lista(system $controler): array
    {

        foreach ($controler->rows_lista as $row){

            $key_row_lista = (new init())->key_row_lista(campo_puro: $row, tabla: $controler->tabla);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al inicializar $key_row_lista', data: $key_row_lista);
            }

            $controler->keys_row_lista[] = $key_row_lista;

        }
        return $controler->keys_row_lista;
    }

    private function name_lista(string $campo_puro): string
    {
        $name_lista = str_replace('_', ' ', $campo_puro);
        return ucwords($name_lista);
    }

    private function key_value_campo(string $campo_puro, string $tabla): string
    {
        return $tabla.'_'.$campo_puro;
    }


}
