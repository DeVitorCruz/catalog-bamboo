<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartItemsModel;
use App\Models\CheckoutModel;
use App\Models\OrdersModel;

use App\Models\OrderUserModel;
use CodeIgniter\Controller;

class CheckoutController extends BaseController
{
    protected $cartModel;
    protected $cartItemsModel;
    protected $orderUserModel;
    protected $ordersModel;
    protected $checkoutModel;

    protected $validationRules = [
        'full_name' => 'required|min_length[3]|max_length[255]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'shipping_address' => 'required|min_length[10]|max_length[255]',
        'payment_method' => 'required|in_list[credit_card, paypal, bank_transfer]'
    ];

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->cartItemsModel = new CartItemsModel();
        $this->orderUserModel = new OrderUserModel();
        $this->ordersModel = new OrdersModel();
        $this->checkoutModel = new CheckoutModel();
    }

    public function extractOrderUser()
    {
        $order_user = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'shipping_address' => $this->request->getPost('shipping_address'),
            'payment_method' => $this->request->getPost('payment_method')
        ];

        return $order_user;
    }

    public function sanitizeInput($data)
    {
        $sanitize_data = [];

        foreach ($data as $key => $item) {
            $sanitize_data[$key] = esc($item);
        }
        return $sanitize_data;
    }

    public function checkout()
    {
        $user_id = session()->get('user_id');

        $cart = $this->cartModel->getActiveCart($user_id);

        if (empty($cart)) {
            return redirect()->to('cart/index')->with('error', 'Your cart is empty.');
        }

        $cart_items = $this->cartItemsModel->productsInCart($cart['cart_id']);

        return view('checkout/index', ['cart_items' => $cart_items]);
    }

    public function processCheckout()
    {

        $user_id = session()->get('user_id');

        $cart = $this->cartModel->getActiveCart($user_id);

        if (empty($cart)) {
            return redirect()->to('cart/index')->with('error', 'Your cart is empty.');
        }

        if ($this->request->getMethod() === 'POST') {

            $order_user = $this->extractOrderUser();

            $order_user_sanitized = $this->sanitizeInput($order_user);

            $validation = \Config\Services::validation();

            $validation->setRules($this->validationRules);

            if (!$validation->run($this->request->getPost())) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $cart_items = $this->cartItemsModel->getCartItems($cart['cart_id']);
            $order_user_sanitized['user_id'] = (int)$user_id;
            
            $order_id = $this->ordersModel->placeOrder($user_id, $cart_items);
            $order_user_sanitized['order_id'] = (int)$order_id;

            $this->orderUserModel->createUserOder($order_user_sanitized);

            $this->cartModel->clearCart($cart['cart_id']);

            return redirect()->to('/')->with('success', 'Order placed successfully!');
        }

        $cart_items = $this->cartItemsModel->productsInCart($cart['cart_id']);

        return view('checkout/index', ['cart_items' => $cart_items]);
    }
}
