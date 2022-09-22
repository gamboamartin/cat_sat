<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\cat_sat_actividad_economica;
use models\cat_sat_tipo_regimen_nom;
use PDO;

class cat_sat_tipo_regimen_nom_html extends html_controler {

    public function select_cat_sat_tipo_regimen_nom_id(int $cols,bool $con_registros,int $id_selected, PDO $link): array|string
    {
        $modelo = new cat_sat_tipo_regimen_nom($link);

        $select = $this->select_catalogo(cols:$cols,con_registros:$con_registros,id_selected:$id_selected,
            modelo: $modelo,label: 'Tipo regimen nom',required: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
