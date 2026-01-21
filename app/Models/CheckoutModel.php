<?php

namespace App\Models;

use App\Models\CartModel;
use App\Models\CartItemsModel;
use App\Models\OrdersModel;
use CodeIgniter\Model;

class CheckoutModel extends Model
{

    protected $cartModel;
    protected $cartItemModel;
    protected $ordersModel;

    public function __construct()
    {

        parent::__construct();

        $this->cartModel = new CartModel();
        $this->cartItemModel = new CartItemsModel();
        $this->ordersModel = new OrdersModel();
    }

    public function checkout($cart_id, $user_id)
    {
        $this->cartModel->where('cart_id', $cart_id)->set(['status' => 'completed'])->update();

        $items = $this->cartItemModel->getCartItems($cart_id);

        return $this->ordersModel->placeOrder($user_id, $items);
    }
}
