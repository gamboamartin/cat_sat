<?php
namespace html\directivas;
use controllers\controlador_cat_sat_obj_imp;
use html\html_controler;


class cat_sat_obj_imp_html extends html_controler {

    public function __construct(controlador_cat_sat_obj_imp $controler)
    {
        parent::__construct($controler);
    }

}
