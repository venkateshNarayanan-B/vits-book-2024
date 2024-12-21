<?= $this->extend("layout/backend/main") ?>

<?= $this->section("content") ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?= esc($page_title) ?></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Add New Purchase Voucher</h3>
                    </div>

                    <form action="<?= site_url('inventory/purchase-vouchers/store') ?>" method="post" id="purchaseVoucherForm" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <!-- Voucher Details Section -->
                            <div class="row">
                                <!-- Voucher No -->
                                <div class="form-group col-md-4">
                                    <label for="voucher_no">Voucher No</label>
                                    <input type="text" name="voucher_no" id="voucher_no" class="form-control" 
                                           value="<?= old('voucher_no') ?? 'PUR-' . date('Ymd') . '-' . mt_rand(100, 999) ?>" required>
                                </div>

                                <!-- Date -->
                                <div class="form-group col-md-4">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="<?= old('date') ?>" required>
                                </div>

                                <!-- Vendor -->
                                <div class="form-group col-md-4">
                                    <label for="vendor_id">Vendor</label>
                                    <select name="vendor_id" id="vendor_id" class="form-control select2" required>
                                        <option value="">Select Vendor</option>
                                        <?php foreach ($vendors as $vendor): ?>
                                            <option value="<?= $vendor['id'] ?>"><?= esc($vendor['ledger_name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Notes -->
                                <div class="form-group col-md-4">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" class="form-control" rows="1"><?= old('notes') ?></textarea>
                                </div>

                                
                            </div>

                            <!-- Add Item Button -->
                            <div class="mt-4">
                                <h5>Item Details</h5>
                                <button type="button" class="btn btn-primary btn-sm" id="addItemButton" data-toggle="modal" data-target="#itemModal">
                                    <i class="fas fa-plus"></i> Add Item
                                </button>
                                <table class="table table-bordered mt-2" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Rate</th>
                                            <th>HSN Code</th>
                                            <th>Tax (%)</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Average</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsTableBody">
                                        <!-- Dynamically added rows will appear here -->
                                    </tbody>
                                </table>
                                <!-- Horizontal Line Below Item Table -->
                                <hr class="mt-4 mb-4">
                            </div>

                            <div class="mt-4">
                                <div class="row">
                                    <!-- Expenses Section -->
                                    <div class="col-md-6 border-right">
                                        <h5>Expenses</h5>
                                        <button type="button" class="btn btn-sm btn-primary mb-2" id="addExpenseButton">Add Expense</button>
                                        <table class="table table-bordered" id="expensesTable">
                                            <thead>
                                                <tr>
                                                    <th>Expense Ledger</th>
                                                    <th>Amount</th>
                                                    <th>Tax (%)</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="expensesTableBody">
                                                <!-- Dynamically added rows will appear here -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Summary Section -->
                                    <div class="col-md-6">
                                        <h5>Summary</h5>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="voucher_discount">Voucher-Level Discount</label>
                                                <input type="number" name="voucher_discount" id="voucher_discount" class="form-control" step="0.01" value="0">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="subtotal">Subtotal</label>
                                                <input type="number" name="subtotal" id="subtotal" class="form-control" step="0.01" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="total_taxes">Total Taxes</label>
                                                <input type="number" name="total_taxes" id="total_taxes" class="form-control" step="0.01" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="total_expenses">Total Expenses</label>
                                                <input type="number" name="total_expenses" id="total_expenses" class="form-control" step="0.01" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="total_discounts">Total Discounts</label>
                                                <input type="number" name="total_discounts" id="total_discounts" class="form-control" step="0.01" readonly>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="grand_total">Grand Total</label>
                                                <input type="number" name="grand_total" id="grand_total" class="form-control" step="0.01" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                        <!-- End of Card Body -->

                        <!-- Footer Buttons -->
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Save Purchase Voucher</button>
                            <a href="<?= site_url('inventory/purchase-vouchers') ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!--Modal sections-->
<!-- Item Entry Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itemModalLabel">Add/Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Main Item Details -->
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="item_name">Item Name</label>
                        <select id="item_name" class="form-control select2" style="width: 100%;" required>
                            <option value="">Select Item</option>
                            <?php foreach ($stockItems as $item): ?>
                                <option value="<?= $item['id'] ?>" 
                                        data-rate="<?= $item['rate'] ?>" 
                                        data-hsn="<?= $item['hsn_code'] ?>" 
                                        data-tax="<?= $item['tax_rate'] ?>"
                                        data-unit-name="<?= $item['unit_name'] ?>">
                                    <?= esc($item['item_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="unit">Unit</label>
                        <input type="text" id="unit" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="rate">Rate</label>
                        <input type="number" id="rate" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="hsn_code">HSN Code</label>
                        <input type="text" id="hsn_code" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tax">Tax (%)</label>
                        <input type="number" id="tax" class="form-control" step="0.01">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="discount">Discount</label>
                        <input type="number" id="discount" class="form-control" step="0.01">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="total">Total</label>
                        <input type="number" id="total" class="form-control" readonly>
                    </div>
                </div>

                <!-- Optional Section -->
                <h6>Optional Details</h6>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="brand">Brand</label>
                        <input type="text" id="brand" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="color">Color</label>
                        <input type="text" id="color" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="size">Size</label>
                        <input type="text" id="size" class="form-control">
                    </div>
                </div>

                <!-- Average Calculation Section -->
                <h6>Average Calculation</h6>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="secondary_unit">Secondary Unit</label>
                        <select id="secondary_unit" class="form-control select2">
                            <option value="">Select Unit</option>
                            <?php foreach ($units as $unit): ?>
                                <option value="<?= $unit['id'] ?>"><?= esc($unit['unit_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="secondary_unit_total">Quantity</label>
                        <input type="number" id="secondary_unit_total" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="average">Average</label>
                        <input type="text" id="average" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveItem">Save Item</button>
            </div>
        </div>
    </div>
</div>

<!-- Serial Number Management Modal -->
<div class="modal fade" id="serialModal" tabindex="-1" role="dialog" aria-labelledby="serialModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serialModalLabel">Manage Serial Numbers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="serialNumberContainer">
                    <!-- Serial Number Fields will be dynamically added here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSerialNumbers">Save Serial Numbers</button>
            </div>
        </div>
    </div>
</div>

<!-- Expense Management Modal -->
<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expenseModalLabel">Add Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="expense_ledger">Expense Ledger</label>
                    <select id="expense_ledger" class="form-control select2" style="width: 100%;">
                        <option value="">Select Expense Ledger</option>
                        <?php foreach ($expenseLedgers as $ledger): ?>
                            <option value="<?= $ledger['id'] ?>"><?= esc($ledger['ledger_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expense_amount">Amount</label>
                    <input type="number" id="expense_amount" class="form-control" step="0.01">
                </div>
                <div class="form-group">
                    <label for="expense_tax">Tax (%)</label>
                    <input type="number" id="expense_tax" class="form-control" step="0.01" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveExpense">Save Expense</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
<!-- Select2 Initialization -->
<script>
    let serialData = {}; // Global object to store serial numbers for each item row
    $(document).ready(function () {
        // Fix for Select2 inside Bootstrap Modals
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};

        // Initialize Select2
        function initSelect2() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: "Select an option",
                allowClear: true
            });
        }
        initSelect2();

        // Auto-generate voucher number if empty
        if ($('#voucher_no').val() === '') {
            let today = new Date().toISOString().slice(0, 10).replace(/-/g, '');
            $('#voucher_no').val('PUR-' + today + '-' + Math.floor(Math.random() * 900 + 100));
        }

        $('#item_name').on('change', function () {
            let selectedItem = $(this).find(':selected');

            // Populate fields based on selected item's data attributes
            $('#rate').val(selectedItem.data('rate') || 0);
            $('#hsn_code').val(selectedItem.data('hsn') || '');
            $('#tax').val(selectedItem.data('tax') || 0);
            $('#unit').val(selectedItem.data('unit-name') || '');
            
            // Trigger calculation when an item is selected
            calculateAmount();
        });


        // Function to calculate Amount, Total, and Average
        function calculateAmount() {
            let quantity = parseFloat($('#quantity').val()) || 0; // Primary Quantity
            let rate = parseFloat($('#rate').val()) || 0;
            let tax = parseFloat($('#tax').val()) || 0;
            let discount = parseFloat($('#discount').val()) || 0;
            let secondaryUnitTotal = parseFloat($('#secondary_unit_total').val()) || 0; // Secondary Unit Total

            // Prevent negative values
            if (quantity < 0) quantity = 0;
            if (rate < 0) rate = 0;
            if (tax < 0) tax = 0;
            if (discount < 0) discount = 0;
            if (secondaryUnitTotal < 0) secondaryUnitTotal = 0;

            // Calculate Amount and Total
            let amount = quantity * rate;
            let totalTax = (amount * tax) / 100;
            let total = (amount + totalTax) - discount;

            // Ensure Total doesn't go negative
            if (total < 0) total = 0;

            // Calculate Average (if secondary_unit_total is provided)
            let average = secondaryUnitTotal > 0 ? (quantity / secondaryUnitTotal).toFixed(3) : 0;

            // Update the fields
            $('#amount').val(amount.toFixed(2));
            $('#total').val(total.toFixed(2));
            $('#average').val(average); // Update average field (optional display)
        }

        // Recalculate on Input Change
        $('#quantity, #rate, #tax, #discount, #secondary_unit_total').on('input', function () {
            calculateAmount();
        });


        //item displayed to item table
        let itemIndex = 0; // Keeps track of row indexes to avoid conflicts
        

        $('#saveItem').on('click', function () {
            // Fetch values from the modal
            let itemName = $('#item_name option:selected').text();
            let itemId = $('#item_name').val();
            let quantity = parseFloat($('#quantity').val()) || 0;
            let rate = parseFloat($('#rate').val()) || 0;
            let hsnCode = $('#hsn_code').val();
            let tax = parseFloat($('#tax').val()) || 0;
            let discount = parseFloat($('#discount').val()) || 0;
            let total = parseFloat($('#total').val()) || 0;
            let unit = $('#unit').val();
            let secondaryUnit = $('#secondary_unit option:selected').text();
            let secondaryQuantity = parseFloat($('#secondary_unit_total').val()) || 0;
            let brand = $('#brand').val();
            let color = $('#color').val();
            let size = $('#size').val();

            // Validation: Ensure required fields are filled
            if (!itemId || quantity <= 0 || rate <= 0) {
                alert("Please select an item and enter valid Quantity and Rate.");
                return;
            }

            // Calculate Average
            let average = secondaryQuantity > 0 ? (quantity / secondaryQuantity).toFixed(3) : 'N/A';

            // Append the new row to the table
            $('#itemsTableBody').append(`
                <tr id="itemRow_${itemIndex}" 
                    data-item-id="${itemId}"
                    data-brand="${brand}" 
                    data-color="${color}" 
                    data-size="${size}">
                    <td>${itemName}</td>
                    <td>${quantity} (${unit})</td>
                    <td>${rate}</td>
                    <td>${hsnCode}</td>
                    <td>${tax}%</td>
                    <td>${discount}</td>
                    <td>${total}</td>
                    <td>${secondaryQuantity ? secondaryQuantity + ' (' + secondaryUnit + ')<br>Avg: ' + average : '-'}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary editItem" data-index="${itemIndex}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-info serialItem" data-index="${itemIndex}">
                            <i class="fas fa-barcode"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger removeItem" data-index="${itemIndex}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);

            itemIndex++; // Increment row index

            // Reset Modal Fields
            $('#itemModal').find('input, textarea, select').val('');
            $('#item_name').val(null).trigger('change');
            $('#itemModal').modal('hide');
            initSelect2(); // Reinitialize Select2 if needed
        });

        // Edit Item Functionality
        $(document).on('click', '.editItem', function () {
            let index = $(this).data('index'); // Get the row index
            let row = $(`#itemRow_${index}`); // Get the row using ID

            // Extract data from the selected row
            let itemName = row.find('td:nth-child(1)').text();
            let quantityUnit = row.find('td:nth-child(2)').text().split(' ');
            let quantity = quantityUnit[0];
            let unit = quantityUnit[1] ? quantityUnit[1].replace(/[()]/g, '') : ''; // Remove parentheses
            let rate = row.find('td:nth-child(3)').text();
            let hsnCode = row.find('td:nth-child(4)').text();
            let tax = row.find('td:nth-child(5)').text().replace('%', '');
            let discount = row.find('td:nth-child(6)').text();
            let total = row.find('td:nth-child(7)').text();
            let averageSection = row.find('td:nth-child(8)').html();
            let secondaryQuantity = averageSection.includes('(') ? averageSection.split('(')[0].trim() : '';
            let secondaryUnitMatch = averageSection.match(/\((.*?)\)/);
            let secondaryUnit = secondaryUnitMatch ? secondaryUnitMatch[1] : '';
            let average = averageSection.includes('Avg') ? averageSection.split('Avg:')[1].trim() : '';

            // Optional Fields Handling
            let brand = row.data('brand') || ''; // Get brand from data attribute
            let color = row.data('color') || ''; // Get color from data attribute
            let size = row.data('size') || '';   // Get size from data attribute

            // Populate the modal fields
            $('#item_name').val($('#item_name option:contains("' + itemName + '")').val()).trigger('change');
            $('#quantity').val(quantity);
            $('#unit').val(unit);
            $('#rate').val(rate);
            $('#hsn_code').val(hsnCode);
            $('#tax').val(tax);
            $('#discount').val(discount);
            $('#total').val(total);
            $('#secondary_unit_total').val(secondaryQuantity);
            $('#secondary_unit').val($('#secondary_unit option').filter(function () {
                return $(this).text().trim() === secondaryUnit;
            }).val()).trigger('change');
            $('#average').val(average);
            $('#brand').val(brand);
            $('#color').val(color);
            $('#size').val(size);

            // Show the modal
            $('#itemModal').modal('show');

            // Replace the Save button with Update functionality
            $('#saveItem').hide();
            $('#updateItem').remove();
            $('#itemModal .modal-footer').append(`
                <button type="button" class="btn btn-primary" id="updateItem" data-index="${index}">Update Item</button>
            `);
        });

        // Update Item Functionality
        $(document).on('click', '#updateItem', function () {
            let index = $(this).data('index'); // Get the row index
            let row = $(`#itemRow_${index}`); // Get the row using ID

            // Fetch values from the modal
            let itemName = $('#item_name option:selected').text();
            let quantity = $('#quantity').val();
            let rate = $('#rate').val();
            let hsnCode = $('#hsn_code').val();
            let tax = $('#tax').val();
            let discount = $('#discount').val();
            let total = $('#total').val();
            let unit = $('#unit').val();
            let secondaryUnit = $('#secondary_unit option:selected').text();
            let secondaryQuantity = $('#secondary_unit_total').val();
            let average = secondaryQuantity > 0 ? (quantity / secondaryQuantity).toFixed(3) : 'N/A';
            let brand = $('#brand').val();
            let color = $('#color').val();
            let size = $('#size').val();

            // Validation
            if (!itemName || quantity <= 0 || rate <= 0) {
                alert("Please select an item and enter valid Quantity and Rate.");
                return;
            }

            // Update the row with new data
            row.html(`
                <td>${itemName}</td>
                <td>${quantity} (${unit})</td>
                <td>${rate}</td>
                <td>${hsnCode}</td>
                <td>${tax}%</td>
                <td>${discount}</td>
                <td>${total}</td>
                <td>${secondaryQuantity ? secondaryQuantity + ' (' + secondaryUnit + ')<br>Avg: ' + average : '-'}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary editItem" data-index="${index}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-info serialItem" data-index="${index}">
                        <i class="fas fa-barcode"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger removeItem" data-index="${index}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `);

            // Update data attributes for optional fields
            row.data('brand', brand);
            row.data('color', color);
            row.data('size', size);

            // Reset Modal and Buttons
            $('#itemModal').modal('hide');
            $('#itemModal').find('input, textarea, select').val('');
            $('#saveItem').show();
            $('#updateItem').remove();
            $('#item_name').val(null).trigger('change');

            // Recalculate summary after removing the item
            updateSummary();
        });


        //serial number management section
        

        // Open Serial Management Modal
        $(document).on('click', '.serialItem', function () {
            let index = $(this).data('index');
            let row = $(`#itemRow_${index}`);
            let quantity = parseInt(row.find('td:nth-child(2)').text().split(' ')[0]) || 0;

            $('#serialModal').data('index', index); // Attach index to modal for tracking
            $('#serialNumberContainer').empty(); // Clear previous content

            // Populate serial number fields
            for (let i = 0; i < quantity; i++) {
                let serialNumber = serialData[index] && serialData[index][i] ? serialData[index][i] : '';
                $('#serialNumberContainer').append(`
                    <div class="form-group">
                        <label>Serial Number ${i + 1}</label>
                        <input type="text" class="form-control serialNumberInput" data-serial-index="${i}" value="${serialNumber}">
                    </div>
                `);
            }

            // Show the modal
            $('#serialModal').modal('show');
        });

        // Save Serial Numbers
        $('#saveSerialNumbers').on('click', function () {
            let index = $('#serialModal').data('index');
            let serialNumbers = [];

            $('.serialNumberInput').each(function () {
                serialNumbers.push($(this).val().trim());
            });

            // Validate serial number count
            let row = $(`#itemRow_${index}`);
            let quantity = parseInt(row.find('td:nth-child(2)').text().split(' ')[0]) || 0;

            if (serialNumbers.length !== quantity) {
                alert(`Number of serial numbers must match the item quantity (${quantity}).`);
                return;
            }

            // Save serial numbers
            serialData[index] = serialNumbers;

            // Debugging: Check if serial numbers are correctly saved
            console.log(`Serial Data for Row ${index}:`, serialData[index]);

            // Update Serial Button (visual indication)
            $(`#itemRow_${index} .serialItem`).removeClass('btn-info').addClass('btn-success');

            $('#serialModal').modal('hide');
        });

        // Remove Item Row
        $(document).on('click', '.removeItem', function () {
            let index = $(this).data('index'); // Get the index of the row
            let row = $(`#itemRow_${index}`);  // Select the row using ID

            // Confirm before deleting
            if (confirm('Are you sure you want to remove this item?')) {
                row.remove(); // Remove the row from the table
                
                // Remove associated serial numbers
                delete serialData[index];

                // Recalculate summary after removing the item
                updateSummary();
            }
        });

        

       //expenses section
        let expenseIndex = 0;

        // Open Expense Modal
        $('#addExpenseButton').on('click', function () {
            $('#expenseModal').modal('show');
        });

        // Save Expense
        $('#saveExpense').on('click', function () {
            let expenseLedger = $('#expense_ledger option:selected').text();
            let expenseLedgerId = $('#expense_ledger').val();
            let expenseAmount = parseFloat($('#expense_amount').val()) || 0;
            let expenseTax = parseFloat($('#expense_tax').val()) || 0;

            // Validation
            if (!expenseLedgerId || expenseAmount <= 0) {
                alert('Please select an expense ledger and enter a valid amount.');
                return;
            }

            // Calculate total with tax
            let totalExpense = expenseAmount + (expenseAmount * expenseTax / 100);

            // Append expense row to the table
            $('#expensesTableBody').append(`
                <tr id="expenseRow_${expenseIndex}" data-ledger-id="${expenseLedgerId}">
                    <td data-ledger-id="${expenseLedgerId}">${expenseLedger}</td>
                    <td>${expenseAmount.toFixed(2)}</td>
                    <td>${expenseTax}%</td>
                    <td>${totalExpense.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger removeExpense" data-index="${expenseIndex}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);

            expenseIndex++;

            // Reset Modal Fields and Close
            $('#expenseModal').find('input, select').val('');
            $('#expenseModal').modal('hide');

            // Update summary
            updateSummary();
        });

        // Remove Expense Row
        $(document).on('click', '.removeExpense', function () {
            let index = $(this).data('index');
            $(`#expenseRow_${index}`).remove();
            updateSummary();
        });

        // Update Summary Including Voucher-Level Discount
        function updateSummary() {
            let subtotal = 0, totalTaxes = 0, totalDiscounts = 0, totalExpenses = 0;

            // Calculate totals from Items Table
            $('#itemsTableBody tr').each(function () {
                let row = $(this);

                let amount = parseFloat(row.find('td:nth-child(7)').text()) || 0; // Total column
                let taxRate = parseFloat(row.find('td:nth-child(5)').text().replace('%', '')) || 0; // Tax percentage
                let discount = parseFloat(row.find('td:nth-child(6)').text()) || 0; // Discount column

                subtotal += amount; // Add to subtotal
                totalTaxes += (amount * taxRate) / 100; // Calculate tax
                totalDiscounts += discount; // Add discount
            });

            // Calculate totals from Expenses Table
            $('#expensesTableBody tr').each(function () {
                let row = $(this);

                let expenseAmount = parseFloat(row.find('td:nth-child(2)').text()) || 0; // Expense Amount
                let expenseTaxRate = parseFloat(row.find('td:nth-child(3)').text().replace('%', '')) || 0; // Tax percentage

                let expenseTax = (expenseAmount * expenseTaxRate) / 100; // Calculate tax on expense
                totalExpenses += (expenseAmount + expenseTax); // Add expense amount with tax
                totalTaxes += expenseTax; // Add expense tax to total taxes
            });

            // Include Voucher-Level Discount
            let voucherDiscount = parseFloat($('#voucher_discount').val()) || 0;

            // Total Discounts (Item-Level + Voucher-Level)
            let combinedDiscounts = totalDiscounts + voucherDiscount;

            // Update Summary Fields
            $('#subtotal').val(subtotal.toFixed(2)); // Subtotal (before tax and discounts)
            $('#total_taxes').val(totalTaxes.toFixed(2)); // Total Taxes
            $('#total_expenses').val(totalExpenses.toFixed(2)); // Total Expenses
            $('#total_discounts').val(combinedDiscounts.toFixed(2)); // Total Discounts

            // Calculate Grand Total
            let grandTotal = subtotal + totalTaxes + totalExpenses - combinedDiscounts;

            // Ensure Grand Total is non-negative
            if (grandTotal < 0) grandTotal = 0;

            $('#grand_total').val(grandTotal.toFixed(2)); // Grand Total
        }






        // Trigger updateSummary when inputs change
        $('#voucher_discount').on('input', function () {
            updateSummary();
        });

        // Call updateSummary when items or expenses are updated
        $(document).on('click', '.removeItem, .removeExpense', function () {
            updateSummary();
        });

        $('#saveItem, #saveExpense').on('click', function () {
            updateSummary();
        });

        // Recalculate on input changes (Item and Expense Modals)
        $('#quantity, #rate, #tax, #discount, #secondary_unit_total').on('input', function () {
            calculateAmount();
        });



    //document ends    
    });
</script>

<script>
    (function () {
        
        // Form Submission Event
        $('#purchaseVoucherForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            let submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Saving...'); // Disable submit button

            let isValid = true;
            let errorMessage = '';

            // Validate Voucher No
            if (!$('#voucher_no').val().trim()) {
                isValid = false;
                errorMessage += 'Voucher No is required.\n';
            }

            // Validate Date
            if (!$('#date').val().trim()) {
                isValid = false;
                errorMessage += 'Date is required.\n';
            }

            // Validate Vendor
            if (!$('#vendor_id').val().trim()) {
                isValid = false;
                errorMessage += 'Vendor is required.\n';
            }

            // Validate Items Table
            if ($('#itemsTableBody tr').length === 0) {
                isValid = false;
                errorMessage += 'At least one item must be added.\n';
            }

            // Validate Items in Table
            $('#itemsTableBody tr').each(function () {
                let quantity = $(this).find('td:nth-child(2)').text().split(' ')[0]; // Quantity Column
                let total = $(this).find('td:nth-child(7)').text(); // Total Column
                if (parseFloat(quantity) <= 0 || parseFloat(total) <= 0) {
                    isValid = false;
                    errorMessage += 'All items must have valid Quantity and Total.\n';
                    return false;
                }
            });

            // Validate Expenses Table (Optional)
            $('#expensesTableBody tr').each(function () {
                let amount = $(this).find('td:nth-child(2)').text(); // Amount Column
                if (parseFloat(amount) <= 0) {
                    isValid = false;
                    errorMessage += 'Expense amounts must be valid.\n';
                    return false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessage,
                });
                submitButton.prop('disabled', false).text('Save Purchase Voucher'); // Re-enable button
            } else {
                // If everything is valid, proceed to the next step
                collectDynamicDataAndSubmit(submitButton); // Pass button to re-enable on error
            }
        });

        function collectDynamicDataAndSubmit(submitButton) {
            // Prepare form data
            let formData = new FormData($('#purchaseVoucherForm')[0]);

            // Collect Items Data
            $('#itemsTableBody tr').each(function (index, row) {
                let itemId = $(row).data('item-id');
                let quantity = $(row).find('td:nth-child(2)').text().split(' ')[0]; // Quantity Column
                let rate = $(row).find('td:nth-child(3)').text(); // Rate Column
                let tax = $(row).find('td:nth-child(5)').text().replace('%', ''); // Tax Column
                let discount = $(row).find('td:nth-child(6)').text(); // Discount Column
                let total = $(row).find('td:nth-child(7)').text(); // Total Column

                // Serial Numbers
                // Log the current state of serialData
                console.log(`Serial Data for Row in form submit ${index}:`, serialData[index]);

                // Append each item's data to the form
                formData.append(`items[${index}][item_id]`, itemId);
                formData.append(`items[${index}][quantity]`, quantity);
                formData.append(`items[${index}][rate]`, rate);
                formData.append(`items[${index}][tax]`, tax);
                formData.append(`items[${index}][discount]`, discount);
                formData.append(`items[${index}][total]`, total);

                // Append serial numbers if they exist
                // Append serial numbers if they exist
                if (serialData[index] && serialData[index].length > 0) {
                    serialData[index].forEach((serial, serialIndex) => {
                        formData.append(`items[${index}][serial_numbers][${serialIndex}]`, serial);
                    });
                } else {
                    // Add a placeholder if no serial numbers are present
                    formData.append(`items[${index}][serial_numbers]`, '');
                }

                 // Log formData after appending serial numbers
                 console.log(`FormData After Adding Serial Numbers for Row ${index}:`, [...formData.entries()]);
            });

            // Collect Expenses Data
            $('#expensesTableBody tr').each(function (index, row) {
                let ledgerId = $(row).data('ledger-id');
                let amount = parseFloat($(row).find('td:nth-child(2)').text()) || 0;
                let tax = parseFloat($(row).find('td:nth-child(3)').text().replace('%', '')) || 0;

                if (amount < 0 || tax < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: `Expense row ${index + 1} has invalid values. Amount and Tax cannot be negative.`,
                    });
                    return false; // Stop processing
                }

                formData.append(`expenses[${index}][ledger_id]`, ledgerId);
                formData.append(`expenses[${index}][amount]`, amount.toFixed(2));
                formData.append(`expenses[${index}][tax]`, tax.toFixed(2));
            });

            // Final Debugging Log
            console.log("Final FormData before submission:", [...formData.entries()]);

            // Submit the form using AJAX
            submitForm(formData, submitButton);
        }


        // Submit Form via AJAX
        function submitForm(formData, submitButton) {
            $.ajax({
                url: $('#purchaseVoucherForm').attr('action'), // Form action URL
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // Optionally show a spinner or loading indicator here
                    Swal.fire({
                        title: 'Saving...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (response) {
                    // Log the response for debugging
                    console.log("Server Response:", response);

                    // Handle success (e.g., redirect or show success message)
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Purchase Voucher saved successfully!',
                    //}).then(() => {
                       // window.location.href = '<?= site_url('inventory/purchase-vouchers') ?>';
                    });
                },
                error: function (xhr) {
                    // Handle error
                    let errorMessage = xhr.responseJSON?.message || 'An error occurred while saving the Purchase Voucher.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                },
                complete: function () {
                    // Re-enable the submit button
                    submitButton.prop('disabled', false).text('Save Purchase Voucher');
                },
            });
        }
    })();
</script>


<?= $this->endSection() ?>
