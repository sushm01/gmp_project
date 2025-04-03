
 <?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php } ?>
<style>
    .rectangular-input {
    border-radius: 50; /* Remove rounded corners */
    height: 100px; /* Adjust height */
    width: 130%; /* Adjust width as needed */
    box-shadow: none; /* Optional: remove shadow for a cleaner look */
}

.custom-outline {
  border: 2px solid #F5DEB3; /* Adds the outline color */
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Cash Entry Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Sales Cash Entry Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Left column: Form -->
      <div class="col-md-6">
        <!-- General form elements -->
        <div class="card card-warning">
          <div class="card-header" style="background-color: #F5DEB3; border-color: #F5DEB3;">
            <h3 class="card-title"><strong>Sales Cash Entry Form</strong></h3>
          </div>
          <!-- /.card-header -->
          <form method="post" id="addBag" action="<?=base_url('welcome/insertSalesCashEntry')?>">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Bill No</label>
                    <input type="text" name="bill_no" class="form-control" placeholder="Enter Bill No" autocomplete="off">
                  </div>
                </div>
              <!--   <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Product Name</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter">
                  </div>
                </div> -->
              <!--   <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Product Name</label>
                    <select name="product_name" id="product_name" class="form-control" placeholder="Enter ...">
                      <option value="">Select Product Name</option>
                      <?php if (!empty($getPN)): ?>
                        <?php foreach ($getPN as $category): ?>
                          <option value="<?php echo $category->id; ?>" data-pieces="<?php echo $category->product_name; ?>">
                            <?php echo $category->product_name; ?>
                          </option>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <option value="">No product_name available</option>
                      <?php endif; ?>
                    </select>
                  </div>
                </div> -->
                <div class="col-sm-4">
    <div class="form-group inline-block">
        <label class="col-form-label">Amount</label>
        <input type="text" name="amount" class="form-control" placeholder="Enter Amount..." autocomplete="off" readonly>
        <input type="hidden" name="original_balance" id="original_balance" value="">
        <input type="hidden" name="updated_balance" id="updated_balance" value="">
    </div>
</div>

 <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Supplier Name</label>
                    <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Enter" autocomplete="off" readonly>
                  </div>
                </div>
              <!--   <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Select Supplier</label>
                    <select type="text" name="supplier_name" class="form-control unitSelect" placeholder="Enter ...">
                      <option value="">Select Supplier Name</option>
                      <?php if ($getSupplier->num_rows() > 0): ?>
                        <?php foreach ($getSupplier->result() as $category): ?>
                          <option value="<?php echo $category->supp_name; ?>">
                            <?php echo $category->supp_name; ?>
                          </option>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <option value="">No Supplier available</option>
                      <?php endif; ?>
                    </select>
                  </div>
                </div> -->
                <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Payment Mode</label>
                    <select name="payment_mode" class="form-control">
                      <option value="" disabled selected>Select Payment Mode</option>
                      <option value="cash">Cash</option>
                      <option value="upi">UPI</option>
                      <option value="credit_bank">Bank</option>
                      <option value="credit_bank">Credit Card</option>  
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Date & Time</label>
                    <input type="date" name="date_time" id="date_time" class="form-control" placeholder="Enter ...">
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" style="background-color: #F5DEB3; border-color: #F5DEB3; color: black;" class="btn btn-primary addBrand-save"><strong>Submit</strong></button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div> 

      <!-- Right column: Table -->
      <div class="col-md-6">
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card card-outline custom-outline">
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <!-- <th>Product Name</th> -->
                          <th>Bill No</th>
                          <th>Balance Amt</th>
                          <th>Supplier</th>
                          <th>Payment Mode</th>
                          <th>Date$Time</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
    <?php if ($getSaleCash !== null && $getSaleCash->num_rows() > 0): ?>
        <?php $i = 1; ?>
        <?php foreach ($getSaleCash->result() as $r): ?>
            <tr>
                <!-- <td><?php echo $i ?></td> -->
                <!-- <td><?php echo $r->product_name ?></td> -->
                <td><?php echo $r->bill_no ?></td>
                <td><?php echo $r->amount ?></td>
                <td><?php echo $r->supplier_name ?></td>
                <td><?php echo $r->payment_mode ?></td>
                <td><?php echo $r->date_time ?></td>
                <td>
              <a class="btn btn-sm btn-warning" 
                       onclick="setDeleteFunction('<?php echo $r->id; ?>')" 
                       style="color: Black">Remove</a> 
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">No records found</td>
        </tr>
    <?php endif; ?> 
</tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

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
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteSalesCash')?>">
                        <input type="hidden" name="dlt_id" id="dlt_id">
                        <button type="button" style="color: SteelBlue" class="btn btn-light" data-dismiss="modal">No</button>
                        <button type="submit" style="color: RosyBrown" class="btn btn-light">Yes Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 


<script>

  function moveToNextOrPreviousField(event, direction) {
    if (event.key === "ArrowRight" || event.key === "ArrowLeft") {
        event.preventDefault();

        // Limit focus to fields within the form
        let form = document.getElementById("addBag");
        let fields = Array.from(form.querySelectorAll('input:not([type="hidden"]), select')); // Exclude hidden fields
        let currentIndex = fields.indexOf(document.activeElement);

        if (currentIndex === -1) return; // If no active element, do nothing

        // Move to the next or previous field based on the direction
        let newIndex = direction === "next" ? currentIndex + 1 : currentIndex - 1;

        // Ensure the new index is within bounds
        if (newIndex >= 0 && newIndex < fields.length) {
            fields[newIndex].focus(); // Focus the next or previous field
        }
    }
}

// Event delegation for better performance
document.getElementById("addBag").addEventListener("keydown", (event) => {
    if (event.target.tagName === "INPUT" || event.target.tagName === "SELECT") {
        if (event.key === "ArrowRight") {
            moveToNextOrPreviousField(event, "next");
        } else if (event.key === "ArrowLeft") {
            moveToNextOrPreviousField(event, "previous");
        }
    }
});

   //-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds
  
  //-----------------------START Delete operation-----------------------------------------//
    function setDeleteFunction(dlt_id){
       // alert(dlt_id)
      $('#dlt_id').val(dlt_id); 
      $('#deleteModal').modal('show');
    }

 /// Handle Invoice No Input (auto-fill supplier and balance)
document.querySelector('input[name="bill_no"]').addEventListener('input', function () {
    const invoiceNo = this.value.trim();
    const balanceField = document.querySelector('input[name="amount"]'); // User-entered amount field
    const supplierField = document.querySelector('input[name="supplier_name"]');
    const originalBalanceField = document.getElementById('original_balance'); // Hidden field for original balance
    const updatedBalanceField = document.querySelector('input[name="updated_balance"]'); // Field for updated balance

    if (invoiceNo !== '') {
        fetch('<?= base_url("welcome/salesPaidAmount") ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'bill_no=' + encodeURIComponent(invoiceNo)
        })
        .then(response => response.json())
        .then(data => {
            if (data && !data.error) {
                // Display supplier name
                supplierField.value = data.supp_name || '';

                // Check if no entries exist for this bill number (s_balance_amt = 0)
                if (data.s_balance_amt === null || data.s_balance_amt === 0) {
                    balanceField.value = ''; // Leave amount blank if no previous entries
                    originalBalanceField.value = '';
                    updatedBalanceField.value = '';
                } else {
                    // Set the original balance in a hidden field
                    const serverBalance = parseFloat(data.s_balance_amt || '0');
                    originalBalanceField.value = serverBalance.toFixed(2); // Set hidden field
                    updatedBalanceField.value = serverBalance.toFixed(2); // Update display balance

                    // Auto-fill the amount field with the calculated amount
                    balanceField.value = serverBalance.toFixed(2);
                }
            } else {
                console.error('Error fetching data:', data.error || 'Unknown error');
                // Reset fields when no valid data is found (invalid bill_no)
                supplierField.value = '00';
                originalBalanceField.value = '00';
                updatedBalanceField.value = '00';
                balanceField.value = '00'; // Clear amount if bill_no is invalid
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            // Reset fields in case of fetch error
            supplierField.value = '';
            originalBalanceField.value = '';
            updatedBalanceField.value = '';
            balanceField.value = ''; // Clear amount on error
        });
    } else {
        // Reset fields if bill_no is empty
        supplierField.value = '';
        originalBalanceField.value = '';
        balanceField.value = '';
        updatedBalanceField.value = '';
    }
});

// Handle Amount Input (Calculate remaining balance)
document.querySelector('input[name="amount"]').addEventListener('input', function () {
    const originalBalance = parseFloat(document.getElementById('original_balance').value || '0');
    const enteredAmount = parseFloat(this.value || '0');
    const updatedBalance = originalBalance - enteredAmount;

    document.querySelector('input[name="updated_balance"]').value = updatedBalance.toFixed(2);

    // if (updatedBalance < 0) {
    //     alert("Entered amount exceeds the available balance!");
    // }
});

//----------------
function validateForm() {
    let isValid = true;

    // Get all form inputs
    const productName = document.getElementById('product_name');
    const billNo = document.querySelector('[name="bill_no"]');
    const balanceAmt = document.querySelector('[name="amount"]'); // Read-only, no validation needed
    const supplierName = document.querySelector('[name="supplier_name"]');
    const paymentMode = document.querySelector('[name="payment_mode"]');
    const dateTime = document.querySelector('[name="date_time"]');

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

    // Validate Bill No
    if (billNo.value.trim() === "") {
        isValid = false;
        showError(billNo, "Bill No is required");
        if (!firstInvalidField) firstInvalidField = billNo;
    }

    // Validate Supplier Selection
    if (supplierName.value === "") {
        isValid = false;
        showError(supplierName, "Supplier Name is required");
        if (!firstInvalidField) firstInvalidField = supplierName;
    }

    // Validate Payment Mode
    if (paymentMode.value === "") {
        isValid = false;
        showError(paymentMode, "Payment Mode is required");
        if (!firstInvalidField) firstInvalidField = paymentMode;
    }

    // Validate Date & Time
    if (dateTime.value === "") {
        isValid = false;
        showError(dateTime, "Date & Time is required");
        if (!firstInvalidField) firstInvalidField = dateTime;
    }

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
        const billDateField = document.getElementById("date_time");
        const today = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD
        billDateField.value = today;
    });
</script>

