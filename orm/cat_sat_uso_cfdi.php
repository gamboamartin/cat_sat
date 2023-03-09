<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;

class cat_sat_uso_cfdi extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_uso_cfdi';
        $columnas = array($tabla=>false);
        $campos_obligatorios[] = 'descripcion';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Uso CFDI';

        /*
        if(!isset($_SESSION['init'][$tabla])) {
            $catalago = array();
            $catalago[] = array('codigo' => 'G01', 'descripcion' => 'Adquisición de mercacías');
            $catalago[] = array('codigo' => 'G02', 'descripcion' => 'Devoluciones, descuentos o bonificaciones');
            $catalago[] = array('codigo' => 'G03', 'descripcion' => 'Gastos en general');
            $catalago[] = array('codigo' => 'I01', 'descripcion' => 'Construcciones');
            $catalago[] = array('codigo' => 'I02', 'descripcion' => 'Mobiliario y equipo de oficina por inversiones');
            $catalago[] = array('codigo' => 'I03', 'descripcion' => 'Equipo de transporte');
            $catalago[] = array('codigo' => 'I04', 'descripcion' => 'Equipo de cómputo y accesorios');
            $catalago[] = array('codigo' => 'I05', 'descripcion' => 'Dados, troqueles, moldes, matrices y herramental');
            $catalago[] = array('codigo' => 'I06', 'descripcion' => 'Comunicaciones telefónicas');
            $catalago[] = array('codigo' => 'I07', 'descripcion' => 'Comunicaciones satelitales');
            $catalago[] = array('codigo' => 'I08', 'descripcion' => 'Otra maquinaria y equipo');
            $catalago[] = array('codigo' => 'D01', 'descripcion' => 'Honorarios médicos, dentales y gastos hospitalarios');
            $catalago[] = array('codigo' => 'D02', 'descripcion' => 'Gastos médicos por incapacidad o discapacidad');
            $catalago[] = array('codigo' => 'D03', 'descripcion' => 'Gastos funerales.');
            $catalago[] = array('codigo' => 'D04', 'descripcion' => 'Donativos');
            $catalago[] = array('codigo' => 'D05', 'descripcion' => 'Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).');
            $catalago[] = array('codigo' => 'D06', 'descripcion' => 'Aportaciones voluntarias al SAR');
            $catalago[] = array('codigo' => 'D07', 'descripcion' => 'Primas por seguros de gastos médicos');
            $catalago[] = array('codigo' => 'D08', 'descripcion' => 'Gastos de transportación escolar obligatoria');
            $catalago[] = array('codigo' => 'D09', 'descripcion' => 'Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones');
            $catalago[] = array('codigo' => 'D10', 'descripcion' => 'Pagos por servicios educativos (colegiaturas)');
            $catalago[] = array('codigo' => 'CP01', 'descripcion' => 'Pagos');
            $catalago[] = array('codigo' => 'CN01', 'descripcion' => 'Nómina');
            $catalago[] = array('codigo' => 'S01', 'descripcion' => 'Sin Efectos Fiscales');

            $r_alta_bd = (new _defaults())->alta_defaults(catalago: $catalago, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }
        */
    }
}