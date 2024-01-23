<?php
namespace gamboamartin\cat_sat\instalacion;

use gamboamartin\cat_sat\models\cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class instalacion
{



    final public function instala(PDO $link): array|stdClass
    {

        $out = new stdClass();
        $cat_sat_tipo_persona_data = array();
        $cat_sat_tipo_persona_data[0]['id'] = 4;
        $cat_sat_tipo_persona_data[0]['descripcion'] = 'PERSONA MORAL';
        $cat_sat_tipo_persona_data[0]['codigo'] = 'PM';
        $cat_sat_tipo_persona_data[0]['PERSONA MORAL'] = 'PERSONA MORAL';

        $cat_sat_tipo_persona_data[1]['id'] = 5;
        $cat_sat_tipo_persona_data[1]['descripcion'] = 'PERSONA FISICA';
        $cat_sat_tipo_persona_data[1]['codigo'] = 'PF';
        $cat_sat_tipo_persona_data[1]['PERSONA MORAL'] = 'PERSONA FISICA';

        $cat_sat_tipo_persona_data[2]['id'] = 6;
        $cat_sat_tipo_persona_data[2]['descripcion'] = 'POR DEFINIR';
        $cat_sat_tipo_persona_data[2]['codigo'] = 'PD';
        $cat_sat_tipo_persona_data[2]['PERSONA MORAL'] = 'POR DEFINIR';

        $cat_sat_tipo_persona_modelo = new cat_sat_tipo_persona(link: $link);


        $out->cat_sat_tipo_persona = new stdClass();


        $cat_sat_tipo_persona_alta = $cat_sat_tipo_persona_modelo->inserta_registros_no_existentes_id(
            registros: $cat_sat_tipo_persona_data);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_tipo_persona', data: $out);
        }
        $out->cat_sat_tipo_persona->alta = $cat_sat_tipo_persona_alta;


        return $out;

    }

}
