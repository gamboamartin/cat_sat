<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_forma_pago extends _modelo_parent{

    public function __construct(PDO $link){

        $tabla = 'cat_sat_forma_pago';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Forma Pago';


        if(!isset($_SESSION['init'][$tabla])) {
            $catalogo = array();
            $catalogo[] = array('id'=>1,'codigo' => '01', 'descripcion' => 'Efectivo');
            $catalogo[] = array('id'=>2,'codigo' => '02', 'descripcion' => 'Cheque nominativo');
            $catalogo[] = array('id'=>3,'codigo' => '03', 'descripcion' => 'Transferencia electrónica de fondos');
            $catalogo[] = array('id'=>4,'codigo' => '04', 'descripcion' => 'Tarjeta de crédito');
            $catalogo[] = array('id'=>5,'codigo' => '05', 'descripcion' => 'Monedero electrónico');
            $catalogo[] = array('id'=>6,'codigo' => '06', 'descripcion' => 'Dinero electrónico');
            $catalogo[] = array('id'=>8,'codigo' => '08', 'descripcion' => 'Vales de despensa');
            $catalogo[] = array('id'=>12,'codigo' => '12', 'descripcion' => 'Dación en pago');
            $catalogo[] = array('id'=>13,'codigo' => '13', 'descripcion' => 'Pago por subrogación');
            $catalogo[] = array('id'=>14,'codigo' => '14', 'descripcion' => 'Pago por consignación');
            $catalogo[] = array('id'=>15,'codigo' => '15', 'descripcion' => 'Condonación');
            $catalogo[] = array('id'=>17,'codigo' => '17', 'descripcion' => 'Compensación');
            $catalogo[] = array('id'=>23,'codigo' => '23', 'descripcion' => 'Novación');
            $catalogo[] = array('id'=>24,'codigo' => '24', 'descripcion' => 'Confusión');
            $catalogo[] = array('id'=>25,'codigo' => '25', 'descripcion' => 'Remisión de deuda');
            $catalogo[] = array('id'=>26,'codigo' => '26', 'descripcion' => 'Prescripción o caducidad');
            $catalogo[] = array('id'=>27,'codigo' => '27', 'descripcion' => 'A satisfacción del acreedor');
            $catalogo[] = array('id'=>28,'codigo' => '28', 'descripcion' => 'Tarjeta de débito');
            $catalogo[] = array('id'=>29,'codigo' => '29', 'descripcion' => 'Tarjeta de servicios');
            $catalogo[] = array('id'=>30,'codigo' => '30', 'descripcion' => 'Aplicación de anticipos');
            $catalogo[] = array('id'=>31,'codigo' => '31', 'descripcion' => 'Intermediario pagos');
            $catalogo[] = array('id'=>99,'codigo' => '99', 'descripcion' => 'Por definir');


            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }
}