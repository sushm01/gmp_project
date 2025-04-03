 <?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php } ?>
<style>
    .rectangular-input {
    border-radius: 50; /* Remove rounded corners */
    height: 100px; /* Adjust height */
    width: 100%; /* Adjust width as needed */
    box-shadow: none; /* Optional: remove shadow for a cleaner look */
}
 #successMessage {
      background-color: SkyBlue; /* Change to your desired color */
      border-color: SkyBlue;
      color: #ffffff; /* Change to your desired text color */
  /*    //max-height: 350px;*/
      max-width: 350px;
      font-size: 16px; /* Change to your desired font size */
      padding: 10px 20px; /* Adjust padding as needed */
      margin-bottom: 20px; /* Adjust margin as needed */
  }

</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
         <!-- right column -->
      <div class="col-md-12">
        <!-- General form elements -->
        <div class="card card-warning">
        <div class="card-header" style="background-color: #D8BFD8; border-color: #D8BFD8;">
    <div class="row align-items-center">
        <!-- Purchase Form Header -->
        <div class="col-md-6">
            <h3 class="card-title"><strong>Purchase Form</strong></h3>
        </div>
    </div>
</div>
          <!-- /.card-header -->
   <form method="post" id="addBag" action="<?= base_url('welcome/savePurchaseOrder') ?>">
      <!-- Invoice No Input Field -->
        <div class="col-md-6 text-left">
            <div class="form-group mb-0">
                <label for="invoice_no" class="col-form-label mr-2">Invoice No:</label>
                <input 
                    type="text" 
                    id="invoice_no" 
                    name="invoice_no"    
                    class="form-control d-inline-block" 
                    placeholder="Enter Invoice No" 
                    style="width: 200px;"
                    autocomplete="off">
            </div>
        </div>
    <!-- SGST% -->
    <div class="card-body">
        <div class="row supplier-row align-items-end">
            <!-- Add/Remove Buttons -->
        <div class="col-sm-1">
            <div class="form-group text-center">
                <button type="button" class="btn btn-success btn-sm add-row" style="background-color: SteelBlue; border-color: SteelBlue; color: white;">+</button>
                <button type="button" class="btn btn-danger btn-sm remove-row" style="background-color: RosyBrown; border-color: RosyBrown; color: white;">-</button>
            </div>
        </div>
              <!-- SL.No -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">SL.No</label>
                    <input type="text" name="sl_no[]" class="form-control sl-no" placeholder="1" readonly>
                </div>
            </div>
            <!-- Materials -->
<div class="col-sm-1">
    <div class="form-group">
        <label class="col-form-label">Materials</label>
        <select name="raw_materials[]" id="raw_materials" class="form-control rawMaterialSelect">
            <option value="">Select Raw</option>
            <?php if (!empty($getRaw)): ?>
                <?php foreach ($getRaw as $category): ?>
                    <option value="<?php echo $category->id; ?>"><?php echo $category->raw_materials; ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No materials available</option>
            <?php endif; ?>
        </select>
    </div>
