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

    public function updatePassword($userId, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        return $this->update($userId, ['password', $hashedPassword]);
    }
}
