<?php

use Phalcon\Mvc\Controller;

class UserControlController extends Controller
{
    public function indexAction()
    {
        $form = new InsertUserForm();

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error('This is an error');
                }
            } else {
                $user = new Users([
                    'name' => $this->request->getPost('name', 'striptags'),
                    'profilesId' => $this->request->getPost('profilesId', 'int'),
                    'email' => $this->request->getPost('email', 'email'),
                ]);

                if (!$user->save()) {
                    foreach ($user->getMessages() as $message) {
                        $this->flash->error((string)$message);
                    }
                } else {
                    $this->flash->success("User was created successfully");
                }
            }
        }

        $this->view->setVar('form', $form);
    }
}