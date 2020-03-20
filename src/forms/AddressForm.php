<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class AddressForm extends Form
{
    public function initialize($entity = null, array $options = [])
    {
        //City
        $city = new Text(
            'city',
            [
                'placeholder' => 'City',
            ]
        );

        $city->addValidators([
            new PresenceOf([
                'message' => 'The city is required',
            ]),
            new StringLength([
                'message' => 'The city must has more then 4 symbols',
                'min' => 4,
            ])
        ]);

        //Region
        $region = new Text(
            'region',
            [
                'placeholder' => 'Region',
            ]
        );

        $region->addValidators([
            new PresenceOf([
                'message' => 'The region is required',
            ]),
            new StringLength([
                'message' => 'The region must has more then 4 symbols',
                'min' => 4,
            ])
        ]);

        //Street
        $street = new Text(
            'street',
            [
                'placeholder' => 'Street',
            ]
        );

        $street->addValidators([
            new PresenceOf([
                'message' => 'The street is required',
            ]),
            new StringLength([
                'message' => 'The street must has more then 4 symbols',
                'min' => 4,
            ])
        ]);

        //Postcode
        $postcode = new Text(
            'postcode',
            [
                'placeholder' => 'Postcode',
            ]
        );

        $postcode->addValidators([
            new PresenceOf([
                'message' => 'The postcode is required',
            ]),
            new StringLength([
                'message' => 'The postcode must has more then 4 symbols',
                'min' => 4,
            ])
        ]);

        //Set all
        $this->add($city);
        $this->add($region);
        $this->add($postcode);
        $this->add($street);
    }
}