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
  #region INICIO DEL CONTROLADOR
  public function indexAction()
  {
    $this->_view->route = $this->route;
    $this->_csrf_section = "manage_ingreso_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
    $dependientesModel = new Page_Model_DbTable_Dependientes();
    $viveConModel = new Page_Model_DbTable_Conquienesvive();
    $datosAcademicosModel = new Page_Model_DbTable_Datosacademicos();
    $datosLaboralesModel = new Page_Model_DbTable_Datoslaborales();

    // Asignar listas predefinidas al objeto de la vista
    $this->_view->list_ingreso_estado_civil = $this->getEstadoCivil();
    $this->_view->list_ingreso_sexo = $this->getIngresosexo();
    $this->_view->list_ingreso_vive_casa = $this->getIngresovivecasa();
    $this->_view->list_ingreso_parentesco = $this->getParentesco();
		$this->_view->list_ciudad_nacimiento = $this->getCiudad();

    // Obtener parámetros sanitizados de la solicitud y asignarlos a la vista
    $this->_view->error = $this->_getSanitizedParam("error");
    $this->_view->cc = $this->_getSanitizedParam("cc");
    $this->_view->emailValidacion = $this->_getSanitizedParam("emailValidacion");

    // Obtener token y email de la sesión
    $token = Session::getInstance()->get("token");
    $email = Session::getInstance()->get("email");
    $this->_view->routeform = $this->route . "/insert";

    if ($token && $email) {
      // Asignar token y email a la vista
      $this->_view->token_encoded = $token;
      $this->_view->email = $email;

      // Consultar si el email ya está registrado y el estado de la solicitud es 2 (validado)
      $consultaEmail1 = $this->mainModel->getList("ingreso_email = '$email' AND ingreso_estado_solicitud = '2'");
      if ($consultaEmail1 && count($consultaEmail1) >= 1) {
        Session::getInstance()->set("error", "El correo '$email' ya se encuentra registrado y validado.");
        Session::getInstance()->set("tipo", "danger");
        header("Location: /page/error/");
        exit; // Detener la ejecución del script después de la redirección
      }

      // Consultar si el email ya está registrado y el estado de la solicitud es 1 (pendiente)
      $consultaEmail2 = $this->mainModel->getList("ingreso_email = '$email' AND ingreso_estado_solicitud = '1'");
      if ($consultaEmail2 && count($consultaEmail2) >= 1) {
        Session::getInstance()->set("error", "El correo '$email' ya se encuentra registrado y pendiente de validación.");
        Session::getInstance()->set("tipo", "warning");
        header("Location: /page/error/");
        exit; // Detener la ejecución del script después de la redirección
      }

      // Consultar si el email ya está registrado y el estado de la solicitud es 3 (rechazado anteriormente)
      $consultaEmail3 = $this->mainModel->getList("ingreso_email = '$email' AND ingreso_estado_solicitud = '3'", "ingreso_id DESC");
      if ($consultaEmail3 && count($consultaEmail3) >= 1) {
        // Session::getInstance()->set("error", "El correo '$email' ya se encuentra registrado y pendiente de validación.");
        // Session::getInstance()->set("tipo", "warning");

        // Obtener contenido por ID y asignarlo a la vista si existe
        $content = $this->mainModel->getById($consultaEmail3[0]->ingreso_id);
        if ($content->ingreso_id) {
          $this->_view->dependientes = $dependientesModel->getList("dependiente_cedula_colaborador = '$content->ingreso_cedula'");
          $this->_view->viveCon = $viveConModel->getList("vive_con_cedula_colaborador = '$content->ingreso_cedula'");
          $this->_view->datosAcademicos = $datosAcademicosModel->getList("datos_academicos_cedula_colaborador = '$content->ingreso_cedula'");
          $this->_view->datosLaborales = $datosLaboralesModel->getList("datos_laborales_cedula_colaborador = '$content->ingreso_cedula'");

          $this->_view->content = $content;
          $this->_view->routeform = $this->route . "/update";
        } else {
          $this->_view->routeform = $this->route . "/insert";
        }
      } else {
      }
    } else {
      // Manejar caso de token no válido
      Session::getInstance()->set("error", "El token no es válido.");
      Session::getInstance()->set("tipo", "danger");
      header("Location: /page/error/");
      exit; // Detener la ejecución del script después de la redirección
    }
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


  #region VALIDAR EL TOKEN
  public function validarAction()
  {

    $this->setLayout('blanco');
    $token_encoded = $this->_getSanitizedParam('token');

    if (!$token_encoded) {
      // echo "Token no proporcionado.";
      Session::getInstance()->set("error", "Token no proporcionado.");
      Session::getInstance()->set("tipo", "warning");
      header("Location: /page/error/");
      return;
    }

    $key = 't@ctic_sp+nama2024'; // Debe ser la misma clave secreta compartida
    $decoded = base64_decode($token_encoded);
    list($email, $expiry_str, $token) = explode('|', $decoded);

    // Verificar la integridad del token
    $data = $email . '|' . $expiry_str;
    $valid_token = hash_hmac('sha256', $data, $key);

    if (!hash_equals($valid_token, $token)) {

      // echo "Token no válido.";
      Session::getInstance()->set("error", "Token no válido.");
      Session::getInstance()->set("tipo", "danger");
      header("Location: /page/error/");
      return;
    }

    $expiry = new DateTime($expiry_str);
    $now = new DateTime();

    if (!($now < $expiry)) {
      // echo "El token ha expirado.";
      Session::getInstance()->set("error", "El token ha expirado.");
      Session::getInstance()->set("tipo", "danger");

      header("Location: /page/error/");
      return;
    }


    // echo "Token válido. Acceso concedido.";
    // Aquí puedes incluir el contenido protegido
    // Token válido y no expirado, redirigir a la página de verificación de correo

    header("Location: /page/index/procesarcorreo?token=" . urlencode($token_encoded));
    exit;
  }


  #region VALIDAR EL CORREO DEL TOKEN
  public function procesarcorreoAction()
  {
    Session::getInstance()->set("token", "");
    Session::getInstance()->set("email", "");


    $token_encoded = $this->_getSanitizedParam('token');
    $this->_view->error = Session::getInstance()->get("error");
    $this->_view->tipo = Session::getInstance()->get("tipo");
    Session::getInstance()->set("error", "");
    Session::getInstance()->set("tipo", "");

    $this->_view->token_encoded = $token_encoded;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $email = $this->_getSanitizedParam('email');


      if (!$email && !$token_encoded) {
        // echo "Correo no válido.";
        Session::getInstance()->set("error", "Correo no válido.");
        Session::getInstance()->set("tipo", "danger");
        header("Location: /page/error/");
        return;
      }


      $key = 't@ctic_sp+nama2024'; // Debe ser la misma clave secreta compartida
      $decoded = base64_decode($token_encoded);
      list($token_email, $expiry_str, $token) = explode('|', $decoded);

      // Verificar la integridad del token
      $data = $token_email . '|' . $expiry_str;
      $valid_token = hash_hmac('sha256', $data, $key);

      if (!(hash_equals($valid_token, $token) && hash_equals($token_email, $email))) {
        Session::getInstance()->set("error", "Token o correo no válido");
        Session::getInstance()->set("tipo", "danger");
        header("Location: /page/index/procesarcorreo?token={$token_encoded}");
        return;
      }

      $expiry = new DateTime($expiry_str);
      $now = new DateTime();

      if (!($now < $expiry)) {
        // echo "El token ha expirado.";
        Session::getInstance()->set("error", "El token ha expirado.");
        Session::getInstance()->set("tipo", "danger");
        header("Location: /page/error/");
        return;
      }

      Session::getInstance()->set("token", $token_encoded);
      Session::getInstance()->set("email", $email);

      header("Location: /page/");

      // echo "Token válido y correo verificado. Acceso concedido.";

      // Aquí puedes incluir el contenido protegido

    }
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
  #region INSERTAR INGRESO
  public function insertAction()
  {
    // Habilitar la visualización de todos los errores.
    // error_reporting(E_ALL);

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
        $ingresoExistente = $this->mainModel->getList(" ingreso_cedula = '$cedula'  ");

        // Consultar si ya existe una entrada con el email proporcionado.
        $email = $data['ingreso_email '];
        $emailExistente = $this->mainModel->getList(" ingreso_email  = '$email'");

        // Si existe una entrada con la cédula, redirigir con un error.
        if ($ingresoExistente) {
          header('Location: ' . $this->route . '?error=1&cc=' . $cedula . '');
          return;
        }
        if ($emailExistente) {
          header('Location: ' . $this->route . '?error=2&emailValidacion=' . $email . '');
          return;
        }


        // Insertar los datos principales en la base de datos.
        $id = $this->mainModel->insert($data);

        #region INSERTAR DEPENDIENTES
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

        #region INSERTAR CON QUIEN VIVE
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


        #region INSERTAR FORMACION ACADEMICA
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

        #region INSERTAR DATOS LABORALES
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

        if ($id) {
          // Crear una instancia del modelo de envío de correo electrónico
          $mailModel = new Core_Model_Sendingemail($this->_view);

          // Enviar correo de REGISTRO
          $mail = $mailModel->sendIngreso($id);
          Session::getInstance()->set("token", null);
          Session::getInstance()->set("email", null);

          // Registrar el ingreso principal en el log.
          $data['ingreso_id'] = $id;
          $data['log_log'] = print_r($data, true);
          $data['log_tipo'] = 'CREAR INGRESO';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($data);
          if ($mail == 1) {
            header("Location: /page/envio?ingreso={$id}&estado=1");
          } else {
            header("Location: /page/envio?ingreso={$id}&estado=2");
          }
        } else {
          Session::getInstance()->set("error", "Hubo un error al momento de guardar el registro, por favor intente nuevamente.");
          Session::getInstance()->set("tipo", "danger");

          header('Location: /page/error/ ');
        }
      }
      // Redirigir a la ruta especificada (esta línea está comentada).
      // header('Location: ' . $this->route . '' . '');
    }
  }


  #region ACTUALIZAR INGRESO

  public function updateAction()
  {
    $this->setLayout('blanco');
    // error_reporting(E_ALL);
    // return;
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $id = $this->_getSanitizedParam("id");
      $content = $this->mainModel->getById($id);
      if ($content->ingreso_id) {
        $data = $this->getData();
        $this->mainModel->update($data, $id);
        $data['ingreso_id'] = $id;
        $data['log_log'] = print_r($data, true);
        $data['log_tipo'] = 'EDITAR INGRESO';
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);

        #region EDITAR DEPENDIENTES
        // Insertar Dependientes.
        $dependientesModel = new Page_Model_DbTable_Dependientes();
        $dependienteIds = $_POST['dependiente_id'];
        $nombres = $_POST['dependiente_nombre'];
        $parentescos = $_POST['dependiente_parentesco'];
        $dependientesArray = [];

        foreach ($nombres as $index => $nombre) {
          $dependienteId = $dependienteIds[$index];

          $parentesco = $parentescos[$index];
          if ($dependienteId != '' && $nombre != '' && $parentesco != '') {
            $dependientesArray = [
              'dependiente_nombre' => $nombre,
              'dependiente_parentesco' => $parentesco,
              'dependiente_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Actualizar el dependiente en la base de datos.
            $dependientesModel->update($dependientesArray, $dependienteId);

            // Registrar en el log si la inserción fue exitosa.
            if ($dependienteId) {
              $data['ingreso_id'] = $content->ingreso_id;
              $data['log_log'] = print_r($dependientesArray, true);
              $data['log_tipo'] = 'EDITAR DEPENDIENTE';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          } else  if ($nombre != '' && $parentesco != '' && $dependienteId == '') {

            $dependientesArray = [
              'dependiente_nombre' => $nombre,
              'dependiente_parentesco' => $parentesco,
              'dependiente_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Insertar el dependiente en la base de datos.
            $idDependiente = $dependientesModel->insert($dependientesArray);
            // Registrar en el log si la inserción fue exitosa.
            if ($idDependiente) {
              $data['ingreso_id'] = $content->ingreso_id;
              $data['log_log'] = print_r($dependientesArray, true);
              $data['log_tipo'] = 'CREAR DEPENDIENTE';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          }
        }


        #region EDITAR VIVE CON
        // Insertar Con quien vive.
        $viveConModel = new Page_Model_DbTable_Conquienesvive();
        $viveConIds = $_POST['vive_con_id'];

        $viveConNombres = $_POST['vive_con_nombre'];
        $viveConParentescos = $_POST['vive_con_parentesco'];
        $viveConTelefonos = $_POST['vive_con_telefono'];
        $viveConArray = [];

        foreach ($viveConNombres as $index => $nombre) {
          $viveConId = $viveConIds[$index];
          $parentesco = $viveConParentescos[$index];
          $telefono = $viveConTelefonos[$index];
          if ($viveConId != '' && $nombre != '' && $parentesco != '' && $telefono != '') {
            $viveConArray = [
              'vive_con_nombre' => $nombre,
              'vive_con_parentesco' => $parentesco,
              'vive_con_telefono' => $telefono,
              'vive_con_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Actualizar en la base de datos.
            $viveConModel->update($viveConArray, $viveConId);

            // Registrar en el log si la inserción fue exitosa.
            if ($viveConId) {
              $data['ingreso_id'] = $viveConId;
              $data['log_log'] = print_r($viveConArray, true);
              $data['log_tipo'] = 'CREAR VIVE CON';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          } else if ($viveConId == '' && $nombre != '' && $parentesco != '' && $telefono != '') {
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

        #region EDITAR FORMACION ACADEMICA
        // Insertar Formación Académica.
        $formacionModel = new Page_Model_DbTable_Datosacademicos();
        $datos_academicos_id = $_POST['datos_academicos_id'];
        $datos_academicos_formacion = $_POST['datos_academicos_formacion'];

        $datosArray = [];

        foreach ($datos_academicos_formacion as $index => $formacion) {
          $datos_academicos_id = $datos_academicos_id[$index];
          if ($formacion != '' && $datos_academicos_id != '') {
            $datosArray = [
              'datos_academicos_formacion' => $formacion,
              'datos_academicos_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Editar en la base de datos.
            $formacionModel->update($datosArray, $datos_academicos_id);

            // Registrar en el log si la inserción fue exitosa.
            if ($datos_academicos_id) {
              $data['ingreso_id'] = $datos_academicos_id;
              $data['log_log'] = print_r($datosArray, true);
              $data['log_tipo'] = 'CREAR FORMACION ACADEMICA';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          } else if ($formacion != '' && $datos_academicos_id == '') {
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


        #region INSERTAR DATOS LABORALES
        // Insertar Datos Laborales.
        $datosLaboralesModel = new Page_Model_DbTable_Datoslaborales();
        $datos_laborales_id = $_POST['datos_laborales_id'];
        $datos_laborales_empleo = $_POST['datos_laborales_empleo'];
        $datos_laborales_fecha_inicio = $_POST['datos_laborales_fecha_inicio'];
        $datos_laborales_fecha_fin = $_POST['datos_laborales_fecha_fin'];
        $datos_laborales_motivo_retiro = $_POST['datos_laborales_motivo_retiro'];
        $datosLaboralesArray = [];

        foreach ($datos_laborales_empleo as $index => $formacionLaboral) {
          $datosLaboralesId = $datos_laborales_id[$index];
          $fechaInicio = $datos_laborales_fecha_inicio[$index];
          $fechaFin = $datos_laborales_fecha_fin[$index];
          $motivoRetiro = $datos_laborales_motivo_retiro[$index];

          if ($datosLaboralesId != '' && $formacionLaboral != '' && $fechaInicio != '' && $fechaFin != '' && $motivoRetiro != '') {
            $datosLaboralesArray = [
              'datos_laborales_empleo' => $formacionLaboral,
              'datos_laborales_fecha_inicio' => $fechaInicio,
              'datos_laborales_fecha_fin' => $fechaFin,
              'datos_laborales_motivo_retiro' => $motivoRetiro,
              'datos_laborales_cedula_colaborador' => $data['ingreso_cedula']
            ];

            // Editar en la base de datos.
            $datosLaboralesModel->update($datosLaboralesArray, $datosLaboralesId);

            // Registrar en el log si la inserción fue exitosa.
            if ($datosLaboralesId) {
              $data['ingreso_id'] = $datosLaboralesId;
              $data['log_log'] = print_r($datosLaboralesArray, true);
              $data['log_tipo'] = 'CREAR DATOS LABORALES';
              $logModel = new Administracion_Model_DbTable_Log();
              $logModel->insert($data);
            }
          } else if ($datosLaboralesId == '' && $formacionLaboral != '' && $fechaInicio != '' && $fechaFin != '' && $motivoRetiro != '') {
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

        if ($id) {
          // Crear una instancia del modelo de envío de correo electrónico
          $mailModel = new Core_Model_Sendingemail($this->_view);

          // Enviar correo de REGISTRO
          $mail = $mailModel->sendIngreso($id);
          Session::getInstance()->set("token", null);
          Session::getInstance()->set("email", null);

          // Registrar el ingreso principal en el log.
          $data['ingreso_id'] = $id;
          $data['log_log'] = print_r($data, true);
          $data['log_tipo'] = 'CREAR INGRESO';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($data);
          if ($mail == 1) {
            header("Location: /page/envio?ingreso={$id}&estado=1");
          } else {
            header("Location: /page/envio?ingreso={$id}&estado=2");
          }
        } else {
          Session::getInstance()->set("error", "Hubo un error al momento de guardar el registro, por favor intente nuevamente.");
          Session::getInstance()->set("tipo", "danger");

          header('Location: /page/error/ ');
        }
      }
    }
    // header('Location: ' . $this->route . '' . '');
  }



  #region GET DATA

  /**
   * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Ingreso.
   *
   * @return array con toda la informacion recibida del formulario.
   */
  private function getData()
  {
    $data = [];
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



  #region GET CIUDADES

  /**
	 * Genera los valores del campo Ciudad.
	 *
	 * @return array cadena con los valores del campo Ciudad.
	 */
	private function getCiudad()
	{
		$modelData = new Page_Model_DbTable_Dependciudad();
		$data = $modelData->getList("", "codigo DESC");
		$array = array();
		foreach ($data as $key => $value) {
			$array[$value->codigo] = $value->nombre;
		}
		return $array;
	}


  #region GET ESTADO CIVIL
  private function getEstadoCivil()
  {
    $array = [];
    $array['Soltero(a)'] = 'Soltero(a)';
		$array['Casado(a)'] = 'Casado(a)';
		$array['Viudo(a)'] = 'Viudo(a)';
    return $array;
  }



  #region GET GENERO

  /**
   * Genera los valores del campo Sexo.
   *
   * @return array cadena con los valores del campo Sexo.
   */
  private function getIngresosexo()
  {
    $array = [];
    $array['Femenimo'] = 'Femenimo';
    $array['Masculino'] = 'Masculino';

    return $array;
  }


  #region GET VIVE EN CASA
  /**
   * Genera los valores del campo Vive en casa.
   *
   * @return array cadena con los valores del campo Vive en casa.
   */
  private function getIngresovivecasa()
  {
    $array = [];
    $array['Familiar'] = 'Familiar';
    $array['Alquilada'] = 'Alquilada';
    $array['Propia'] = 'Propia';

    return $array;
  }


  #region GET PARENTESCO

  /**
   * Genera los valores del campo Sexo.
   *
   * @return array cadena con los valores del campo Sexo.
   */
  private function getParentesco()
  {
    $array = [];
    $array['Padre'] = 'Padre';
    $array['Madre'] = 'Madre';
    $array['Hermano'] = 'Hermano';
    $array['Hermana'] = 'Hermana';
    $array['Esposo'] = 'Esposo';
    $array['Esposa'] = 'Esposa';
    $array['Hijo'] = 'Hijo';
    $array['Hija'] = 'Hija';
    $array['Abuelo'] = 'Abuelo';
    $array['Abuela'] = 'Abuela';
    $array['Nieto'] = 'Nieto';
    $array['Nieta'] = 'Nieta';
    $array['Tío'] = 'Tío';
    $array['Tía'] = 'Tía';
    $array['Primo'] = 'Primo';
    $array['Prima'] = 'Prima';
    $array['Sobrino'] = 'Sobrino';
    $array['Sobrina'] = 'Sobrina';
    $array['Suegro'] = 'Suegro';
    $array['Suegra'] = 'Suegra';
    $array['Cuñado'] = 'Cuñado';
    $array['Cuñada'] = 'Cuñada';

    return $array;
  }




  #region VALLIDAR CEDULA

  public function validarcedulaAction()
  {

    $this->setLayout('blanco');
    $cedula = $this->_getSanitizedParam("cc");
    $data = $this->mainModel->getList(" ingreso_cedula = '$cedula'");
    if ($data) {
      echo json_encode(['status' => 'error', 'message' => 'La cedula ya se encuentra registrada']);
    } else {
      echo json_encode(['status' => 'success', 'message' => 'Cedula valida']);
    }
  }

  public function elimiardependienteAction()
  {

    $this->setLayout('blanco');
    $id = $this->_getSanitizedParam("id");
    $dependientesModel = new Page_Model_DbTable_Dependientes();
    $dependientesModel->deleteRegister($id);

    echo json_encode(['title' => 'Listo!', 'status' => 'success', 'text' => 'Registro eliminado exitosamente.']);
  }

  public function eliminarviveconAction()
  {

    $this->setLayout('blanco');
    $id = $this->_getSanitizedParam("id");
    $viveConModel = new Page_Model_DbTable_Conquienesvive();
    $viveConModel->deleteRegister($id);

    echo json_encode(['title' => 'Listo!', 'status' => 'success', 'text' => 'Registro eliminado exitosamente.']);
  }

  public function eliminarformacionAction()
  {

    $this->setLayout('blanco');
    $id = $this->_getSanitizedParam("id");
    $datosAcademicosModel = new Page_Model_DbTable_Datosacademicos();
    $datosAcademicosModel->deleteRegister($id);

    echo json_encode(['title' => 'Listo!', 'status' => 'success', 'text' => 'Registro eliminado exitosamente.']);
  }

  public function eliminardatoslaboralesAction()
  {

    $this->setLayout('blanco');
    $id = $this->_getSanitizedParam("id");
    $datosLaboralesModel = new Page_Model_DbTable_Datoslaborales();
    $datosLaboralesModel->deleteRegister($id);

    echo json_encode(['title' => 'Listo!', 'status' => 'success', 'text' => 'Registro eliminado exitosamente.']);
  }
}
