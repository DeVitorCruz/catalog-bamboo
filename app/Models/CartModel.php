<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primarykey = 'cart_id';
    protected $allowedFields = ['user_id', 'total', 'status'];

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useTimestamps = true;

    public function getActiveCart($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }

    public function createCart($user_id)
    {
        $data = [
            'user_id' => $user_id,
            'status' => 'open',
            'total' => 0
        ];

        $this->insert($data);

        return $this->getInsertID();
    }

    public function clearCart($cart_id)
    {
        return $this->where('cart_id', $cart_id)->delete();
    }
}
