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
            $catalago[] = array('codigo' => '01', 'descripcion' => 'Efectivo');
            $catalago[] = array('codigo' => '02', 'descripcion' => 'Cheque nominativo');
            $catalago[] = array('codigo' => '03', 'descripcion' => 'Transferencia electrónica de fondos');
            $catalago[] = array('codigo' => '04', 'descripcion' => 'Tarjeta de crédito');
            $catalago[] = array('codigo' => '05', 'descripcion' => 'Monedero electrónico');
            $catalago[] = array('codigo' => '06', 'descripcion' => 'Dinero electrónico');
            $catalago[] = array('codigo' => '08', 'descripcion' => 'Vales de despensa');
            $catalago[] = array('codigo' => '12', 'descripcion' => 'Dación en pago');
            $catalago[] = array('codigo' => '13', 'descripcion' => 'Pago por subrogación');
            $catalago[] = array('codigo' => '14', 'descripcion' => 'Pago por consignación');
            $catalago[] = array('codigo' => '15', 'descripcion' => 'Condonación');
            $catalago[] = array('codigo' => '17', 'descripcion' => 'Compensación');
            $catalago[] = array('codigo' => '23', 'descripcion' => 'Novación');
            $catalago[] = array('codigo' => '24', 'descripcion' => 'Confusión');
            $catalago[] = array('codigo' => '25', 'descripcion' => 'Remisión de deuda');
            $catalago[] = array('codigo' => '26', 'descripcion' => 'Prescripción o caducidad');
            $catalago[] = array('codigo' => '27', 'descripcion' => 'A satisfacción del acreedor');
            $catalago[] = array('codigo' => '28', 'descripcion' => 'Tarjeta de débito');
            $catalago[] = array('codigo' => '29', 'descripcion' => 'Tarjeta de servicios');
            $catalago[] = array('codigo' => '30', 'descripcion' => 'Aplicación de anticipos');
            $catalago[] = array('codigo' => '31', 'descripcion' => 'Intermediario pagos');
            $catalago[] = array('codigo' => '99', 'descripcion' => 'Por definir');



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