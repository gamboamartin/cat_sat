<?php
namespace gamboamartin\cat_sat\tests\controllers;

use gamboamartin\cat_sat\controllers\controlador_cat_sat_clase_producto;
use gamboamartin\cat_sat\controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\cat_sat\controllers\controlador_cat_sat_tipo_producto;
use gamboamartin\cat_sat\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use JsonException;
use stdClass;


class controlador_cat_sat_clase_productoTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
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

        $_GET['seccion'] = 'cat_sat_clase_producto';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 2;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $del = (new base_test())->del_adm_usuario(link: $this->link);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al eliminar', data: $del);
            print_r($error);
            exit;
        }

        $del = (new base_test())->del_adm_seccion(link: $this->link);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al del', data: $del);
            print_r($error);
            exit;
        }

        $alta = (new base_test())->alta_adm_usuario(link: $this->link, id: 2);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al insertar', data: $alta);
            print_r($error);
            exit;
        }

        $alta = (new base_test())->alta_adm_seccion(link: $this->link, descripcion: 'cat_sat_clase_producto', id: 2);
        if(errores::$error){
            $error = (new errores())->error(mensaje: 'Error al insertar', data: $alta);
            print_r($error);
            exit;
        }

        $ctl = (new controlador_cat_sat_clase_producto(link: $this->link,paths_conf: $this->paths_conf));
        $ctl = new liberator($ctl);

        $resultado = $ctl->init_datatable();
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals('Id', $resultado->columns['cat_sat_clase_producto_id']['titulo']);
        $this->assertEquals('Código', $resultado->columns['cat_sat_clase_producto_codigo']['titulo']);
        $this->assertEquals('Tipo', $resultado->columns['cat_sat_tipo_producto_descripcion']['titulo']);
        $this->assertEquals('División', $resultado->columns['cat_sat_division_producto_descripcion']['titulo']);
        $this->assertEquals('Grupo', $resultado->columns['cat_sat_grupo_producto_descripcion']['titulo']);
        $this->assertEquals('Clase', $resultado->columns['cat_sat_clase_producto_descripcion']['titulo']);
        $this->assertEquals('Productos', $resultado->columns['cat_sat_clase_producto_n_productos']['titulo']);
        $this->assertEquals('cat_sat_clase_producto.id', $resultado->filtro[0]);
        $this->assertEquals('cat_sat_clase_producto.codigo', $resultado->filtro[1]);
        $this->assertEquals('cat_sat_clase_producto.descripcion', $resultado->filtro[2]);
        $this->assertEquals('cat_sat_tipo_producto.descripcion', $resultado->filtro[3]);
        $this->assertEquals('cat_sat_division_producto.descripcion', $resultado->filtro[4]);
        $this->assertEquals('cat_sat_grupo_producto.descripcion', $resultado->filtro[5]);



        errores::$error = false;
    }







}

