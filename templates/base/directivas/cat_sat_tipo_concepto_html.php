<?php
namespace html\directivas;
use controllers\controlador_cat_sat_tipo_concepto;
use html\html_controler;


class cat_sat_tipo_concepto_html extends html_controler {

    public function __construct(controlador_cat_sat_tipo_concepto $controler)
    {
        parent::__construct($controler);
    }

}
