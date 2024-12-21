<?php
namespace App\Controllers;

use App\Models\LedgerModel;
use App\Models\PurchaseVoucherModel;
use App\Models\PurchaseItemModel;
use App\Models\StockItemModel;
use App\Models\InventoryTransactionModel;
use App\Models\StockItemSerialNumberModel;
use App\Models\UnitModel;
use App\Models\VoucherEntryModel;
use App\Models\VoucherModel;

class PurchaseVoucherController extends BaseController
{
    private $ledgerModel;
    private $purchaseVoucherModel;
    private $purchaseItemModel;
    private $stockItemModel;
    private $inventoryTransactionModel;
    private $stockItemSerialNumberModel;
    private $unitModel;
    private $voucherModel;
    private $voucherEntryModel;

    public function __construct()
    {
        // Initialize all required models
        $this->ledgerModel = new LedgerModel();
        $this->purchaseVoucherModel = new PurchaseVoucherModel();
        $this->purchaseItemModel = new PurchaseItemModel();
        $this->stockItemModel = new StockItemModel();
        $this->inventoryTransactionModel = new InventoryTransactionModel();
        $this->stockItemSerialNumberModel = new StockItemSerialNumberModel();
        $this->unitModel = new UnitModel();
        $this->voucherModel = new VoucherModel();
    }

    public function index()
    {
        // Set titles and menu
        $title = "Purchase Vouchers";
        $page_title = "Purchase Vouchers";
        $menu = "accounts";

        // Handle AJAX request for data
        if ($this->request->isAJAX()) {
            // Fetch purchase vouchers along with vendor names
            $purchaseVouchers = $this->purchaseVoucherModel
                ->select('purchase_details.*, ledgers.ledger_name AS vendor_name')
                ->join('ledgers', 'ledgers.id = purchase_details.vendor_id')
                ->findAll();

            // Prepare data for DataTables
            $data = [];
            foreach ($purchaseVouchers as $voucher) {
                $data[] = [
                    'id' => $voucher['id'],
                    'voucher_no' => $voucher['voucher_no'],
                    'date' => date('Y-m-d', strtotime($voucher['date'])),
                    'vendor_name' => $voucher['vendor_name'],
                    'total_amount' => number_format($voucher['total_amount'], 2),
                    'tax_amount' => number_format($voucher['tax_amount'], 2),
                    'discount_amount' => number_format($voucher['discount_amount'], 2),
                    'net_amount' => number_format($voucher['net_amount'], 2),
                    'actions' => '
                        <a href="' . base_url('inventory/purchase-vouchers/view/' . $voucher['id']) . '" 
                        class="btn btn-sm btn-success" 
                        title="View Voucher">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="' . base_url('inventory/purchase-vouchers/edit/' . $voucher['id']) . '" 
                        class="btn btn-sm btn-primary" 
                        title="Edit Voucher">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="' . base_url('inventory/purchase-vouchers/delete/' . $voucher['id']) . '" 
                        class="btn btn-sm btn-danger" 
                        title="Delete Voucher" 
                        onclick="return confirm(\'Are you sure you want to delete this voucher?\')">
                            <i class="fas fa-trash"></i> Delete
                        </a>
                    ',
                ];
            }

            // Return JSON data for DataTables
            return $this->response->setJSON(['data' => $data]);
        }

        // Load the index view
        return view('backend/accounts/inventory/purchase/index', compact('title', 'page_title', 'menu'));
    }

