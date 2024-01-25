<?php
namespace gamboamartin\cat_sat\instalacion;

use gamboamartin\administrador\models\_instalacion;
use gamboamartin\cat_sat\models\cat_sat_clase_producto;
use gamboamartin\cat_sat\models\cat_sat_conf_reg_tp;
use gamboamartin\cat_sat\models\cat_sat_division_producto;
use gamboamartin\cat_sat\models\cat_sat_grupo_producto;
use gamboamartin\cat_sat\models\cat_sat_producto;
use gamboamartin\cat_sat\models\cat_sat_regimen_fiscal;
use gamboamartin\cat_sat\models\cat_sat_tipo_persona;
use gamboamartin\cat_sat\models\cat_sat_tipo_producto;
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

    private function cat_sat_clase_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_clase_producto_modelo = new cat_sat_clase_producto(link: $link);

        $cat_sat_clase_productos = array();
        $cat_sat_clase_productos[0]['id'] = 841115;
        $cat_sat_clase_productos[0]['descripcion'] = 'Servicios contables (Honorarios contables)';
        $cat_sat_clase_productos[0]['codigo'] = '841115';
        $cat_sat_clase_productos[0]['descripcion_select'] = '841115 Servicios Contables (Honorarios Contables)';
        $cat_sat_clase_productos[0]['cat_sat_grupo_producto_id'] = '8411';


        $out->cat_sat_clase_productos = $cat_sat_clase_productos;

        foreach ($cat_sat_clase_productos as $cat_sat_clase_producto){
            $existe = $cat_sat_clase_producto_modelo->existe_by_id(registro_id: $cat_sat_clase_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe clase de producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_clase_producto_modelo->alta_registro(registro: $cat_sat_clase_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar clase de producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

    }

    private function cat_sat_conf_reg_tp(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_conf_reg_tp_modelo = new cat_sat_conf_reg_tp(link: $link);

        $cat_sat_conf_reg_tps = array();
        $cat_sat_conf_reg_tps[0]['id'] = 1;
        $cat_sat_conf_reg_tps[0]['cat_sat_tipo_persona_id'] = '4';
        $cat_sat_conf_reg_tps[0]['cat_sat_regimen_fiscal_id'] = '601';

        $cat_sat_conf_reg_tps[1]['id'] = 2;
        $cat_sat_conf_reg_tps[1]['cat_sat_tipo_persona_id'] = '4';
        $cat_sat_conf_reg_tps[1]['cat_sat_regimen_fiscal_id'] = '603';

        $cat_sat_conf_reg_tps[2]['id'] = 3;
        $cat_sat_conf_reg_tps[2]['cat_sat_tipo_persona_id'] = '5';
        $cat_sat_conf_reg_tps[2]['cat_sat_regimen_fiscal_id'] = '605';

        $cat_sat_conf_reg_tps[3]['id'] = 4;
        $cat_sat_conf_reg_tps[3]['cat_sat_tipo_persona_id'] = '5';
        $cat_sat_conf_reg_tps[3]['cat_sat_regimen_fiscal_id'] = '612';

        $cat_sat_conf_reg_tps[4]['id'] = 5;
        $cat_sat_conf_reg_tps[4]['cat_sat_tipo_persona_id'] = '4';
        $cat_sat_conf_reg_tps[4]['cat_sat_regimen_fiscal_id'] = '626';

        $cat_sat_conf_reg_tps[5]['id'] = 6;
        $cat_sat_conf_reg_tps[5]['cat_sat_tipo_persona_id'] = '5';
        $cat_sat_conf_reg_tps[5]['cat_sat_regimen_fiscal_id'] = '626';

        $cat_sat_conf_reg_tps[6]['id'] = 7;
        $cat_sat_conf_reg_tps[6]['cat_sat_tipo_persona_id'] = '4';
        $cat_sat_conf_reg_tps[6]['cat_sat_regimen_fiscal_id'] = '622';

        $cat_sat_conf_reg_tps[7]['id'] = 8;
        $cat_sat_conf_reg_tps[7]['cat_sat_tipo_persona_id'] = '4';
        $cat_sat_conf_reg_tps[7]['cat_sat_regimen_fiscal_id'] = '623';


        $out->cat_sat_conf_reg_tps = $cat_sat_conf_reg_tps;

        foreach ($cat_sat_conf_reg_tps as $cat_sat_conf_reg_tp){
            $existe = $cat_sat_conf_reg_tp_modelo->existe_by_id(registro_id: $cat_sat_conf_reg_tp['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe cat_sat_conf_reg_tp', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_conf_reg_tp_modelo->alta_registro(registro: $cat_sat_conf_reg_tp);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar cat_sat_conf_reg_tp', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

    }
    private function cat_sat_division_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_division_producto_modelo = new cat_sat_division_producto(link: $link);

        $cat_sat_division_productos = array();
        $cat_sat_division_productos[0]['id'] = 84;
        $cat_sat_division_productos[0]['descripcion'] = 'Servicios Financieros y de Seguros';
        $cat_sat_division_productos[0]['codigo'] = '84';
        $cat_sat_division_productos[0]['descripcion_select'] = '84 Servicios Financieros y de Seguros';
        $cat_sat_division_productos[0]['cat_sat_tipo_producto_id'] = '2';


        foreach ($cat_sat_division_productos as $cat_sat_division_producto){
            $existe = $cat_sat_division_producto_modelo->existe_by_id(registro_id: $cat_sat_division_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe cat_sat_division_producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_division_producto_modelo->alta_registro(registro: $cat_sat_division_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar cat_sat_division_producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

    }
    private function cat_sat_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_producto_modelo = new cat_sat_producto(link: $link);

        $cat_sat_productos = array();
        $cat_sat_productos[0]['id'] = 84111506;
        $cat_sat_productos[0]['descripcion'] = 'Servicios de facturación';
        $cat_sat_productos[0]['codigo'] = '84111506';
        $cat_sat_productos[0]['descripcion_select'] = '84111506 Servicios De Facturación';
        $cat_sat_productos[0]['cat_sat_clase_producto_id'] = '841115';


        $out->cat_sat_productos = $cat_sat_productos;

        foreach ($cat_sat_productos as $cat_sat_producto){
            $existe = $cat_sat_producto_modelo->existe_by_id(registro_id: $cat_sat_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_producto_modelo->alta_registro(registro: $cat_sat_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

    }

   /* private function cat_sat_producto_del(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $ins = new _instalacion(link: $link);

        $create_table = $ins->create_table_new(table: __FUNCTION__);
        if(errores::$error){
            return (new errores())->error(mensaje: 'Error al crear table', data: $create_table);
        }


        //$cat_sat_producto_def_modelo = new cat_sat_producto_def(link: $link);

        $cat_sat_productos = array();
        $cat_sat_productos[0]['id'] = 84111506;
        $cat_sat_productos[0]['descripcion'] = 'Servicios de facturación';
        $cat_sat_productos[0]['codigo'] = '84111506';
        $cat_sat_productos[0]['descripcion_select'] = '84111506 Servicios De Facturación';
        $cat_sat_productos[0]['cat_sat_clase_producto_id'] = '841115';


        $out->cat_sat_productos = $cat_sat_productos;

        foreach ($cat_sat_productos as $cat_sat_producto){
            $existe = $cat_sat_producto_modelo->existe_by_id(registro_id: $cat_sat_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_producto_modelo->alta_registro(registro: $cat_sat_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

    }

   */
    private function cat_sat_grupo_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_grupo_producto_modelo = new cat_sat_grupo_producto(link: $link);

        $cat_sat_grupo_productos = array();
        $cat_sat_grupo_productos[0]['id'] = 8411;
        $cat_sat_grupo_productos[0]['descripcion'] = 'Servicios de contabilidad y auditorias';
        $cat_sat_grupo_productos[0]['codigo'] = '8411';
        $cat_sat_grupo_productos[0]['descripcion_select'] = '8411 Servicios De Contabilidad Y Auditorias';
        $cat_sat_grupo_productos[0]['cat_sat_division_producto_id'] = '84';


        foreach ($cat_sat_grupo_productos as $cat_sat_grupo_producto){
            $existe = $cat_sat_grupo_producto_modelo->existe_by_id(registro_id: $cat_sat_grupo_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe cat_sat_grupo_producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_grupo_producto_modelo->alta_registro(registro: $cat_sat_grupo_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar cat_sat_grupo_producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

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


        $cat_sat_tipo_persona[1]['id'] = 5;
        $cat_sat_tipo_persona[1]['descripcion'] = 'PERSONA FISICA';
        $cat_sat_tipo_persona[1]['codigo'] = 'PF';


        $cat_sat_tipo_persona[2]['id'] = 6;
        $cat_sat_tipo_persona[2]['descripcion'] = 'POR DEFINIR';
        $cat_sat_tipo_persona[2]['codigo'] = 'PD';



        return $cat_sat_tipo_persona;

    }
    private function cat_sat_tipo_producto(PDO $link): array|stdClass
    {
        $out = new stdClass();
        $cat_sat_tipo_producto_modelo = new cat_sat_tipo_producto(link: $link);

        $cat_sat_tipo_productos = array();
        $cat_sat_tipo_productos[0]['id'] = 1;
        $cat_sat_tipo_productos[0]['descripcion'] = 'Productos';
        $cat_sat_tipo_productos[0]['codigo'] = 'Productos';
        $cat_sat_tipo_productos[0]['descripcion_select'] = 'Productos';


        $cat_sat_tipo_productos[1]['id'] = 2;
        $cat_sat_tipo_productos[1]['descripcion'] = 'Servicios';
        $cat_sat_tipo_productos[1]['codigo'] = 'Servicios';
        $cat_sat_tipo_productos[1]['descripcion_select'] = 'Servicios';
        $out->cat_sat_tipo_productos = $cat_sat_tipo_productos;

        foreach ($cat_sat_tipo_productos as $cat_sat_tipo_producto){
            $existe = $cat_sat_tipo_producto_modelo->existe_by_id(registro_id: $cat_sat_tipo_producto['id']);
            if(errores::$error){
                return (new errores())->error(mensaje: 'Error al validar si existe tipo de producto', data: $existe);
            }
            $out->existe = $existe;
            if(!$existe){
                $alta = $cat_sat_tipo_producto_modelo->alta_registro(registro: $cat_sat_tipo_producto);
                if(errores::$error){
                    return (new errores())->error(mensaje: 'Error al insertar tipo de producto', data: $alta);
                }
                $out->altas[] = $alta;
            }
        }

        return $out;

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
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_tipo_persona', data: $cat_sat_tipo_persona_alta);
        }
        $out->cat_sat_tipo_persona->alta = $cat_sat_tipo_persona_alta;

        $cat_sat_regimen_fiscal_modelo = new cat_sat_regimen_fiscal(link: $link);
        $out->cat_sat_regimen_fiscal = new stdClass();
        $cat_sat_regimen_fiscal = $cat_sat_regimen_fiscal_modelo->inserta_registros_no_existentes_id(
            registros: $this->data->cat_sat_regimen_fiscal);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_regimen_fiscal', data: $cat_sat_regimen_fiscal);
        }
        $out->cat_sat_regimen_fiscal->alta = $cat_sat_regimen_fiscal;

        $cat_sat_tipo_producto = $this->cat_sat_tipo_producto(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_tipo_producto', data: $cat_sat_tipo_producto);
        }
        $out->cat_sat_tipo_producto = $cat_sat_tipo_producto;

        $cat_sat_division_producto = $this->cat_sat_division_producto(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_division_producto', data: $cat_sat_division_producto);
        }
        $out->cat_sat_division_producto = $cat_sat_division_producto;

        $cat_sat_grupo_producto = $this->cat_sat_grupo_producto(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_grupo_producto', data: $cat_sat_grupo_producto);
        }
        $out->cat_sat_grupo_producto = $cat_sat_grupo_producto;

        $cat_sat_clase_producto = $this->cat_sat_clase_producto(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_clase_producto', data: $cat_sat_clase_producto);
        }
        $out->cat_sat_clase_producto = $cat_sat_clase_producto;

        $cat_sat_producto = $this->cat_sat_producto(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_producto', data: $cat_sat_producto);
        }
        $out->cat_sat_producto = $cat_sat_producto;

        $cat_sat_conf_reg_tp = $this->cat_sat_conf_reg_tp(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_conf_reg_tp', data: $cat_sat_conf_reg_tp);
        }
        $out->cat_sat_conf_reg_tp = $cat_sat_conf_reg_tp;

        /*$cat_sat_producto_def = $this->cat_sat_producto_def(link: $link);
        if (errores::$error) {
            return (new errores())->error(mensaje: 'Error al insertar cat_sat_producto_def', data: $cat_sat_producto_def);
        }
        $out->cat_sat_producto_def = $cat_sat_producto_def;*/


        return $out;

    }

}
