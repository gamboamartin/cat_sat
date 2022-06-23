<?php
namespace html;
use config\generales;
use controllers\base\system;
use gamboamartin\errores\errores;
use links\links_menu;
use stdClass;

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
     * @param int $cols Columnas en formato css de 1 a 12
     * @param system $controler Controlador en ejecucion
     * @param string $seccion Seccion a ejecutar
     * @return array|string
     */
    public function button_href_status(int $cols, system $controler, string $seccion): array|string
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

        return "<div class='control-group col-sm-$cols'>$html</div>";
    }

    public function button_href_valida_persona_fisica(system $controler): array|string
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

    /**
     * @param system $controler Controlador en ejecucion
     * @param bool $value_vacio
     * @return array|string
     */
    public function input_alias(system $controler, bool $value_vacio): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'alias',
            place_holder: 'Alias', value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return "<div class='control-group col-sm-6'>$html</div>";
    }

    public function input_codigo(int $cols, system $controler, bool $value_vacio): array|string
    {

        $html =$this->input_text_required(controler: $controler,disable: false,name: 'codigo',place_holder: 'Codigo',
            value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return "<div class='control-group col-sm-$cols'>$html</div>";
    }

    public function input_codigo_bis(int $cols, system $controler, bool $value_vacio): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'codigo_bis',
            place_holder: 'Codigo BIS', value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }

        return "<div class='control-group col-sm-$cols'>$html</div>";

    }

    public function input_descripcion(system $controler, bool $value_vacio): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'descripcion',
            place_holder: 'Descripcion', value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return "<div class='control-group col-sm-12'>$html</div>";

    }

    public function input_descripcion_select(system $controler, bool $value_vacio): array|string
    {
        $html =$this->input_text_required(controler: $controler,disable: false,name: 'descripcion_select',
            place_holder: 'Descripcion Select', value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }
        return "<div class='control-group col-sm-6'>$html</div>";
    }

    public function input_id(int $cols, system $controler, bool $value_vacio): array|string
    {
        $html =$this->input_text(controler: $controler,disable: true,name: 'id',place_holder: 'ID',
            required: false, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar input', data: $html);
        }

        return "<div class='control-group col-sm-$cols'>$html</div>";
    }

    private function input_text(system $controler, bool $disable, string $name, string $place_holder,
                                bool $required, bool $value_vacio): array|string
    {
        $label = $this->html->label(id_css: $name, place_holder: $place_holder);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $label);
        }

        if($value_vacio){
            $controler->row_upd = new stdClass();
            $controler->row_upd->$name = '';
        }

        $html= $this->html->text(disabled:$disable, id_css: $name, name: $name, place_holder: $place_holder,
            required: $required, value: $controler->row_upd->$name);

        return $label."<div class='controls'>$html</div>";

    }

    /**
     * @param system $controler
     * @param bool $disable
     * @param string $name Usado para identificador css name input y place holder
     * @param string $place_holder
     * @param bool $value_vacio
     * @return array|string
     */
    private function input_text_required(system $controler, bool $disable, string $name,
                                         string $place_holder, bool $value_vacio ): array|string
    {
        $label = $this->html->label(id_css: $name, place_holder: $place_holder);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar label', data: $label);
        }
        if($value_vacio){
            $controler->row_upd = new stdClass();
            $controler->row_upd->$name = '';
        }
        $html= $this->html->text(disabled:$disable, id_css: $name, name: $name, place_holder: $place_holder,
            required: true, value: $controler->row_upd->$name);

        return $label."<div class='controls'>$html</div>";

    }

    private function li_menu_principal_lista(string $seccion): array|string
    {
        $a = $this->link_menu_principal_lista(seccion: $seccion);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar liga', data: $a);
        }

        return "<li class='nav-item'>$a</li>";
    }

    private function link_menu_principal_lista(string $seccion): string
    {
        $links_menu = new links_menu(-1);

        $liga = $links_menu->links->$seccion->lista;
        $title_seccion = str_replace('_', ' ', $seccion);
        $title_seccion = ucwords($title_seccion);
        return "<a class='nav-link' href='$liga' role='button'>$title_seccion</a>";
    }

    public function lis_menu_principal(): array|string
    {
        $secciones = (new generales())->secciones;
        $lis = '';
        foreach($secciones as $seccion){
            $li = $this->li_menu_principal_lista(seccion: $seccion);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al generar li', data: $li);
            }
            $lis.=$li;
        }
        return $lis;

    }

    /**
     * Genera un mensaje de exito
     * @param system $controler Controlador en ejecucion
     * @return array|string
     * @version 0.13.0
     */
    public function mensaje_exito(system $controler): array|string
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

    /**
     * Genera un mensaje de tipo warning
     * @param system $controler Controlador en ejecucion
     * @return array|string
     * @version 0.19.1
     */
    public function mensaje_warning(system $controler): array|string
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
