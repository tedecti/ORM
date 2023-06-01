<?php

namespace Src\Controllers;

use Src\Models;

class User extends Models
{
    public $table = 'users';

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById($id)
    {
        return $this->getById($id);
    }
}