</div>
             <!-- Units -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">Units</label>
                    <select type="text" name="unit_id[]" id="unit_id" class="form-control unitSelect" placeholder="Enter ...">
                        <option value="">Select Unit</option>
                        <?php if ($getUnits->num_rows() > 0): ?>
                            <?php foreach ($getUnits->result() as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->units; ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No units available</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <!-- Purchase Price -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Purchase Price</label>
                    <input type="text" id="purchase_amount" name="purchase_price[]" class="form-control purchase-price" placeholder="Enter ..." oninput="calculateGrossAmount(this)">
                </div>
            </div>
            <!-- Qty -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">Qty</label>
                    <input type="text" id="quantity" name="qty[]" class="form-control qty" placeholder="Enter ..." oninput="calculateGrossAmount(this)">
                </div>
            </div>
            <!-- Gross Amt -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">Gross Amt</label>
                    <input type="text" name="gross_amt[]" id="gross_amt[]" class="form-control gross-amt" value="0" readonly>
                </div>
            </div>
            <!-- SGST% -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">SGST%</label>
                    <input type="text" name="sgst[]" id="sgst[]" class="form-control sgst" placeholder="Enter..">
                </div>
            </div>
            <!-- CGST% -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">CGST%</label>
                    <input type="text" name="cgst[]" id="cgst[]" class="form-control cgst" placeholder="Enter..">
                </div>
            </div>
            <!-- GST Amt -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">GST Amt</label>
                    <input type="text" name="gst_amt[]" id="gst_amt[]" class="form-control gst-amt" value="0" readonly>
                </div>
            </div>
            <!-- Line Total -->
            <div class="col-sm-1">
                <div class="form-group">
                    <label class="col-form-label">Line Total</label>
                    <input type="text" name="line_total[]" id="line_total[]" class="form-control line-total" value="0" readonly>
                </div>
            </div>
        </div>
    </div>
    <!-- Static fields -->
    <div class="card-body">
        <!-- Bill Date -->
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label">Bill Date</label>
                    <input type="date" name="bill_date" id="bill_date" class="form-control" placeholder="Enter ...">
                </div>
            </div>
            <!-- Select Supplier -->
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label">Select Supplier</label>
                    <select type="text" name="supplier_id" id="" class="form-control" placeholder="Enter ...">
                        <option value="">Select Supplier Name</option>
                        <?php if ($getSupplier->num_rows() > 0): ?>
                            <?php foreach ($getSupplier->result() as $category): ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->supp_name; ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No Supp available</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- Payment Mode -->
            <div class="col-sm-3">
              <div class="form-group inline-block">
                <label class="col-form-label">Payment Mode</label>
                <select name="payment_mode" class="form-control">
                  <option value="" disabled selected>Select Payment Mode</option>
                  <option value="cash">Cash</option>
                  <option value="upi">UPI</option>
                   <option value="credit_bank">credit_bank</option>
                </select>
              </div>
            </div>
            <!-- Descriptions -->
            <div class="col-sm-3">
                <div class="form-group inline-block">
                    <label class="col-form-label">Descriptions</label>
                    <input type="text" name="" class="form-control rectangular-input" placeholder="Enter ...">
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Total Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Total Amt</label>
                    <input type="text" name="total_amt" id="total_amt" class="form-control total-amt" value="0" readonly>
                </div>
            </div>
            <!-- Cash Discount% -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Cash Discount%</label>
                    <input type="number" name="cash_discount" id="cash_discount" class="form-control" placeholder="Enter Discount %" oninput="calculatePayable()">
                </div>
            </div>
            <!-- Payable Mode -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Payable Amt</label>
                    <input type="text" name="payable_amt" id="payable_mode" class="form-control" placeholder="Payable Amount" readonly>
                </div>
            </div>
            <!-- Paid Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Paid Amt</label>
                    <input type="text" name="paid_amt" id="paid_amt" class="form-control" placeholder="Enter ...">
                </div>
            </div>
            <!-- Balance Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Balance Amt</label>
                    <input type="text" name="balance_amt" id="balance_amt" class="form-control" placeholder="Enter ..." readonly>
                </div>
            </div>
            <!-- Other form fields -->
   <!--  <div class="col-sm-2">
        <div class="form-group">
            <label class="col-form-label">Invoice Copy</label>
            <input type="file" name="invoice_copy" class="form-control" required>
        </div>
    </div> -->
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" style="background-color: #D8BFD8; border-color: #D8BFD8; color: black;" class="btn btn-primary addBrand-save"><strong>Confirm Order</strong></button>
        <button type="reset" style="background-color: #D8BFD8; border-color: #D8BFD8; color: black;" class="btn btn-secondary addBrand-save"><strong>Cancel</strong></button>
    </div>
    </form>
    </div>
    <!-- /.card-body -->
    </div>
 <!-- /.card -->
    </div>

          <!-- /.card -->
          <div class="card">
            <div class="card-header" style="background-color: #D8BFD8; border-color: #D8BFD8;">
              <h3 class="card-title"><strong>Purchase Data From</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Invoice.No</th>
                    <th>Bill Date</th>
                    <th>Line Total</th>
                    <th>Payable Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance Amount</th>
                    <th>Supplier Name</th>
                    <th>Mobile.No</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
    <?php if ($getOrder !== null && $getOrder->num_rows() > 0): ?>
        <?php $i = 1; ?>
        <?php foreach ($getOrder->result() as $r): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $r->invoice_no; ?></td>
                <td><?php echo $r->bill_date; ?></td>
                <td><?php echo $r->line_total; ?></td>
                <td><?php echo $r->payable_amt; ?></td>
                <td><?php echo $r->paid_amt; ?></td>
                <td><?php echo $r->balance_amt; ?></td>
                <td><?php echo $r->supp_name; ?></td>
                <td><?php echo $r->supp_mobile_no; ?></td>
                <td>
                    <a class="btn btn-sm btn-warning" onclick="setDeleteFunction('<?php echo $r->id; ?>')" style="color: Black">Remove</a>
                     <a class="btn btn-sm btn-success" onclick="setEditFunction('<?php echo $r->id; ?>',
                    '<?php echo htmlspecialchars($r->invoice_no, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->bill_date, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->line_total, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->payable_amt, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->paid_amt, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->balance_amt, ENT_QUOTES); ?>'
                    // '<?php echo htmlspecialchars($r->supp_name, ENT_QUOTES); ?>'
                    // '<?php echo htmlspecialchars($r->supp_mobile_no, ENT_QUOTES); ?>'
                     )" style="color: Black">Update</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">No products found</td>
        </tr>
    <?php endif; ?>
</tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!--------------------------Delete Brand Modal ---------------------------------------->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Supplier's details?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteOrder'); ?>">
                    <input type="hidden" name="dlt_id" id="dlt_id">
        <button type="button" style="color: SteelBlue" class="btn btn-light" data-dismiss="modal">No</button>
                 <button type="submit" style="color: RosyBrown" class="btn btn-light">Yes Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!---------------------------Edit Brand Modal ---------------------------------------->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Stock Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('welcome/updatePurchase') ?>" id="editParty">
                <div class="modal-body">
                    <div class="row">
                        <!-- Product Name -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Invoice No</label>
                                <input type="hidden" name="id" id="party_id"> 
                                <input type="text" name="invoice_no" id="inv_id" class="form-control" placeholder="Enter Product Name" readonly required />
                            </div>
                        </div>

                        <!-- HSN Code -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="text" name="bill_date" id="bill_id" class="form-control" placeholder="Enter HSN Code" readonly />
                            </div>
                        </div>

                        <!-- Quantity (in dozens) -->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Line Total</label>
                                <input type="text" name="line_total" id="linetotal_id" class="form-control" placeholder="Enter Quantity in Dozens" readonly />
                            </div>
                        </div>

                       <!-- Pieces Per Packet -->
<div class="col-sm-3">
    <div class="form-group">
        <label>Payable Amount</label>
        <input type="text" name="payable_amt" id="payable_id" class="form-control" placeholder="Enter Quantity in Dozens" readonly> 
    </div>
</div>

<!-- Materials -->
<div class="col-sm-3">
    <div class="form-group">
        <label>Paid Amount</label>
        <input type="text" name="paid_amt" id="paid_id" class="form-control" placeholder="Enter Quantity in Dozens">
    </div>
</div>

<!-- Quantity -->
<div class="col-sm-3">
    <div class="form-group">
        <label>Balance Amount</label>
        <input type="text" name="balance_amt" id="balance_id" class="form-control" placeholder="Enter Quantity" readonly />
    </div>
