<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['name'];

    public function getCategories()
    {
        return $this->findAll(); // Retrieves all products
    }

    public function addCategory($data)
    {
        return $this->insert($data);
    }

    // Method to update category

    public function updateCategory($id, $data)
    {
        return $this->update($id, $data);
    }

    // Method to delete category

    public function deleteCategory($id)
    {
        return $this->delete($id);
    }
}
