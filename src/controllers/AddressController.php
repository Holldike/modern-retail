<?php

use Phalcon\Mvc\Controller;

class AddressController extends Controller
{
    /**
     * Default action show list
     */
    public function indexAction()
    {
        $this->view->setVar('address', Address::find());
    }

    public function deleteAction($address_id)
    {

    }

    public function editAction($user_id)
    {
        $user = User::findFirstByUserId($user_id);
        if (!$user) {
            $this->flash->error('User was not found.');

            $this->response->redirect('/user');
        }

        $form = new AddressForm();
        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $user);

            if (!$form->isValid($this->request->getPost())) {
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
                    $this->flash->success('Address was added successfully.');
                }
            }
        }

        $this->view->setVar('form', $form);
        $this->view->setVar('user', $user);
        $this->view->setVar('addresses', $user->address);
    }
}