</div>

                        <!-- Units -->
                        <!-- <div class="col-sm-3">
                            <div class="form-group">
                                <label>Supplier</label>
                                <input type="text" name="supp_name" id="supp_id" class="form-control" placeholder="Enter Units" readonly />
                            </div>
                        </div>
 -->
                        <!-- Wholesale Price -->
                    <!--     <div class="col-sm-3">
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input type="text" name="supp_mobile_no" id="mobile_id" class="form-control" placeholder="Enter Wholesale Price" readonly />
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" style="color: SteelBlue" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" style="color: RosyBrown" class="btn btn-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    // Function to move to the next or previous input field on Arrow keys
    function moveToNextOrPreviousField(event, direction) {
        if (event.key === "ArrowRight" || event.key === "ArrowLeft") {
            event.preventDefault(); // Prevent default action of arrow keys

            let fields = document.querySelectorAll('input, select'); // Get all input/select fields
            let currentIndex = Array.from(fields).indexOf(document.activeElement); // Get the current field index
            
            if (currentIndex === -1) return; // If no active element, do nothing
            
            // Move to the next or previous field based on the direction
            let newIndex = direction === "next" ? currentIndex + 1 : currentIndex - 1;

            // Check bounds and move to the next or previous field
            if (newIndex >= 0 && newIndex < fields.length) {
                fields[newIndex].focus(); // Focus the next or previous field
            }
        }
    }

    // Initialize event listeners for all input fields and select elements
    document.querySelectorAll('input, select').forEach((input) => {
        input.addEventListener('keydown', (event) => {
            if (event.key === "ArrowRight") {
                moveToNextOrPreviousField(event, "next"); // Move to next field on Right Arrow
            } else if (event.key === "ArrowLeft") {
                moveToNextOrPreviousField(event, "previous"); // Move to previous field on Left Arrow
            }
        });
    });


    //--------------------- Function to calculate the balance for update function
    function calculateBalance() {
        const payableAmount = parseFloat(document.getElementById('payable_id').value) || 0;
        const paidAmount = parseFloat(document.getElementById('paid_id').value) || 0;
        
        // Calculate balance amount
        const balanceAmount = payableAmount - paidAmount;
        
        // Update the balance input field
        document.getElementById('balance_id').value = balanceAmount.toFixed(2);
    }

    // Event listener for changes in the paid amount
    document.getElementById('paid_id').addEventListener('input', calculateBalance);

//-----------update function
 function setEditFunction(id, invoice_no, bill_date, line_total, payable_amt, paid_amt, balance_amt) {
    $('#party_id').val(id); 
    $('#inv_id').val(decodeURIComponent(invoice_no));
    $('#bill_id').val(bill_date);
    $('#linetotal_id').val(line_total);
    $('#payable_id').val(payable_amt);
    $('#paid_id').val(paid_amt);
    $('#balance_id').val(balance_amt);
    // $('#supp_id').val(supp_name);
    // $('#mobile_id').val(supp_mobile_no);
    $('#editModal').modal('show');
}

  //-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds

    //-----------------------START Delete operation-----------//
    function setDeleteFunction(dlt_id) {
    if (dlt_id) {
        // Set the ID in the hidden input field
        $('#dlt_id').val(dlt_id);

        // Show the delete modal
        $('#deleteModal').modal('show');
    } else {
        alert("Invalid ID provided.");
    }
}

   //--------------------------END Delete operation----------//

    //------------------------- Add/Remove Row Functionality ------

document.addEventListener('DOMContentLoaded', () => {
    const addBagForm = document.getElementById('addBag');

    // Function to update SL.No for all rows
    function updateSerialNumbers() {
        const rows = addBagForm.querySelectorAll('.supplier-row');
        rows.forEach((row, index) => {
            const slNoField = row.querySelector('.sl-no');
            if (slNoField) {
                slNoField.value = index + 1; // Update SL.No (1-based index)
            }
        });
    }

    // Function to attach event listeners to the material dropdown
    function attachMaterialChangeListener(row) {
        const materialDropdown = row.querySelector('.rawMaterialSelect');
        const unitDropdown = row.querySelector('.unitSelect');

        materialDropdown.addEventListener('change', function () {
            const materialId = this.value;
            if (materialId) {
                $.ajax({
                    url: "<?php echo site_url('welcome/getUnitsByMaterial'); ?>",
                    type: "POST",
                    data: { material_id: materialId },
                    dataType: "json",
                    success: function (data) {
                        unitDropdown.innerHTML = '<option value="">Select Unit</option>'; // Clear the dropdown
                        data.forEach(item => {
                            const option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.units;
                            unitDropdown.appendChild(option);
                        });
                    },
                    error: function () {
                        alert('Error fetching units!');
                    }
                });
            } else {
                unitDropdown.innerHTML = '<option value="">Select Unit</option>';
            }
        });
    }

    // Function to attach event listeners for material dropdown to all rows
    function attachListenersToAllRows() {
        const rows = addBagForm.querySelectorAll('.supplier-row');
        rows.forEach(row => {
            attachMaterialChangeListener(row);
        });
    }

    // Event listener for add and remove row buttons
    addBagForm.addEventListener('click', function (event) {
        if (event.target.classList.contains('add-row')) {
            const parentRow = event.target.closest('.supplier-row');
            const row = parentRow.cloneNode(true);

            // Clear input values in the cloned row, except for SL.No
            row.querySelectorAll('input, select').forEach(input => {
                if (!input.classList.contains('sl-no')) {
                    input.value = '';
                }
            });

            // Append the new row and update serial numbers
            addBagForm.querySelector('.card-body').appendChild(row);
            updateSerialNumbers();

            // Attach event listener for the new row
            attachMaterialChangeListener(row);
        }

        if (event.target.classList.contains('remove-row')) {
            const rows = addBagForm.querySelectorAll('.supplier-row');
            if (rows.length > 1) {
                event.target.closest('.supplier-row').remove();
                updateSerialNumbers();
            } else {
                alert('At least one row is required.');
            }
        }
    });

    // Initialize SL.No and attach listeners for the initial rows
    updateSerialNumbers();
    attachListenersToAllRows();
});

