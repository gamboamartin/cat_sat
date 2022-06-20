<?php
namespace tests\controllers;

use controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use html\html;
use JsonException;
use stdClass;


class htmlTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();

    }

    public function test_alert_success(): void
    {
        errores::$error = false;
        $html = new html();
        //$inicializacion = new liberator($inicializacion);

        $mensaje = 'a';
        $resultado = $html->alert_success($mensaje);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("<div class='alert alert-success' role='alert' ><strong>Muy bien!</strong> a.</div>", $resultado);
        errores::$error = false;
    }


    public function test_label(): void
    {
        errores::$error = false;
        $html = new html();
        //$inicializacion = new liberator($inicializacion);

        $id_css = 'a';
        $place_holder = 'c';
        $resultado = $html->label($id_css, $place_holder);


        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("<label class='control-label' for='a'>c</label>", $resultado);


        errores::$error = false;
    }







}

