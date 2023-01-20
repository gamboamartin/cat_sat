<?php
namespace tests\controllers;

use gamboamartin\cat_sat\controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\cat_sat\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use JsonException;
use stdClass;


class controlador_cat_sat_tipo_personaTest extends test {
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
    public function test_lista(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';
        $controler = new controlador_cat_sat_tipo_persona(link: $this->link, paths_conf: $this->paths_conf);
        //$inicializacion = new liberator($inicializacion);

        $del = (new base_test())->del_cat_sat_tipo_persona(link: $this->link);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al eliminar', data: $del);
            print_r($error);
            exit;
        }
        
        $alta = (new base_test())->alta_cat_sat_tipo_persona(link: $this->link);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al insertar', data: $alta);
            print_r($error);
            exit;
        }
        $resultado = $controler->lista(header: false, ws: false);


        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEmpty($resultado);


        errores::$error = false;
    }







}

