<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class AddressController extends Controller
{
    /**
     * Default action show list
     */
    public function indexAction()
    {
        $users = User::find();

        $this->view->setVar('users', $users);
        $this->assets->addJs('js/jquery.js');
    }

    public function listAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);

        $filterData = [];
        if ($user_id = $this->request->getPost('filter_user')) {
            $filterData[] = 'user_id = ' . $user_id;
        }

        $addresses = Address::find($filterData);

        $this->view->setVar('addresses', $addresses);
    }

    /**
     * Delete specific address by its id
     * @param $address_id
     */
    public function deleteAction($address_id)
    {
        $address = Address::findFirst($address_id);
        if ($address) {
            $address->delete();
            $this->response->redirect('/address/editUser/' . $address->user->user_id);
        }
    }

    /**
     * Edits addresses for specific user
     * @param $user_id
     */
    public function editUserAction($user_id)
    {
        $user = User::findFirstByUserId($user_id);
        if (!$user) {
            $this->response->redirect('/user');
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
                if (!$address->save()) {
                    foreach ($address->getMessages() as $message) {
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