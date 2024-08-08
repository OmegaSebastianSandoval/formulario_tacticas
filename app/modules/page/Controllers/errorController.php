<?php

class Page_errorController extends Page_mainController
{
    public function indexAction()
    {
        $error = Session::getInstance()->get("error");
        $tipo = Session::getInstance()->get("tipo");

        if ($error) {
            $this->_view->error = $error;
            $this->_view->tipo = $tipo;
            Session::getInstance()->set("error", "");
            Session::getInstance()->set("tipo", "");
        }
    }
}
