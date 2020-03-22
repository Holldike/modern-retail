<?php

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    /**
     * Default action shows list
     */
    public function indexAction()
    {
        $this->view->setVar('users', User::find());
    }

    /**
     * Shows insert form
     */
    public function insertAction()
    {
        $form = new UserForm();

        if ($this->request->isPost()) {
            $user = new User();
            $form->bind($this->request->getPost(), $user);

            if (!$form->isValid()) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error((string)$message);
                    break;
                }
            } else {
                $user->save();
                $this->flash->success("User was created successfully");
            }
        }

        $this->view->setVar('form', $form);
    }

    /**
     * Shows edit form
     */
    public function editAction($user_id)
    {
        $user = User::findFirstByUserId($user_id);
        if (!$user) {
            return;
        }

        $form = new AddressForm();

        if ($this->request->isPost()) {
            $address = new Address();
            $address->user_id = $user_id;

            $form->bind($this->request->getPost(), $address);

            if (!$form->isValid($this->request->getPost())) {
                foreach ($form->getMessages() as $message) {
                    $this->flash->error((string)$message);
                    break;
                }
            } else {
                $address->save();
                $this->flash->success('Address was added successfully.');
            }
        }

        $this->view->setVar('form', $form);
        $this->view->setVar('user', $user);
    }
}