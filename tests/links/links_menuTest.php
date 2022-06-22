<?php
namespace tests\controllers;


use controllers\controlador_cat_sat_tipo_de_comprobante;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;

use JetBrains\PhpStorm\NoReturn;

use JsonException;
use links\links_menu;
use stdClass;


class links_menuTest extends test {
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
     */
    #[NoReturn] public function test_alta(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $html = new links_menu(-1);
        $html = new liberator($html);


        $seccion = 'a';
        $resultado = $html->alta($seccion);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("./index.php?seccion=a&accion=alta", $resultado);


        errores::$error = false;
    }

    /**
     * @throws JsonException
     */
    #[NoReturn] public function test_init_link_controller(): void
    {
        errores::$error = false;
        $_GET['seccion'] = 'cat_sat_tipo_de_comprobante';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_GET['session_id'] = '1';
        $html = new links_menu(-1);
        //$html = new liberator($html);


        $controler = new controlador_cat_sat_tipo_de_comprobante(link: $this->link, paths_conf: $this->paths_conf);

        $resultado = $html->init_link_controller($controler);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=lista&session_id=1", $resultado->cat_sat_tipo_de_comprobante->lista);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=modifica&registro_id=-1&session_id=1", $resultado->cat_sat_tipo_de_comprobante->modifica);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=alta&session_id=1", $resultado->cat_sat_tipo_de_comprobante->alta);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=alta_bd&session_id=1", $resultado->cat_sat_tipo_de_comprobante->alta_bd);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=modifica_bd&registro_id=-1&session_id=1", $resultado->cat_sat_tipo_de_comprobante->modifica_bd);
        $this->assertEquals("./index.php?seccion=cat_sat_tipo_de_comprobante&accion=elimina_bd&registro_id=-1&session_id=1", $resultado->cat_sat_tipo_de_comprobante->elimina_bd);

        errores::$error = false;
    }

    /**
     */
    #[NoReturn] public function test_link_alta(): void
    {
        errores::$error = false;
        $_GET['session_id'] = 1;
        $html = new links_menu(-1);
        $html = new liberator($html);


        $seccion = 'a';
        $resultado = $html->link_alta($seccion);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("./index.php?seccion=a&accion=alta&session_id=1", $resultado);
        errores::$error = false;
    }

}

