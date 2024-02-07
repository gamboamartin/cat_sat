<?php
namespace gamboamartin\cat_sat\tests\orm;

use gamboamartin\cat_sat\models\cat_sat_metodo_pago;
use gamboamartin\cat_sat\models\cat_sat_moneda;
use gamboamartin\cat_sat\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\test;
use stdClass;


class cat_sat_metodo_pagoTest extends test {
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
    public function test_existe_predeterminado(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_metodo_pago';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 1;
        $_GET['session_id'] = '1';
        $modelo = new cat_sat_metodo_pago(link: $this->link);



        $resultado = $modelo->existe_predeterminado();

        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertNotTrue($resultado);

        errores::$error = false;

        $modelo = new cat_sat_moneda(link: $this->link);

        $del = (new \gamboamartin\cat_sat\tests\base_test())->del_cat_sat_moneda($this->link);
        if(errores::$error){
            $error = (new errores())->error('Error al eliminar', $del);
            print_r($error);
            exit;
        }

        $alta = (new base_test())->alta_cat_sat_moneda(link: $this->link, predeterminado: 'activo');
        if(errores::$error){
            $error = (new errores())->error('Error al insertar', $alta);
            print_r($error);
            exit;
        }

        //print_r($resultado);exit;
        $resultado = $modelo->existe_predeterminado();


        $this->assertIsBool($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertTrue($resultado);
        errores::$error = false;
    }







}

