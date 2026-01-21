<?php

namespace App\Controllers;

use  App\Models\WishlistModel;
use CodeIgniter\Controller;

class WishlistController extends BaseController
{
    protected $wishlistModel;

    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
    }

    // Add to wishlist
    public function addToWishlist($product_id)
    {
        $user_id = session()->get('user_id');
        $this->wishlistModel->addToWishlist($user_id, $product_id);

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    // Remove from wishlist
    public function removeFromWishlist($product_id)
    {
        $user_id = session()->get('user_id');
        $this->wishlistModel->removeFromWishlist($user_id, $product_id);

        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }

    // View wishlist
    public function viewWishlist()
    {
        $user_id = session()->get('user_id');

        $wishlist = $this->wishlistModel->getWishlist($user_id);

        return view('wishlist/index', ['wishlist' => $wishlist]);
    }
}
