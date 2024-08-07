<?php

/**
 * Controlador de Ingreso que permite la  creacion, edicion  y eliminacion de los ingreso del Sistema
 */
class Page_indexController extends Page_mainController
{



  /**
   * $mainModel  instancia del modelo de  base de datos ingreso
   * @var modeloContenidos
   */
  public $mainModel;

  /**
   * $route  url del controlador base
   * @var string
   */
  protected $route;

  /**
   * $pages cantidad de registros a mostrar por pagina]
   * @var integer
   */
  protected $pages;

  /**
   * $namefilter nombre de la variable a la fual se le van a guardar los filtros
   * @var string
   */
  protected $namefilter;

  /**
   * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
   * @var string
   */
  protected $_csrf_section = "page_index";

  /**
   * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
   * @var string
   */
  protected $namepages;



  /**
   * Inicializa las variables principales del controlador ingreso .
   *
   * @return void.
   */
  public function init()
  {
    $this->mainModel = new Page_Model_DbTable_Ingreso();
    $this->namefilter = "parametersfilterindex";
    $this->route = "/page/index";
    $this->namepages = "pages_index";
    $this->namepageactual = "page_actual_index";
    $this->_view->route = $this->route;
    if (Session::getInstance()->get($this->namepages)) {
      $this->pages = Session::getInstance()->get($this->namepages);
    } else {
      $this->pages = 20;
    }
    parent::init();
  }


  /**
   * Recibe la informacion y  muestra un listado de  ingreso con sus respectivos filtros.
   *
   * @return void.
   */
  public function indexAction()
  {
    $this->_view->route = $this->route;
    $this->_csrf_section = "manage_ingreso_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $this->_view->list_ingreso_estado_civil = $this->getEstadoCivil();
    $this->_view->list_ingreso_sexo = $this->getIngresosexo();
    $this->_view->list_ingreso_vive_casa = $this->getIngresovivecasa();
    $this->_view->routeform = $this->route . "/insert";
  }
  public function pruebaAction()
  {

    error_reporting(E_ALL);
    $this->setLayout('blanco');
    // Crear una instancia del modelo de envío de correo electrónico
    $mailModel = new Core_Model_Sendingemail($this->_view);

    // Enviar correo de REGISTRO
    $mail = $mailModel->sendIngreso(1);
    print_r($mail);
  }


  /**
   * Genera la Informacion necesaria para editar o crear un  ingreso  y muestra su formulario
   *
   * @return void.
   */


