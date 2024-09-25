<?php
// app/controllers/SettingsController.php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\AttributeModel;
use App\Models\CategoryAttributeModel;
use CodeIgniter\Controller;

class SettingsController extends BaseController
{
    protected $categoryModel;
    protected $attributeModel;
    protected $categoryAttributeModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->categoryAttributeModel = new CategoryAttributeModel();
        $this->attributeModel = new AttributeModel();
    }

    // Common validation rules for both category and attributes

    protected $validationRulesCategory = [
        'category_name' => 'required|min_length[3]|max_length[255]'
    ];
    protected $validationRulesAttributes = [
        'attribute_name' => 'required|min_length[3]|max_length[255]'
    ];

    // Function to sanitize input data

    protected function sanitizeInputCategory($data)
    {
        return [
            'name' => ucwords(strtolower(trim($data['category_name'])))
        ];
    }

    // Function to sanitize input data

    protected function sanitizeInputAttribute($data)
    {
        return [
            'name' => ucwords(strtolower(trim($data['attribute_name'])))
        ];
    }

    public function description()
    {

        $categoryModel = new CategoryModel();
        $attributeModel = new AttributeModel();

        // Fetch all categories and Attributes

        $data['categories'] = $categoryModel->getCategories();
        $data['attributes'] = $attributeModel->getAttributes();

        // Display the form to add categories and attributes
        return view('settings/description', $data);
    }

    public function addCategory()
    {
        $categoryModel = new CategoryModel();

        $data = [
            'category_name' => $this->request->getPost('category_name')
        ];

        $sanitizedData = $this->sanitizeInputCategory($data);

        if ($this->validate($this->validationRulesCategory)) {

            // Insert the sanitized data into the database
            if ($categoryModel->addCategory($sanitizedData)) {
                return redirect()->to('/settings/description')->with('message', 'Category added successfully!');
            } else {
                return redirect()->back()->withInput()->with('errors', $categoryModel->errors());
            }
        } else {

            // Return validation errors to the view
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Edit category form

    public function editCategory($id)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->find($id);

        return view('settings/edit_category', $data);
    }

    // Update category

    public function updateCategory($id)
    {
        $categoryModel = new CategoryModel();

        $data = [
            'category_name' => $this->request->getPost('category_name')
        ];

        $sanitizedData = $this->sanitizeInputCategory($data);

        if ($this->validate($this->validationRulesCategory)) {

            // Insert the sanitized data into the database
            if ($categoryModel->updateCategory($id, $sanitizedData)) {
                return redirect()->to('/settings/description')->with('message', 'Category added successfully!');
            } else {
                return redirect()->back()->withInput()->with('errors', $categoryModel->errors());
            }
        } else {

            // Return validation errors to the view
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Delete category

    public function deleteCategory($id)
    {
        $categoryModel = new CategoryModel();

        $categoryModel->deleteCategory($id);

        return redirect()->to(base_url('settings/description'))->with('success', 'Category deleted successfully');
    }

    public function addAttribute()
    {
        $attributeModel = new AttributeModel();

        $data = [
            'attribute_name' => $this->request->getPost('attribute_name')
        ];

        $sanitizedData = $this->sanitizeInputAttribute($data);

        if ($this->validate($this->validationRulesAttributes)) {

            // Insert the sanitized data into the database
            if ($attributeModel->addAttribute($sanitizedData)) {
                return redirect()->to('/settings/description')->with('success', 'Attribute added successfully!');
            } else {
                return redirect()->back()->withInput()->with('errors', $attributeModel->errors());
            }
        } else {
            // Return validation errors to the view
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Edit Attribute

    public function editAttribute($id)
    {
        $attributeModel = new AttributeModel();

        $data['attribute'] = $attributeModel->find($id);

        return view('settings/edit_attribute', $data);
    }

    // Update attribute

    public function updateAttribute($id)
    {
        $attributeModel = new AttributeModel();

        $data = [
            'attribute_name' => $this->request->getPost('attribute_name')
        ];

        $sanitizedData = $this->sanitizeInputAttribute($data);

        if ($this->validate($this->validationRulesAttributes)) {

            // update the sanitized data into the database
            if ($attributeModel->updateAttribute($id, $sanitizedData)) {
                return redirect()->to('/settings/description')->with('success', 'Attribute added successfully!');
            } else {
                return redirect()->back()->withInput()->with('errors', $attributeModel->errors());
            }
        } else {
            // Return validation errors to the view
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Delete attribute
    public function deleteAttribute($id)
    {
        $attributeModel = new AttributeModel();

        $attributeModel->deleteAttribute($id);

        return redirect()->to(base_url('settings/description'))->with('success', 'Attribute deleted successfully');
    }

    // Show form to assign attributes to a category
    public function assignAttributes()
    {
        $categories  = $this->categoryModel->findAll();
        $attributes = $this->attributeModel->findAll();

        // Pass the category, attributes, and existing category attributes to the view

        return view('settings/assign_attributes', [
            'categories' => $categories,
            'attributes' => $attributes,
        ]);
    }

    // Save the attributes associated with a category

    public function saveAttributes()
    {
        // Validate the inputs (ensure category_id and attributes_ids are provided)
        $validationRules = [
            'category_id' => 'required|integer',
            'attribute_ids' => 'required|is_array'
        ];

        // Validate input
        if (!$this->validate($validationRules)) {
            // If validation fails, redirect back with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Retrive the selected category ID
        $category_id = $this->request->getPost('category_id');

        // Retrive the attribute IDs
        $selected_attributes = $this->request->getPost('attribute_ids');

        if (!is_array($selected_attributes)) {
            $selected_attributes =  [$selected_attributes];
        }

        // Delegate the attribute saving operation to the model

        $this->categoryAttributeModel->saveAttributes($category_id, $selected_attributes);

        return redirect()->to('/settings/description')->with('success', 'Attributes assigned successfully');
    }

    public function getAttributesByCategory($category_id)
    {
        $categoryAttributes = $this->categoryAttributeModel->getAttributesByCategory($category_id);
        return $this->response->setJSON($categoryAttributes);
    }
}
