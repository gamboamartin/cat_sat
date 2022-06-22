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
        $data = new stdClass();
        $data->msj = $init_msj;
        $data->links = $init_links;
        return $data;
    }
}
