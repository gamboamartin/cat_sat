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

    /**
     * @param string $accion Accion a ejecutar
     * @param string $etiqueta Etiqueta de boton
     * @param string $name Nombre para ser aplicado a for
     * @param string $place_holder Etiqueta a mostrar
     * @param int $registro_id Registro a mandar transaccion
     * @param string $seccion Seccion a ejecutar
     * @param string $style Estilo del boton info,danger,warning etc
     * @return array|string
     */
    private function button_href(string $accion, string $etiqueta, string $name, string $place_holder, int $registro_id,
                                 string $seccion, string $style): array|string
    {
        $label = $this->html->label(id_css: $name, place_holder: $place_holder);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $label);
        }
        $html= $this->html->button_href(accion: $accion,etiqueta:  $etiqueta, registro_id: $registro_id,
            seccion:  $seccion, style: $style);

        return $label."<div class='controls'>$html</div>";

    }

    /**
     * Genera un boton de tipo link para transaccionar status
     * @param controlador_base $controler Controlador en ejecucion
     * @param string $seccion Seccion a ejecutar
     * @return array|string
     */
    public function button_href_status(controlador_base $controler, string $seccion): array|string
    {
        $style = 'danger';
        if($controler->row_upd->status === 'activo'){
            $style = 'info';
        }
        $html = $this->button_href(accion: 'status',etiqueta: $controler->row_upd->status,name: 'status',
            place_holder: 'Status',registro_id: $controler->registro_id,seccion: $seccion, style: $style);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $html);
        }
        return $html;
    }

    public function button_href_valida_persona_fisica(controlador_base $controler): array|string
    {

        $style = 'danger';
        if($controler->row_upd->valida_persona_fisica === 'activo'){
            $style = 'info';
        }

        $html = $this->button_href(accion: 'valida_persona_fisica',etiqueta: $controler->row_upd->valida_persona_fisica
            ,name: 'valida_persona_fisica', place_holder: 'Valida persona fisica',registro_id: $controler->registro_id,
            seccion: 'cat_sat_tipo_persona', style: $style);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $html);
        }
        return $html;
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

    /**
     * Genera un mensaje de exito
     * @param controlador_base $controler Controlador en ejecucion
     * @version 0.13.0
     * @return array|string
     */
    public function mensaje_exito(controlador_base $controler): array|string
    {
        if($controler->mensaje_exito!==''){
            $alert_exito = $this->html->alert_success(mensaje: $controler->mensaje_exito);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar alerta', data: $alert_exito);
            }
            $controler->mensaje_exito = $alert_exito;
        }
        return $controler->mensaje_exito;
    }

    public function mensaje_warning(controlador_base $controler): array|string
    {
        if($controler->mensaje_warning!==''){
            $alert_warning = $this->html->alert_warning(mensaje: $controler->mensaje_warning);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar alerta', data: $alert_warning);
            }
            $controler->mensaje_warning = $alert_warning;
        }
        return $controler->mensaje_warning;
    }
}