  /**
   * Inserta la informacion de un ingreso  y redirecciona al listado de ingreso.
   *
   * @return void.
   */
  public function insertAction()
  {
    // Habilitar la visualización de todos los errores.
    error_reporting(E_ALL);

    // Establecer el diseño de la página como 'blanco'.
    $this->setLayout('blanco');

    // Obtener y sanitizar el parámetro CSRF.
    $csrf = $this->_getSanitizedParam("csrf");

    // Verificar si el token CSRF recibido coincide con el almacenado en la sesión.
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {

      // Verificar que el método de solicitud sea POST.
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtener los datos del formulario.
        $data = $this->getData();

        // Consultar si ya existe una entrada con la cédula proporcionada.
        $cedula = $data['ingreso_cedula'];
        $ingresoExistente = $this->mainModel->getList(" ingreso_cedula = '$cedula'");

        // Si existe una entrada con la cédula, redirigir con un error.
        if ($ingresoExistente) {
          header('Location: ' . $this->route . '?error=1&cc=' . $cedula . '');
          return;
        }

        // Insertar los datos principales en la base de datos.
        $id = $this->mainModel->insert($data);

        // Insertar Dependientes.
        $dependientesModel = new Page_Model_DbTable_Dependientes();
        $nombres = $_POST['dependiente_nombre'];
        $parentescos = $_POST['dependiente_parentesco'];
        $dependientesArray = [];

        foreach ($nombres as $index => $nombre) {
          $parentesco = $parentescos[$index];
          if ($nombre != '' && $parentesco != '') {
            $dependientesArray = [
              'dependiente_nombre' => $nombre,
              'dependiente_parentesco' => $parentesco,
              'dependiente_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Insertar el dependiente en la base de datos.
            $idDependiente = $dependientesModel->insert($dependientesArray);

            // Registrar en el log si la inserción fue exitosa.
            if ($idDependiente) {
              $data['ingreso_id'] = $idDependiente;
              $data['log_log'] = print_r($dependientesArray, true);
              $data['log_tipo'] = 'CREAR DEPENDIENTE';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          }
        }

        // Insertar Con quien vive.
        $viveConModel = new Page_Model_DbTable_Conquienesvive();
        $viveConNombres = $_POST['vive_con_nombre'];
        $viveConParentescos = $_POST['vive_con_parentesco'];
        $viveConTelefonos = $_POST['vive_con_telefono'];
        $viveConArray = [];

        foreach ($viveConNombres as $index => $nombre) {
          $parentesco = $viveConParentescos[$index];
          $telefono = $viveConTelefonos[$index];
          if ($nombre != '' && $parentesco != '' && $telefono != '') {
            $viveConArray = [
              'vive_con_nombre' => $nombre,
              'vive_con_parentesco' => $parentesco,
              'vive_con_telefono' => $telefono,
              'vive_con_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Insertar en la base de datos.
            $idViveCon = $viveConModel->insert($viveConArray);

            // Registrar en el log si la inserción fue exitosa.
            if ($idViveCon) {
              $data['ingreso_id'] = $idViveCon;
              $data['log_log'] = print_r($viveConArray, true);
              $data['log_tipo'] = 'CREAR VIVE CON';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          }
        }

        // Insertar Formación Académica.
        $formacionModel = new Page_Model_DbTable_Datosacademicos();
        $datos_academicos_formacion = $_POST['datos_academicos_formacion'];
        $datosArray = [];

        foreach ($datos_academicos_formacion as $index => $formacion) {
          if ($formacion != '') {
            $datosArray = [
              'datos_academicos_formacion' => $formacion,
              'datos_academicos_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Insertar en la base de datos.
            $idFormacion = $formacionModel->insert($datosArray);

            // Registrar en el log si la inserción fue exitosa.
            if ($idFormacion) {
              $data['ingreso_id'] = $idFormacion;
              $data['log_log'] = print_r($datosArray, true);
              $data['log_tipo'] = 'CREAR FORMACION ACADEMICA';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          }
        }

        // Insertar Datos Laborales.
        $datosLaboralesModel = new Page_Model_DbTable_Datoslaborales();
        $datos_laborales_empleo = $_POST['datos_laborales_empleo'];
        $datos_laborales_fecha_inicio = $_POST['datos_laborales_fecha_inicio'];
        $datos_laborales_fecha_fin = $_POST['datos_laborales_fecha_fin'];
        $datos_laborales_motivo_retiro = $_POST['datos_laborales_motivo_retiro'];
        $datosLaboralesArray = [];

        foreach ($datos_laborales_empleo as $index => $formacionLaboral) {
          $fechaInicio = $datos_laborales_fecha_inicio[$index];
          $fechaFin = $datos_laborales_fecha_fin[$index];
          $motivoRetiro = $datos_laborales_motivo_retiro[$index];

          if ($formacionLaboral != '' && $fechaInicio != '' && $fechaFin != '' && $motivoRetiro != '') {
            $datosLaboralesArray = [
              'datos_laborales_empleo' => $formacionLaboral,
              'datos_laborales_fecha_inicio' => $fechaInicio,
              'datos_laborales_fecha_fin' => $fechaFin,
              'datos_laborales_motivo_retiro' => $motivoRetiro,
              'datos_laborales_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Insertar en la base de datos.
            $idDatosLaborales = $datosLaboralesModel->insert($datosLaboralesArray);

            // Registrar en el log si la inserción fue exitosa.
            if ($idDatosLaborales) {
              $data['ingreso_id'] = $idDatosLaborales;
              $data['log_log'] = print_r($datosLaboralesArray, true);
              $data['log_tipo'] = 'CREAR DATOS LABORALES';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          }
        }

        // Registrar el ingreso principal en el log.
        $data['ingreso_id'] = $id;
        $data['log_log'] = print_r($data, true);
        $data['log_tipo'] = 'CREAR INGRESO';
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);
      }
      // Redirigir a la ruta especificada (esta línea está comentada).
      // header('Location: ' . $this->route . '' . '');
    }
  }




  /**
   * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Ingreso.
   *
   * @return array con toda la informacion recibida del formulario.
   */
  private function getData()
  {
    $data = array();
    $data['ingreso_fecha_ingreso']  = $this->_getSanitizedParam("ingreso_fecha_ingreso");
    $data['ingreso_nombre'] = $this->_getSanitizedParam("ingreso_nombre");
    $data['ingreso_apellido'] = $this->_getSanitizedParam("ingreso_apellido");
    $data['ingreso_fecha_nacimiento'] = $this->_getSanitizedParam("ingreso_fecha_nacimiento");
    $data['ingreso_lugar_nacimiento'] = $this->_getSanitizedParam("ingreso_lugar_nacimiento");
    $data['ingreso_cedula'] = $this->_getSanitizedParam("ingreso_cedula");
    $data['ingreso_nacionalidad'] = $this->_getSanitizedParam("ingreso_nacionalidad");
    $data['ingreso_direccion_casa'] = $this->_getSanitizedParam("ingreso_direccion_casa");
    $data['ingreso_telefono'] = $this->_getSanitizedParam("ingreso_telefono");
    $data['ingreso_telefono_casa'] = $this->_getSanitizedParam("ingreso_telefono_casa");
    $data['ingreso_email'] = $this->_getSanitizedParam("ingreso_email");
    $data['ingreso_estado_civil'] = $this->_getSanitizedParam("ingreso_estado_civil");
    $data['ingreso_nombre_pareja'] = $this->_getSanitizedParam("ingreso_nombre_pareja");
    $data['ingreso_carnet_blanco'] = $this->_getSanitizedParam("ingreso_carnet_blanco");
    $data['ingreso_numero_hijos'] = $this->_getSanitizedParam("ingreso_numero_hijos");
    $data['ingreso_numero_seguro_social'] = $this->_getSanitizedParam("ingreso_numero_seguro_social");
    $data['ingreso_hobby'] = $this->_getSanitizedParamHtml("ingreso_hobby");
    $data['ingreso_edad'] = $this->_getSanitizedParam("ingreso_edad");
    $data['ingreso_sexo'] = $this->_getSanitizedParam("ingreso_sexo");
    $data['ingreso_carnet_verde'] = $this->_getSanitizedParam("ingreso_carnet_verde");
    $data['ingreso_afiliado_seguro_social'] = $this->_getSanitizedParam("ingreso_afiliado_seguro_social");
    $data['ingreso_nombre_madre'] = $this->_getSanitizedParam("ingreso_nombre_madre");
    $data['ingreso_telefono_madre'] = $this->_getSanitizedParam("ingreso_telefono_madre");
    $data['ingreso_nombre_padre'] = $this->_getSanitizedParam("ingreso_nombre_padre");
    $data['ingreso_telefono_padre'] = $this->_getSanitizedParam("ingreso_telefono_padre");
    $data['ingreso_vive_casa'] = $this->_getSanitizedParam("ingreso_vive_casa");
    $data['ingreso_fecha_solicitud'] = date("Y-m-d H:i:s");
    $data['ingreso_estado_solicitud'] = '1';
    return $data;
  }


  private function getEstadoCivil()
  {
    $array = array();
    $array['Casado'] = 'Casado';
    $array['Union Libre'] = 'Unión Libre';
    $array['Soltero'] = 'Soltero';
    return $array;
  }


  /**
   * Genera los valores del campo Sexo.
   *
   * @return array cadena con los valores del campo Sexo.
   */
  private function getIngresosexo()
  {
    $array = array();
    $array['Femenimo'] = 'Femenimo';
    $array['Masculino'] = 'Masculino';

    return $array;
  }


  /**
   * Genera los valores del campo Vive en casa.
   *
   * @return array cadena con los valores del campo Vive en casa.
   */
  private function getIngresovivecasa()
  {
    $array = array();
    $array['Familiar'] = 'Familiar';
    $array['Alquilada'] = 'Alquilada';
    $array['Propia'] = 'Propia';

    return $array;
  }

  public function validarcedulaAction()
  {

    $this->setLayout('blanco');
    $cedula = $this->_getSanitizedParam("cc");
    $data = $this->mainModel->getList(" ingreso_cedula = '$cedula'");
    if ($data) {
      echo json_encode(array('status' => 'error', 'message' => 'La cedula ya se encuentra registrada'));
    } else {
      echo json_encode(array('status' => 'success', 'message' => 'Cedula valida'));
    }
  }
}
