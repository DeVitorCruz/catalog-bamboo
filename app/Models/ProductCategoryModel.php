<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'product_id'; // Primary key for the Model
    protected $allowedFields = ['product_id', 'category_id'];

    public function addProductCategory($productId, $categoryId)
    {
        $data = [
            'product_id' => $productId,
            'category_id' => $categoryId
        ];

        $this->insert($data);
    }


    public function updateOrInsertCategory($product_id, $category_id)
    {

        // Check if the product already has a category
        $existingCategory = $this->where('product_id', $product_id)->first();

        if ($existingCategory) {
            // Update the category if it exists
            $this->update(['product_id' => $product_id], ['category_id' => $category_id]);
        } else {
            // Insert a new category if none exists
            $this->insert([
                'product_id' => $product_id,
                'category_id' => $category_id
            ]);
        }
    }

    public function getCategoryByProductId($product_id)
    {
        return $this->db->table('product_categories')
            ->select('categories.name')
            ->join('categories', 'product_categories.category_id = categories.category_id')
            ->where('product_categories.product_id', $product_id)
            ->get()
            ->getRowArray();
    }
}
