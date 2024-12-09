<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use App\Models\VoucherEntryModel;
use App\Models\LedgerModel;

class ReceiptVoucherController extends BaseController
{
    protected $voucherModel;
    protected $voucherEntryModel;
    protected $ledgerModel;

    public function __construct()
    {
        $this->voucherModel = new VoucherModel();
        $this->voucherEntryModel = new VoucherEntryModel();
        $this->ledgerModel = new LedgerModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            $vouchers = $this->voucherModel->where('voucher_type', 'Receipt')->findAll();

            $data = [];
            foreach ($vouchers as $voucher) {
                $entries = $this->voucherEntryModel->where('voucher_id', $voucher['id'])->findAll();

                foreach ($entries as $entry) {
                    $ledger = $this->ledgerModel->find($entry['ledger_id']);
                    $ledgerName = $ledger ? $ledger['ledger_name'] : 'Unknown Ledger';

                    $data[] = [
                        esc($voucher['id']),
                        esc($voucher['date']),
                        esc($voucher['reference_no']),
                        esc($ledgerName), // Ledger Name
                        number_format($entry['debit'], 2), // Debit Amount
                        '<a href="' . site_url('receipt-vouchers/edit/' . $voucher['id']) . '" class="btn btn-sm btn-primary">Edit</a>
                         <a href="' . site_url('receipt-vouchers/delete/' . $voucher['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>',
                    ];
                }
            }

            return $this->response->setJSON(['data' => $data]);
        }

        $data = [
            'menu' => 'accounts',
            'page_title' => 'Receipt Vouchers',
            'title' => 'Receipt Vouchers',
        ];

        return view('backend/accounts/vouchers/receipt/index', $data);
    }

    public function create()
    {
        $data = [
            'menu' => 'accounts',
            'page_title' => 'Create Receipt Voucher',
            'title' => 'Create Receipt Voucher',
            'ledgers' => $this->ledgerModel->findAll(),
        ];

        return view('backend/accounts/vouchers/receipt/create', $data);
    }

    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            $voucherData = [
                'date' => $this->request->getPost('date'),
                'voucher_type' => 'Receipt',
                'reference_no' => $this->request->getPost('reference_no'),
            ];
            $this->voucherModel->save($voucherData);
            $voucherId = $this->voucherModel->getInsertID();

            $entries = $this->request->getPost('entries');
            foreach ($entries as $entry) {
                $entry['voucher_id'] = $voucherId;
                $this->voucherEntryModel->save($entry);

                // Update ledger balance for debit
                $this->updateLedgerBalance($entry['ledger_id'], $entry['debit']);
            }

            session()->setFlashdata('swal_success', 'Receipt Voucher created successfully!');
            return redirect()->to('/receipt-vouchers');
        }
    }

    public function edit($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Receipt') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Receipt Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        $data = [
            'menu' => 'accounts',
            'title' => 'Edit Receipt Voucher',
            'page_title' => 'Edit Receipt Voucher',
            'voucher' => $voucher,
            'entries' => $entries,
            'ledgers' => $this->ledgerModel->findAll(),
        ];

        return view('backend/accounts/vouchers/receipt/edit', $data);
    }

    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'required|decimal',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            $voucherData = [
                'date' => $this->request->getPost('date'),
                'reference_no' => $this->request->getPost('reference_no'),
            ];
            $this->voucherModel->update($id, $voucherData);

            // Reverse old ledger balances
            $oldEntries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();
            foreach ($oldEntries as $oldEntry) {
                $this->updateLedgerBalance($oldEntry['ledger_id'], -$oldEntry['debit']);
            }

            // Update voucher entries
            $this->voucherEntryModel->where('voucher_id', $id)->delete();
            $entries = $this->request->getPost('entries');
            foreach ($entries as $entry) {
                $entry['voucher_id'] = $id;
                $this->voucherEntryModel->save($entry);

                // Update ledger balance for debit
                $this->updateLedgerBalance($entry['ledger_id'], $entry['debit']);
            }

            session()->setFlashdata('swal_success', 'Receipt Voucher updated successfully!');
            return redirect()->to('/receipt-vouchers');
        }
    }

    public function delete($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Receipt') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Receipt Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        foreach ($entries as $entry) {
            // Reverse ledger balances
            $this->updateLedgerBalance($entry['ledger_id'], +$entry['debit']);
        }

        $this->voucherModel->delete($id);
        $this->voucherEntryModel->where('voucher_id', $id)->delete();

        session()->setFlashdata('swal_success', 'Receipt Voucher deleted successfully!');
        return redirect()->to('/receipt-vouchers');
    }

    private function updateLedgerBalance($ledgerId, $debit)
    {
        $ledger = $this->ledgerModel->find($ledgerId);

        if ($ledger) {
            $currentBalance = isset($ledger['balance']) && is_numeric($ledger['balance'])
                ? (float)$ledger['balance']
                : 0;

            $debit = is_numeric($debit) ? (float)$debit : 0;

            $this->ledgerModel->update($ledgerId, [
                'balance' => $currentBalance - $debit,
            ]);
        }
    }
}
