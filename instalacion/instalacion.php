<?php
namespace gamboamartin\cat_sat\instalacion;

use gamboamartin\cat_sat\models\cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class instalacion
{
    private stdClass $data;

    public function __construct()
    {
        $data = $this->data();
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al incializar',data:  $data);
            print_r($error);
            exit;
        }

    }
    private function cat_sat_regimen_fiscal(): array
    {
        $cat_sat_regimen_fiscal = array();
        $cat_sat_regimen_fiscal[] = array('id'=>"601",'descripcion'=>"General de Ley Personas Morales",
            'codigo'=>"601", 'status'=>"activo",'descripcion_select'=>"601 General de Ley Personas Morales",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"603",'descripcion'=>"Personas Morales con Fines no Lucrativos",
            'codigo'=>"603", 'status'=>"activo",'descripcion_select'=>"603 Personas Morales con Fines no Lucrativos",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"605",
            'descripcion'=>"Sueldos y Salarios e Ingresos Asimilados a Salarios", 'codigo'=>"605", 'status'=>"activo",
            'descripcion_select'=>"605 Sueldos y Salarios e Ingresos Asimilados a Salarios",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"606",'descripcion'=>"Arrendamiento", 'codigo'=>"606",
            'status'=>"activo",'descripcion_select'=>"606 Arrendamiento", 'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"607",'descripcion'=>"Régimen de Enajenación o Adquisición de Bienes",
            'codigo'=>"607", 'status'=>	"activo",
            'descripcion_select'=>"607 Régimen de Enajenación o Adquisición de Bienes", 'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"608",'descripcion'=>"Demás ingresos", 'codigo'=>"608",
            'status'=>	"activo",'descripcion_select'=>"608 Demás ingresos", 'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"610",
            'descripcion'=>"Residentes en el Extranjero sin Establecimiento Permanente en México", 'codigo'=>"610",
            'status'=>"activo",
            'descripcion_select'=>"610 Residentes en el Extranjero sin Establecimiento Permanente en México",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"611",'descripcion'=>"Ingresos por Dividendos (socios y accionistas)",
            'codigo'=>"611", 'status'=>	"activo",
            'descripcion_select'=>"611 Ingresos por Dividendos (socios y accionistas)", 'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"612",
            'descripcion'=>"Personas Físicas con Actividades Empresariales y Profesionales", 'codigo'=>"612",
            'status'=>	"activo",
            'descripcion_select'=>"612 Personas Físicas con Actividades Empresariales y Profesionales",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"614",'descripcion'=>"Ingresos por intereses",
            'codigo'=>"614", 'status'=>	"activo",'descripcion_select'=>"614 Ingresos por intereses",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"615",'descripcion'=>"Régimen de los ingresos por obtención de premios",
            'codigo'=>"615", 'status'=>	"activo",
            'descripcion_select'=>"615 Régimen de los ingresos por obtención de premios", 'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"616",'descripcion'=>"Sin obligaciones fiscales",
            'codigo'=>"616"	, 'status'=>"activo",'descripcion_select'=>"616 Sin obligaciones fiscales",
            'predeterminado'=>"activo");
        $cat_sat_regimen_fiscal[] = array('id'=>"620",
            'descripcion'=>"Sociedades Cooperativas de Producción que optan por diferir sus ingresos",
            'codigo'=>"620", 'status'=>	"activo",
            'descripcion_select'=>"620 Sociedades Cooperativas de Producción que optan por diferir sus ingresos",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"621",'descripcion'=>"Incorporación Fiscal",
            'codigo'=>"621", 'status'=>	"activo",'descripcion_select'=>"621 Incorporación Fiscal",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"622",
            'descripcion'=>"Actividades Agrícolas	 Ganaderas	 Silvícolas y Pesqueras",
            'codigo'=>"622", 'status'=>	"activo",
            'descripcion_select'=>"622 Actividades Agrícolas	 Ganaderas	 Silvícolas y Pesqueras",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"623",'descripcion'=>"Opcional para Grupos de Sociedades",
            'codigo'=>"623", 'status'=>	"activo",'descripcion_select'=>"623 Opcional para Grupos de Sociedades",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"624",'descripcion'=>"Coordinados",
            'codigo'=>"624", 'status'=>	"activo",'descripcion_select'=>"624 Coordinados",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"625",
            'descripcion'=>"Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas",
            'codigo'=>"625", 'status'=>	"activo",
            'descripcion_select'=>
                "625 Régimen de las Actividades Empresariales con ingresos a través de Plataformas Tecnológicas",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"626",'descripcion'=>"Régimen Simplificado de Confianza",
            'codigo'=>"626", 'status'=>	"activo",'descripcion_select'=>"626 Régimen Simplificado de Confianza",
            'predeterminado'=>"inactivo");
        $cat_sat_regimen_fiscal[] = array('id'=>"999",'descripcion'=>"POR DEFINIR", 'codigo'=>"999",
            'status'=>	"activo",'descripcion_select'=>"999 POR DEFINIR", 'predeterminado'=>"inactivo");


        return $cat_sat_regimen_fiscal;

    }


    private function cat_sat_tipo_persona(): array
    {
        $cat_sat_tipo_persona = array();
        $cat_sat_tipo_persona[0]['id'] = 4;
        $cat_sat_tipo_persona[0]['descripcion'] = 'PERSONA MORAL';
        $cat_sat_tipo_persona[0]['codigo'] = 'PM';
        $cat_sat_tipo_persona[0]['PERSONA MORAL'] = 'PERSONA MORAL';

        $cat_sat_tipo_persona[1]['id'] = 5;
        $cat_sat_tipo_persona[1]['descripcion'] = 'PERSONA FISICA';
        $cat_sat_tipo_persona[1]['codigo'] = 'PF';
        $cat_sat_tipo_persona[1]['PERSONA MORAL'] = 'PERSONA FISICA';

        $cat_sat_tipo_persona[2]['id'] = 6;
        $cat_sat_tipo_persona[2]['descripcion'] = 'POR DEFINIR';
        $cat_sat_tipo_persona[2]['codigo'] = 'PD';
        $cat_sat_tipo_persona[2]['PERSONA MORAL'] = 'POR DEFINIR';


        return $cat_sat_tipo_persona;

    }


    private function data(): stdClass|array
    {
        $this->data = new stdClass();

        $cat_sat_tipo_persona = $this->cat_sat_tipo_persona();
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al obtener cat_sat_tipo_persona', data: $cat_sat_tipo_persona);
        }

        $this->data->cat_sat_tipo_persona = $cat_sat_tipo_persona;

        $cat_sat_regimen_fiscal = $this->cat_sat_regimen_fiscal();
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al obtener cat_sat_regimen_fiscal', data: $cat_sat_regimen_fiscal);
        }

        $this->data->cat_sat_regimen_fiscal = $cat_sat_regimen_fiscal;

        return $this->data;

    }



    final public function instala(PDO $link): array|stdClass
    {

        $out = new stdClass();

        $cat_sat_tipo_persona_modelo = new cat_sat_tipo_persona(link: $link);

        $out->cat_sat_tipo_persona = new stdClass();
        $cat_sat_tipo_persona_alta = $cat_sat_tipo_persona_modelo->inserta_registros_no_existentes_id(
            registros: $this->data->cat_sat_tipo_persona);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_tipo_persona', data: $out);
        }
        $out->cat_sat_tipo_persona->alta = $cat_sat_tipo_persona_alta;

        $out->cat_sat_regimen_fiscal = new stdClass();
        $cat_sat_regimen_fiscal = $cat_sat_tipo_persona_modelo->inserta_registros_no_existentes_id(
            registros: $this->data->cat_sat_regimen_fiscal);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_regimen_fiscal', data: $out);
        }
        $out->cat_sat_regimen_fiscal->alta = $cat_sat_regimen_fiscal;


        return $out;

    }

}
