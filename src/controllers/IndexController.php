<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    /**
     * Shows user list
     */
    public function indexAction()
    {
        $this->dispatcher->forward(['controller' => 'user']);
    }

    /**
     * Shows 404
     */
    public function route404Action()
    {
    }
}