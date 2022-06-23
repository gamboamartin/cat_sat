<?php
namespace html\directivas;
use controllers\controlador_cat_sat_regimen_fiscal;
use html\html_controler;


class cat_sat_regimen_fiscal_html extends html_controler {

    public function __construct(controlador_cat_sat_regimen_fiscal $controler)
    {
        parent::__construct($controler);
    }

}
