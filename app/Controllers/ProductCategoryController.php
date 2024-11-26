<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;

class ProductCategoryController extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new ProductCategoryModel();
    }

    public function index()
    {
        $title = 'Product Categories';
        $page_title = 'Product Categories';
        $menu = 'cms';

        return view('backend/cms/categories/index', compact('title', 'page_title', 'menu'));
    }

    public function getData()
    {
        $request = service('request');
        $categoryModel = $this->categoryModel;

        // DataTable parameters
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        // Total records
        $totalRecords = $categoryModel->countAll();

        // Apply search filter
        if (!empty($searchValue)) {
            $categoryModel->like('name', $searchValue);
        }

        // Total filtered records
        $totalFiltered = $categoryModel->countAllResults();

        // Fetch paginated data
        if (!empty($searchValue)) {
            $categoryModel->like('name', $searchValue);
        }
        $categories = $categoryModel->orderBy('id', 'DESC')->findAll($length, $start);

        // Format data for DataTable
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category['id'],
                'name' => esc($category['name']),
                'actions' => '
                    <a href="' . base_url('cms/products/categories/edit/' . $category['id']) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="' . $category['id'] . '">
                        <i class="fas fa-trash"></i> Delete
                    </button>',
            ];
        }

        // Response for DataTable
        return $this->response->setJSON([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ]);
    }

    public function create()
    {
        $title = 'Add Category';
        $page_title = 'Add Category';
        $menu = 'cms';

        return view('backend/cms/categories/create', compact('title', 'page_title', 'menu'));
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        // Validate input
        $validation->setRules([
            'name' => 'required|max_length[255]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Save category
        $this->categoryModel->save([
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/cms/products/categories')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $title = 'Edit Category';
        $page_title = 'Edit Category';
        $menu = 'cms';
        $category = $this->categoryModel->find($id);

        if (!$category) {
            return redirect()->to('/cms/products/categories')->with('error', 'Category not found.');
        }

        return view('backend/cms/categories/edit', compact('title', 'page_title', 'menu', 'category'));
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        // Validate input
        $validation->setRules([
            'name' => 'required|max_length[255]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Update category
        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);

        return redirect()->to('/cms/products/categories')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        if (!$this->categoryModel->find($id)) {
            return redirect()->to('/cms/products/categories')->with('error', 'Category not found.');
        }

        $this->categoryModel->delete($id);
        return redirect()->to('/cms/products/categories')->with('success', 'Category deleted successfully.');
    }
}
