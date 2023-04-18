<?php
namespace html;

use gamboamartin\cat_sat\models\cat_sat_conf_imps;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use PDO;


class cat_sat_conf_imps_html extends html_controler {

    public function select_cat_sat_conf_imps_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new cat_sat_conf_imps($link);

        $select = $this->select_catalogo(cols:$cols,con_registros:$con_registros,id_selected:$id_selected,
            modelo: $modelo, label: "Configuracion de Impuestos");
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}