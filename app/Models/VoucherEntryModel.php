<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherEntryModel extends Model
{
    protected $table            = 'voucher_entries';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['voucher_id', 'entry_type', 'ledger_id', 'date', 'related_id', 'debit', 'credit', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    //update ledger balance
    public function updateLedgerBalance($ledgerId, $debit, $credit, $operation = 'add')
    {
        $ledgerModel = new \App\Models\LedgerModel();
        $ledger = $ledgerModel->find($ledgerId);

        if ($ledger) {
            // Adjust balance based on the operation
            $adjustment = $debit - $credit;
            $newBalance = ($operation === 'add') ? $ledger['balance'] + $adjustment : $ledger['balance'] - $adjustment;

            $ledgerModel->update($ledgerId, ['balance' => $newBalance]);
        }
    }
}
