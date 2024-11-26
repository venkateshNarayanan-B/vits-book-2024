<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventoryTransactionModel;
use App\Models\StockItemModel;

class InventoryTransactionController extends BaseController
{
    protected $transactionModel;
    protected $itemModel;

    public function __construct()
    {
        $this->transactionModel = new InventoryTransactionModel();
        $this->itemModel = new StockItemModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Inventory Transactions',
            'page_title' => 'Manage Inventory Transactions',
            'menu' => 'accounts' // Updated to 'accounts'
        ];

        return view('backend/accounts/inventory/transactions', $data);
    }

    public function fetchTransactions()
    {
        $transactions = $this->transactionModel->getInventoryTransactions(); // Fetch all transactions with stock item names
        $data = [];

        foreach ($transactions as $transaction) {
            $data[] = [
                $transaction['id'],
                esc($transaction['date']),
                esc($transaction['item_name']),
                esc($transaction['quantity']),
                esc($transaction['transaction_type']),
                '<a href="' . base_url("inventory/transactions/edit/" . $transaction['id']) . '" class="btn btn-primary btn-sm">Edit</a>
                 <a href="' . base_url("inventory/transactions/delete/" . $transaction['id']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</a>'
            ];
        }

        return $this->response->setJSON(['data' => $data]);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Transaction',
            'page_title' => 'Add New Inventory Transaction',
            'menu' => 'accounts', // Updated to 'accounts'
            'items' => $this->itemModel->findAll(),
            'transaction_types' => ['Inward', 'Outward']
        ];

        return view('backend/accounts/inventory/add_transaction', $data);
    }

    public function store()
    {
        $validationRules = [
            'stock_item_id' => 'required|integer',
            'quantity' => 'required|decimal',
            'transaction_type' => 'required|in_list[Inward,Outward]',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->transactionModel->save([
            'stock_item_id' => $this->request->getPost('stock_item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'transaction_type' => $this->request->getPost('transaction_type'),
            'date' => $this->request->getPost('date')
        ]);

        return redirect()->to('inventory/transactions')->with('swal_success', 'Transaction added successfully.');
    }

    public function edit($id)
    {
        $transaction = $this->transactionModel->getTransactionById($id);

        if (!$transaction) {
            return redirect()->to('inventory/transactions')->with('swal_error', 'Transaction not found.');
        }

        $data = [
            'title' => 'Edit Transaction',
            'page_title' => 'Edit Inventory Transaction',
            'menu' => 'accounts', // Updated to 'accounts'
            'transaction' => $transaction,
            'items' => $this->itemModel->findAll(),
            'transaction_types' => ['Inward', 'Outward']
        ];

        return view('backend/accounts/inventory/edit_transaction', $data);
    }

    public function update($id)
    {
        $transaction = $this->transactionModel->getTransactionById($id);

        if (!$transaction) {
            return redirect()->to('inventory/transactions')->with('swal_error', 'Transaction not found.');
        }

        $validationRules = [
            'stock_item_id' => 'required|integer',
            'quantity' => 'required|decimal',
            'transaction_type' => 'required|in_list[Inward,Outward]',
            'date' => 'required|valid_date'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->transactionModel->update($id, [
            'stock_item_id' => $this->request->getPost('stock_item_id'),
            'quantity' => $this->request->getPost('quantity'),
            'transaction_type' => $this->request->getPost('transaction_type'),
            'date' => $this->request->getPost('date')
        ]);

        return redirect()->to('inventory/transactions')->with('swal_success', 'Transaction updated successfully.');
    }

    public function delete($id)
    {
        $transaction = $this->transactionModel->getTransactionById($id);

        if (!$transaction) {
            return redirect()->to('inventory/transactions')->with('swal_error', 'Transaction not found.');
        }

        $this->transactionModel->delete($id);

        return redirect()->to('inventory/transactions')->with('swal_success', 'Transaction deleted successfully.');
    }
}

