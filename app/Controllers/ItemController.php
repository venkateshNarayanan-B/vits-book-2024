<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StockItemModel;
use App\Models\StockCategoryModel;
use App\Models\StockItemSerialNumberModel;

class ItemController extends BaseController
{
    protected $itemModel;
    protected $categoryModel;
    protected $serialNumberModel;

    public function __construct()
    {
        $this->itemModel = new StockItemModel();
        $this->categoryModel = new StockCategoryModel();
        $this->serialNumberModel = new StockItemSerialNumberModel();
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
        $items = $this->itemModel->getItemsWithCategory();
        $data = [];

        foreach ($items as $item) {
            $data[] = [
                esc($item['item_name']),
                esc($item['category_name']),
                esc($item['unit']),
                esc($item['rate']),
                esc($item['opening_stock']),
                '<a href="' . base_url('inventory/item/edit/' . $item['id']) . '" class="btn btn-primary btn-sm">Edit</a>' .
                ' <a href="' . base_url('inventory/item/delete/' . $item['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this item?\')">Delete</a>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function create()
    {
        $data = [
            'categories' => $this->categoryModel->findAll(),
            'title' => 'Add Item',
            'page_title' => 'Add New Item',
            'menu' => 'accounts'
        ];

        return view('backend/accounts/inventory/add_item', $data);
    }

    public function store()
    {
        $rules = [
            'item_name' => 'required',
            'category_id' => 'required',
            'unit' => 'required',
            'hsn_code' => 'required',
            'tax_rate' => 'required|decimal',
            'rate' => 'required|decimal',
            'opening_stock' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('swal_error', $this->validator->getErrors());
        }

        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'unit' => $this->request->getPost('unit'),
            'hsn_code' => $this->request->getPost('hsn_code'),
            'tax_rate' => $this->request->getPost('tax_rate'),
            'rate' => $this->request->getPost('rate'),
            'opening_stock' => $this->request->getPost('opening_stock') ?: 0,
            'brand' => $this->request->getPost('brand'),
            'color' => $this->request->getPost('color'),
            'size' => $this->request->getPost('size'),
        ];

        $itemId = $this->itemModel->insert($data);

        if ($this->request->getPost('requires_serial')) {
            $serialNumbers = $this->request->getPost('serial_numbers');

            if (count($serialNumbers) !== (int)$data['opening_stock']) {
                return redirect()->back()->withInput()->with('swal_error', 'The number of serial numbers must match the opening stock.');
            }

            foreach ($serialNumbers as $serialNumber) {
                $this->serialNumberModel->insert([
                    'stock_item_id' => $itemId,
                    'serial_number' => $serialNumber,
                ]);
            }
        }

        return redirect()->to('inventory/items')->with('swal_success', 'Item added successfully.');
    }

    public function edit($id)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Item not found');
        }

        $serialNumbers = $this->serialNumberModel->where('stock_item_id', $id)->findAll();

        $data = [
            'item' => $item,
            'categories' => $this->categoryModel->findAll(),
            'serial_numbers' => $serialNumbers,
            'title' => 'Edit Item',
            'page_title' => 'Edit Item',
            'menu' => 'accounts'
        ];

        return view('backend/accounts/inventory/edit_item', $data);
    }

    public function update($id)
    {
        $rules = [
            'item_name' => 'required',
            'category_id' => 'required',
            'unit' => 'required',
            'hsn_code' => 'required',
            'tax_rate' => 'required|decimal',
            'rate' => 'required|decimal',
            'opening_stock' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('swal_error', $this->validator->getErrors());
        }

        $data = [
            'item_name' => $this->request->getPost('item_name'),
            'category_id' => $this->request->getPost('category_id'),
            'unit' => $this->request->getPost('unit'),
            'hsn_code' => $this->request->getPost('hsn_code'),
            'tax_rate' => $this->request->getPost('tax_rate'),
            'rate' => $this->request->getPost('rate'),
            'opening_stock' => $this->request->getPost('opening_stock') ?: 0,
            'brand' => $this->request->getPost('brand'),
            'color' => $this->request->getPost('color'),
            'size' => $this->request->getPost('size'),
        ];

        $this->itemModel->update($id, $data);

        $this->serialNumberModel->where('stock_item_id', $id)->delete();
        if ($this->request->getPost('requires_serial')) {
            $serialNumbers = $this->request->getPost('serial_numbers');

            if (count($serialNumbers) !== (int)$data['opening_stock']) {
                return redirect()->back()->withInput()->with('swal_error', 'The number of serial numbers must match the opening stock.');
            }

            foreach ($serialNumbers as $serialNumber) {
                $this->serialNumberModel->insert([
                    'stock_item_id' => $id,
                    'serial_number' => $serialNumber,
                ]);
            }
        }

        return redirect()->to('inventory/items')->with('swal_success', 'Item updated successfully.');
    }

    public function delete($id)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            return redirect()->to('inventory/items')->with('swal_error', 'Item not found.');
        }

        $this->serialNumberModel->where('stock_item_id', $id)->delete();
        $this->itemModel->delete($id);

        return redirect()->to('inventory/items')->with('swal_success', 'Item deleted successfully.');
    }
}
