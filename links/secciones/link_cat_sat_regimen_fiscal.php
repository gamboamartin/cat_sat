<?php
namespace links\secciones;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use PDO;
use stdClass;

class link_cat_sat_regimen_fiscal extends links_menu {
    public stdClass $links;


    private function link_nuevo_regimen_fiscal(): array|string
    {
        $nuevo_regimen_fiscal = $this->nuevo_regimen_fiscal();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de nuevo_regimen_fiscal',
                data: $nuevo_regimen_fiscal);
        }

        $nuevo_regimen_fiscal.="&session_id=$this->session_id";
        return $nuevo_regimen_fiscal;
    }

    protected function links(PDO $link, int $registro_id): stdClass|array
    {

        $links =  parent::links(link: $link, registro_id: $registro_id); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar links', data: $links);
        }

        $nuevo_regimen_fiscal = $this->link_nuevo_regimen_fiscal();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar link', data: $nuevo_regimen_fiscal);
        }
        

        return $links;
    }

    /**
     * Genera un link de alta a regimen fiscal
     * @return string
     * @version 0.34.2
     */
    private function nuevo_regimen_fiscal(): string
    {
        return "./index.php?seccion=cat_sat_regimen_fiscal&accion=alta";
    }



}
