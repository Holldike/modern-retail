<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->assets->addJs('js/jquery.js');
        $this->view->setVar('users', User::find());
    }

    public function addressListAction()
    {

    }
}