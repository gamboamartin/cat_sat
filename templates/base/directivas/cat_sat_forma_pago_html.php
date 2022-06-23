<?php
namespace html\directivas;
use controllers\controlador_cat_sat_forma_pago;
use html\html_controler;


class cat_sat_forma_pago_html extends html_controler {

    public function __construct(controlador_cat_sat_forma_pago $controler)
    {
        parent::__construct($controler);
    }

}
