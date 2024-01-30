<?php
namespace gamboamartin\cat_sat\tests\instalacion;

use gamboamartin\cat_sat\instalacion\instalacion;
use gamboamartin\cat_sat\models\cat_sat_isn;
use gamboamartin\cat_sat\models\cat_sat_isr;
use gamboamartin\cat_sat\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;


class instalacionTest extends test {
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

    public function test_cat_sat_cve_prod(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 1;
        $_GET['session_id'] = '1';
        $ins = new instalacion();
        $ins = new liberator($ins);


        $resultado = $ins->cat_sat_cve_prod(link: $this->link);
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }
    public function test_instala(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 1;
        $_GET['session_id'] = '1';
        $ins = new instalacion();


        $resultado = $ins->instala(link: $this->link);
        //print_r($resultado);exit;
        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);
       // $this->assertEquals(1,$resultado->registro_id);
        errores::$error = false;
    }


}

