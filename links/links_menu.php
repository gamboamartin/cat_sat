<?php
namespace links;
use config\generales;
use gamboamartin\errores\errores;
use stdClass;

class links_menu{
    public stdClass $links;
    private string $session_id;
    private errores $error;
    public function __construct(int $registro_id){
        $this->error = new errores();
        $this->links = new stdClass();
        $this->session_id = (new generales())->session_id;

        $links = $this->links(registro_id: $registro_id);
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
    private function link_modifica(int $registro_id, string $seccion): array|string
    {
        $modifica = $this->modifica(registro_id: $registro_id, seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica', data: $modifica);
        }

        $modifica.="&session_id=$this->session_id";
        return $modifica;
    }
    private function link_modifica_bd(int $registro_id, string $seccion): array|string
    {
        $modifica = $this->modifica_bd(registro_id: $registro_id, seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica_bd', data: $modifica);
        }

        $modifica.="&session_id=$this->session_id";
        return $modifica;
    }

    private function links(int $registro_id): stdClass
    {
        $this->links->cat_sat_tipo_persona = new stdClass();

        $lista_cstp = $this->link_lista(seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de lista', data: $lista_cstp);
        }
        $this->links->cat_sat_tipo_persona->lista =  $lista_cstp;

        $modifica_cstp = $this->link_modifica(registro_id: $registro_id, seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica', data: $modifica_cstp);
        }
        $this->links->cat_sat_tipo_persona->modifica =  $modifica_cstp;


        $modifica_bd_cstp = $this->link_modifica_bd(registro_id: $registro_id, seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de modifica_bd', data: $modifica_bd_cstp);
        }
        $this->links->cat_sat_tipo_persona->modifica_bd =  $modifica_bd_cstp;


        $elimina_cstp = $this->link_elimina_bd(seccion: 'cat_sat_tipo_persona');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de elimina', data: $elimina_cstp);
        }
        $this->links->cat_sat_tipo_persona->elimina_bd =  $elimina_cstp;



        $this->links->adm_session = new stdClass();
        $this->links->adm_session->inicio = "./index.php?seccion=adm_session&accion=inicio";
        $this->links->adm_session->inicio.="&session_id=$this->session_id";

        $this->links->adm_session->logout = "./index.php?seccion=adm_session&accion=logout";
        $this->links->adm_session->logout.="&session_id=$this->session_id";

        return $this->links;
    }

    private function lista(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=lista";
    }
    private function modifica(int $registro_id, string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=modifica&registro_id=$registro_id";
    }
    private function modifica_bd(int $registro_id, string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=modifica_bd&registro_id=$registro_id";
    }
}
