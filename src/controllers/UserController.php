<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    /**
     * Shows user list
     */
    public function indexAction()
    {
        $this->view->setVar('users', User::find());
    }

    /**
     * Shows edit form
     * @param $user_id
     */
    public function editAction($user_id)
    {
        $user = User::findFirstByUserId($user_id);
        if (!$user) {
            return;
        }

        $this->view->setVar('form', new AddressForm());
        $this->view->setVar('user', $user);
    }

    /**
     * Shows insert form
     */
    public function insertAction()
    {
        $form = new UserForm();
        $this->view->setVar('form', $form);
    }

    /**
     * Saves user
     */
    public function saveAction()
    {
        $user = new User();
        $form = new UserForm();
        $form->bind($this->request->getPost(), $user);

        if (!$form->isValid()) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error((string)$message);
            }
        } else {
            $user->save();
            $this->flashSession->success("User was created successfully");
        }

        $this->response->redirect('/user/insert');
    }
}