<?php
namespace html;
use base\orm\modelo;
use controllers\controlador_cat_sat_isn;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use PDO;
use stdClass;


class cat_sat_isn_html extends html_controler {
    private function asigna_inputs_alta(controlador_cat_sat_isn $controler, array|stdClass $inputs): array|stdClass
    {
        $controler->inputs->select = new stdClass();
        $controler->inputs->select->dp_estado_id = $inputs['selects']->dp_estado_id;

        $controler->inputs->porcentaje = $inputs['inputs']->porcentaje;

        return $controler->inputs;
    }

    public function genera_inputs_alta(controlador_cat_sat_isn $controler, modelo $modelo, PDO $link, array $keys_selects = array()): array|stdClass
    {
        $inputs = $this->init_alta2(row_upd: $controler->row_upd,modelo: $controler->modelo,link: $link,keys_selects:  $keys_selects);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs',data:  $inputs);

        }
        $inputs_asignados = $this->asigna_inputs_alta(controler:$controler, inputs: $inputs);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar inputs',data:  $inputs_asignados);
        }

        return $inputs_asignados;
    }
}
