<?php
namespace links;
use config\generales;
use gamboamartin\errores\errores;
use stdClass;

class links_menu{
    public stdClass $links;
    private string $session_id;
    private errores $error;
    public function __construct(){
        $this->error = new errores();
        $this->links = new stdClass();
        $this->session_id = (new generales())->session_id;

        $links = $this->links();
        if(errores::$error){
            $error = $this->error->error(mensaje: 'Error al generar links', data: $links);
            print_r($error);
            die('Error');
        }

    }

    private function elimina_bd(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=elimina_bd";
    }

    private function link_elimina_bd(string $seccion): array|string
    {
        $elimina = $this->elimina_bd(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de elimina', data: $elimina);
        }

        $elimina.="&session_id=$this->session_id";
        return $elimina;
    }

    private function link_lista(string $seccion): array|string
    {
        $lista_cstp = $this->lista(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de lista', data: $lista_cstp);
        }

        $lista_cstp.="&session_id=$this->session_id";
        return $lista_cstp;
    }
    private function link_modifica(string $seccion): array|string
    {
        $modifica = $this->modifica(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica', data: $modifica);
        }

        $modifica.="&session_id=$this->session_id";
        return $modifica;
    }

    private function links(): stdClass
    {
        $this->links->cat_sat_tipo_persona = new stdClass();

        $lista_cstp = $this->link_lista(seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de lista', data: $lista_cstp);
        }
        $this->links->cat_sat_tipo_persona->lista =  $lista_cstp;

        $modifica_cstp = $this->link_modifica(seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica', data: $modifica_cstp);
        }
        $this->links->cat_sat_tipo_persona->modifica =  $modifica_cstp;

        $elimina_cstp = $this->link_elimina_bd(seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de elimina', data: $elimina_cstp);
        }
        $this->links->cat_sat_tipo_persona->elimina_bd =  $elimina_cstp;



        $this->links->adm_session = new stdClass();
        $this->links->adm_session->inicio = "./index.php?seccion=adm_session&accion=inicio";
        $this->links->adm_session->inicio.="&session_id=$this->session_id";

        return $this->links;
    }

    private function lista(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=lista";
    }
    private function modifica(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=modifica";
    }
}
