<?php
namespace html\directivas;
use controllers\controlador_cat_sat_tipo_de_comprobante;
use gamboamartin\errores\errores;
use html\directivas;
use stdClass;

class cat_sat_tipo_de_comprobante_html{
    private controlador_cat_sat_tipo_de_comprobante $controler;
    private directivas $directivas;
    private errores $error;
    public function __construct(controlador_cat_sat_tipo_de_comprobante $controler){
        $this->controler = $controler;
        $this->directivas = new directivas();
        $this->error = new errores();
    }

    public function alta(): array|stdClass
    {
        $this->controler->inputs = new stdClass();


        $inputs_base = $this->inputs_base(value_vacio: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs', data: $inputs_base);
        }

        return $this->controler->inputs;
    }

    private function inputs_base(bool $value_vacio): array|stdClass
    {
        $html_codigo = $this->directivas->input_codigo(cols: 6,controler: $this->controler,value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_codigo);
        }
        $this->controler->inputs->codigo = $html_codigo;

        $html_codigo_bis = $this->directivas->input_codigo_bis(cols:6,controler: $this->controler,value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_codigo);
        }
        $this->controler->inputs->codigo_bis = $html_codigo_bis;

        $html_descripcion = $this->directivas->input_descripcion(controler: $this->controler,value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_descripcion);
        }
        $this->controler->inputs->descripcion = $html_descripcion;

        $html_alias = $this->directivas->input_alias(controler: $this->controler,value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_alias);
        }
        $this->controler->inputs->alias = $html_alias;

        $html_descripcion_select = $this->directivas->input_descripcion_select(controler: $this->controler,value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_descripcion_select);
        }
        $this->controler->inputs->descripcion_select = $html_descripcion_select;

        return $this->controler->inputs;
    }

    public function modifica(): array|stdClass
    {
        $this->controler->inputs = new stdClass();

        $html_id = $this->directivas->input_id(controler: $this->controler,value_vacio: false);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_id);
        }
        $this->controler->inputs->id = $html_id;

        $inputs_base = $this->inputs_base(value_vacio: false);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs', data: $inputs_base);
        }

        return $this->controler->inputs;
    }
}
