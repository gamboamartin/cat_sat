<?php
namespace html;

use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use models\cat_sat_regimen_fiscal;
use PDO;


class cat_sat_regimen_fiscal_html extends html_controler {

    public function select_cat_sat_regimen_fiscal_id(int $cols, bool $con_registros, int $id_selected, PDO $link): array|string
    {
        $modelo = new cat_sat_regimen_fiscal($link);

        $select = $this->select_catalogo(cols:$cols,con_registros:$con_registros,id_selected:$id_selected, modelo: $modelo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }

}
