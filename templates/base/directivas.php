<?php
namespace html;
use base\controller\controlador_base;
use gamboamartin\errores\errores;

class directivas{
    private html $html;
    private errores $error;
    public function __construct(){
        $this->html = new html();
        $this->error = new errores();
    }

    public function input_alias(controlador_base $controler): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'alias',
            place_holder: 'Alias');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    public function input_codigo(controlador_base $controler): array|string
    {

        $html =$this->input_text_required(controler: $controler,disable: false,name: 'codigo',place_holder: 'Codigo');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    public function input_codigo_bis(controlador_base $controler): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'codigo_bis',
            place_holder: 'Codigo BIS');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    public function input_descripcion(controlador_base $controler): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'descripcion',
            place_holder: 'Descripcion');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    public function input_descripcion_select(controlador_base $controler): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'descripcion_select',
            place_holder: 'Descripcion Select');
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    public function input_id(controlador_base $controler): array|string
    {
        $html =$this->input_text(controler: $controler,disable: true,name: 'id',place_holder: 'ID',
            required: false);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return $html;
    }

    private function input_text(controlador_base $controler, bool $disable, string $name, string $place_holder,
                                bool $required): array|string
    {
        $label = $this->html->label(id_css: $name, place_holder: $place_holder);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $label);
        }
        $html= $this->html->text(disabled:$disable, id_css: $name, name: $name, place_holder: $place_holder,
            required: $required, value: $controler->row_upd->$name);

        return $label."<div class='controls'>$html</div>";

    }

    private function input_text_required(controlador_base $controler, bool $disable, string $name,
                                         string $place_holder): array|string
    {
        $label = $this->html->label(id_css: $name, place_holder: $place_holder);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $label);
        }
        $html= $this->html->text(disabled:$disable, id_css: $name, name: $name, place_holder: $place_holder,
            required: true, value: $controler->row_upd->$name);

        return $label."<div class='controls'>$html</div>";

    }
}
