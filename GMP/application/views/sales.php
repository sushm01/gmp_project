 
 <?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php } ?>
<style>
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
            <h1>Sales & Billing Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sales Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
             <div class="card-header" style="background-color: #F5DEB3; border-color: #F5DEB3;">
           <h3 class="card-title"><strong>Sales & Billing Form</strong></h3>
            </div>
            <!-- /.card-header -->
   <form method="post" id="addBag" action="<?= base_url('welcome/addSales') ?>">
    <div class="card-body">
     <div class="row mb-3 align-items-center">
    <!-- Input Field -->
<div class="col-auto">
    <div class="input-group input-group-sm">
        <div class="input-group-prepend">
            <span class="input-group-text fw-bold">Bill No</span>
        </div>
      <input class="form-control form-control-sm" name="bill_no" type="text" 
       placeholder="" autocomplete="off" readonly 
       value="<?php echo isset($bill_no) ? $bill_no : ''; ?>" 
       style="width: 100px;">

    </div>
</div>


    <!-- Button -->
    <div class="col-auto">
        <button type="button" style="background-color: DarkGoldenRod; border-color: DarkGoldenRod; color: white;" 
                class="btn btn-primary btn-sm" id="topButton">Wholesale Price</button>
            </div>
        </div>


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
        
        <!-- Product Name -->
        <div class="col-sm-2">
            <div class="form-group">
                <label class="col-form-label">Product Name</label>
               <select name="product_name_id[]" id="product_name" class="form-control" placeholder="Enter ...">
    <option value="">Select Product Name</option>
    <?php 
    $seenIds = []; // Array to keep track of seen product IDs
    if (!empty($getPN)): 
        foreach ($getPN as $category): 
            if (!in_array($category->product_id, $seenIds)): // Check if ID is already seen
                $seenIds[] = $category->product_id; // Mark this ID as seen
    ?>
                <option value="<?php echo $category->product_id ?? 'N/A'; ?>"  
                    data-pieces="<?php echo htmlspecialchars($category->pieces_pp ?? 'Unknown'); ?>"
                    data-hsn="<?php echo htmlspecialchars($category->hsn_code ?? ''); ?>"
                    data-p_per_p="<?php echo htmlspecialchars($category->pieces_pp ?? ''); ?>"
                    data-pkt_avl="<?php echo htmlspecialchars($category->qty_in_packet ?? ''); ?>"
                    data-dzn_avl="<?php echo htmlspecialchars($category->qty_in_dozens ?? ''); ?>"
                    data-wholesale-price="<?php echo htmlspecialchars($category->wholesale_price ?? '0'); ?>"
                    data-retail-price="<?php echo htmlspecialchars($category->retail_price ?? '0'); ?>">
                    <?php echo htmlspecialchars($category->product_name ?? 'Unknown'); ?>
                </option>
    <?php 
            endif; 
        endforeach; 
    else: 
    ?>    
        <option value="">No product name available</option>
    <?php endif; ?>