//     document.addEventListener('DOMContentLoaded', () => {
//     const addBagForm = document.getElementById('addBag');

//     // Function to update SL.No for all rows
//     function updateSerialNumbers() {
//         const rows = addBagForm.querySelectorAll('.supplier-row');
//         rows.forEach((row, index) => {
//             const slNoField = row.querySelector('.sl-no');
//             if (slNoField) {
//                 slNoField.value = index + 1; // Update SL.No (1-based index)
//             }
//         });
//     }

//     // Event listener for add and remove row buttons
//     addBagForm.addEventListener('click', function (event) {
//         if (event.target.classList.contains('add-row')) {
//             const parentRow = event.target.closest('.supplier-row');
//             const row = parentRow.cloneNode(true);

//             // Clear input values in the cloned row, except for SL.No
//             row.querySelectorAll('input').forEach(input => {
//                 if (!input.classList.contains('sl-no')) {
//                     input.value = '';
//                 }
//             });

//             // Append the new row and update serial numbers
//             addBagForm.querySelector('.card-body').appendChild(row);
//             updateSerialNumbers();
//         }

//         if (event.target.classList.contains('remove-row')) {
//             const rows = addBagForm.querySelectorAll('.supplier-row');
//             if (rows.length > 1) {
//                 event.target.closest('.supplier-row').remove();
//                 updateSerialNumbers();
//             } else {
//                 alert('At least one row is required.');
//             }
//         }
//     });

//     // Initialize SL.No for the initial rows
//     updateSerialNumbers();
// });


  //------------------ Event listener for changes in fields
    document.addEventListener("input", function (event) {
    // Auto-generate balance amount when `payable_mode` or `paid_amt` changes
    if (event.target.id === "paid_amt" || event.target.id === "payable_mode" || event.target.id === "cash_discount") {
        updateBalanceAmount();
    }

    // Recalculate GST, Gross Amount, and Line Total for dynamic table rows
    if (
        event.target.classList.contains("sgst") || 
        event.target.classList.contains("cgst") || 
        event.target.classList.contains("purchase-price") || 
        event.target.classList.contains("qty")
    ) {
        const row = event.target.closest(".row");

        // Recalculate GST amount when SGST or CGST changes 
        if (event.target.classList.contains("sgst") || event.target.classList.contains("cgst")) {
            calculateGSTAmount(row);
        }

        // Recalculate Gross Amount when Purchase Price or Quantity changes
        if (event.target.classList.contains("purchase-price") || event.target.classList.contains("qty")) {
            calculateGrossAmount(event.target);
        }

        // Update line total in all cases
        updateLineTotal(row);

        // Update balance amount (if relevant to the table)
        updateBalanceAmount();

        calculatePayable();
    }
});

// Function to calculate the gross amount
function calculateGrossAmount(element) {
    const row = element.closest(".row");
    const purchasePriceField = row.querySelector(".purchase-price");
    const qtyField = row.querySelector(".qty");
    const grossAmtField = row.querySelector(".gross-amt");

    const purchasePrice = parseFloat(purchasePriceField.value) || 0;
    const qty = parseFloat(qtyField.value) || 0;
    const grossAmt = purchasePrice * qty;

    // Auto-update the gross amount field
    grossAmtField.value = grossAmt.toFixed(2);

    // Recalculate GST amount if necessary
    calculateGSTAmount(row);
    updateBalanceAmount();
}

