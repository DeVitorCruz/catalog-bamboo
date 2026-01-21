<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderUserModel extends Model
{
    protected $table = 'order_user';
    protected $primarykey = 'order_user_id';
    protected $allowedFields = ['order_id', 'user_id', 'full_name', 'email', 'shipping_address', 'payment_method'];

    protected $creaedField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useTimestamps = true;

    public function createUserOder($order_user)
    {
        return $this->insert($order_user);
    }
}
