<?php
namespace controllers\base;

use gamboamartin\errores\errores;
use links\links_menu;

class actions{

    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }

    public function init_alta_bd(): array|string
    {
        $siguiente_view = (new actions())->siguiente_view();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener siguiente view', data: $siguiente_view);
        }
        $limpia_button = (new actions())->limpia_butons();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al limpiar botones', data: $limpia_button);
        }
        return $siguiente_view;
    }

    /**
     * Limpia los valores POST de botones
     * @return array
     */
    private function limpia_butons(): array
    {
        if(isset($_POST['guarda'])){
            unset($_POST['guarda']);
        }
        if(isset($_POST['guarda_otro'])){
            unset($_POST['guarda_otro']);
        }
        return $_POST;
    }

    public function retorno_alta_bd(int $registro_id, string $siguiente_view){
        $links = new links_menu(registro_id: $registro_id);
        $retorno = $links->links->cat_sat_tipo_persona->modifica;
        if($siguiente_view === 'alta'){
            $retorno = $links->links->cat_sat_tipo_persona->alta;
        }
        return $retorno;
    }

    /**
     * Determina que funcion se ejecutara despues del alta bd
     * @version 1.16.1
     * @return string
     */
    private function siguiente_view(): string
    {
        $siguiente_view = 'modifica';
        if(isset($_POST['guarda_otro'])){
            $siguiente_view = 'alta';
        }
        return $siguiente_view;
    }


}
