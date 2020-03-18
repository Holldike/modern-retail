<?php

use Phalcon\Mvc\Controller;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->form = $this->getForm();
    }

    private function getForm()
    {
        $form = new Form();
        $form->add(
            new Text(
                'firstName',
                [
                    'maxlength' => 20,
                    'placeholder' => 'First Name',
                ]
            )
        );
        $form->add(
            new Text(
                'lastName',
                [
                    'maxlength' => 20,
                    'placeholder' => 'Last Name',
                ]
            )
        );
        $form->add(
            new Text(
                'email',
                [
                    'placeholder' => 'Email',
                ]
            )
        );
        $form->add(
            new Text(
                'password',
                [
                    'placeholder' => 'Password',
                ]
            )
        );
        $form->add(new Select(
            'userType',
            [
                1 => 'Client',
                2 => 'Admin',
            ]
        ));

        return $form;
    }
}