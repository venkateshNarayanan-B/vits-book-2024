<?php

namespace App\Models;

use CodeIgniter\Model;

class StockItemModel extends Model
{
    protected $table            = 'stock_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'item_name',
        'category_id',
        'unit',
        'rate',
        'opening_stock',
        'hsn_code',
        'tax_rate',
        'brand',
        'color',
        'size',
        'created_at',
        'updated_at',
        'primary_unit_id'
    ];

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

    // Function to get stock items with category names
    public function getItemsWithCategory()
    {
        // Perform a join with the stock_categories table
        return $this->select('stock_items.id, stock_items.item_name, stock_categories.category_name, stock_items.primary_unit_id, stock_items.rate, stock_items.opening_stock')
                    ->join('stock_categories', 'stock_categories.id = stock_items.category_id', 'left')
                    ->findAll();
    }
}
