<?php

namespace App\Models;

use App\Models\OrderItemModel;
use CodeIgniter\Model;

class OrdersModel extends Model
{

    protected $orderItemModel;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $allowedFields = ['user_id', 'total', 'status'];

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useTimestamps = true;

    public function __construct()
    {
        // Call the parent constructor to initialize the Model's default properties
        parent::__construct();

        $this->orderItemModel = new OrderItemModel();
    }

    public function placeOrder($user_id, $cart_items = null)
    {
        $order_data = [
            'user_id' => $user_id,
            'total' => 100,
            'status' => 'pending'
        ];

        $this->createOrder($order_data);

        $order_id = $this->getInsertID();

        foreach ($cart_items as $item) {
            $this->orderItemModel->addOrderItem($order_id, $item);
        }

        return $order_id;
    }

    public function createOrder($order_data)
    {
        return $this->insert($order_data);
    }

    private function calculateTotal($cart_items)
    {
        $total = 0;

        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function getOrderHistory($user_id)
    {
        $this->where('user_id', $user_id);

        return $this->get()->getResultArray();
    }
}
