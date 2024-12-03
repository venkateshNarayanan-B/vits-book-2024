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
        $draw = $request->getPost('draw') ?? 0;
        $start = $request->getPost('start') ?? 0;
        $length = $request->getPost('length') ?? 10;
        $searchValue = $request->getPost('search')['value'] ?? '';

        $query = $this->categoryModel;
        if (!empty($searchValue)) {
            $query->like('name', $searchValue);
        }

        $totalFiltered = $query->countAllResults(false);
        $categories = $query->orderBy('id', 'DESC')->findAll($length, $start);
        $totalRecords = $this->categoryModel->countAll();

        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category['id'],
                'name' => esc($category['name']),
                'image' => $category['image']
                    ? base_url('uploads/categories/' . $category['image'])
                    : null,
                'actions' => '
                    <a href="' . base_url('cms/products/categories/edit/' . $category['id']) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="' . $category['id'] . '">
                        <i class="fas fa-trash"></i> Delete
                    </button>',
            ];
        }

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
        $validation->setRules([
            'name' => 'required|max_length[255]',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $fileName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/categories', $fileName);
        }

        $this->categoryModel->insert([
            'name' => $this->request->getPost('name'),
            'image' => $fileName,
            'slug' => url_title($this->request->getPost('name'), '-', true),
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
        $validation->setRules([
            'name' => 'required|max_length[255]',
            'image' => 'if_exist|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $fileName = null;

        $category = $this->categoryModel->find($id);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/categories', $fileName);

            if ($category && $category['image']) {
                @unlink('uploads/categories/' . $category['image']);
            }
        }

        $this->categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'image' => $fileName ?? $category['image'],
            'slug' => url_title($this->request->getPost('name'), '-', true),
        ]);

        return redirect()->to('/cms/products/categories')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/cms/products/categories')->with('error', 'Category not found.');
        }

        if (!empty($category['image'])) {
            @unlink('uploads/categories/' . $category['image']);
        }

        $this->categoryModel->delete($id);

        return redirect()->to('/cms/products/categories')->with('success', 'Category deleted successfully.');
    }
}
