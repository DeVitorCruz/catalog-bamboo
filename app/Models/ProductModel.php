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
}
