<?php
namespace gamboamartin\cat_sat\models;
use base\orm\_defaults;
use base\orm\_modelo_parent;
use gamboamartin\errores\errores;
use PDO;
use stdClass;

class cat_sat_division_producto extends _modelo_parent{
    public function __construct(PDO $link){
        $tabla = 'cat_sat_division_producto';
        $columnas = array($tabla=>false,"cat_sat_tipo_producto" => $tabla);
        $campos_obligatorios[] = 'descripcion';
        $campos_obligatorios[] = 'cat_sat_tipo_producto_id';

        $columnas_extra['cat_sat_division_producto_n_grupos'] = "(SELECT COUNT(*) FROM cat_sat_grupo_producto 
        WHERE cat_sat_grupo_producto.cat_sat_division_producto_id = cat_sat_division_producto.id)";

        $tipo_campos['codigo'] = 'cod_int_0_2_numbers';

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas, columnas_extra: $columnas_extra, tipo_campos: $tipo_campos);

        $this->NAMESPACE = __NAMESPACE__;

        $this->etiqueta = 'Division Producto';


        if(!isset($_SESSION['init'][$tabla])) {

            if(isset($_SESSION['init']['cat_sat_tipo_producto'])){
                unset($_SESSION['init']['cat_sat_tipo_producto']);
            }

            new cat_sat_tipo_producto(link: $this->link);

            $catalago = array();
            $catalogo[] = array('codigo'=>"50", 'descripcion'=>'Alimentos, Bebidas y Tabaco', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"52", 'descripcion'=>'Artículos Domésticos, Suministros y Productos Electrónicos de Consumo', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"40", 'descripcion'=>'Componentes y Equipos para Distribución y Sistemas de Acondicionamiento', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"31", 'descripcion'=>'Componentes y Suministros de Manufactura', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"32", 'descripcion'=>'Componentes y Suministros Electrónicos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"30", 'descripcion'=>'Componentes y Suministros para Estructuras, Edificación, Construcción y Obras Civiles', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"39", 'descripcion'=>'Componentes, Accesorios y Suministros de Sistemas Eléctricos e Iluminación', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"43", 'descripcion'=>'Difusión de Tecnologías de Información y Telecomunicaciones', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"42", 'descripcion'=>'Equipo Médico, Accesorios y Suministros', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"47", 'descripcion'=>'Equipos de Limpieza y Suministros', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"44", 'descripcion'=>'Equipos de Oficina, Accesorios y Suministros', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"46", 'descripcion'=>'Equipos y Suministros de Defensa, Orden Publico, Proteccion, Vigilancia y Seguridad', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"41", 'descripcion'=>'Equipos y Suministros de Laboratorio, de Medición, de Observación y de Pruebas', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"45", 'descripcion'=>'Equipos y Suministros para Impresión, Fotografia y Audiovisuales', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"49", 'descripcion'=>'Equipos, Suministros y Accesorios para Deportes y Recreación', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"27", 'descripcion'=>'Herramientas y Maquinaria General', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"64", 'descripcion'=>'Instrumentos financieros, productos, contratos y acuerdos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"60", 'descripcion'=>'Instrumentos Musicales, Juegos, Juguetes, Artes, Artesanías y Equipo educativo, Materiales, Accesorios y Suministros', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"20", 'descripcion'=>'Maquinaria y Accesorios de Minería y Perforación de Pozos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"21", 'descripcion'=>'Maquinaria y Accesorios para Agricultura, Pesca, Silvicultura y Fauna', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"22", 'descripcion'=>'Maquinaria y Accesorios para Construcción y Edificación', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"26", 'descripcion'=>'Maquinaria y Accesorios para Generación y Distribución de Energía', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"23", 'descripcion'=>'Maquinaria y Accesorios para Manufactura y Procesamiento Industrial', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"24", 'descripcion'=>'Maquinaria, Accesorios y Suministros para Manejo, Acondicionamiento y Almacenamiento de Materiales', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"48", 'descripcion'=>'Maquinaria, Equipo y Suministros para la Industria de Servicios', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"11", 'descripcion'=>'Material Mineral, Textil y Vegetal y Animal No Comestible', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"12", 'descripcion'=>'Material Químico incluyendo Bioquímicos y Materiales de Gas', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"10", 'descripcion'=>'Material Vivo Vegetal y Animal, Accesorios y Suministros', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"15", 'descripcion'=>'Materiales Combustibles, Aditivos para Combustibles, Lubricantes y Anticorrosivos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"13", 'descripcion'=>'Materiales de Resina, Colofonia, Caucho, Espuma, Película y Elastómericos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"14", 'descripcion'=>'Materiales y Productos de Papel', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"51", 'descripcion'=>'Medicamentos y Productos Farmacéuticos', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"56", 'descripcion'=>'Muebles, Mobiliario y Decoración', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"54", 'descripcion'=>'Productos para Relojería, Joyería y Piedras Preciosas', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"55", 'descripcion'=>'Publicaciones Impresas, Publicaciones Electrónicas y Accesorios', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"53", 'descripcion'=>'Ropa, Maletas y Productos de Aseo Personal', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"95", 'descripcion'=>'Terrenos, Edificios, Estructuras y Vías', 'cat_sat_tipo_producto_id'=>1);
            $catalogo[] = array('codigo'=>"25", 'descripcion'=>'Vehículos Comerciales, Militares y Particulares, Accesorios y Componentes', 'cat_sat_tipo_producto_id'=>1);


            $catalogo[] = array('codigo'=>"94", 'descripcion'=>'Organizaciones y Clubes', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"81", 'descripcion'=>'Servicios Basados en Ingeniería, Investigación y Tecnología', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"70", 'descripcion'=>'Servicios de Contratación Agrícola, Pesquera, Forestal y de Fauna', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"92", 'descripcion'=>'Servicios de Defensa Nacional, Orden Publico, Seguridad y Vigilancia', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"72", 'descripcion'=>'Servicios de Edificación, Construcción de Instalaciones y Mantenimiento', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"80", 'descripcion'=>'Servicios de Gestión, Servicios Profesionales de Empresa y Servicios Administrativos', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"76", 'descripcion'=>'Servicios de Limpieza, Descontaminación y Tratamiento de Residuos', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"71", 'descripcion'=>'Servicios de Minería, Petróleo y Gas', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"73", 'descripcion'=>'Servicios de Producción Industrial y Manufactura', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"85", 'descripcion'=>'Servicios de Salud', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"78", 'descripcion'=>'Servicios de Transporte, Almacenaje y Correo', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"90", 'descripcion'=>'Servicios de Viajes, Alimentación, Alojamiento y Entretenimiento', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"82", 'descripcion'=>'Servicios Editoriales, de Diseño, de Artes Graficas y Bellas Artes', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"86", 'descripcion'=>'Servicios Educativos y de Formación', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"84", 'descripcion'=>'Servicios Financieros y de Seguros', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"77", 'descripcion'=>'Servicios Medioambientales', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"91", 'descripcion'=>'Servicios Personales y Domésticos', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"93", 'descripcion'=>'Servicios Políticos y de Asuntos Cívicos', 'cat_sat_tipo_producto_id'=>2);
            $catalogo[] = array('codigo'=>"83", 'descripcion'=>'Servicios Públicos y Servicios Relacionados con el Sector Público', 'cat_sat_tipo_producto_id'=>2);


            foreach ($catalogo as $key=>$row){
                $catalogo[$key]['id'] = (int)$row['codigo'];
            }

            $r_alta_bd = (new _defaults())->alta_defaults(catalogo: $catalogo, entidad: $this);
            if (errores::$error) {
                $error = $this->error->error(mensaje: 'Error al insertar', data: $r_alta_bd);
                print_r($error);
                exit;
            }
            $_SESSION['init'][$tabla] = true;
        }


    }

    public function get_division(int $cat_sat_division_producto_id): array|stdClass
    {
        $registro = $this->registro(registro_id: $cat_sat_division_producto_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener division producto',data:  $registro);
        }

        return $registro;
    }
}