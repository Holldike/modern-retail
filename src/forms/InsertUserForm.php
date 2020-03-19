<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class InsertUserForm extends Form
{
    public function initialize()
    {
        //Name
        $firstName = new Text(
            'firstName',
            [
                'maxlength' => 20,
                'placeholder' => 'First Name',
            ]
        );

        $lastName = new Text(
            'lastName',
            [
                'maxlength' => 20,
                'placeholder' => 'Last Name',
            ]
        );

        $nameValidators = [
            new PresenceOf([
                'message' => 'The name is required',
            ]),
            new StringLength([
                'message' => 'The name is too short',
                'min' => 3,
            ])
        ];

        $firstName->addValidators($nameValidators);
        $lastName->addValidators($nameValidators);

        //Email
        $email = new Text(
            'email',
            [
                'placeholder' => 'Email',
            ]
        );

        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required',
            ]),
            new Email([
                'message' => 'The e-mail is not valid',
            ]),
        ]);

        //Password
        $password = new Text(
            'password',
            [
                'placeholder' => 'Password',
            ]
        );

        $password->addValidators([
            new StringLength([
                'message' => 'The password must has more then 4 symbols',
                'min' => 4,
            ])
        ]);

        //User type
        $userType = new Select(
            'userType',
            [
                1 => 'Client',
                2 => 'Admin',
            ]
        );

        $userType->addValidators([
            new PresenceOf([
                'message' => 'The type of user is required',
            ])
        ]);

        //Set all
        $this->add($firstName);
        $this->add($lastName);
        $this->add($email);
        $this->add($password);
        $this->add($userType);
    }
}