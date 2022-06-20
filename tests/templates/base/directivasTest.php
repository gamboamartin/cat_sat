<?php
namespace tests\controllers;

use base\controller\controlador_base;
use base\controller\controler;
use controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use html\directivas;
use html\html;
use JetBrains\PhpStorm\NoReturn;
use JsonException;
use models\cat_sat_tipo_persona;
use stdClass;


class directivasTest extends test {
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
    #[NoReturn] public function test_mensaje_exito(): void
    {
        errores::$error = false;
        $html = new directivas();

        $controler = new controlador_cat_sat_tipo_persona(link: $this->link,paths_conf: $this->paths_conf);

        $resultado = $html->mensaje_exito($controler);

        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("", $resultado);

        errores::$error = false;
        $html = new directivas();
        $_SESSION['exito'][]['mensaje'] = 'hola';
        $controler = new controlador_cat_sat_tipo_persona(link: $this->link,paths_conf: $this->paths_conf);
        $resultado = $html->mensaje_exito($controler);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("<div class='alert alert-success' role='alert' ><strong>Muy bien!</strong> ", $resultado);

        errores::$error = false;
    }


}

