<?php

use Phalcon\Mvc\Controller;

class UserControlController extends Controller
{
    public function indexAction()
    {
        $form = new InsertUserForm();

        if ($this->request->isPost()) {
            $user = new User(['created_at' => date("Y-m-d H:i:s")]);
            $form->bind($this->request->getPost(), $user);

            if (!$form->isValid()) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error((string)$message);
                    break;
                }
            } else {
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


    public function editAction($user_id)
    {

    }
}