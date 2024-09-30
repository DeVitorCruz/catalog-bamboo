<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['name', 'description', 'price', 'stock', 'image_url'];

    // Optionally, you can define validatio rules

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'permit_empty|max_length[1000]',
        'price' => 'required|decimal',
        'stock' => 'required|integer',
        'image_url' => 'permit_empty|max_length[255]'
    ];

    // Method to get all products
    public function getProducts()
    {
        return $this->findAll(); // Retrieves all products
    }

    // Method to get a product by ID

    public function getProduct($id)
    {
        return $this->find($id);
    }

    // Method to create a new product
    public function createProduct($data)
    {
        return $this->insert($data);
    }

    // Method to updata an existing product
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }

    // Method to delete a product
    public function deleteProduct($id)
    {
        return $this->delete($id);
    }

    public function getAttributes($categoryId)
    {
        // Load the model if not already loaded
        $this->load->model('CategoryAttributeModel');

        // Get the attributes for the selected category

        $attributes = $this->CategoryAttributeModel->getAttributesByCategory($categoryId);

        // Return as JSON
        return $this->response->setJSON($attributes);
    }

    // Main method to apply all filters

    public function filterProducts($categories = null, $minPrice = null, $maxPrice = null, $attributes = [])
    {
        $builder = $this->db->table('products')
            ->select('products.*');

        // Apply individual filters

        $builder = $this->applyCategoryFilter($builder, $categories);
        $builder = $this->applyPriceFilter($builder, $minPrice, $maxPrice);
        $builder = $this->applyAttributeFilter($builder, $attributes);

        // Exacute the query and return the results
        return $builder->get()->getResultArray();
    }

    // Filter products by category

    private function applyCategoryFilter($builder, $categories)
    {
        // Filter by category
        if (!empty($categories)) {
            $builder->join('product_categories', 'product_categories.product_id = products.product_id');
            $builder->whereIn('product_categories.category_id', $categories);
        }

        return $builder;
    }

    // Filter products by price range
    private function applyPriceFilter($builder, $minPrice, $maxPrice)
    {
        if ($minPrice) {
            $builder->where('products.price >=', $minPrice);
        }
        if ($maxPrice) {
            $builder->where('products.price <=', $maxPrice);
        }

        return $builder;
    }

    // Filter products by attributes
    private function applyAttributeFilter($builder, $attributes)
    {
        if (!empty($attributes)) {
            $builder->join('product_attributes', 'product_attributes.product_id = products.product_id');
            $builder->whereIn('product_attributes.attribute_id', $attributes);
        }

        return $builder;
    }

    public function getProductsByPriceRange($minPrice, $maxPrice)
    {
        return $this->db->table('products')
            ->where('price >=', $minPrice)
            ->where('price <=', $maxPrice)
            ->get()
            ->getResultArray();
    }
}
