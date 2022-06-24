<?php
namespace html\directivas;
use controllers\controlador_cat_sat_uso_cfdi;
use html\html_controler;


class cat_sat_uso_cfdi_html extends html_controler {

    public function __construct(controlador_cat_sat_uso_cfdi $controler)
    {
        parent::__construct($controler);
    }

}
