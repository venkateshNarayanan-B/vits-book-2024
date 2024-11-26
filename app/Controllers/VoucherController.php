<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use App\Models\VoucherEntryModel;
use App\Models\LedgerModel;
use App\Models\StockItemModel;
use App\Models\ServiceModel;

class VoucherController extends BaseController
{
    protected $voucherModel;
    protected $voucherEntryModel;
    protected $ledgerModel;
    protected $stockItemModel;
    protected $servicesModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
        $this->voucherEntryModel = new VoucherEntryModel();
        $this->ledgerModel = new LedgerModel();
        $this->stockItemModel = new StockItemModel();
        $this->servicesModel = new ServiceModel();
    }

    // List All Vouchers
    public function index()
    {
        $data = [
            'menu' => 'accounts',
            'page_title' => 'Vouchers',
            'title' => 'Vouchers',
            'vouchers' => $this->voucherModel->findAll()
        ];

        return view('backend/accounts/vouchers/index', $data);
    }

    //function to calculate and update ledger balance
    private function updateLedgerBalance($ledgerId, $debit, $credit)
    {
        // Find the ledger by ID
        $ledger = $this->ledgerModel->find($ledgerId);

        if ($ledger) {
            // Ensure 'balance' exists and is numeric
            $currentBalance = isset($ledger['balance']) && is_numeric($ledger['balance']) 
                ? (float)$ledger['balance'] 
                : 0;

            // Ensure debit and credit are numeric
            $debit = is_numeric($debit) ? (float)$debit : 0;
            $credit = is_numeric($credit) ? (float)$credit : 0;

            // Calculate balance change
            $balanceChange =  $credit - $debit;

            // Update the ledger balance
            $this->ledgerModel->update($ledgerId, [
                'balance' => $currentBalance + $balanceChange
            ]);
        }
    }


    // Show Create Voucher Form
    public function create()
    {
        $data = [
            'menu' => 'accounts',
            'title' => 'Create Voucher',
            'page_title' => 'Create Voucher',
            'ledgers' => $this->ledgerModel->findAll()
        ];

        return view('backend/accounts/vouchers/create', $data);
    }

    // Store a New Voucher
    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            // Validate the input
            $rules = [
                'date' => 'required|valid_date',
                'voucher_type' => 'required|in_list[Sales,Purchase,Receipt,Payment,Contra,Journal]',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'permit_empty|decimal',
                'entries.*.credit' => 'permit_empty|decimal'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            // Save the voucher
            $voucherData = [
                'date' => $this->request->getPost('date'),
                'voucher_type' => $this->request->getPost('voucher_type'),
                'reference_no' => $this->request->getPost('reference_no')
            ];

            $this->voucherModel->save($voucherData);
            $voucherId = $this->voucherModel->getInsertID();

            // Save voucher entries
            $entries = $this->request->getPost('entries');
            foreach ($entries as $entry) {
                $entry['voucher_id'] = $voucherId;
                $this->voucherEntryModel->save($entry);

                // Update ledger balance
                $this->updateLedgerBalance(
                    $entry['ledger_id'],
                    $entry['debit'] ?? 0,
                    $entry['credit'] ?? 0
                );
            }

            session()->setFlashdata('swal_success', 'Voucher created successfully!');
            return redirect()->to('/vouchers');
        }
    }

    // Show Edit Voucher Form
    public function edit($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        $data = [
            'menu' => 'accounts',
            'title' => 'Edit Voucher',
            'page_title' => 'Edit Voucher',
            'voucher' => $voucher,
            'entries' => $entries,
            'ledgers' => $this->ledgerModel->findAll()
        ];

        return view('backend/accounts/vouchers/edit', $data);
    }

    // Update a Voucher
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            // Validate the input
            $rules = [
                'date' => 'required|valid_date',
                'voucher_type' => 'required|in_list[Sales,Purchase,Receipt,Payment,Contra,Journal]',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'permit_empty|decimal',
                'entries.*.credit' => 'permit_empty|decimal'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            // Update the voucher
            $voucherData = [
                'date' => $this->request->getPost('date'),
                'voucher_type' => $this->request->getPost('voucher_type'),
                'reference_no' => $this->request->getPost('reference_no')
            ];
            $this->voucherModel->update($id, $voucherData);

            $oldEntries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

            // Reverse ledger balances for old entries
            foreach ($oldEntries as $oldEntry) {
                $this->updateLedgerBalance(
                    $oldEntry['ledger_id'],
                    -$oldEntry['debit'],
                    -$oldEntry['credit']
                );
            }

            // Update voucher entries
            $this->voucherEntryModel->where('voucher_id', $id)->delete();
            $entries = $this->request->getPost('entries');
            foreach ($entries as $entry) {
                $entry['voucher_id'] = $id;
                $this->voucherEntryModel->save($entry);

                // Update ledger balance
                $this->updateLedgerBalance(
                    $entry['ledger_id'],
                    $entry['debit'] ?? 0,
                    $entry['credit'] ?? 0
                );
            }

            session()->setFlashdata('swal_success', 'Voucher updated successfully!');
            return redirect()->to('/vouchers');
        }
    }

    // Delete a Voucher
    public function delete($id)
    {
        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        foreach ($entries as $entry) {
            // Reverse ledger balances
            $this->updateLedgerBalance(
                $entry['ledger_id'],
                -$entry['debit'],
                -$entry['credit']
            );
        }
        
        $this->voucherModel->delete($id);
        $this->voucherEntryModel->where('voucher_id', $id)->delete();

        session()->setFlashdata('swal_success', 'Voucher deleted successfully!');
        return redirect()->to('/vouchers');
    }

    public function entries_list($voucherId)
    {
        // Load the necessary models
        $voucherEntriesModel = new \App\Models\VoucherEntryModel();
        $voucherModel = new \App\Models\VoucherModel();

        // Fetch the voucher details
        $voucher = $voucherModel->find($voucherId);
        if (!$voucher) {
            return redirect()->to('/vouchers')->with('swal_error', 'Voucher not found.');
        }

        // Fetch the associated entries
        $entries = $voucherEntriesModel
            ->where('voucher_id', $voucherId)
            ->join('ledgers', 'voucher_entries.ledger_id = ledgers.id', 'left')
            ->select('voucher_entries.*, ledgers.ledger_name')
            ->findAll();

        // Pass data to the view
        $data = [
            'menu' => 'accounts',
            'title' => 'Entry List',
            'page_title' => 'Voucher Entries List',
            'voucher' => $voucher,
            'entries' => $entries,
            'voucher_id'=> $voucherId
        ];

        return view('backend/accounts/vouchers/entries', $data);
    }

    public function add_entry($voucher_id)
    {
        // Fetch the voucher details (optional)
        $ledgers = $this->ledgerModel->findAll();
        $services = $this->servicesModel->findAll();
        $stock_items = $this->stockItemModel->findAll();
        if (!$voucher_id) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Voucher with ID $voucher_id not found.");
        }

        if ($this->request->getMethod() === 'post') {
            // Validate the form data
            $rules = [
                'ledger_id' => 'required|integer',
                'debit' => 'required|decimal',
                'credit' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/vouchers/add_entry', [
                    'validation' => $this->validator,
                    'voucher_id' => $voucher_id,
                    'ledgers' => $ledgers,
                    'services' => $services,
                    'stock_items' => $stock_items,
                    'entries' => $this->voucherEntryModel->where('voucher_id', $voucher_id)->findAll(),
                    'page_title' => 'Voucher Entries',
                    'title' => 'Add Entry',
                    'menu' => 'accounts'
                ]);
            }

            $postData = $this->request->getPost();
            $postData['voucher_id'] = $voucher_id;

            // Save the entry data
            $this->voucherEntryModel->save($postData);
            // Update the ledger balance
            $this->updateLedgerBalance($postData['ledger_id'], $postData['debit'], $postData['credit']);


            session()->setFlashdata('swal_success', 'Voucher entry added successfully!');
            return redirect()->to('vouchers/entry/' . $voucher_id);
        }

        // Load available ledgers for the dropdown
        
        return view('backend/accounts/vouchers/add_entry', [
            'voucher_id' => $voucher_id,
            'ledgers' => $ledgers,
            'services' => $services,
            'stock_items' => $stock_items,
            'page_title' => 'Add Entry',
            'title' => 'Add Entry to Voucher',
            'menu' => 'accounts'
        ]);
        
    }

    public function edit_entry($entry_id)
    {
        $entry = $this->voucherEntryModel->find($entry_id);
        // Find the entry by its ID
        $entry = $this->voucherEntryModel->find($entry_id);
        if (!$entry) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Entry with ID $entry_id not found.");
        }

        // Fetch the related voucher ID
        $voucher_id = $entry['voucher_id'];
        $voucher = $this->voucherModel->find($voucher_id);
        // Get the list of ledgers for the dropdown
        $ledgers = $this->ledgerModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validate form data
            $rules = [
                'ledger_id' => 'required|integer',
                'debit' => 'required|decimal',
                'credit' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return view('backend/accounts/vouchers/edit_entry', [
                    'validation' => $this->validator,
                    'voucher_id' => $voucher_id,
                    'ledgers' => $ledgers,
                    'entries' => $this->voucherEntryModel->where('voucher_id', $voucher_id)->findAll(),
                    'page_title' => 'Voucher Entries',
                    'title' => 'Edit Entry',
                    'menu' => 'accounts'
                ]);
            }

            $oldDebit = $entry['debit'];
            $oldCredit = $entry['credit'];
            $oldLedgerId = $entry['ledger_id'];

            $newDebit = $this->request->getPost('debit');
            $newCredit = $this->request->getPost('credit');
            $newLedgerId = $this->request->getPost('ledger_id');

            // Update the entry
            $this->voucherEntryModel->update($entry_id, [
                'ledger_id' => $this->request->getPost('ledger_id'),
                'debit' => $this->request->getPost('debit'),
                'credit' => $this->request->getPost('credit'),
            ]);

            // Update ledger balances
            $this->updateLedgerBalance($oldLedgerId, -$oldDebit, -$oldCredit);
            $this->updateLedgerBalance($newLedgerId, $newDebit, $newCredit);

            session()->setFlashdata('swal_success', 'Voucher entry updated successfully!');
            return redirect()->to('vouchers/entry/' . $voucher_id);
        }

        

        return view('backend/accounts/vouchers/edit_entry', [
            'entry' => $entry,
            'ledgers' => $ledgers,
            'voucher_id' => $voucher_id,
            'page_title' => 'Edit Entry',
            'title' => 'Edit Voucher Entry',
            'menu' => 'accounts'
        ]);
    }

    public function delete_entry($entry_id)
    {
        // Find the entry to ensure it exists
        $entry = $this->voucherEntryModel->find($entry_id);
        if (!$entry) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Entry with ID $entry_id not found.");
        }

        // Fetch the related voucher ID
        $voucher_id = $entry['voucher_id'];
        $ledger_id = $entry['ledger_id'];
        $debit = $entry['debit'];
        $credit = $entry['credit'];

        // Delete the entry
        $this->voucherEntryModel->delete($entry_id);

        // Update ledger balance
        $this->updateLedgerBalance($ledger_id, -$debit, -$credit);

        session()->setFlashdata('swal_success', 'Voucher entry deleted successfully!');
        return redirect()->to('vouchers/entry/' . $voucher_id);
    }


}