// Function to calculate the GST amount
function calculateGSTAmount(row) {
    const purchasePrice = parseFloat(row.querySelector(".purchase-price").value) || 0;
    const qty = parseFloat(row.querySelector(".qty").value) || 0;
    const basePrice = purchasePrice * qty;

    const sgstRate = parseFloat(row.querySelector(".sgst").value) || 0;
    const cgstRate = parseFloat(row.querySelector(".cgst").value) || 0;

    const gstAmt = basePrice * ((sgstRate + cgstRate) / 100);

    // Auto-update the GST amount field
    const gstAmtField = row.querySelector(".gst-amt");
    gstAmtField.value = gstAmt.toFixed(2);
}

function updateLineTotal(row) {
    const grossAmt = parseFloat(row.querySelector(".gross-amt").value) || 0;
    const gstAmt = parseFloat(row.querySelector(".gst-amt").value) || 0;
    const lineTotalField = row.querySelector(".line-total");

    const lineTotal = grossAmt + gstAmt;

    // Auto-update the line total field
    lineTotalField.value = lineTotal.toFixed(2);

    // Call updateTotalAmount to recalculate the overall total
    updateTotalAmount();
}

// Function to update the total amount and initialize the payable field
function updateTotalAmount() {
    let totalAmount = 0;
    const lineTotalFields = document.querySelectorAll('.line-total');

    // Calculate the total amount by summing up all line totals
    lineTotalFields.forEach(field => {
        totalAmount += parseFloat(field.value) || 0;
    });

    // Auto-update the total amount field
    const totalAmtField = document.querySelector('[id="total_amt"]');
    totalAmtField.value = totalAmount.toFixed(2);

    // Initialize the payable field with the total amount (before applying any discount)
    document.getElementById('payable_mode').value = totalAmount.toFixed(2);

    // Optional: Highlight the field with a red border to indicate it was auto-updated
    totalAmtField.style.border = "2px solid red"; // Highlight with a red border

    // Remove the red border after a short delay (e.g., 1 second)
    setTimeout(() => {
        totalAmtField.style.border = "none"; // Remove red border
    }, 1000);

    // Debugging logs
    console.log('Total Amount:', totalAmount);
}
 
function calculatePayable() {
    let totalGrossAmount = 0;
    document.querySelectorAll('.gross-amt').forEach(field => {
        totalGrossAmount += parseFloat(field.value) || 0;
    });

    // Get cash discount and paid amount fields
    const cashDiscountField = document.getElementById('cash_discount');
    const paidAmtField = document.getElementById('paid_amt');
    const totalAmtField = document.getElementById('total_amt');
    const payableModeField = document.getElementById('payable_mode');
    const balanceAmtField = document.getElementById('balance_amt');
    const totalGrossAmtField = document.getElementById('total_gross_amt');

    // Parse values, defaulting to 0 if the field is empty
    const cashDiscount = cashDiscountField ? parseFloat(cashDiscountField.value) || 0 : 0;
    const paidAmt = paidAmtField ? parseFloat(paidAmtField.value) || 0 : 0;
    const totalAmt = totalAmtField ? parseFloat(totalAmtField.value) || 0 : 0;

    let payableAmount;

    if (isNaN(cashDiscount) || cashDiscount === 0) {
        payableAmount = totalAmt;
    } else {
        const discountValue = (cashDiscount / 100) * totalGrossAmount;
        payableAmount = totalAmt - discountValue;
    }

    // Update payable and balance amounts
    if (payableModeField) payableModeField.value = payableAmount.toFixed(2);
    if (balanceAmtField) balanceAmtField.value = (payableAmount - paidAmt).toFixed(2);
    if (totalGrossAmtField) totalGrossAmtField.value = totalGrossAmount.toFixed(2);

    console.log('Total Gross Amount:', totalGrossAmount);
    console.log('Cash Discount:', cashDiscount);
    console.log('Paid Amount:', paidAmt);
    console.log('Payable Amount:', payableAmount);
}

