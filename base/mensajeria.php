<?php
/**
 * Inicializa los mensajes de error warning etc definido sen variable SESSION[mensajes]
 * @author Martin Gamboa Vazquez
 * @version 0.21.2
 */
namespace base;
use controllers\base\system;
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
     * @param system $controler Controlador en ejecucion
     * @return array|stdClass
     * @version 0.20.1
     */
    public function init_mensajes(system $controler): array|stdClass
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
