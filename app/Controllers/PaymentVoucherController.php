<?php

namespace App\Controllers;

use App\Models\VoucherModel;
use App\Models\VoucherEntryModel;
use App\Models\LedgerModel;

class PaymentVoucherController extends BaseController
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
            $vouchers = $this->voucherModel->where('voucher_type', 'Payment')->findAll();

            $data = [];
            foreach ($vouchers as $voucher) {
                // Fetch entries for this voucher
                $entries = $this->voucherEntryModel->where('voucher_id', $voucher['id'])->findAll();

                foreach ($entries as $entry) {
                    $ledger = $this->ledgerModel->find($entry['ledger_id']);
                    $ledgerName = $ledger ? $ledger['ledger_name'] : 'Unknown Ledger';

                    $data[] = [
                        esc($voucher['id']),
                        esc(date('Y-m-d', strtotime($voucher['date']))),
                        esc($voucher['reference_no']),
                        esc($ledgerName), // Ledger Name
                        number_format($entry['debit'], 2), // Debit Amount
                        number_format($entry['credit'], 2), // Credit Amount
                        '<a href="' . site_url('payment-vouchers/edit/' . $voucher['id']) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . site_url('payment-vouchers/delete/' . $voucher['id']) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>',
                    ];
                }
            }

            return $this->response->setJSON(['data' => $data]);
        }

        $data = [
            'menu' => 'accounts',
            'page_title' => 'Payment Vouchers',
            'title' => 'Payment Vouchers',
        ];

        return view('backend/accounts/vouchers/payment/index', $data);
    }


    // Show Create Payment Voucher Form
    public function create()
    {
        $data = [
            'menu' => 'accounts',
            'page_title' => 'Create Payment Voucher',
            'title' => 'Create Payment Voucher',
            'ledgers' => $this->ledgerModel->findAll(),
        ];

        return view('backend/accounts/vouchers/payment/create', $data);
    }

    // Store a New Payment Voucher
    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'permit_empty|decimal',
                'entries.*.credit' => 'permit_empty|decimal',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            $voucherData = [
                'date' => $this->request->getPost('date'),
                'voucher_type' => 'Payment',
                'reference_no' => $this->request->getPost('reference_no'),
            ];

            $this->voucherModel->save($voucherData);
            $voucherId = $this->voucherModel->getInsertID();

            $entries = $this->request->getPost('entries');
            foreach ($entries as $entry) {
                $entry['voucher_id'] = $voucherId;
                $this->voucherEntryModel->save($entry);

                // Update ledger balance
                $this->updateLedgerBalance($entry['ledger_id'], $entry['debit'] ?? 0, $entry['credit'] ?? 0);
            }

            session()->setFlashdata('swal_success', 'Payment Voucher created successfully!');
            return redirect()->to('/payment-vouchers');
        }
    }

    // Edit a Payment Voucher
    public function edit($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Payment') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Payment Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        $data = [
            'menu' => 'accounts',
            'title' => 'Edit Payment Voucher',
            'page_title' => 'Edit Payment Voucher',
            'voucher' => $voucher,
            'entries' => $entries,
            'ledgers' => $this->ledgerModel->findAll(),
        ];

        return view('backend/accounts/vouchers/payment/edit', $data);
    }

    // Update a Payment Voucher
    public function update($id)
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'date' => 'required|valid_date',
                'reference_no' => 'required|max_length[255]',
                'entries.*.ledger_id' => 'required|integer',
                'entries.*.debit' => 'permit_empty|decimal',
                'entries.*.credit' => 'permit_empty|decimal',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }

            $voucherData = [
                'date' => $this->request->getPost('date'),
                'reference_no' => $this->request->getPost('reference_no'),
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
                $this->updateLedgerBalance($entry['ledger_id'], $entry['debit'] ?? 0, $entry['credit'] ?? 0);
            }

            session()->setFlashdata('swal_success', 'Payment Voucher updated successfully!');
            return redirect()->to('/payment-vouchers');
        }
    }

    // Delete a Payment Voucher
    public function delete($id)
    {
        $voucher = $this->voucherModel->find($id);
        if (!$voucher || $voucher['voucher_type'] !== 'Payment') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Payment Voucher with ID $id not found.");
        }

        $entries = $this->voucherEntryModel->where('voucher_id', $id)->findAll();

        foreach ($entries as $entry) {
            // Reverse ledger balances
            $this->updateLedgerBalance(
                $entry['ledger_id'],
                +$entry['debit'],
                -$entry['credit']
            );
        }

        $this->voucherModel->delete($id);
        $this->voucherEntryModel->where('voucher_id', $id)->delete();

        session()->setFlashdata('swal_success', 'Payment Voucher deleted successfully!');
        return redirect()->to('/payment-vouchers');
    }

    // Update Ledger Balance
    private function updateLedgerBalance($ledgerId, $debit, $credit)
    {
        $ledger = $this->ledgerModel->find($ledgerId);

        if ($ledger) {
            $currentBalance = isset($ledger['balance']) && is_numeric($ledger['balance']) 
                ? (float)$ledger['balance'] 
                : 0;

            $debit = is_numeric($debit) ? (float)$debit : 0;
            $credit = is_numeric($credit) ? (float)$credit : 0;

            $balanceChange = $credit - $debit;

            $this->ledgerModel->update($ledgerId, [
                'balance' => $currentBalance + $balanceChange,
            ]);
        }
    }
}
