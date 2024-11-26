<?php

namespace App\Models;

use CodeIgniter\Model;

class InventoryTransactionModel extends Model
{
    protected $table            = 'inventory_transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['date', 'stock_item_id', 'quantity', 'transaction_type', 'created_at', 'updated_at'];

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

    public function getInventoryTransactions()
    {
        return $this->select('inventory_transactions.*, stock_items.item_name')
                    ->join('stock_items', 'stock_items.id = inventory_transactions.stock_item_id', 'left')
                    ->findAll();
    }

    public function getTransactionById($id)
    {
        return $this->where('id', $id)->first();
    }
}
