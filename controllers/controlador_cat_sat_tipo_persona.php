<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;

use gamboamartin\errores\errores;
use gamboamartin\system\system;
use html\cat_sat_tipo_persona_html;
use html\directivas;

use html\html;
use JsonException;
use links\secciones\link_cat_sat_tipo_persona;
use models\cat_sat_tipo_persona;
use PDO;
use stdClass;

class controlador_cat_sat_tipo_persona extends system {

    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_tipo_persona(link: $link);
        $html_base = new html();
        $html = new cat_sat_tipo_persona_html(html: $html_base);
        $obj_link = new link_cat_sat_tipo_persona($this->registro_id);
        $this->rows_lista[] = 'valida_persona_fisica';
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Tipos de Persona';
        $this->acciones->valida_persona_fisica = new stdClass();
        $this->acciones->valida_persona_fisica->style = '';
        $this->acciones->valida_persona_fisica->style_status = true;

    }

    /**
     * @param bool $header
     * @param bool $ws
     * @param string $breadcrumbs
     * @param bool $aplica_form
     * @param bool $muestra_btn
     * @return array|string
     */
    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '',
                             bool $aplica_form = true, bool $muestra_btn = true): array|string
    {


        $r_modifica = parent::modifica(header: $header, ws: $ws, breadcrumbs: $breadcrumbs,aplica_form:  $aplica_form,
            muestra_btn:  $muestra_btn); // TODO: Change the autogenerated stub

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_modifica,
                header:  $header,ws:  $ws);
        }

        $button_valida_persona_fisica = (new directivas())->button_href_valida_persona_fisica(
            registro_id:$this->registro_id,valida_persona_fisica: $this->row_upd->valida_persona_fisica);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar boton', data: $button_valida_persona_fisica,
                header:  $header, ws: $ws);
        }
        $this->inputs->valida_persona_fisica = $button_valida_persona_fisica;


        $button_status = (new directivas())->button_href_status(cols: 6, registro_id:$this->registro_id,
            seccion: $this->seccion,status: $this->row_upd->status);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar boton', data: $button_status,
                header:  $header, ws: $ws);
        }
        $this->inputs->status = $button_status;

        return $r_modifica;

    }

    /**
     * @throws JsonException
     */
    public function valida_persona_fisica(bool $header, bool $ws): array|stdClass
    {
        $this->link->beginTransaction();
        $upd = $this->modelo->status('valida_persona_fisica', $this->registro_id);
        if(errores::$error){
            $this->link->rollBack();
            return $this->retorno_error(mensaje: 'Error al modificar registro', data: $upd,header:  $header, ws: $ws);
        }
        $this->link->commit();
        $_SESSION['exito'][]['mensaje'] = 'Se ajusto el estatus de manera el registro con el id '.$this->registro_id;

        $this->header_out(result: $upd, header: $header,ws:  $ws);
        return $upd;

    }


}
