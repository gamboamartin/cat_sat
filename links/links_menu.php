<?php
namespace links;
use config\generales;
use gamboamartin\errores\errores;
use stdClass;

class links_menu{
    public stdClass $links;
    private string $session_id;
    public function __construct(){
        $this->links = new stdClass();
        $this->session_id = (new generales())->session_id;

        $links = $this->links();
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al generar links', data: $links);
            print_r($error);
            die('Error');
        }

    }
    private function links(): stdClass
    {
        $this->links->cat_sat_tipo_persona = "./index.php?seccion=cat_sat_tipo_persona&accion=lista";
        $this->links->cat_sat_tipo_persona.="&session_id=$this->session_id";

        $this->links->adm_session = "./index.php?seccion=adm_session&accion=inicio";
        $this->links->adm_session.="&session_id=$this->session_id";

        return $this->links;
    }
}
