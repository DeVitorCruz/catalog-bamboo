<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price', 'total'];

    public function addOrderItem($order_id, $item)
    {
        $order_item = [
            'order_id' => $order_id,
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'total' => $item['price'] * $item['quantity']
        ];

        return $this->insert($order_item);
    }
}
