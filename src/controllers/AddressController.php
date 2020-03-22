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

    /**
     * Shows list of addresses with AJAX
     */
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
        if (!$address) {
            return;
        }

        $address->delete();
        $this->response->redirect('/user/edit/' . $address->user->user_id);
    }
}