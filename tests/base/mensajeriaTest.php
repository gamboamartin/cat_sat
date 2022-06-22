<?php
namespace tests\controllers;

use base\mensajeria;
use controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use JsonException;
use stdClass;


class mensajeriaTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/cat_sat/config/generales.php';
        $this->paths_conf->database = '/var/www/html/cat_sat/config/database.php';
        $this->paths_conf->views = '/var/www/html/cat_sat/config/views.php';
    }

    /**
     * @throws JsonException
     */
    public function test_init_mensajes(): void
    {
        errores::$error = false;
        $msj = new mensajeria();

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_GET['session_id'] = '1';
        $controler = new controlador_cat_sat_tipo_persona(link: $this->link, paths_conf: $this->paths_conf);
        //$inicializacion = new liberator($inicializacion);

        $resultado = $msj->init_mensajes($controler);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
        $msj = new mensajeria();

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_GET['session_id'] = '1';
        $_SESSION['exito'][]['mensaje'] = 'a';
        $controler = new controlador_cat_sat_tipo_persona(link: $this->link, paths_conf: $this->paths_conf);
        //$inicializacion = new liberator($inicializacion);

        $resultado = $msj->init_mensajes($controler);

        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("<div class='alert alert-success' role='alert' ><strong>Muy bien!", $resultado->exito);


        errores::$error = false;
    }







}