    public function view($id)
    {
        // Fetch purchase voucher details
        $purchase = $this->purchaseVoucherModel->find($id);
        if (!$purchase) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Purchase voucher not found.',
            ]);
        }

        // Fetch vendor details
        $vendor = $this->ledgerModel->find($purchase['vendor_id']);
        if (!$vendor) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Vendor not found for this purchase voucher.',
            ]);
        }

        // Fetch items associated with the purchase voucher
        $items = $this->purchaseItemModel
            ->select('purchase_items.*, stock_items.item_name, stock_items.hsn_code, stock_items.tax_rate')
            ->join('stock_items', 'stock_items.id = purchase_items.stock_item_id', 'left')
            ->where('purchase_id', $id)
            ->findAll();

        // Fetch serial numbers for items (if available)
        foreach ($items as &$item) {
            $serialNumbers = $this->stockItemSerialNumberModel
                ->where('stock_item_id', $item['stock_item_id'])
                ->findAll();
            $item['serial_numbers'] = array_column($serialNumbers, 'serial_number');
        }

        // Fetch expenses linked to the purchase voucher
        $expenses = $this->ledgerModel
            ->select('ledgers.id AS expense_ledger_id, ledgers.ledger_name, expenses.amount AS expense_amount')
            ->join('expenses', 'expenses.ledger_id = ledgers.id', 'left')
            ->where('expenses.purchase_id', $id)
            ->findAll();

        // GST Breakdown (if applicable)
        $gstBreakdown = $this->calculateGSTBreakdown($purchase['tax_amount'], $vendor);

        // Prepare response data
        $response = [
            'status' => 'success',
            'data' => [
                'voucher_no' => $purchase['voucher_no'],
                'date' => $purchase['date'],
                'vendor_name' => $vendor['ledger_name'],
                'payment_mode' => $purchase['payment_mode'],
                'amount_paid' => $purchase['amount_paid'],
                'outstanding_amount' => $purchase['outstanding_amount'],
                'notes' => $purchase['notes'],
                'total_amount' => $purchase['total_amount'],
                'tax_amount' => $purchase['tax_amount'],
                'discount_amount' => $purchase['discount_amount'],
                'net_amount' => $purchase['net_amount'],
                'gst_breakdown' => $gstBreakdown,
                'items' => $items,
                'expenses' => $expenses,
            ],
        ];

        return $this->response->setJSON($response);
    }

    private function calculateGSTBreakdown($taxAmount, $vendor)
    {
        // Dummy GST calculation logic (modify as per requirements)
        $cgst = $taxAmount / 2; // Example: Split equally between CGST and SGST
        $sgst = $taxAmount / 2;
        $igst = 0; // Placeholder for future use

        return [
            'cgst' => $cgst,
            'sgst' => $sgst,
            'igst' => $igst,
            'total_tax' => $taxAmount,
        ];
    }

    public function create()
    {
        // Load models
        $ledgerModel = $this->ledgerModel;
        $stockItemModel = $this->stockItemModel;
        $unitModel = $this->unitModel;

        // Fetch vendors (group_id = 7)
        $vendors = $ledgerModel->where('group_id', 7)->findAll();

        // Fetch stock items
        $stockItems = $this->stockItemModel
        ->select('stock_items.id, stock_items.item_name, stock_items.rate, stock_items.hsn_code, stock_items.tax_rate, units.unit_name')
        ->join('units', 'units.id = stock_items.primary_unit_id', 'left')
        ->findAll();

        // Fetch units
        $units = $unitModel->findAll();

        // Fetch expense ledgers (group_id = 8)
        $expenseLedgers = $ledgerModel->where('group_id', 8)->findAll();

        // Pass data to the view
        return view('backend/accounts/inventory/purchase/create', [
            'title' => 'Create Purchase Voucher',
            'page_title' => 'Purchase Voucher - Create',
            'menu' => 'accounts',
            'vendors' => $vendors,
            'stockItems' => $stockItems,
            'units' => $units,
            'expenseLedgers' => $expenseLedgers,
        ]);
    }

    public function store()
    {
        // Retrieve input data
        $data = $this->request->getPost();

        // Validate input
        if (!$this->validate([
            'date' => 'required',
            'vendor_id' => 'required|integer',
            'items.*.stock_item_id' => 'required|integer',
            'items.*.quantity' => 'required|numeric',
            'items.*.rate' => 'required|numeric',
            'items.*.tax' => 'permit_empty|numeric',
            'items.*.discount' => 'permit_empty|numeric',
            'expenses.*.ledger_id' => 'permit_empty|integer',
            'expenses.*.amount' => 'permit_empty|numeric',
            'voucher_no' => 'required|string',
            'voucher_discount' => 'permit_empty|numeric',
            'total_expenses' => 'permit_empty|numeric',
            'notes' => 'permit_empty|string',
        ])) {
            return redirect()->back()->with('swal_error', 'Validation failed. Please check your input.')->withInput();
        }

        // Begin transaction
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Step 1: Insert Voucher Details
            $voucherData = [
                'date' => $data['date'],
                'voucher_type' => 'Purchase',
                'reference_no' => $data['reference_no'] ?? null,
            ];
            $this->voucherModel->insert($voucherData);
            $voucherId = $this->voucherModel->getInsertID();

            // Calculate totals
            $subtotal = (float) $data['subtotal'];
            $totalTaxes = (float) $data['total_taxes'];
            $totalDiscounts = (float) $data['total_discounts'];
            $voucherDiscount = (float) ($data['voucher_discount'] ?? 0.00);
            $totalExpenses = (float) ($data['total_expenses'] ?? 0.00);
            
            $grand_total = ($subtotal + $totalTaxes + $totalExpenses) - ($totalDiscounts + $voucherDiscount);

            // Step 2: Insert Purchase Details
            $purchaseData = [
                'vendor_id' => $data['vendor_id'],
                'voucher_id' => $voucherId,
                'voucher_no' => $data['voucher_no'],
                'total_amount' => $subtotal,
                'tax_amount' => $totalTaxes,
                'discount_amount' => $totalDiscounts,
                'voucher_discount' => $voucherDiscount,
                'total_expenses' => $totalExpenses,
                'grand_total' => $grand_total,
                'outstanding_amount' => $grand_total, // Payments handled separately
                'notes' => $data['notes'] ?? null,
                'net_amount' => $grand_total,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->purchaseVoucherModel->insert($purchaseData);
            $purchaseId = $this->purchaseVoucherModel->getInsertID();

            // Step 3: Insert Item Details and Inventory Transactions
            foreach ($data['items'] as $item) {
                // Type casting
                $quantity = (float) $item['quantity'];
                $rate = (float) $item['rate'];
                $amount = (float) $item['amount'];
                $secondaryUnitTotal = (float) ($item['secondary_unit_total'] ?? 0);

                // Calculate average weight
                $averageWeight = ($secondaryUnitTotal > 0) ? ($quantity / $secondaryUnitTotal) * 100 : null;

                // Item data
                $itemData = [
                    'purchase_id' => $purchaseId,
                    'stock_item_id' => (int) $item['stock_item_id'],
                    'quantity' => $quantity,
                    'rate' => $rate,
                    'amount' => $amount,
                    'tax' => (float) ($item['tax'] ?? 0.00),
                    'average_weight' => $averageWeight,
                    'secondary_unit_total' => $secondaryUnitTotal,
                    'secondary_unit_id' => (int) $item['secondary_unit_id'],
                    'brand' => $item['brand'] ?? null,
                    'color' => $item['color'] ?? null,
                    'size' => $item['size'] ?? null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->purchaseItemModel->insert($itemData);

                // Inventory Transaction
                $this->inventoryTransactionModel->insert([
                    'stock_item_id' => $item['stock_item_id'],
                    'quantity' => $quantity,
                    'transaction_type' => 'Inward',
                    'date' => $data['date'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                // Serial Numbers
                if (!empty($item['serial_numbers'])) {
                    $serialNumbers = $item['serial_numbers'];
                    if (!is_array($serialNumbers) || count($serialNumbers) != $quantity) {
                        throw new \Exception("Serial numbers count must match item quantity for item ID: {$item['stock_item_id']}.");
                    }

                    foreach ($serialNumbers as $serial) {
                        // Check for duplicate serial numbers
                        $existingSerial = $this->stockItemSerialNumberModel->where('serial_number', $serial)->first();
                        if ($existingSerial) {
                            throw new \Exception("Duplicate serial number found: {$serial}.");
                        }

                        $this->stockItemSerialNumberModel->insert([
                            'stock_item_id' => $item['stock_item_id'],
                            'serial_number' => $serial,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }

            // Step 4: Insert Voucher Entries
            $this->insertVoucherEntry($voucherId, $data['date'], $data['vendor_id'], $grand_total);

            // Expense Entries
            if (!empty($data['expenses'])) {
                foreach ($data['expenses'] as $expense) {
                    $ledgerId = $expense['ledger_id'] ?? null;
                    $amount = (float) ($expense['amount'] ?? 0.00);

                    if ($ledgerId && $amount > 0) {
                        $this->insertVoucherEntry($voucherId, $data['date'], $ledgerId, $amount);
                    }
                }
            }

            // Commit Transaction
            $db->transCommit();
            return redirect()->to('/inventory/purchase')->with('swal_success', 'Purchase voucher created successfully.');

        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('swal_error', 'Failed to create purchase voucher: ' . $e->getMessage())->withInput();
        }
    }

    private function insertVoucherEntry($voucherId, $date, $ledgerId, $debit)
    {
        $this->voucherEntryModel = new VoucherEntryModel();

        $this->voucherEntryModel->insert([
            'voucher_id' => $voucherId,
            'date' => $date,
            'ledger_id' => $ledgerId,
            'debit' => $debit,
            'credit' => 0.00,
            'entry_type' => 'Ledger',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Update Ledger Balance
        $this->updateLedgerBalance($ledgerId, $debit, 0.00);
    }

    private function updateLedgerBalance($ledgerId, $debit, $credit)
    {
        $ledger = $this->ledgerModel->find($ledgerId);

        if ($ledger) {
            $currentBalance = (float) ($ledger['balance'] ?? 0);
            $balanceChange = $credit - $debit;

            $this->ledgerModel->update($ledgerId, [
                'balance' => $currentBalance + $balanceChange,
            ]);
        }
    }



}
