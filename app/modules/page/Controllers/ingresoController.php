<?php
/**
* Controlador de Ingreso que permite la  creacion, edicion  y eliminacion de los ingreso del Sistema
*/
class Page_ingresoController extends Page_mainController
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
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "page_ingreso";

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
		$this->namefilter = "parametersfilteringreso";
		$this->route = "/page/ingreso";
		$this->namepages ="pages_ingreso";
		$this->namepageactual ="page_actual_ingreso";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
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
		$title = "Aministración de ingreso";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  ingreso  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_ingreso_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_ingreso_sexo = $this->getIngresosexo();
		$this->_view->list_ingreso_vive_casa = $this->getIngresovivecasa();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->ingreso_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar ingreso";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear ingreso";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear ingreso";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un ingreso  y redirecciona al listado de ingreso.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['ingreso_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR INGRESO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un ingreso  y redirecciona al listado de ingreso.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->ingreso_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['ingreso_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR INGRESO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un ingreso  y redirecciona al listado de ingreso.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR INGRESO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Ingreso.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['ingreso_fecha_ingreso'] = '' ;
		$data['ingreso_nombre'] = $this->_getSanitizedParam("ingreso_nombre");
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
		$data['ingreso_fecha_solicitud'] = '' ;
		$data['ingreso_estado_solicitud'] = '' ;
		return $data;
	}

	/**
     * Genera los valores del campo Sexo.
     *
     * @return array cadena con los valores del campo Sexo.
     */
	private function getIngresosexo()
	{
		$array = array();
		$array['Data'] = 'Data';
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
		$array['Data'] = 'Data';
		return $array;
	}

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->ingreso_fecha_ingreso != '') {
                $filtros = $filtros." AND ingreso_fecha_ingreso LIKE '%".$filters->ingreso_fecha_ingreso."%'";
            }
            if ($filters->ingreso_nombre != '') {
                $filtros = $filtros." AND ingreso_nombre LIKE '%".$filters->ingreso_nombre."%'";
            }
            if ($filters->ingreso_fecha_nacimiento != '') {
                $filtros = $filtros." AND ingreso_fecha_nacimiento LIKE '%".$filters->ingreso_fecha_nacimiento."%'";
            }
            if ($filters->ingreso_cedula != '') {
                $filtros = $filtros." AND ingreso_cedula LIKE '%".$filters->ingreso_cedula."%'";
            }
            if ($filters->ingreso_nacionalidad != '') {
                $filtros = $filtros." AND ingreso_nacionalidad LIKE '%".$filters->ingreso_nacionalidad."%'";
            }
		}
        return $filtros;
    }

    /**
     * Recibe y asigna los filtros de este controlador
     *
     * @return void
     */
    protected function filters()
    {
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['ingreso_fecha_ingreso'] =  $this->_getSanitizedParam("ingreso_fecha_ingreso");
					$parramsfilter['ingreso_nombre'] =  $this->_getSanitizedParam("ingreso_nombre");
					$parramsfilter['ingreso_fecha_nacimiento'] =  $this->_getSanitizedParam("ingreso_fecha_nacimiento");
					$parramsfilter['ingreso_cedula'] =  $this->_getSanitizedParam("ingreso_cedula");
					$parramsfilter['ingreso_nacionalidad'] =  $this->_getSanitizedParam("ingreso_nacionalidad");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}