<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    /**
     * Default action show insert form
     */
    public function indexAction()
    {
        $form = new UserForm();

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
                        break;
                    }
                } else {
                    $this->flash->success("User was created successfully");
                }
            }
        }

        $this->view->setVar('form', $form);
    }
}