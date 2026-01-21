<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CartItemsModel;
use App\Models\CartModel;
use CodeIgniter\Controller;


class CartController extends BaseController
{

    protected $productModel;
    protected $cartItemModel;
    protected $cartModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->cartItemModel = new CartItemsModel();
        $this->cartModel = new CartModel();
    }

    public function index()
    {

        $user_id = session()->get('user_id');

        $cart = $this->cartModel->getActiveCart($user_id);

        $cart_items = $this->cartItemModel->productsInCart($cart['cart_id']);

        return view('cart/index', ['cart_items' => $cart_items]);
    }

    public function addToCart()
    {

        $user_id = session()->get('user_id');

        $product_id = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('price');

        // Check if the user has an active cart

        $cart = $this->cartModel->getActiveCart($user_id);

        if (!$cart) {
            $cart_id = $this->cartModel->createCart($user_id);
        } else {
            $cart_id = $cart['cart_id'];
        }

        $this->cartItemModel->addItemToCart($cart_id, $product_id, $price, $quantity);

        return redirect()->to('cart');
    }

    public function updateCart()
    {

        $cart_item_id = $this->request->getPost('cart_item_id');
        $product_id = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity');
        $price = $this->request->getPost('price');

        $this->cartItemModel->addItemToCart($cart_item_id, $product_id, $price, $quantity);

        return redirect()->to('cart');
    }

    public function removeFromCart()
    {
        $cart_item_id = $this->request->getPost('cart_item_id');

        $this->cartItemModel->delete($cart_item_id);

        return redirect()->to('cart');
    }
}
