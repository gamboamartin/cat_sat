<?php
namespace tests\controllers;


use gamboamartin\errores\errores;
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
        $html = new links_menu(-1);


        $seccion = 'a';
        $resultado = $html->alta($seccion);
        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase("./index.php?seccion=a&accion=alta", $resultado);


        errores::$error = false;
    }


}

