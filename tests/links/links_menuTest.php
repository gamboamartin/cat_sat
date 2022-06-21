<?php
namespace tests\controllers;


use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;

use JetBrains\PhpStorm\NoReturn;

use links\links_menu;
use stdClass;


class links_menuTest extends test {
    public errores $errores;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();


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

