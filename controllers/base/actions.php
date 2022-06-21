<?php
namespace controllers\base;

use gamboamartin\errores\errores;
use links\links_menu;
use stdClass;

class actions{

    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }


    private function asigna_link_row(string $accion, int $indice, string $link, array $registros_view, stdClass $row): array
    {
        $name_link = 'link_'.$accion;
        $row->$name_link = $link;
        $registros_view[$indice] = $row;
        return $registros_view;
    }

    private function asigna_link_rows(string $accion, int $indice, array $registros_view, stdClass $row, string $seccion): array
    {
        $key_id = $this->key_id(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener key id', data:  $key_id);
        }
        $link = $this->link_accion(accion: $accion,key_id:  $key_id,row:  $row,seccion:  $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar link', data:  $link);
        }

        $registros_view = $this->asigna_link_row(accion: $accion,indice:  $indice,
            link:  $link,registros_view:  $registros_view,row:  $row);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar link', data:  $registros_view);
        }
        return $registros_view;
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

    private function genera_link_row(string $accion, array $registros, array $registros_view, string $seccion): array
    {
        foreach ($registros as $indice=>$row){
            $registros_view = $this->asigna_link_rows(accion: $accion,indice:  $indice,
                registros_view: $registros_view,row:  $row, seccion: $seccion);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al asignar link', data:  $registros_view);
            }
        }
        return $registros_view;
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

    private function link_accion(string $accion, string $key_id , stdClass $row, string $seccion){
        return (new links_menu(registro_id: $row->$key_id))->links->$seccion->$accion;
    }

    private function key_id(string $seccion): string
    {

        return $seccion.'_id';
    }

    public function registros_view_actions(array $acciones, array $registros, string $seccion): array
    {
        $registros_view = array();
        foreach ($acciones as $accion){
            $registros_view = $this->genera_link_row(accion: $accion,registros:  $registros,
                registros_view: $registros_view,seccion:  $seccion);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al asignar link', data:  $registros_view);
            }
        }
        return $registros_view;
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
