<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UsuarioModel extends Model
{
    protected $table                = 'usuarios';
    protected $allowedFields        = [
        'name', 'password', 'token'
    ];
    
    public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified email address');

        return $user;
    }
}
