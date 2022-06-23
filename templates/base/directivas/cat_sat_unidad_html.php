<?php
namespace html\directivas;
use controllers\controlador_cat_sat_unidad;
use html\html_controler;


class cat_sat_unidad_html extends html_controler {

    public function __construct(controlador_cat_sat_unidad $controler)
    {
        parent::__construct($controler);
    }

}
