<?php
namespace links;
use config\generales;
use controllers\base\system;
use gamboamartin\errores\errores;
use stdClass;

class links_menu{
    public stdClass $links;
    protected string $session_id;
    protected errores $error;
    private array $secciones;
    public function __construct(int $registro_id){
        $this->error = new errores();
        $this->links = new stdClass();
        $this->session_id = (new generales())->session_id;


        $this->secciones[] = 'cat_sat_tipo_de_comprobante';
        $this->secciones[] = 'cat_sat_tipo_persona';


        $links = $this->links(registro_id: $registro_id);
        if(errores::$error){
            $error = $this->error->error(mensaje: 'Error al generar links', data: $links);
            print_r($error);
            die('Error');
        }

    }

    /**
     * Genera un link de alta
     * @version 0.14.0
     * @param string $seccion Seccion en ejecucion
     * @return string|array
     */
    private function alta(string $seccion): string|array
    {
        $seccion = trim($seccion);
        if($seccion === ''){
            return $this->error->error(mensaje: 'Error seccion esta vacia', data:$seccion);
        }
        return "./index.php?seccion=$seccion&accion=alta";
    }

    private function alta_bd(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=alta_bd";
    }

    private function altas(): array|stdClass
    {

        $links = $this->links_sin_id(accion: 'alta');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $links);
        }


        return $this->links;
    }

    private function altas_bd(): array|stdClass
    {
        $links = $this->links_sin_id(accion: 'alta_bd');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $links);
        }

        return $this->links;
    }

    private function con_id(string $accion, int $registro_id, string $seccion): array|stdClass
    {
        $function = 'link_'.$accion;
        $link = $this->$function(registro_id: $registro_id, seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de elimina bd', data: $link);
        }

        $init = $this->init_action(accion: $accion,link: $link,seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
        }
        return $init;
    }

    private function elimina_bd(int $registro_id, string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=elimina_bd&registro_id=$registro_id";
    }

    private function eliminas_bd(int $registro_id): array|stdClass
    {
        $init = $this->links_con_id(accion: 'elimina_bd',registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
        }

        return $this->links;
    }

    private function init_action(string $accion, string $link, string $seccion): stdClass
    {
        if(!isset($this->links->$seccion)){
            $this->links->$seccion = new stdClass();
        }
        $this->links->$seccion->$accion =  $link;
        return $this->links;
    }

    /**
     * Genera y asigna los links basicos para views de controller
     * @version v0.21.2
     * @param system $controler Controlador en ejecucion
     * @return stdClass
     */
    public function init_link_controller(system $controler): stdClass
    {
        $seccion = $controler->seccion;
        $controler->link_alta = $this->links->$seccion->alta;
        $controler->link_alta_bd = $this->links->$seccion->alta_bd;
        $controler->link_elimina_bd = $this->links->$seccion->elimina_bd;
        $controler->link_lista = $this->links->$seccion->lista;
        $controler->link_modifica = $this->links->$seccion->modifica;
        $controler->link_modifica_bd = $this->links->$seccion->modifica_bd;
        return $this->links;
    }

    /**
     * Genera un link de tipo alta
     * @version 0.18.1
     * @param string $seccion Seccion a inicializar el link
     * @return array|string
     */
    private function link_alta(string $seccion): array|string
    {
        $seccion = trim($seccion);
        if($seccion === ''){
            return $this->error->error(mensaje: 'Error seccion esta vacia', data:$seccion);
        }
        $this->session_id = trim($this->session_id);
        if($this->session_id === ''){
            return $this->error->error(mensaje: 'Error links_menu->session_id esta vacio', data: $this->session_id);
        }

        $alta = $this->alta( seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de alta', data: $alta);
        }

        $alta.="&session_id=$this->session_id";
        return $alta;
    }

    private function link_alta_bd(string $seccion): array|string
    {
        $alta_bd = $this->alta_bd(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de alta_bd', data: $alta_bd);
        }

        $alta_bd.="&session_id=$this->session_id";
        return $alta_bd;
    }

    private function link_elimina_bd(int $registro_id, string $seccion): array|string
    {
        $elimina = $this->elimina_bd(registro_id: $registro_id, seccion: $seccion);
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

    protected function links(int $registro_id): stdClass|array
    {

        $listas  = $this->listas();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar listas', data: $listas);
        }
        $modificas  = $this->modificas(registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar modificas', data: $modificas);
        }
        $altas  = $this->altas();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar altas', data: $altas);
        }

        $altas_bd  = $this->altas_bd();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar altas bd', data: $altas_bd);
        }

        $modificas_bd  = $this->modificas_bd(registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar modificas bd', data: $modificas_bd);
        }

        $eliminas_bd  = $this->eliminas_bd(registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar eliminas bd', data: $eliminas_bd);
        }


        $this->links->adm_session = new stdClass();
        $this->links->adm_session->inicio = "./index.php?seccion=adm_session&accion=inicio";
        $this->links->adm_session->inicio.="&session_id=$this->session_id";

        $this->links->adm_session->logout = "./index.php?seccion=adm_session&accion=logout";
        $this->links->adm_session->logout.="&session_id=$this->session_id";

        return $this->links;
    }

    private function links_con_id(string $accion, int $registro_id): array|stdClass
    {
        foreach ($this->secciones as $seccion){

            $init = $this->con_id(accion: $accion,registro_id: $registro_id,seccion: $seccion);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
            }

        }
        return $this->links;
    }

    private function links_sin_id(string $accion): array|stdClass
    {
        foreach ($this->secciones as $seccion){

            $init = $this->sin_id(seccion: $seccion,accion: $accion);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
            }
        }
        return $this->links;
    }

    private function lista(string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=lista";
    }

    private function listas(): array|stdClass
    {

        $links = $this->links_sin_id(accion: 'lista');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $links);
        }

        return $this->links;

    }

    private function modifica(int $registro_id, string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=modifica&registro_id=$registro_id";
    }

    private function modifica_bd(int $registro_id, string $seccion): string
    {
        return "./index.php?seccion=$seccion&accion=modifica_bd&registro_id=$registro_id";
    }

    private function modificas(int $registro_id): array|stdClass
    {

        $init = $this->links_con_id(accion: 'modifica',registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
        }
        return $this->links;
    }

    private function modificas_bd(int $registro_id): array|stdClass
    {

        $init = $this->links_con_id(accion: 'modifica_bd',registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
        }
        return $this->links;
    }

    private function sin_id(string $seccion, string $accion): array|stdClass
    {
        $function_link = 'link_'.$accion;

        $link_accion = $this->$function_link(seccion: $seccion);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al obtener link de '.$accion, data: $link_accion);
        }

        $init = $this->init_action(accion: $accion, link: $link_accion, seccion: $seccion);
        if (errores::$error) {
            return $this->error->error(mensaje: 'Error al inicializa link', data: $init);
        }

        return $init;

    }
}
