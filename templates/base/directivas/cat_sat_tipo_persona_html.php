<?php
namespace html\directivas;
use controllers\controlador_cat_sat_tipo_persona;
use html\html_controler;


class cat_sat_tipo_persona_html extends html_controler {

    public function __construct(controlador_cat_sat_tipo_persona $controler)
    {
        parent::__construct($controler);
    }

}
