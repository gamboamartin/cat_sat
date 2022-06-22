<?php
namespace base;
use base\controller\controlador_base;
use gamboamartin\errores\errores;
use html\directivas;
use stdClass;

class mensajeria{

    private errores $error;

    public function __construct(){
        $this->error = new errores();
    }

    /**
     * Inicializa los mensajes a mostrar en views
     * @version 0.20.1
     * @param controlador_base $controler Controlador en ejecucion
     * @return array|stdClass
     */
    public function init_mensajes(controlador_base $controler): array|stdClass
    {
        $mensaje_exito = (new directivas())->mensaje_exito(controler: $controler);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar alerta', data: $mensaje_exito);
        }

        $mensaje_warning = (new directivas())->mensaje_warning(controler: $controler);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar alerta', data: $mensaje_warning);
        }

        $data = new stdClass();

        $data->exito = $mensaje_exito;
        $data->warning = $mensaje_warning;

        return $data;
    }

}
