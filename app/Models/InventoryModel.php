<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'inventory';
    protected $allowedFields = ['product_id', 'stock_quantity', 'stock_threshold'];

    public function createStore($product_quantity)
    {
        $this->insert($product_quantity);
    }

    public function viewInventory()
    {
        $this->select('products.name, inventory.stock_quantity, inventory.stock_threshold');
        $this->from('products');
        $this->join('inventory', 'products.product_id = inventory.product_id', 'left');
        $query = $this->get();

        $data['inventor'] = $query->result_array();

        $this->load->view('admin/inventory_view', $data);
    }

    public function getProductWithStock($productId)
    {
        $this->select('products.*, inventory.stock_quantity, inventory.stock_threshold');
        $this->from('products');
        $this->join('inventory', 'products.product_id = inventory.product_id', 'left');
        $this->where('products.product_id', $productId);

        $query = $this->get();

        return $query->row_array();
    }

    public function updateStock($productId, $quantity)
    {
        $this->set('stock_quantity', 'stock_quantity - ' . (int)$quantity, FALSE);
        $this->where('product_id', $productId);
        $this->update('inventory');
    }

    public function replenishStock($productId, $quantity)
    {
        $this->set('stock_quantity', 'stock_quantity + ' . (int)$quantity, FALSE);
        $this->where('product_id', $productId);
        $this->update('inventory');
    }
}
