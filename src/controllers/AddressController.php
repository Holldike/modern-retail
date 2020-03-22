<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class AddressController extends Controller
{
    public function indexAction()
    {
        $this->view->setVar('users', User::find());
        $this->assets->addJs('js/jquery.js');
    }

    /**
     * @param $address_id
     */
    public function deleteAction($address_id)
    {
        $address = Address::findFirst($address_id);
        if (!$address) {
           return;
        }

        $address->delete();
        $this->flash->success('Address was deleted successfully.');
        $this->response->redirect('/user/edit/' . $address->user->user_id);
    }

    public function saveAction()
    {
        $post = $this->request->getPost();

        if (!User::findFirstByUserId($post['user_id'])) {
            return;
        }

        $address = new Address();
        $form = new AddressForm();
        $form->bind($post, $address);

        if (!$form->isValid($this->request->getPost())) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string)$message);
            }
        } else {
            $address->save();
            $this->flash->success('Address was added successfully.');
        }

        $this->response->redirect('/user/edit/' . $post['user_id']);
    }

    /**
     * Shows content list addresses
     */
    public function listContentAction()
    {
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);

        $filterData = [];

        if ($user_id = $this->request->getPost('filter_user')) {
            $filterData[] = 'user_id = ' . $user_id;
        }

        $this->view->setVar('addresses', Address::find($filterData));
    }
}