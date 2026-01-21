<?php

namespace App\Controllers;

use App\Models\OrderModel;
use CodeIgniter\Controller;

class OrderController extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function placeOrder()
    {
        $user_id = session()->get('user_id');
        $cart_items = session()->get('cart');

        $order_id = $this->orderModel->placeOrder($user_id, $cart_items);

        if ($order_id !== false) {
            session()->remove('cart');
            return redirect()->to('/orders/success');
        } else {
            return redirect()->back()->with('error', 'Failed to place order.');
        }
    }

    // View order history
    public function orderHistory()
    {
        $user_id = session()->get('user_id');

        $orders = $this->orderModel->getOrderHistory($user_id);

        return view('orders/history', ['orders' => $orders]);
    }
}
