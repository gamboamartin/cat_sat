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
            $catalago = array();
            $catalago[] = array('id'=>1,'codigo' => '01', 'descripcion' => 'Efectivo');
            $catalago[] = array('id'=>2,'codigo' => '02', 'descripcion' => 'Cheque nominativo');
            $catalago[] = array('id'=>3,'codigo' => '03', 'descripcion' => 'Transferencia electrónica de fondos');
            $catalago[] = array('id'=>4,'codigo' => '04', 'descripcion' => 'Tarjeta de crédito');
            $catalago[] = array('id'=>5,'codigo' => '05', 'descripcion' => 'Monedero electrónico');
            $catalago[] = array('id'=>6,'codigo' => '06', 'descripcion' => 'Dinero electrónico');
            $catalago[] = array('id'=>7,'codigo' => '08', 'descripcion' => 'Vales de despensa');
            $catalago[] = array('id'=>8,'codigo' => '12', 'descripcion' => 'Dación en pago');
            $catalago[] = array('id'=>9,'codigo' => '13', 'descripcion' => 'Pago por subrogación');
            $catalago[] = array('id'=>10,'codigo' => '14', 'descripcion' => 'Pago por consignación');
            $catalago[] = array('id'=>11,'codigo' => '15', 'descripcion' => 'Condonación');
            $catalago[] = array('id'=>12,'codigo' => '17', 'descripcion' => 'Compensación');
            $catalago[] = array('id'=>13,'codigo' => '23', 'descripcion' => 'Novación');
            $catalago[] = array('id'=>14,'codigo' => '24', 'descripcion' => 'Confusión');
            $catalago[] = array('id'=>15,'codigo' => '25', 'descripcion' => 'Remisión de deuda');
            $catalago[] = array('id'=>16,'codigo' => '26', 'descripcion' => 'Prescripción o caducidad');
            $catalago[] = array('id'=>17,'codigo' => '27', 'descripcion' => 'A satisfacción del acreedor');
            $catalago[] = array('id'=>18,'codigo' => '28', 'descripcion' => 'Tarjeta de débito');
            $catalago[] = array('id'=>19,'codigo' => '29', 'descripcion' => 'Tarjeta de servicios');
            $catalago[] = array('id'=>20,'codigo' => '30', 'descripcion' => 'Aplicación de anticipos');
            $catalago[] = array('id'=>21,'codigo' => '31', 'descripcion' => 'Intermediario pagos');
            $catalago[] = array('id'=>22,'codigo' => '99', 'descripcion' => 'Por definir');



            $r_alta_bd = (new _defaults())->alta_defaults(catalago: $catalago, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }
}