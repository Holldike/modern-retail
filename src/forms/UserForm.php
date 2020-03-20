<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\StringLength;

class UserForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {
        //Name
        $firstName = new Text(
            'firstname',
            [
                'maxlength' => 20,
                'placeholder' => 'First Name',
            ]
        );

        $lastName = new Text(
            'lastname',
            [
                'maxlength' => 20,
                'placeholder' => 'Last Name',
            ]
        );

        $nameValidators = [
            new PresenceOf([
                'message' => 'The all names is required',
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
            ])
        ]);

        //Password
        $password = new Password(
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
            'user_type',
            [
                'client' => 'Client',
                'admin' => 'Admin',
            ]
        );

        $userType->addValidators([
            new PresenceOf([
                'message' => 'The type of user is required',
            ]),
            new InclusionIn([
                'domain' => ['admin', 'client'],
                'message' => 'Sorry, but something went wrong, please repeat',
            ])
        ]);

        //Set all
        if ($options['edit']) {
            $this->add(new Hidden('user_id'));
        } else {
            $email->addValidator(
                new Uniqueness([
                    'message' => 'The e-mail is already exists',
                    'model' => new User()
                ])
            );
        }

        $this->add($firstName);
        $this->add($lastName);
        $this->add($email);
        $this->add($password);
        $this->add($userType);
    }
}