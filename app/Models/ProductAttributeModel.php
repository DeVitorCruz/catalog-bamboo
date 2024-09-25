<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributeModel extends Model
{
    protected $table = 'product_attributes';
    protected $primaryKey = 'product_attribute_id';
    protected $allowedFields = ['product_id', 'attribute_id', 'value'];

    public function addProductAttribute($productId, $attributeId, $value)
    {
        $data = [
            'product_id' => $productId,
            'attribute_id' => $attributeId,
            'value' => $value
        ];

        $this->insert($data);
    }

    public function updateAttributes($product_id, $attributeValues)
    {
        // First, delete al existing attributes for the product
        $this->where('product_id', $product_id)->delete();

        // Then, insert the new attributes
        foreach ($attributeValues as $attribute) {
            $this->insert([
                'product_id' => $product_id,
                'attribute_id' => $attribute['attribute_id'],
                'value' => $attribute['value']
            ]);
        }
    }

    public function getAttributesByProductId($product_id)
    {
        return $this->db->table('product_attributes')
            ->select('attributes.name, product_attributes.value')
            ->join('attributes', 'product_attributes.attribute_id = attributes.attribute_id')
            ->where('product_attributes.product_id', $product_id)
            ->get()
            ->getResultArray();
    }
}
