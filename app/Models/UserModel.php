<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    public function registerUser($userData)
    {
        return $this->insert($userData);
    }

    public function findUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function updateUserRole($userId, $role)
    {
        return $this->update($userId, ['role' => $role]);
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }

    public function getUser($user_id)
    {
        return $this->find($user_id);
    }

    public function updatePassword($user_id, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($user_id, ['password' => $hashedPassword]);
    }
}
