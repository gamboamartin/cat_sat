<?php
namespace html\directivas;
use controllers\controlador_cat_sat_tipo_de_comprobante;
use html\html_controler;


class cat_sat_tipo_de_comprobante_html extends html_controler {

    public function __construct(controlador_cat_sat_tipo_de_comprobante $controler)
    {
        parent::__construct($controler);
    }

}
