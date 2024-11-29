<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductImageModel;

class ProductController extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $productImageModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new ProductCategoryModel();
        $this->productImageModel = new ProductImageModel();
    }

    public function index()
    {
        $title = 'Products';
        $page_title = 'Products';
        $menu = 'cms';

        return view('backend/cms/products/index', compact('title', 'page_title', 'menu'));
    }

    public function getData()
    {
        $request = service('request');
        $draw = $request->getPost('draw');
        $start = $request->getPost('start');
        $length = $request->getPost('length');
        $searchValue = $request->getPost('search')['value'];

        $productModel = $this->productModel;
        $query = $productModel->join('product_categories', 'products.category_id = product_categories.id', 'left')
                              ->select('products.*, product_categories.name as category_name');

        if (!empty($searchValue)) {
            $query = $query->groupStart()
                           ->like('products.name', $searchValue)
                           ->orLike('product_categories.name', $searchValue)
                           ->groupEnd();
        }

        $totalFiltered = $query->countAllResults(false);
        $products = $query->orderBy('products.id', 'DESC')->findAll($length, $start);
        $totalRecords = $productModel->countAll();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product['id'],
                'name' => esc($product['name']),
                'category' => esc($product['category_name']),
                'price' => esc($product['price']),
                'status' => $product['status'] === 'active' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>',
                'actions' => '
                    <a href="' . base_url('cms/products/edit/' . $product['id']) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="' . $product['id'] . '">
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
        $title = 'Add Product';
        $page_title = 'Add Product';
        $menu = 'cms';
        $categories = $this->categoryModel->findAll();

        return view('backend/cms/products/create', compact('title', 'page_title', 'menu', 'categories'));
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'category_id' => 'required|integer',
            'name' => 'required|max_length[255]',
            'price' => 'permit_empty|decimal',
            'description' => 'permit_empty|string',
            'status' => 'required|in_list[active,inactive]',
            'meta_title' => 'max_length[255]',
            'meta_description' => 'max_length[255]',
            'meta_keywords' => 'max_length[255]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $productId = $this->productModel->insert([
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'status' => $this->request->getPost('status'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
        ]);

        $specifications = $this->request->getPost('specifications');
        if (!empty($specifications['keys']) && !empty($specifications['values'])) {
            $db = \Config\Database::connect();
            $builder = $db->table('product_specifications');
            foreach ($specifications['keys'] as $index => $key) {
                if (!empty($key) && !empty($specifications['values'][$index])) {
                    $builder->insert([
                        'product_id' => $productId,
                        'specification_key' => $key,
                        'specification_value' => $specifications['values'][$index],
                    ]);
                }
            }
        }

        $this->handleImageUpload($productId);
        return redirect()->to('/cms/products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            return redirect()->to('/cms/products')->with('error', 'Product not found.');
        }

        $categories = $this->categoryModel->findAll();
        $db = \Config\Database::connect();
        $specifications = $db->table('product_specifications')
                            ->where('product_id', $id)
                            ->get()
                            ->getResultArray();
        $images = $this->productImageModel->where('product_id', $id)->findAll();

        $title = 'Edit Product';
        $page_title = 'Edit Product';
        $menu = 'cms';

        return view('backend/cms/products/edit', compact('title', 'page_title', 'menu', 'product', 'categories', 'specifications', 'images'));
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'category_id' => 'required|integer',
            'name' => 'required|max_length[255]',
            'price' => 'permit_empty|decimal',
            
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->productModel->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'status' => $this->request->getPost('status'),
            'meta_title' => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
            'meta_keywords' => $this->request->getPost('meta_keywords'),
        ]);

        $db = \Config\Database::connect();
        $builder = $db->table('product_specifications');
        $builder->where('product_id', $id)->delete();

        $specifications = $this->request->getPost('specifications');
        if (!empty($specifications['keys']) && !empty($specifications['values'])) {
            foreach ($specifications['keys'] as $index => $key) {
                if (!empty($key) && !empty($specifications['values'][$index])) {
                    $builder->insert([
                        'product_id' => $id,
                        'specification_key' => $key,
                        'specification_value' => $specifications['values'][$index],
                    ]);
                }
            }
        }

        $this->handleImageUpload($id);
        return redirect()->to('/cms/products')->with('success', 'Product updated successfully.');
    }

    public function handleImageUpload($productId)
    {
        $files = $this->request->getFiles();
        if ($files && isset($files['images'])) {
            $uploadedImages = [];
            foreach ($files['images'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fileMimeType = $file->getMimeType();
                    $filePath = 'uploads/products/';
                    $fileName = $file->getRandomName();

                    if (!is_dir($filePath)) {
                        mkdir($filePath, 0777, true);
                    }

                    if ($file->move($filePath, $fileName)) {
                        $uploadedImages[] = [
                            'product_id' => $productId,
                            'image_path' => $filePath . $fileName,
                            'file_type'  => $fileMimeType,
                            'is_featured' => false,
                        ];
                    }
                }
            }

            if (!empty($uploadedImages)) {
                $this->productImageModel->insertBatch($uploadedImages);
            }
        }
    }

    public function setFeaturedImage($imageId, $productId)
    {
        $this->productImageModel->where('product_id', $productId)->set(['is_featured' => false])->update();
        $this->productImageModel->update($imageId, ['is_featured' => true]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Featured image updated successfully.',
        ]);
    }

    public function deleteImage($imageId)
    {
        try {
            // Find the image by ID
            $image = $this->productImageModel->find($imageId);

            if ($image) {
                // Delete the image file from storage
                if (file_exists($image['image_path'])) {
                    unlink($image['image_path']);
                }

                // Remove the image entry from the database
                $this->productImageModel->delete($imageId);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Image deleted successfully.',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Image not found.',
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error deleting image: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'An error occurred while deleting the image.',
            ]);
        }
    }

}
