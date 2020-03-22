<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->dispatcher->forward(['controller' => 'user']);
    }

    public function route404Action()
    {

    }
}
