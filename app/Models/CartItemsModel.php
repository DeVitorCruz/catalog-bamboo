<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemsModel extends Model
{
    protected $table = 'cart_items';
    protected $primarykey = 'cart_item_id';
    protected $allowedFields = ['cart_item_id', 'cart_id', 'product_id', 'quantity', 'price', 'total'];

    public function getCartItems($cart_id)
    {
        $this->where('cart_id', $cart_id);

        return $this->get()->getResultArray();
    }

    public function addItemToCart($cart_id, $product_id, $price, $quantity = 1)
    {
        $existingItem = $this->where('cart_id', $cart_id)
            ->where('product_id', $product_id)
            ->first();


        if ($existingItem) {
            $this->where('cart_item_id', $existingItem['cart_item_id'])->set(['quantity' => $existingItem['quantity'] + $quantity])
                ->update();
        } else {
            $this->insert([
                'cart_id' => $cart_id,
                'product_id' => $product_id,
                'price' => $price,
                'quantity' => $quantity
            ]);
        }
    }

    public function productsInCart($cart_id)
    {
        $this->select('cart_items.*, products.name, products.image_url')
            ->join('products', 'cart_items.product_id = products.product_id', 'left')
            ->where('cart_items.cart_id', $cart_id);

        return $this->get()->getResultArray();
    }
}
