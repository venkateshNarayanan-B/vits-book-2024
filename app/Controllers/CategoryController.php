<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockCategoryModel;

class CategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new StockCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Stock Categories',
            'page_title' => 'Manage Categories',
            'menu' => 'accounts'
        ];

        return view('backend/accounts/inventory/categories', $data);
    }

    public function fetchCategories()
    {
        $categories = $this->categoryModel->findAll();
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                esc($category['category_name']),
                '<a href="' . base_url("categories/edit/" . $category['id']) . '" class="btn btn-primary btn-sm">Edit</a>
                 <a href="' . base_url("categories/delete/" . $category['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Category',
            'page_title' => 'Add New Category',
            'menu' => 'accounts'
        ];

        return view('backend/accounts/inventory/add_category', $data);
    }

    public function store()
    {
        $validationRules = [
            'category_name' => 'required|min_length[3]|is_unique[stock_categories.category_name]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->save([
            'category_name' => $this->request->getPost('category_name')
        ]);

        return redirect()->to('categories')->with('swal_success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category not found');
        }

        $data = [
            'title' => 'Edit Category',
            'page_title' => 'Update Category',
            'menu' => 'accounts',
            'category' => $category
        ];

        return view('backend/accounts/inventory/edit_category', $data);
    }

    public function update($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Category not found');
        }

        $validationRules = [
            'category_name' => "required|min_length[3]|is_unique[stock_categories.category_name,id,{$id}]"
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->update($id, [
            'category_name' => $this->request->getPost('category_name')
        ]);

        return redirect()->to('categories')->with('swal_success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $this->categoryModel->delete($id);

        return redirect()->to('categories')->with('swal_success', 'Category deleted successfully.');
    }
}

