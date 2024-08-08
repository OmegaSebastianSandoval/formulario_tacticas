<?php

class Page_envioController extends Page_mainController
{
    public function indexAction()
    {
        $ingresoModel = new Page_Model_DbTable_Ingreso();
        $ingresoId = $this->_getSanitizedParam('ingreso');
        $estado = $this->_getSanitizedParam('estado');
        $ingreso = $ingresoModel->getById($ingresoId);
        $this->_view->ingreso = $ingreso;
        $this->_view->estado = $estado;
    }
  
    
}
