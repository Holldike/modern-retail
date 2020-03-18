<?php

use Phalcon\Mvc\Model;

class User extends Model
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $user_type;
    public $created_at;
}