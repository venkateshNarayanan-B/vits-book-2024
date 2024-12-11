<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockItemModel;
use App\Models\StockCategoryModel;

class ItemController extends BaseController
{
    protected $itemModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->itemModel = new StockItemModel();
        $this->categoryModel = new StockCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Stock Items',
            'page_title' => 'Manage Items',
            'menu' => 'accounts'
        ];

        return view('backend/accounts/inventory/items', $data);
    }

    public function fetchItems()
    {
        $items = $this->itemModel->getItemsWithCategory(); // Assumes optimized query to fetch items with categories
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                esc($item['item_name']),
                esc($item['category_name']),
                esc($item['unit']),
                number_format($item['rate'], 2),
                number_format($item['opening_stock'], 2),
                '<a href="' . base_url("inventory/item/edit/" . esc($item['id'])) . '" class="btn btn-primary btn-sm">Edit</a>
                 <a href="' . base_url("inventory/item/delete/" . esc($item['id'])) . '" class="btn btn-danger btn-sm delete-item">Delete</a>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Item',
            'page_title' => 'Add New Item',
            'menu' => 'accounts',
            'categories' => $this->categoryModel->findAll() // Fetches all categories
        ];

        return view('backend/accounts/inventory/add_item', $data);
    }

    public function store()
    {
        $validationRules = [
            'item_name' => 'required|min_length[3]',
            'category_id' => 'required|integer|is_not_unique[stock_categories.id]',
            'unit' => 'required',
            'rate' => 'required|decimal',
            'opening_stock' => 'required|decimal',
            'hsn_code' => 'required|max_length[10]', // Validation for HSN Code
            'tax_rate' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]', // Validation for Tax Rate
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->itemModel->save([
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'unit' => $this->request->getPost('unit'),
            'rate' => $this->request->getPost('rate'),
            'opening_stock' => $this->request->getPost('opening_stock'),
            'hsn_code' => $this->request->getPost('hsn_code'), // Add this line
            'tax_rate' => $this->request->getPost('tax_rate'), // Add this line
            'brand' => $this->request->getPost('brand'),
            'color' => $this->request->getPost('color'),
            'size' => $this->request->getPost('size'),
        ]);

        return redirect()->to('inventory/items')->with('swal_success', 'Item added successfully.');
    }

    public function edit($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return redirect()->to('inventory/items')->with('swal_error', 'Item not found.');
        }

        $data = [
            'title' => 'Edit Item',
            'page_title' => 'Update Item',
            'menu' => 'accounts',
            'item' => $item,
            'categories' => $this->categoryModel->findAll()
        ];

        return view('backend/accounts/inventory/edit_item', $data);
    }

    public function update($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return redirect()->to('inventory/items')->with('swal_error', 'Item not found.');
        }

        $validationRules = [
            'item_name' => 'required|min_length[3]',
            'category_id' => 'required|integer|is_not_unique[stock_categories.id]',
            'unit' => 'required',
            'rate' => 'required|decimal',
            'opening_stock' => 'required|decimal',
            'hsn_code' => 'required|max_length[10]', // Validation for HSN Code
            'tax_rate' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]', // Validation for Tax Rate
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->itemModel->update($id, [
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'unit' => $this->request->getPost('unit'),
            'rate' => $this->request->getPost('rate'),
            'opening_stock' => $this->request->getPost('opening_stock'),
            'hsn_code' => $this->request->getPost('hsn_code'), // Add this line
            'tax_rate' => $this->request->getPost('tax_rate'), // Add this line
            'brand' => $this->request->getPost('brand'),
            'color' => $this->request->getPost('color'),
            'size' => $this->request->getPost('size'),
        ]);

        return redirect()->to('inventory/items')->with('swal_success', 'Item updated successfully.');
    }

    public function delete($id)
    {
        $item = $this->itemModel->find($id);

        if (!$item) {
            return redirect()->to('inventory/items')->with('swal_error', 'Item not found.');
        }

        try {
            $this->itemModel->delete($id);
        } catch (\Exception $e) {
            return redirect()->to('inventory/items')->with('swal_error', 'Unable to delete item. It may be referenced elsewhere.');
        }

        return redirect()->to('inventory/items')->with('swal_success', 'Item deleted successfully.');
    }
}
