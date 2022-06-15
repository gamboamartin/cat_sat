<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use base\controller\controlador_base;
use gamboamartin\errores\errores;
use models\cat_sat_tipo_persona;
use PDO;
use stdClass;

class controlador_cat_sat_tipo_persona extends controlador_base {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_tipo_persona(link: $link);
        parent::__construct(link: $link,modelo:  $modelo, paths_conf: $paths_conf);
    }

    /**
     * Genera la lista mostrable en la accion de cat_sat_tipo_persona / lista
     * @version 0.5.0
     * @param bool $header if header se ejecuta en html
     * @param bool $ws retorna webservice
     * @return array
     */
    public function lista(bool $header, bool $ws = false): array
    {
        $cat_sat_tipos_persona = $this->modelo->registros(return_obj: true);

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener registros',
                data:  $cat_sat_tipos_persona, header: $header, ws: $ws);
        }

        $this->registros = $cat_sat_tipos_persona;
        $this->titulo_lista = 'Tipos persona';

        return $this->registros;
    }

    public function opciones(bool $header, bool $ws){

    }




}
