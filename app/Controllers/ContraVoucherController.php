<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use App\Models\VoucherEntryModel;
use App\Models\LedgerModel;
use App\Models\AccountGroupModel;

class ContraVoucherController extends BaseController
{
    protected $voucherModel;
    protected $voucherEntryModel;
    protected $ledgerModel;
    protected $accountGroupModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
        $this->voucherEntryModel = new VoucherEntryModel();
        $this->ledgerModel = new LedgerModel();
        $this->accountGroupModel = new AccountGroupModel();
    }

    // List Contra Vouchers
    public function index()
    {
        if ($this->request->isAJAX()) {
            $vouchers = $this->voucherModel->where('voucher_type', 'Contra')->findAll();

            $data = [];
            foreach ($vouchers as $voucher) {
                $entries = $this->voucherEntryModel->where('voucher_id', $voucher['id'])->findAll();

                $debitEntry = null;
                $creditEntry = null;

                foreach ($entries as $entry) {
                    if ($entry['debit'] > 0) {
                        $debitEntry = $entry;
                    }
                    if ($entry['credit'] > 0) {
                        $creditEntry = $entry;
                    }
                }

                $debitLedger = $debitEntry ? $this->ledgerModel->find($debitEntry['ledger_id']) : null;
                $creditLedger = $creditEntry ? $this->ledgerModel->find($creditEntry['ledger_id']) : null;

                $data[] = [
                    esc($voucher['id']),
                    esc($voucher['date']),
                    esc($voucher['reference_no']),
                    esc($debitLedger['ledger_name'] ?? 'Unknown Ledger'),
                    esc($creditLedger['ledger_name'] ?? 'Unknown Ledger'),
                    number_format($debitEntry['debit'] ?? 0, 2),
                    '<a href="' . site_url('contra-vouchers/edit/' . $voucher['id']) . '" class="btn btn-sm btn-primary">Edit</a>
                     <a href="' . site_url('contra-vouchers/delete/' . $voucher['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>',
                ];
            }

            return $this->response->setJSON(['data' => $data]);
        }

        $data = [
            'menu' => 'accounts',
            'page_title' => 'Contra Vouchers',
            'title' => 'Contra Vouchers',
        ];

        return view('backend/accounts/vouchers/contra/index', $data);
    }

    // Show Create Contra Voucher Form
    public function create()
    {
        $bankAndCashGroupIds = $this->accountGroupModel
            ->whereIn('group_name', ['Bank', 'Cash'])
            ->findColumn('id');

        $ledgers = $this->ledgerModel
            ->whereIn('group_id', $bankAndCashGroupIds)
            ->findAll();

        $data = [
            'menu' => 'accounts',
            'page_title' => 'Create Contra Voucher',
            'title' => 'Create Contra Voucher',
            'ledgers' => $ledgers,
        ];

        return view('backend/accounts/vouchers/contra/create', $data);
    }

    // Store a New Contra Voucher
    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'debit_ledger' => 'required|integer|differs[credit_ledger]',
                'credit_ledger' => 'required|integer',
                'amount' => 'required|decimal|greater_than[0]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
            }

            $amount = $this->request->getPost('amount');

            $voucherData = [
                'date' => $this->request->getPost('date'),
                'voucher_type' => 'Contra',
                'reference_no' => $this->request->getPost('reference_no'),
            ];

            $this->voucherModel->save($voucherData);
            $voucherId = $this->voucherModel->getInsertID();

            // Save Debit Entry
            $this->voucherEntryModel->save([
                'voucher_id' => $voucherId,
                'ledger_id' => $this->request->getPost('debit_ledger'),
                'date' => $voucherData['date'],
                'debit' => $amount,
                'credit' => 0,
            ]);
            $this->updateLedgerBalance($this->request->getPost('debit_ledger'), $amount, 0);

            // Save Credit Entry
            $this->voucherEntryModel->save([
                'voucher_id' => $voucherId,
                'ledger_id' => $this->request->getPost('credit_ledger'),
                'date' => $voucherData['date'],
                'debit' => 0,
                'credit' => $amount,
            ]);
            $this->updateLedgerBalance($this->request->getPost('credit_ledger'), 0, $amount);

            session()->setFlashdata('swal_success', 'Contra Voucher created successfully!');
            return redirect()->to('/contra-vouchers');
        }
    }

    // Show Edit Contra Voucher Form
    public function edit($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Contra') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Contra Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        // Separate Debit and Credit Entries
        $debitEntry = array_filter($entries, fn($entry) => $entry['debit'] > 0);
        $creditEntry = array_filter($entries, fn($entry) => $entry['credit'] > 0);

        $debitEntry = reset($debitEntry); // Get the first debit entry
        $creditEntry = reset($creditEntry); // Get the first credit entry

        // Filter ledgers for Bank and Cash groups
        $bankAndCashGroupIds = $this->accountGroupModel
            ->whereIn('group_name', ['Bank', 'Cash'])
            ->findColumn('id');

        $ledgers = $this->ledgerModel
            ->whereIn('group_id', $bankAndCashGroupIds)
            ->findAll();

        $data = [
            'menu' => 'accounts',
            'title' => 'Edit Contra Voucher',
            'page_title' => 'Edit Contra Voucher',
            'voucher' => $voucher,
            'entries' => $entries,
            'debit_entry' => $debitEntry,
            'credit_entry' => $creditEntry,
            'amount' => $debitEntry['debit'] ?? 0, // Use the debit amount as the shared amount
            'ledgers' => $ledgers,
        ];

        return view('backend/accounts/vouchers/contra/edit', $data);
    }


    // Update an Existing Contra Voucher
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'debit_ledger' => 'required|integer|differs[credit_ledger]',
                'credit_ledger' => 'required|integer',
                'amount' => 'required|decimal|greater_than[0]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
            }

            $voucher = $this->voucherModel->find($id);
            if (!$voucher || $voucher['voucher_type'] !== 'Contra') {
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Contra Voucher with ID $id not found.");
            }

            $amount = $this->request->getPost('amount');

            // Update voucher details
            $voucherData = [
                'date' => $this->request->getPost('date'),
                'reference_no' => $this->request->getPost('reference_no'),
            ];
            $this->voucherModel->update($id, $voucherData);

            // Reverse old ledger balances and delete entries
            $oldEntries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();
            foreach ($oldEntries as $entry) {
                $this->updateLedgerBalance($entry['ledger_id'], -$entry['debit'], -$entry['credit']);
            }
            $this->voucherEntryModel->where('voucher_id', $id)->delete();

            // Save new Debit Entry
            $this->voucherEntryModel->save([
                'voucher_id' => $id,
                'ledger_id' => $this->request->getPost('debit_ledger'),
                'date' => $voucherData['date'],
                'debit' => $amount,
                'credit' => 0,
            ]);
            $this->updateLedgerBalance($this->request->getPost('debit_ledger'), $amount, 0);

            // Save new Credit Entry
            $this->voucherEntryModel->save([
                'voucher_id' => $id,
                'ledger_id' => $this->request->getPost('credit_ledger'),
                'date' => $voucherData['date'],
                'debit' => 0,
                'credit' => $amount,
            ]);
            $this->updateLedgerBalance($this->request->getPost('credit_ledger'), 0, $amount);

            session()->setFlashdata('swal_success', 'Contra Voucher updated successfully!');
            return redirect()->to('/contra-vouchers');
        }
    }


    // Delete a Contra Voucher
    public function delete($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Contra') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Contra Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        foreach ($entries as $entry) {
            $this->updateLedgerBalance($entry['ledger_id'], -$entry['debit'], -$entry['credit']);
        }

        $this->voucherModel->delete($id);
        $this->voucherEntryModel->where('voucher_id', $id)->delete();

        session()->setFlashdata('swal_success', 'Contra Voucher deleted successfully!');
        return redirect()->to('/contra-vouchers');
    }

    // Update Ledger Balance
    private function updateLedgerBalance($ledgerId, $debit, $credit)
    {
        $ledger = $this->ledgerModel->find($ledgerId);

        if ($ledger) {
            $currentBalance = $ledger['balance'] ?? 0;

            $balanceChange = $credit - $debit;

            $this->ledgerModel->update($ledgerId, [
                'balance' => $currentBalance + $balanceChange,
            ]);
        }
    }
}
