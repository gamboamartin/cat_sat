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

        
        if(!isset($_SESSION['init'][$tabla])) {
            $catalago = array();
            $catalago[] = array('id'=>1,'codigo' => 'G01', 'descripcion' => 'Adquisición de mercacías');
            $catalago[] = array('id'=>2,'codigo' => 'G02', 'descripcion' => 'Devoluciones, descuentos o bonificaciones');
            $catalago[] = array('id'=>3,'codigo' => 'G03', 'descripcion' => 'Gastos en general');
            $catalago[] = array('id'=>4,'codigo' => 'I01', 'descripcion' => 'Construcciones');
            $catalago[] = array('id'=>5,'codigo' => 'I02', 'descripcion' => 'Mobiliario y equipo de oficina por inversiones');
            $catalago[] = array('id'=>6,'codigo' => 'I03', 'descripcion' => 'Equipo de transporte');
            $catalago[] = array('id'=>7,'codigo' => 'I04', 'descripcion' => 'Equipo de cómputo y accesorios');
            $catalago[] = array('id'=>8,'codigo' => 'I05', 'descripcion' => 'Dados, troqueles, moldes, matrices y herramental');
            $catalago[] = array('id'=>9,'codigo' => 'I06', 'descripcion' => 'Comunicaciones telefónicas');
            $catalago[] = array('id'=>10,'codigo' => 'I07', 'descripcion' => 'Comunicaciones satelitales');
            $catalago[] = array('id'=>11,'codigo' => 'I08', 'descripcion' => 'Otra maquinaria y equipo');
            $catalago[] = array('id'=>12,'codigo' => 'D01', 'descripcion' => 'Honorarios médicos, dentales y gastos hospitalarios');
            $catalago[] = array('id'=>13,'codigo' => 'D02', 'descripcion' => 'Gastos médicos por incapacidad o discapacidad');
            $catalago[] = array('id'=>14,'codigo' => 'D03', 'descripcion' => 'Gastos funerales.');
            $catalago[] = array('id'=>15,'codigo' => 'D04', 'descripcion' => 'Donativos');
            $catalago[] = array('id'=>16,'codigo' => 'D05', 'descripcion' => 'Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación).');
            $catalago[] = array('id'=>17,'codigo' => 'D06', 'descripcion' => 'Aportaciones voluntarias al SAR');
            $catalago[] = array('id'=>18,'codigo' => 'D07', 'descripcion' => 'Primas por seguros de gastos médicos');
            $catalago[] = array('id'=>19,'codigo' => 'D08', 'descripcion' => 'Gastos de transportación escolar obligatoria');
            $catalago[] = array('id'=>20,'codigo' => 'D09', 'descripcion' => 'Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones');
            $catalago[] = array('id'=>21,'codigo' => 'D10', 'descripcion' => 'Pagos por servicios educativos (colegiaturas)');
            $catalago[] = array('id'=>22,'codigo' => 'CP01', 'descripcion' => 'Pagos');
            $catalago[] = array('id'=>23,'codigo' => 'CN01', 'descripcion' => 'Nómina');
            $catalago[] = array('id'=>24,'codigo' => 'S01', 'descripcion' => 'Sin Efectos Fiscales');

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