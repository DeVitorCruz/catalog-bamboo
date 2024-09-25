<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryAttributeModel extends Model
{
    protected $table = 'category_attribute';
    protected $primaryKey = ['category_id', 'attribute_id'];
    protected $allowedFields = ['category_id', 'attribute_id'];

    // Method to save attributes associated with a category
    public function saveAttributes($category_id, $attribute_ids)
    {

        // Start a database transaction to ensure atomicity
        $this->db->transStart();

        // Clear previous relations for this category
        $this->where('category_id', $category_id)->delete();

        // Now we can insert the new set of attributes for the category
        $data = [];
        foreach ($attribute_ids as $attribute_id) {
            $data[] = [
                'category_id' => $category_id,
                'attribute_id' => $attribute_id
            ];
        }

        // Complete the transaction
        $this->db->transComplete();

        // Check for success or failure of the transaction

        if ($this->db->transStatus() === FALSE) {
            // Handle the failure scenario
            throw new \RuntimeException('Failed to save category attributes');
        } else {

            // Insert the data into the database

            if ($this->insertBatch($data)) {
                // On success, redirect back with success message
                return redirect()->to(current_url())->with('success', 'Attributes successfully linked to the category.');
            } else {
                // On failure, redirect back with error message
                return redirect()->back()->with('error', 'Failed to link attributes.');
            }
        }
    }

    // Method to get attributes associated with a specific category

    public function getAttributesByCategory($category_id)
    {
        return $this->db->table('category_attribute')
            ->select('attributes.attribute_id, attributes.name')
            ->join('attributes', 'category_attribute.attribute_id = attributes.attribute_id')
            ->where('category_attribute.category_id', $category_id)
            ->get()
            ->getResultArray();
    }
}
