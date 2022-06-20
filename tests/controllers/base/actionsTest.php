<?php
namespace tests\controllers;

use controllers\base\actions;
use controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use JsonException;
use stdClass;


class actionsTest extends test {
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
    public function test_siguiente_view(): void
    {
        errores::$error = false;
        $act = new actions();
        $act = new liberator($act);

        $resultado = $act->siguiente_view();

        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('modifica', $resultado);

        errores::$error = false;
        $_POST['guarda_otro'] = '';
        $resultado = $act->siguiente_view();
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('alta', $resultado);
        errores::$error = false;


        errores::$error = false;
    }







}

