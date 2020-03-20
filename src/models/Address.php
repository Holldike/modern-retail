<?php

use Phalcon\Mvc\Model;

class Address extends Model
{
    public $address_id;
    public $user_id;
    public $city;
    public $postcode;
    public $region;
    public $street;
}