</select>


            </div>
        </div>
           <!-- HSN Code -->
    <div class="col-sm-1">
        <div class="form-group">
            <label class="col-form-label">HSN Code</label>
            <input type="text" name="s_hsn_code[]" id="hsn_code" class="form-control" placeholder="HSN Code" readonly>
        </div>
    </div>  
        <!-- Pieces/Packets -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Pieces/Packet</label>
                <input type="text" name="s_pieces_pkt[]" id="p_per_p" class="form-control" value="0" placeholder="" readonly>
            </div>
        </div>
        
        <!-- Packet Avl -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Packet Avl</label>
                <input type="text" name="s_pkt_avl[]" id="pkt_avl" class="form-control" value="0" placeholder="" readonly>
            </div>
        </div>
        
        <!-- Dozens Avl -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Dozen Avl</label>
                <input type="text" name="s_dzn_avl[]" id="dzn_avl" class="form-control" value="0" readonly>
            </div>
        </div>
        
        <!-- Dozens -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Dozens</label>
               <input type="number" name="s_dozens[]" id="dozens" class="form-control" value="0" placeholder="Enter" min="1">
            </div>
        </div>

          <!-- Net Qty -->
          <div class="col-sm-1">
              <div class="form-group">
                  <label class="col-form-label">Net Qty</label>
                  <input type="text" name="s_net_qty[]" id="net_qty" class="form-control" value="0" readonly>
              </div>
          </div>
        
          <!-- Price/Dozens -->
          <div class="col-sm-1">
              <div class="form-group">
                  <label class="col-form-label">Price/Dozens</label>
                  <input type="text" name="s_price_dzn[]" id="price_field" class="form-control" value="0">
              </div>
          </div>
                  
        <!-- Price/Packets -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Price/Packets</label>
                <input type="text" name="s_price_pkt[]" id="price_per_pkt" class="form-control" value="0" readonly>
            </div>
        </div>

        <!-- Gross Amt -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Gross Amt</label>
                <input type="text" name="s_gross_amt[]" class="form-control gross-amt" value="0" readonly>
            </div>
        </div>
        
        <!-- SGST% -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">SGST%</label>
              <input type="text" name="s_sgst[]" class="form-control sgst" placeholder="Enter SGST%" autocomplete="off">
            </div>
        </div>
        
        <!-- CGST% -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">CGST%</label>
                <input type="text" name="s_cgst[]" class="form-control cgst" placeholder="Enter CGST%" autocomplete="off">
            </div>
        </div>
        
        <!-- GST Amt -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col -form-label">GST Amt</label>
               <input type="text" name="s_gst_amt[]" class="form-control gst-amt" value="0" readonly>
            </div>
        </div>
        
        <!-- Line Total -->
        <div class="col-sm-1">
            <div class="form-group">
                <label class="col-form-label">Line Total</label>
                <input type="text" name="s_line_total[]" class="form-control line-total" value="0" readonly>
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
                    <select type="text" name="s_supplier_id" id="" class="form-control" placeholder="Enter ...">
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
                <select name="s_payment_mode" class="form-control">
                  <option value="" disabled selected>Select Payment Mode</option>
                  <option value="cash">Cash</option>
                  <option value="upi">UPI</option>
                   <option value="credit_bank">credit_bank</option>
                </select>
              </div>
            </div>
  
        </div>
        <div class="row">
            <!-- Total Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Total Amt</label>
                    <input type="text" name="s_total_amt" id="total_amt" class="form-control total-amt" value="0" readonly>
                </div>
            </div>
            <!-- Cash Discount% -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Cash Discount%</label>
                    <input type="number" name="s_cash_discount" id="cash_discount" class="form-control" placeholder="Enter Discount %" oninput="calculatePayable()">
                </div>
            </div>
            <!-- Payable Mode -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Payable Amt</label>
                    <input type="text" name="s_payable_amt" id="payable_mode" class="form-control" placeholder="Payable Amount" readonly>
                </div>
            </div>
            <!-- Paid Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Paid Amt</label>
                    <input type="text" name="s_paid_amt" id="paid_amt" class="form-control" placeholder="Enter ..." autocomplete="off">
                </div>
            </div>
            <!-- Balance Amt -->
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="col-form-label">Balance Amt</label>
                    <input type="text" name="s_balance_amt" id="balance_amt" class="form-control" placeholder="Enter ..." readonly>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
    <button type="submit" style="background-color: #F5DEB3; border-color: #F5DEB3; color: black;" 
            class="btn btn-primary addBrand-save"><strong>Confirm Order</strong></button>
    <button type="reset" style="background-color: #F5DEB3; border-color: #F5DEB3; color: black;" 
            class="btn btn-secondary addBrand-save"><strong>Cancel</strong></button>
     </div>

    </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
             <div class="card-header" style="background-color: #F5DEB3; border-color: #F5DEB3;">
              <h3 class="card-title"><strong>Sales & Billing Data From</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
     <thead>
                  <tr>
                    <th>Sl.No</th>
                    <!-- <th>Product Name</th> -->
                    <th>Bill No</th>
               <!--      <th>HSN Code</th>
                    <th>Pcs/Pkt</th>
                    <th>Pkt Avl</th>
                    <th>Dzn Avl</th>
                    <th>Num of Dzn</th>
                    <th>Price/Dzn</th>
                    <th>Price/Pkt</th>
                    <th>Gross Amt</th>
                    <th>GST Amt</th>
                    <th>Line Total</th> -->
                    <th>Bill Date</th>
                    <th>Line Total</th>
                    <th>Cash Discount</th>
                    <th>Supplier</th>
                    <th>Payable Amt</th>
                    <th>Paid Amt</th>
                    <th>Balance Amt</th>
                    <th>Print Detail</th>
                  </tr>
                </thead>
           <tbody>
    <?php if ($getsales !== null && $getsales->num_rows() > 0): ?>
        <?php $i = 1; ?>
        <?php foreach ($getsales->result() as $r): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $r->bill_no; ?></td>
                <td><?php echo $r->bill_date; ?></td>
                <td><?php echo $r->s_line_total; ?></td>
                <td><?php echo $r->s_cash_discount; ?></td>
                <td><?php echo $r->supp_name; ?></td>
                <td><?php echo $r->s_payable_amt; ?></td>
                <td><?php echo $r->s_paid_amt; ?></td>
                <td><?php echo $r->s_balance_amt; ?></td>
                <td>
                  <!--   <a class="btn btn-sm btn-warning" 
                       onclick="setDeleteFunction('<?php echo $r->id; ?>')" 
                       style="color: Black">Remove</a> -->
                    <a class="fas fa-file-invoice" 
                       href="<?php echo base_url('welcome/print_SalesInvoice/' . $r->bill_no); ?>" 
                       style="font-size: 18px; color: blue;" 
                       title="Print Sales Invoice"></a>
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
                    <p>Are you sure you want to delete this Supplier deatails?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteSales')?>">
                        <input type="hidden" name="dlt_id" id="dlt_id">
                        <button type="button" style="color: SteelBlue" class="btn btn-light" data-dismiss="modal">No</button>
                        <button type="submit" style="color: RosyBrown" class="btn btn-light">Yes Delete</button>
                    </form>
                </div>
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
    const topButton = document.getElementById('topButton');
    let isWholesale = true; // Track the current mode

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

   function updateProductDetails(row, selectedOption) {
    const hsnCodeField = row.querySelector('#hsn_code');
    const pPerPField = row.querySelector('#p_per_p');
    const pktAvlField = row.querySelector('#pkt_avl');
    const dznAvlField = row.querySelector('#dzn_avl');
    const priceField = row.querySelector('#price_field');
    const grossAmtField = row.querySelector('.gross-amt');
    const linetotalAmtField = row.querySelector('.line-total');

    if (selectedOption.value) {
        hsnCodeField.value = selectedOption.getAttribute('data-hsn') || '';
        pPerPField.value = selectedOption.getAttribute('data-p_per_p') || '';
        pktAvlField.value = selectedOption.getAttribute('data-pkt_avl') || '';
        dznAvlField.value = selectedOption.getAttribute('data-dzn_avl') || '';
        priceField.value = selectedOption.getAttribute(isWholesale ? 'data-wholesale-price' : 'data-retail-price') || '0';

        // Update gross and line total fields
        grossAmtField.value = parseFloat(priceField.value).toFixed(1) || '0.0';
        linetotalAmtField.value = parseFloat(priceField.value).toFixed(1) || '0.0';
    } else {
        clearFields(row);
    }

    // Trigger total and payable updates
    updateTotalAmount();
    calculatePayable();
}


    // Function to clear the fields when no product is selected
    function clearFields(row) {
        row.querySelector('#hsn_code').value = '0';
        row.querySelector('#p_per_p').value = '0';
        row.querySelector('#pkt_avl').value = '0';
        row.querySelector('#dzn_avl').value = '0';
        row.querySelector('#price_field').value = '0';
        row.querySelector('#price_per_pkt').value = '0'; 
        row.querySelector('.gross-amt').value = '0';
        row.querySelector('.sgst').value = '';
        row.querySelector('.cgst').value = '';
        row.querySelector('.gst-amt').value = '0';
        row.querySelector('.line-total').value = '0';// Clear price/packets field
    }

    // Function to calculate Price/Packets based on a fixed net quantity and price field
    function calculatePricePerPackets(row) {
        const netQty = 12; // Fixed net quantity
        const priceField = parseFloat(row.querySelector('#price_field').value) || 0;

        if (netQty > 0) {
            const pricePerPkt = (priceField / netQty).toFixed(1); // Divide price_field by fixed net_qty
            row.querySelector('#price_per_pkt').value = pricePerPkt; // Update the Price/Packets input field
        } else {
            row.querySelector('#price_per_pkt').value = '0';
        }
    }

    // Function to handle product change event for all rows
    function handleProductChange(event) {
        const row = event.target.closest('.supplier-row');
        const selectedOption = event.target.options[event.target.selectedIndex];
        updateProductDetails(row, selectedOption);
        calculatePricePerPackets(row); // Trigger price/packets calculation

        // Set default values for dozens and net qty when a product is selected
        if (selectedOption.value) {
            row.querySelector('#dozens').value = 1; // Default value for dozens
            row.querySelector('#net_qty').value = 12; // Default value for net qty

            // Trigger the event to calculate net qty based on the default dozens value
            row.querySelector('#dozens').dispatchEvent(new Event('input'));

            // Trigger price/packets calculation again
            calculatePricePerPackets(row);
        } else {
            // Clear input fields if no product is selected
            row.querySelector('#dozens').value = 0;
            row.querySelector('#net_qty').value = 0;
            row.querySelector('#price_field').value = '0';
            row.querySelector('#price_per_pkt').value = '0';
        }
    }

    // Function to handle dozens input changes
    function handleDozensInput(row) {
        const dozens = parseInt(row.querySelector('#dozens').value) || 0; // Get the value of dozens, default to 0 if empty or invalid
        const netQty = dozens * 12; // Calculate Net Qty
        row.querySelector('#net_qty').value = netQty; // Update the Net Qty input field

        // Trigger price/packets calculation
        calculatePricePerPackets(row);
    }

    // Event listener for add and remove row buttons
    addBagForm.addEventListener('click', function (event) {
    if (event.target.classList.contains('add-row')) {
        const parentRow = event.target.closest('.supplier-row');
        const row = parentRow.cloneNode(true);

        // Clear input values in the cloned row
        row.querySelectorAll('input').forEach(input => {
            if (!input.classList.contains('sl-no')) { // Skip SL.No field
                if (input.classList.contains('sgst') || input.classList.contains('cgst')) {
                    // Do not clear SGST or CGST values
                    return;
                } else {
                    // Reset all other inputs to '0'
                    input.value = '0';
                }
            }
        });

        // Append the new row and update serial numbers
        addBagForm.querySelector('.card-body').appendChild(row);
        updateSerialNumbers();

        // Reapply event listener for product selection and dozens input in the new row
        const productSelect = row.querySelector("#product_name");
        productSelect.addEventListener('change', handleProductChange);

        const dozensInput = row.querySelector('#dozens');
        if (dozensInput) {
            dozensInput.addEventListener('input', function () {
                handleDozensInput(row);
                calculateRow(row);
                updateTotalAmount();  // Recalculate gross-amt and line-total based on dozens input change
            });
        }
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

     // Event listener for when a product is selected in any row
     document.querySelectorAll("#product_name").forEach(productSelect => {
     productSelect.addEventListener('change', handleProductChange);
     });

    // Event listener for when dozens input changes
    document.querySelectorAll('#dozens').forEach(dozensInput => {
        dozensInput.addEventListener('input', function () {
            const row = dozensInput.closest('.supplier-row');
            handleDozensInput(row);
            calculateRow(row);
            updateTotalAmount();  // Recalculate gross-amt and line-total based on dozens input change
        });
    });

    // Event listener for wholesale/retail mode toggle
    topButton.addEventListener('click', function () {
        isWholesale = !isWholesale; // Toggle mode
        updateButtonState();
        updatePriceField(); // Update price for all rows
    });

    // Function to update wholesale and retail pricing logic
    function updateButtonState() {
        if (isWholesale) {
            topButton.innerHTML = 'Wholesale Price';
            topButton.className = 'btn btn-primary';
            topButton.style.backgroundColor = 'DarkGoldenRod';
            topButton.style.borderColor = 'DarkGoldenRod';
        } else {
            topButton.innerHTML = 'Retail Price';
            topButton.className = 'btn btn-success';
            topButton.style.backgroundColor = 'DarkOliveGreen';
            topButton.style.borderColor = 'DarkOliveGreen';
        }
    }

    // Function to update the price field based on the mode and selected product
function updatePriceField() {
    const rows = addBagForm.querySelectorAll('.supplier-row');
    rows.forEach(row => {
        const productNameDropdown = row.querySelector('#product_name');
        const selectedOption = productNameDropdown.options[productNameDropdown.selectedIndex];
        const priceValue = isWholesale
            ? selectedOption.getAttribute('data-wholesale-price')
            : selectedOption.getAttribute('data-retail-price');
        row.querySelector('#price_field').value = priceValue || '0';

        // Trigger price/packets calculation after updating the price field
        calculatePricePerPackets(row);

        // Trigger gross-amt and line-total calculation after updating the price field
        calculateRow(row);
        updateTotalAmount();
    });
}

// Add event listener for price field change to auto-generate values
document.addEventListener("DOMContentLoaded", function () {
    const priceFields = document.querySelectorAll('#price_field');
    priceFields.forEach(field => {
        field.addEventListener('input', function () {
            const row = field.closest('.supplier-row');
            calculateRow(row); // Recalculate gross-amt and line-total based on price field change
        });
    });

    // Initialize button state and price field
    updateButtonState();
});

//---------------calculation for grossamt, sgst. cgst, gstamt and line total
// document.addEventListener("DOMContentLoaded", function () {
    function calculateRow(row) {
        const dozens = parseFloat(row.querySelector("#dozens").value) || 0;
        const pricePerDozen = parseFloat(row.querySelector("#price_field").value) || 0;
        const sgstRate = parseFloat(row.querySelector(".sgst").value) || 0;
        const cgstRate = parseFloat(row.querySelector(".cgst").value) || 0;

        // Step 1: Calculate base price (Net Amount)
        const basePrice = dozens * pricePerDozen;

        // Step 2: Calculate total GST percentage and divisor for gross calculation
        const totalGSTPercent = sgstRate + cgstRate;
        const divisor = 1 + totalGSTPercent / 100;

        // Step 3: Calculate Gross Amount
        const grossAmount = basePrice / divisor;

        // Step 4: Calculate GST Amount
        const gstAmount = basePrice - grossAmount;

        // Step 5: Calculate Line Total
        const lineTotal = grossAmount + gstAmount;

        // Update the fields
        row.querySelector(".gross-amt").value = grossAmount.toFixed(1);
        row.querySelector(".gst-amt").value = gstAmount.toFixed(1);
        row.querySelector(".line-total").value = lineTotal.toFixed(1);
    }

   function updateTotalAmount() {
    let totalAmount = 0;

    // Sum all line-total fields
    document.querySelectorAll('.line-total').forEach(field => {
        totalAmount += parseFloat(field.value) || 0;
    });

    // Update the total amount field
    const totalAmtField = document.querySelector('#total_amt');
    if (totalAmtField) {
        totalAmtField.value = totalAmount.toFixed(2);
    }

    // Ensure the payable amount is updated
    calculatePayable();
}

    // Add event listeners to each row for product selection and calculation
    document.querySelectorAll(".supplier-row").forEach((row) => {
        const productSelect = row.querySelector("#product_name");

        // When product is selected
        productSelect.addEventListener("change", function () {
            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            updateProductDetails(row, selectedProduct); // Assuming this function populates other fields
            calculateRow(row); // Recalculate after updating product details
        });

        // Add input event listeners for calculation
        row.addEventListener("input", () => calculateRow(row));
    });

    // Event listener for changes in fields
    document.addEventListener("input", function (event) {
        if (
            event.target.classList.contains("sgst") || 
            event.target.classList.contains("cgst") || 
            event.target.classList.contains("price_field") || 
            event.target.classList.contains("dozens")
        ) {
            const row = event.target.closest(".row");
            calculateRow(row);
            updateTotalAmount();
        }
    });
});

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


// Add event listeners to each row for product selection and calculation
    document.querySelectorAll(".supplier-row").forEach((row) => {
        const productSelect = row.querySelector("#product_name");

        // When product is selected
        productSelect.addEventListener("change", function () {
            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            updateProductDetails(row, selectedProduct); // Assuming this function populates other fields
            calculateRow(row); // Recalculate after updating product details
        });

        // Add input event listeners for calculation
        row.addEventListener("input", () => calculateRow(row));
    });

    // Event listener for changes in fields related to row calculations
    document.addEventListener("input", function (event) {
        if (
            event.target.classList.contains("sgst") || 
            event.target.classList.contains("cgst") || 
            event.target.classList.contains("price_field") || 
            event.target.classList.contains("dozens")
        ) {
            const row = event.target.closest(".row");
            calculateRow(row);
            updateTotalAmount();
        }
    });

    // Event listener for cash discount change to update the payable amount
    document.querySelector("#cash_discount").addEventListener("input", calculatePayable);
   
   // Event listener to calculate balance amount
document.addEventListener("input", function(event) {
    if (event.target.id === "paid_amt") {
        // Get the payable amount and paid amount
        const payableAmt = parseFloat(document.getElementById("payable_mode").value) || 0;
        const paidAmt = parseFloat(event.target.value) || 0;

        // Calculate the balance amount
        const balanceAmt = payableAmt - paidAmt;

        // Update the balance amount field
        const balanceAmtField = document.querySelector('[id="balance_amt"]');
        if (balanceAmtField) {
            balanceAmtField.value = balanceAmt.toFixed(1);
        }

        // Debugging: log the results
        console.log('Payable Amount:', payableAmt);
        console.log('Paid Amount:', paidAmt);
        console.log('Balance Amount:', balanceAmt);
    }

     updateProductDetails(row, selectedOption);
});

//----------------- Validation function
  function validateForm() {
    let isValid = true;

    // Get all form inputs
    const productName = document.querySelector('[name="product_name_id"]');
    const billDate = document.getElementById('bill_date');
    const supplierId = document.querySelector('[name="s_supplier_id"]');
    const paymentMode = document.querySelector('[name="s_payment_mode"]');
    const paidAmt = document.getElementById('paid_amt');
    const cgsts = document.querySelectorAll('.cgst');
    const sgsts = document.querySelectorAll('.sgst');

    // Clear previous error messages
    const errorMessages = document.querySelectorAll('.error-msg');
    errorMessages.forEach((error) => error.remove());

    // Helper to track first invalid field
    let firstInvalidField = null;

    // Validate Product Name
    if (productName.value === "") {
        isValid = false;
        showError(productName, "Product Name is required");
        if (!firstInvalidField) firstInvalidField = productName;
    }

    // Validate Bill Date
    if (billDate.value === "") {
        isValid = false;
        showError(billDate, "Bill Date is required");
        if (!firstInvalidField) firstInvalidField = billDate;
    }

    // Validate Supplier Selection
    if (supplierId.value === "") {
        isValid = false;
        showError(supplierId, "Supplier is required");
        if (!firstInvalidField) firstInvalidField = supplierId;
    }

    // Validate Payment Mode
    if (paymentMode.value === "") {
        isValid = false;
        showError(paymentMode, "Payment Mode is required");
        if (!firstInvalidField) firstInvalidField = paymentMode;
    }

    // Validate Paid Amount
    if (paidAmt.value === "") {
        isValid = false;
        showError(paidAmt, "Paid Amount is required");
        if (!firstInvalidField) firstInvalidField = paidAmt;
    } else if (isNaN(paidAmt.value) || parseFloat(paidAmt.value) <= 0) {
        isValid = false;
        showError(paidAmt, "Paid Amount must be a valid positive number");
        if (!firstInvalidField) firstInvalidField = paidAmt;
    }

    // Validate CGST
    cgsts.forEach((cgst) => {
        if (isNaN(cgst.value) || parseFloat(cgst.value) < 0 || parseFloat(cgst.value) > 100) {
            isValid = false;
            showError(cgst, "CGST must be a valid percentage between 0 and 100");
            if (!firstInvalidField) firstInvalidField = cgst;
        }
    });

    // Validate SGST
    sgsts.forEach((sgst) => {
        if (isNaN(sgst.value) || parseFloat(sgst.value) < 0 || parseFloat(sgst.value) > 100) {
            isValid = false;
            showError(sgst, "SGST must be a valid percentage between 0 and 100");
            if (!firstInvalidField) firstInvalidField = sgst;
        }
    });

    // Focus on the first invalid field
    if (firstInvalidField) firstInvalidField.focus();

    return isValid;
}

// Function to show error message below input field
function showError(inputElement, message) {
    const errorDiv = document.createElement('div');
    errorDiv.classList.add('error-msg');
    errorDiv.style.color = 'Brown';
    errorDiv.style.fontSize = '12px';
    errorDiv.innerText = message;

    // Ensure error is added after the parent of the field for better UI
    inputElement.parentNode.appendChild(errorDiv);
}

// Bind form submit
document.getElementById('addBag').onsubmit = function (event) {
    if (!validateForm()) {
        event.preventDefault(); // Prevent form submission
    }
};
</script>

<script>
    // Set today's date as the default value in the input field
    document.addEventListener("DOMContentLoaded", function () {
        const billDateField = document.getElementById("bill_date");
        const today = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD
        billDateField.value = today;
    });
</script>

   