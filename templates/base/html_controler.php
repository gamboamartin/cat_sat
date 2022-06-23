<?php
namespace html;
use controllers\base\system;
use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;
use stdClass;

class html_controler{
    protected directivas $directivas;
    protected system $controler;
    protected errores $error;

    public function __construct(system $controler){
        $this->directivas = new directivas();
        $this->controler = $controler;
        $this->error = new errores();
    }

    public function alta(): array|stdClass
    {
        $this->controler->inputs = new stdClass();

        $cols = new stdClass();
        $cols->codigo = 6;
        $cols->codigo_bis = 6;
        $inputs_base = $this->inputs_base(cols:$cols, value_vacio: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs', data: $inputs_base);
        }

        return $this->controler->inputs;
    }

    /**
     * @param stdClass $cols Objeto con la definicion del numero de columnas a integrar en un input base
     * @param bool $value_vacio
     * @return array|stdClass
     */
    protected function inputs_base(stdClass $cols, bool $value_vacio): array|stdClass
    {

        $keys = array('codigo','codigo_bis');
        $valida = (new validacion())->valida_existencia_keys(keys: $keys,registro:  $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }
        $valida = (new validacion())->valida_numerics(keys: $keys, row: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $html_codigo = $this->directivas->input_codigo(cols: $cols->codigo,controler: $this->controler,
            value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_codigo);
        }
        $this->controler->inputs->codigo = $html_codigo;

        $html_codigo_bis = $this->directivas->input_codigo_bis(cols: $cols->codigo_bis,
            controler: $this->controler,value_vacio: $value_vacio);
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

        $html_descripcion_select = $this->directivas->input_descripcion_select(controler: $this->controler,
            value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_descripcion_select);
        }
        $this->controler->inputs->descripcion_select = $html_descripcion_select;

        return $this->controler->inputs;
    }

    public function modifica(): array|stdClass
    {
        $this->controler->inputs = new stdClass();

        $html_id = $this->directivas->input_id(cols:4,controler: $this->controler,value_vacio: false);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html_id);
        }
        $this->controler->inputs->id = $html_id;

        $cols = new stdClass();
        $cols->codigo = 4;
        $cols->codigo_bis = 4;
        $inputs_base = $this->inputs_base(cols:$cols,value_vacio: false);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar inputs', data: $inputs_base);
        }

        return $this->controler->inputs;
    }
}
