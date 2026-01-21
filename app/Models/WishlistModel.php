<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $primarykey = 'wishlist_id';
    protected $allowedFields = ['user_id', 'product_id'];

    // Add to wishlist
    public function addToWishlist($user_id, $product_id)
    {
        $wishlist_item = [
            'user_id' => $user_id,
            'product_id' => $product_id
        ];

        return $this->insert($wishlist_item);
    }

    // Remove from wishlist
    public function removeFromWishlist($user_id, $product_id)
    {
        return $this->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->delete();
    }

    // Get the user's wishlist
    public function getWishlist($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }
}