// Function to update balance amount
function updateBalanceAmount() {
    // Get the payable amount and paid amount
    const payableAmt = parseFloat(document.getElementById("payable_mode").value) || 0;
    const paidAmt = parseFloat(document.getElementById("paid_amt").value) || 0;

    // Calculate the balance amount
    const balanceAmt = payableAmt - paidAmt;

    // Update the balance amount field
    const balanceAmtField = document.querySelector('[id="balance_amt"]');
    if (balanceAmtField) {
        balanceAmtField.value = balanceAmt.toFixed(2);
    }

    // Debugging: log the results
    console.log('Payable Amount:', payableAmt);
    console.log('Paid Amount:', paidAmt);
    console.log('Balance Amount:', balanceAmt);
}

  //----------------- Validation function
  function validateForm() {
    let isValid = true;

    // Get all form inputs
    const invoiceNo = document.getElementById('invoice_no');
    const billDate = document.getElementById('bill_date');
    const supplierId = document.querySelector('[name="supplier_id"]');
    const paymentMode = document.querySelector('[name="payment_mode"]');
    const totalAmt = document.getElementById('total_amt');
    const cashDiscount = document.getElementById('cash_discount');
    const payableAmt = document.getElementById('payable_mode');
    const paidAmt = document.getElementById('paid_amt');
    const balanceAmt = document.getElementById('balance_amt');
    const purchasePrices = document.querySelectorAll('.purchase-price');
    const quantities = document.querySelectorAll('.qty');
    const cgsts = document.querySelectorAll('.cgst');
    const sgsts = document.querySelectorAll('.sgst');
    const materials = document.querySelectorAll('.rawMaterialSelect');
    const units = document.querySelectorAll('.unitSelect');

    // Clear previous error messages
    const errorMessages = document.querySelectorAll('.error-msg');
    errorMessages.forEach(function(error) {
      error.remove();
    });

    // Validate Invoice No (Only numbers allowed)
    if (invoiceNo.value === "") {
      isValid = false;
      showError(invoiceNo, "Invoice No is required");
    } else if (!/^\d+$/.test(invoiceNo.value)) {
      isValid = false;
      showError(invoiceNo, "Invoice No must be numeric");
    }

    // Validate Bill Date (Date must be selected)
    if (billDate.value === "") {
      isValid = false;
      showError(billDate, "Bill Date is required");
    }

    // Validate Supplier Selection (Required)
    if (supplierId.value === "") {
      isValid = false;
      showError(supplierId, "Supplier is required");
    }

    // Validate Payment Mode (Required and must be a valid selection)
    if (paymentMode.value === "") {
      isValid = false;
      showError(paymentMode, "Payment Mode is required");
    }

    // Validate Total Amount (Must be a positive number)
    if (totalAmt.value === "" || totalAmt.value === "0") {
      isValid = false;
      showError(totalAmt, "Total Amount is required and cannot be zero");
    } else if (isNaN(totalAmt.value) || parseFloat(totalAmt.value) <= 0) {
      isValid = false;
      showError(totalAmt, "Total Amount must be a valid positive number");
    }

    // Validate Cash Discount (Must be a number and can be 0 or positive)
    if (cashDiscount.value === "") {
      isValid = false;
      showError(cashDiscount, "Cash Discount is required");
    } else if (isNaN(cashDiscount.value) || parseFloat(cashDiscount.value) < 0) {
      isValid = false;
      showError(cashDiscount, "Cash Discount must be a valid number (>=0)");
    }

    // Validate Payable Amount (Must be a positive number)
    if (payableAmt.value === "" || payableAmt.value === "0") {
      isValid = false;
      showError(payableAmt, "Payable Amount is required and cannot be zero");
    } else if (isNaN(payableAmt.value) || parseFloat(payableAmt.value) <= 0) {
      isValid = false;
      showError(payableAmt, "Payable Amount must be a valid positive number");
    }

    // Validate Paid Amount (Must be a positive number)
    if (paidAmt.value === "") {
      isValid = false;
      showError(paidAmt, "Paid Amount is required");
    } else if (isNaN(paidAmt.value) || parseFloat(paidAmt.value) <= 0) {
      isValid = false;
      showError(paidAmt, "Paid Amount must be a valid positive number");
    }

    // Validate Balance Amount (Must be a positive number)
    if (balanceAmt.value === "") {
      isValid = false;
      showError(balanceAmt, "Balance Amount is required");
    } else if (isNaN(balanceAmt.value) || parseFloat(balanceAmt.value) < 0) {
      isValid = false;
      showError(balanceAmt, "Balance Amount must be a valid positive number");
    }

    // Validate Purchase Price (Must be a positive number)
    purchasePrices.forEach(function(purchasePrice, index) {
      if (purchasePrice.value === "" || purchasePrice.value === "0") {
        isValid = false;
        showError(purchasePrice, "Purchase Price is required and cannot be zero");
      } else if (isNaN(purchasePrice.value) || parseFloat(purchasePrice.value) <= 0) {
        isValid = false;
        showError(purchasePrice, "Purchase Price must be a valid positive number");
      }
    });

    // Validate Quantity (Must be a positive number)
    quantities.forEach(function(quantity, index) {
      if (quantity.value === "" || quantity.value === "0") {
        isValid = false;
        showError(quantity, "Quantity is required and cannot be zero");
      } else if (isNaN(quantity.value) || parseFloat(quantity.value) <= 0) {
        isValid = false;
        showError(quantity, "Quantity must be a valid positive number");
      }
    });

    // Validate CGST (Must be a valid percentage between 0 and 100)
    cgsts.forEach(function(cgst, index) {
      if (isNaN(cgst.value) || parseFloat(cgst.value) < 0 || parseFloat(cgst.value) > 100) {
        isValid = false;
        showError(cgst, "CGST must be a valid percentage between 0 and 100");
      }
    });

    // Validate SGST (Must be a valid percentage between 0 and 100)
    sgsts.forEach(function(sgst, index) {
       if (isNaN(sgst.value) || parseFloat(sgst.value) < 0 || parseFloat(sgst.value) > 100) {
        isValid = false;
        showError(sgst, "SGST must be a valid percentage between 0 and 100");
      }
    });

    // Validate Materials (Must be selected)
    materials.forEach(function(material, index) {
      if (material.value === "") {
        isValid = false;
        showError(material, "Material is required");
      }
    });

    // Validate Units (Must be selected)
    units.forEach(function(unit, index) {
      if (unit.value === "") {
        isValid = false;
        showError(unit, "Unit is required");
      }
    });

    // Return the result of the validation
    return isValid;
  }

  // Function to show error message below input field
  function showError(inputElement, message) {
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('error-msg');
    errorDiv.style.color = 'Brown';
    errorDiv.style.fontSize = '12px';
    errorDiv.innerText = message;
    inputElement.parentNode.appendChild(errorDiv);
  }

  // Bind form submit
  document.getElementById('addBag').onsubmit = function(event) {
    if (!validateForm()) {
      event.preventDefault(); // Prevent form submission
    }
  };

//----------------auto select units based on materials 
    //  $(document).ready(function () {
    //     $('#raw_materials').on('change', function () {
    //         var materialId = $(this).val();
    //         if (materialId) {
    //             $.ajax({
    //                 url: "<?php echo site_url('welcome/getUnitsByMaterial'); ?>",
    //                 type: "POST",
    //                 data: { material_id: materialId },
    //                 dataType: "json",
    //                 success: function (data) {
    //                     $('#unit_id').empty(); // Clear the dropdown
    //                     $('#unit_id').append('<option value="">Select Unit</option>');
    //                     $.each(data, function (key, value) {
    //                         $('#unit_id').append('<option value="' + value.id + '">' + value.units + '</option>');
    //                     });
    //                 },
    //                 error: function () {
    //                     alert('Error fetching units!');
    //                 }
    //             });
    //         } else {
    //             $('#unit_id').empty();
    //             $('#unit_id').append('<option value="">Select Unit</option>');
    //         }
    //     });
    // });
</script>

<script>
    // Set today's date as the default value in the input field
    document.addEventListener("DOMContentLoaded", function () {
        const billDateField = document.getElementById("bill_date");
        const today = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD
        billDateField.value = today;
    });
</script>

   