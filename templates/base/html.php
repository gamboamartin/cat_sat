<?php
namespace html;
use base\frontend\params_inputs;
use gamboamartin\errores\errores;

class html{
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }


    public function label(string $id_css, string $place_holder): string
    {
        return "<label class='control-label' for='$id_css'>$place_holder</label>";
    }

    public function text(bool $disabled, string $id_css, string $name, string $place_holder, bool $required,
                         mixed $value): string|array
    {
        $disabled_html = (new params_inputs())->disabled_html(disabled:$disabled);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar $disabled_html', data: $disabled_html);
        }

        $required_html = (new params_inputs())->required_html(required: $required);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar $required_html', data: $required_html);
        }

        $html = "<input type='text' name='$name' value='$value' class='form-control' $disabled_html $required_html ";
        $html.= "id='$id_css' placeholder='$place_holder' />";
        return $html;
    }
}
