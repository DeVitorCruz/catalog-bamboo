<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductAttributeModel;
use App\Models\CategoryModel;
use App\Models\AttributeModel;
use App\Models\InventoryModel;
use App\Models\CategoryAttributeModel;
use CodeIgniter\Controller;

class ProductController extends BaseController
{

    protected $productModel;
    protected $productCategoryModel;
    protected $productAttributeModel;
    protected $categoryModel;
    protected $attributeModel;
    protected $categoryAttributeModel;
    protected $inventoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->productAttributeModel = new ProductAttributeModel();
        $this->categoryModel = new CategoryModel();
        $this->attributeModel = new AttributeModel();
        $this->categoryAttributeModel = new CategoryAttributeModel();
        $this->inventoryModel = new InventoryModel();
    }


    // Common validation rules for both create and update actions

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[255]',
        'description' => 'max_length[1000]',
        'price' => 'required|decimal',
        'stock' => 'required|integer',
        'image_url' => 'permit_empty|valid_url'
    ];

    // Function to sanitize input data

    protected function sanitizeInput($data)
    {
        return [
            'name' => ucwords(strtolower(trim($data['name']))),
            'description' => trim($data['description']),
            'price' => number_format((float)$data['price'], 2, '.', ''),
            'stock' => (int)$data['stock'],
            'image_url' => filter_var($data['image_url'], FILTER_SANITIZE_URL)
        ];
    }

    public function list()
    {

        $categories = $this->categoryModel->getCategories();
        $attributes = $this->attributeModel->getAttributes();
        $product = $this->productModel->getProducts();

        $data = [
            'products' => $product,
            'categories' => $categories,
            'attributes' => $attributes
        ];

        // Fetch all products

        return view('products/list', $data); // Load the view to display
    }

    public function create()
    {

        $data['categories'] = $this->categoryModel->findAll();

        return view('products/create', $data); // Load the product form view
    }

    // Load attributes dynamically base on category
    public function getAttributesByCategory($category_id)
    {

        // Get the attributes for the selected category
        $attributes = $this->categoryAttributeModel->getAttributesByCategory($category_id);

        // Return as JSON
        return $this->response->setJSON($attributes);
    }

    // Store method for creating a new product
    public function store()
    {

        // Get and sanitize product data
        $product = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'image_url' => $this->request->getPost('image_url')
        ];

        // Validate product data

        if (!$this->validate($this->validationRules)) {
            return redirect()->back()->withInput('errors', $this->validator->getErrors());
        }

        $sanitizedData = $this->sanitizeInput($product);

        // Sanitize and validate category_id

        $category_id = $this->request->getPost('category_id');

        if (!is_numeric($category_id) || $category_id <= 0) {
            return redirect()->back()->withInput()->with('errors', ['category_id' => 'Invalid category selected.']);
        }

        // Sanitize and validate attribute values 

        $attributeValues = $this->request->getPost('attribute_values');

        if (!is_array($attributeValues)) {
            return redirect()->back()->withInput()->with('errors', ['attribute_values' => 'Invalid attribute values.']);
        }


        $quantity = $this->request->getPost('stock');

        if (!is_numeric($quantity) || $quantity < 0) {
            return redirect()->back()->withInput()->with('errors', ['stock' => 'Invalid stock selected.']);
        }

        // Further validation for each attribute

        foreach ($attributeValues as $attributedId => $value) {
            if (!isset($attributedId) || !is_numeric($attributedId)) {
                return redirect()->back()->withInput()->with('errors', ['attribute_id' => 'Invalid attribute ID.']);
            }

            if (!isset($value) || empty($value)) {
                return redirect()->back()->withInput()->with('error', ['value' => 'Attribute value is required.']);
            }
        }

        // Proceed to insert into products table
        $this->productModel->createProduct($sanitizedData);
        $product_id = $this->productModel->insertID(); // Get the last inserted product ID


        // Insert into the inventory table
        $product_quantity = [
            'product_id' => $product_id,
            'stock_quantity' => $quantity
        ];

        $this->inventoryModel->createStore($product_quantity);

        // Insert into product_categories table

        $this->productCategoryModel->addProductCategory($product_id, $category_id);

        // Insert into product_attributes table

        foreach ($attributeValues as $attributedId => $value) {
            $this->productAttributeModel->addProductAttribute($product_id, $attributedId, $value);
        }

        // Redirect with success message

        return redirect()->to('/product/create')->with('message', 'Product added successfully.');
    }

    public function edit($id)
    {

        // Fetch the product details

        $product = $this->productModel->getProduct($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product no found.');
        }

        // Fetch all available categories

        $categories = $this->categoryModel->getCategories();

        // Fetch the current category of the product

        $currentCategory = $this->productCategoryModel->where('product_id', $id)->first();

        // Fetch all attributes accosciated with the current category 

        $attributes = $this->categoryAttributeModel->getAttributesByCategory($currentCategory['category_id']);

        // Fetch the current attribute values for the product

        $currentAttributes = $this->productAttributeModel->where('product_id', $id)->findAll();

        // Pass data to the view for editing

        $data =  [
            'product' => $product,
            'categories' => $categories,
            'currentCategory' => $currentCategory,
            'attributes' => $attributes,
            'currentAttributes' => $currentAttributes
        ]; // Fetch product by ID

        return view('products/edit', $data); // Load the edit view
    }

    // Update method for editing an existing product
    public function update($id)
    {

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock'),
            'image_url' => $this->request->getPost('image_url')
        ];

        // Get post data and sanitize it

        $sanitizedData = $this->sanitizeInput($data);

        if (!$this->validate($this->validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // update product information
        $this->productModel->updateProduct($id, $sanitizedData);

        // Update category association
        $category_id = $this->request->getPost('category_id');

        if ($category_id) {
            $this->productCategoryModel->updateOrInsertCategory($id, $category_id);
        }

        // Update attribute values

        $attributeValues = $this->request->getPost('attribute_values');

        if (is_array($attributeValues)) {
            $this->productAttributeModel->updateAttributes($id, $attributeValues);
        }

        // Redirect with success message

        return redirect()->to('/product')->with('message', 'Product updated successfully.');
    }

    public function delete($id)
    {
        // Start a transaction for safe deletion
        $db = \Config\Database::connect();
        $db->transBegin();

        try {

            // Step 1: Delete from product_attributes
            $this->productAttributeModel->where('product_id', $id)->delete();

            // Step 2: Delete from product_categories
            $this->productCategoryModel->where('product_id', $id)->delete();

            // Step 3: Delete the product itself
            $this->productModel->deleteProduct($id);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete the product.');
            }

            $db->transCommit();
            return redirect()->to('/product')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if any error occurred
            $db->transRollback();
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }

    public function getProductDetails($product_id)
    {
        // Get product detials

        $product = $this->productModel->getProduct($product_id);
        $category = $this->productCategoryModel->getCategoryByProductId($product_id);
        $attributes = $this->productAttributeModel->getAttributesByProductId($product_id);

        // Return the product details as JSON
        return $this->response->setJSON([
            'product' => $product,
            'category' => $category,
            'attributes' => $attributes
        ]);
    }

    public function filterProducts()
    {
        $categories = $this->request->getPost('categories');
        $attributes = $this->request->getPost('attributes');
        $minPrice = $this->request->getPost('minPrice');
        $maxPrice = $this->request->getPost('maxPrice');

        // Pass the filters to the ProductModel
        $products = $this->productModel->filterProducts($categories, $minPrice, $maxPrice, $attributes);

        // Return the results as JSON

        return $this->response->setJSON($products);
    }

    public function filter()
    {
        $minPrice = $this->request->getGet('min_price');
        $maxPrice = $this->request->getGet('max_price');

        // Fetch products within the price range

        $products = $this->productModel->getProductsByPriceRange($minPrice, $maxPrice);

        // Load a partial view to return only the product grid
        return $this->response->setJSON($products);
    }
}
