<?php
namespace gamboamartin\cat_sat\tests\orm;

use gamboamartin\cat_sat\models\_validacion;
use gamboamartin\cat_sat\models\cat_sat_moneda;
use gamboamartin\direccion_postal\tests\base_test;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use stdClass;


class _validacionTest extends test {
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
    public function test_verifica_forma_pago(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 1;
        $_GET['session_id'] = '1';
        $_validacion = new _validacion();
        $_validacion = new liberator($_validacion);

        $cat_sat_forma_pago = new stdClass();
        $cat_sat_forma_pago->codigo = '99';
        $cat_sat_metodo_pago = new stdClass();
        $cat_sat_metodo_pago->codigo = 'PPD';
        $registro = new stdClass();
        $resultado = $_validacion->verifica_forma_pago($cat_sat_forma_pago, $cat_sat_metodo_pago, $registro);

        $this->assertTrue($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
    }


}

