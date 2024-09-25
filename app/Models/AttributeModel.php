<?php

namespace App\Models;

use CodeIgniter\Model;

class AttributeModel extends Model
{
    protected $table = 'attributes';
    protected $primaryKey = 'attribute_id';
    protected $allowedFields = ['name'];

    public function getAttributes()
    {
        return $this->findAll(); // Retrieves all products
    }

    public function addAttribute($data)
    {
        return $this->insert($data);
    }

    // Method to update attribute

    public function updateAttribute($id, $data)
    {
        return $this->update($id, $data);
    }

    // Method to delete attribute

    public function deleteAttribute($id)
    {
        return $this->delete($id);
    }
}
