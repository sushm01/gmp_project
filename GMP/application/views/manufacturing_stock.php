 
<?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
<?php } ?>

<?php if ($this->session->flashdata('info')): ?>
    <div id="successMessage" class="alert alert-info">
        <?php echo $this->session->flashdata('info'); ?>
    </div>
<?php endif; ?>

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
            <h1>Producation Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Producation Details</li>
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
          <div class="card-header" style="background-color: #E6E6FA; border-color: #E6E6FA;">
            <h3 class="card-title"><strong>Manufactural Form</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form method="post" id="addBag" action="<?=base_url('welcome/insertMfd_stock')?>">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" placeholder="Enter ..." autocomplete="off">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group inline-block">
                    <label class="col-form-label">HSN Code</label>
                    <input type="text" name="hsn_code" class="form-control" placeholder="Enter ..." autocomplete="off">
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group inline-block">
                  <label class="col-form-label">Pieces Per Packets</label>
<select name="pieces_packet" id="pieces_pp" class="form-control" placeholder="Enter ...">
    <option value="">Select Pieces Per Packets</option>
    <?php if ($getPieces->num_rows() > 0): ?>
        <?php foreach ($getPieces->result() as $category): ?>
            <option value="<?php echo $category->id; ?>" data-pieces="<?php echo $category->pieces_pp; ?>">
                <?php echo $category->pieces_pp; ?>
            </option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">No pieces_pp available</option>
    <?php endif; ?>
</select>
                  </div>
                </div>
                <div class="col-sm-3">
                <div class="form-group inline-block">
    <label class="col-form-label">Quantity in Kg</label>
    <input type="number" name="qty_in_kg" id="quantity_kg" class="form-control" placeholder="Enter ..." value="1" min="1">
</div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group inline-block">
    <label class="col-form-label">Qty (in pieces)</label>
     <input type="text" name="qty_in_pieces" id="qty_in_pieces" class="form-control" placeholder="Enter ..." readonly>
</div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Qty (in packets)</label>
                     <input type="text" name="qty_in_packet" id="qty_in_packets" class="form-control" placeholder="Enter ..." autocomplete="off" readonly>
                  </div>
                </div>
                <div class="col-sm-4">
                 <div class="form-group inline-block">
    <label class="col-form-label">Qty (in dozens)</label>
    <input type="text" name="qty_in_dozens" id="qty_in_dozens" class="form-control" placeholder="Enter ..." autocomplete="off" readonly>
</div>

                </div>
                <div class="">
                  <span style="font-size: 1.5em;">&#x2192;</span> <!-- Arrow mark -->
                  <h6 style="display: inline; margin-left: 5px;"><strong>Materials Used</strong></h6>
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
                    <!-- New Rows -->
                     <div class="row">
                    <div class="col-sm-4">
    <div class="form-group">
    <label class="col-form-label">Material</label>
    <select name="raw_materials[]" id="raw_materials" class="form-control rawMaterialSelect" required>
        <option value="">Select Raw</option>
        <?php if (!empty($getRaw)): ?>
            <?php foreach ($getRaw as $category): ?>
                <option value="<?php echo $category->material_id; ?>">
                    <?php echo htmlspecialchars($category->raw_materials); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No materials available</option>
        <?php endif; ?>
    </select>
</div>
</div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label class="col-form-label">Quantity</label>
                          <input type="text" name="quantity[]" class="form-control" placeholder="Enter quantity..." autocomplete="off">
                        </div>
                      </div>
                     <div class="col-sm-4">
    <div class="form-group">
        <label class="col-form-label">Units</label>
        <select name="units[]" id="units" class="form-control" required>
            <option value="">Select Unit</option>
            <?php if (!empty($getRaw)): ?>
                <?php foreach ($getRaw as $category): ?>
                    <option value="<?php echo $category->units; ?>">
                        <?php echo htmlspecialchars($category->units); ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No units available</option>
            <?php endif; ?>
        </select>
    </div>
</div>
                    </div>
                  </div>
        
<div class="row">
       <div class="col-sm-2">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter ...">
                  </div>
                </div>
  <div class="col-sm-3">
    <div class="form-group inline-block">
      <label class="col-form-label">Wholesale Unit Price (dozen)</label>
      <input type="text" name="wholesale_price" class="form-control" placeholder="Enter material..." autocomplete="off">
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group inline-block">
      <label class="col-form-label">Retail Unit Price (dozen)</label>
      <input type="text" name="retail_price" class="form-control" placeholder="Enter quantity..." autocomplete="off">
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group inline-block">
      <label class="col-form-label">SGST%</label>
      <input type="text" name="sgst" id="sgst" class="form-control sgst" placeholder="Enter price..." autocomplete="off">
    </div>
  </div>
  <div class="col-sm-3 d-flex align-items-end justify-content-between">
    <div class="form-group inline-block" style="width: 70%;">
      <label class="col-form-label">CGST%</label>
      <input type="text" name="cgst" id="cgst" class="form-control cgst" placeholder="Enter price..." autocomplete="off">
    </div>
    <!-- Save Details Button -->
    <button type="submit" style="background-color: #E6E6FA; border-color: #E6E6FA; width: 28%; color: black;" 
        class="btn btn-primary addBrand-save"><strong>Save Details</strong></button>

  </div>
</div>

          </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
       <div class="card-header" style="background-color: #E6E6FA; border-color: #E6E6FA;">
              <h3 class="card-title"><strong>Manufactural Data From</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Product Name</th>
                    <th>HSN</th>
                    <th>Date</th>
                    <th>Quantity(in dozens)</th>
                    <th>Pieces Per Packets</th>
                    <th>Materials</th>
                    <th>Quantity</th>
                    <th>Units</th>
                    <th>Wholesale Price</th>
                    <th>Retail Price</th>
                    <th>CGST%</th>
                    <th>SGST%</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                 <tbody>
    <?php if ($getStocks !== null): ?>
        <?php $i = 1; ?>
        <?php foreach ($getStocks as $stock): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $stock->product_name; ?></td>
                <td><?php echo $stock->hsn_code; ?></td>
                <td><?php echo $stock->date; ?></td>
                <td><?php echo $stock->qty_in_dozens; ?></td>
                <td><?php echo $stock->pieces_pp; ?></td>
                <td><?php echo $stock->raw_materials; ?></td> <!-- Displaying the material name -->
                <td><?php echo $stock->quantity; ?></td>
                <td><?php echo $stock->units; ?></td>
                <td><?php echo $stock->wholesale_price; ?></td>
                <td><?php echo $stock->retail_price; ?></td>
                <td><?php echo $stock->sgst; ?></td>
                <td><?php echo $stock->cgst; ?></td>
                <td>
                     <a class="btn btn-sm btn-warning" onclick="setDeleteFunction('<?php echo $stock->stock_id; ?>')" style="color: Black">Remove</a>
                   <!--   <a class="btn btn-sm btn-success" onclick="setEditFunction('<?php echo $stock->stock_id; ?>',
                    '<?php echo htmlspecialchars($stock->product_name, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->hsn_code, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->qty_in_dozens, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->pieces_pp, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->raw_materials, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->quantity, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->units, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->wholesale_price, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->retail_price, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->sgst, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($stock->cgst, ENT_QUOTES); ?>'
                     )" style="color: Black">Update</a> -->
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="12">No stock entries found</td>
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
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteStock')?>">
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
 
//-------------getting stock material and unit from raw stock
    $(document).ready(function() {
    $('#raw_materials').on('change', function() {
        var selectedMaterialId = $(this).val();
        // Fetch corresponding units for the selected material (you may need an AJAX call to the server)
        // For example, you can send the material_id to the controller and get the units dynamically.
    });
});
 
  function setEditFunction(id, product_name, hsn_code, qty_in_dozens, pieces_packet, raw_materials, quantity, units, wholesale_price, retail_price, sgst, cgst) {
    $('#party_id').val(id); 
    $('#pn_id').val(decodeURIComponent(product_name));
    $('#hsn_id').val(hsn_code);
    $('#qty_dzn_id').val(qty_in_dozens);
    $('#pieces_pp').val(pieces_packet);
    $('#raw_materials').val(raw_materials);
    $('#qty_id').val(quantity);
    $('#unit_id').val(units);
    $('#whsl_id').val(wholesale_price);
    $('#retail_id').val(retail_price);
    $('#sgst_id').val(sgst);
    $('#cgst_id').val(cgst);
    $('#editModal').modal('show');
}

    //-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds

  //-----------------------START Delete operation-----------//
    function setDeleteFunction(dlt_id){
       // alert(dlt_id)
      $('#dlt_id').val(dlt_id); 
      $('#deleteModal').modal('show');
    }

  //-------------- add row and remover row
    document.addEventListener('DOMContentLoaded', () => {
        const addBagForm = document.getElementById('addBag');

        addBagForm.addEventListener('click', function (event) {
            if (event.target.classList.contains('add-row')) {
                const parentRow = event.target.closest('.supplier-row');
                const newRow = parentRow.cloneNode(true);

                // Clear input values in the cloned row
                newRow.querySelectorAll('input').forEach(input => input.value = '');

                // Append the new row after the current one
                parentRow.after(newRow);

                // Update all material labels
                updateMaterialLabels();
            }

            if (event.target.classList.contains('remove-row')) {
                const rows = addBagForm.querySelectorAll('.supplier-row');
                if (rows.length > 1) {
                    event.target.closest('.supplier-row').remove();

                    // Update material labels after removing a row
                    updateMaterialLabels();
                } else {
                    alert('At least one row is required.');
                }
            }
        });

  //---------------------------sgst and cgst % converation
//        document.addEventListener("input", function (event) {
//     if (event.target.classList.contains("sgst") || event.target.classList.contains("cgst")) {
//         // Get the value entered by the user
//         let inputValue = parseFloat(event.target.value) || 0;

//         // Convert the value to its decimal equivalent
//         inputValue = inputValue / 100;

//         // Update the input field to display the converted value
//         event.target.value = inputValue.toFixed(2); // Show as decimal with two decimal places
//     }
// });

  //---------------- Function to update material labels dynamically
        function updateMaterialLabels() {
            const rows = addBagForm.querySelectorAll('.supplier-row');
            rows.forEach((row, index) => {
                const label = row.querySelector('label.col-form-label');
                if (label) {
                    label.textContent = `Material ${index + 1}`;
                }
            });
        }
    });

  //---------------------- Ensure the DOM is fully loaded 1 
   document.addEventListener('DOMContentLoaded', function () {
    const piecesDropdown = document.getElementById('pieces_pp');
    const quantityInput = document.getElementById('quantity_kg');

    // Set the default value to 1 and make it read-only
    quantityInput.value = 1;
    quantityInput.readOnly = true;

    // Event listener for dropdown change
    piecesDropdown.addEventListener('change', function () {
        if (piecesDropdown.value !== "") {
            quantityInput.value = 1; // Keep the default value to 1
        }
    });
});


//-----------------------cal for pieces, packets and dozens

document.addEventListener('DOMContentLoaded', function () {
    const piecesPerKg = 840; // Default value for pieces per kg
    const quantityKgInput = document.getElementById('quantity_kg');
    const qtyInPiecesInput = document.getElementById('qty_in_pieces');
    const piecesPerPacketSelect = document.getElementById('pieces_pp');
    const qtyInPacketsInput = document.getElementById('qty_in_packets');
    const qtyInDozensInput = document.getElementById('qty_in_dozens'); // New input field for dozens

    // Function to calculate and update Qty (in pieces)
    function calculatePieces() {
        const quantityKg = parseFloat(quantityKgInput.value) || 0; // Get Quantity in Kg (default to 0 if invalid)
        const qtyInPieces = quantityKg * piecesPerKg; // Calculate Qty in pieces
        qtyInPiecesInput.value = qtyInPieces.toFixed(0); // Update the field (rounded to whole number)
    }

    // Function to calculate and update Qty (in packets and dozens)
    function calculateQtyInPackets() {
        const selectedOption = piecesPerPacketSelect.options[piecesPerPacketSelect.selectedIndex];
        const piecesPerPacket = parseFloat(selectedOption?.dataset.pieces);
        const piecesPerKg = parseFloat(selectedOption?.dataset.piecesPerKg); // Add this data attribute to the option
        const qtyInPieces = parseFloat(qtyInPiecesInput.value);
        const quantityKg = parseFloat(quantityKgInput.value);

        let totalPieces = 0;

        // Calculate total pieces from kg if valid
        if (!isNaN(quantityKg) && !isNaN(piecesPerKg) && piecesPerKg > 0) {
            totalPieces = quantityKg * piecesPerKg;
            qtyInPiecesInput.value = totalPieces.toFixed(0); // Update the qty_in_pieces field
        } else if (!isNaN(qtyInPieces)) {
            totalPieces = qtyInPieces; // Use the direct qty_in_pieces input
        }

        // Calculate qty in packets
        if (!isNaN(piecesPerPacket) && totalPieces > 0) {
            const qtyInPackets = totalPieces / piecesPerPacket;
            qtyInPacketsInput.value = qtyInPackets.toFixed(2); // Rounded to whole number

            // Calculate qty in dozens
            const qtyInDozens = qtyInPackets / 12;
            qtyInDozensInput.value = qtyInDozens.toFixed(2); // Rounded to 2 decimal places
        } else {
            qtyInPacketsInput.value = '';
            qtyInDozensInput.value = '';
        }
    }

    // Initialize calculations on page load
    calculatePieces();
    calculateQtyInPackets();

    // Event listeners for dynamic calculations
    quantityKgInput.addEventListener('input', () => {
        calculatePieces();
        calculateQtyInPackets();
    });

    qtyInPiecesInput.addEventListener('input', calculateQtyInPackets);
    piecesPerPacketSelect.addEventListener('change', calculateQtyInPackets);
});

//--------------------- Validation function
  function validateForm() {
    let isValid = true;

    // Get all form inputs
    const productName = document.querySelector('[name="product_name"]');
    const hsnCode = document.querySelector('[name="hsn_code"]');
    const piecesPacket = document.querySelector('[name="pieces_packet"]');
    const qtyInKg = document.querySelector('[name="qty_in_kg"]');
    const qtyInPieces = document.querySelector('[name="qty_in_pieces"]');
    const qtyInPackets = document.querySelector('[name="qty_in_packet"]');
    const qtyInDozens = document.querySelector('[name="qty_in_dozens"]');
    const wholesalePrice = document.querySelector('[name="wholesale_price"]');
    const retailPrice = document.querySelector('[name="retail_price"]');
    const sgst = document.querySelector('[name="sgst"]');
    const cgst = document.querySelector('[name="cgst"]');
    
    const materialFields = document.querySelectorAll('[name="materials[]"]');
    const quantityFields = document.querySelectorAll('[name="quantity[]"]');
    const unitFields = document.querySelectorAll('[name="units[]"]');
    
    // Clear previous error messages
    const errorMessages = document.querySelectorAll('.error-msg');
    errorMessages.forEach(function(error) {
      error.remove();
    });

    // Validate Product Name (Alphabetic characters and spaces only)
    if (productName.value.trim() === "") {
      isValid = false;
      showError(productName, "Product Name is required");
    } else if (!/^[A-Za-z\s]+$/.test(productName.value)) {  // Regular expression for alphabetic characters and spaces
      isValid = false;
      showError(productName, "Product Name must contain only alphabetic characters and spaces");
    }

    // Validate HSN Code (Numeric only)
    if (hsnCode.value.trim() === "") {
      isValid = false;
      showError(hsnCode, "HSN Code is required");
    } else if (!/^\d+$/.test(hsnCode.value)) {
      isValid = false;
      showError(hsnCode, "HSN Code must be numeric");
    }

    // Validate Pieces Per Packets (Selection required)
    if (piecesPacket.value === "") {
      isValid = false;
      showError(piecesPacket, "Pieces Per Packet is required");
    }

    // Validate Quantity in Kg (Numeric and greater than 0)
    if (qtyInKg.value.trim() === "" || isNaN(qtyInKg.value) || qtyInKg.value <= 0) {
      isValid = false;
      showError(qtyInKg, "Quantity in Kg must be a number greater than 0");
    }

    // Validate Quantity in Pieces, Packets, and Dozens (Numeric)
    const fieldsToValidate = [qtyInPieces, qtyInPackets, qtyInDozens];
    fieldsToValidate.forEach(function(field) {
      if (field.value.trim() === "" || isNaN(field.value)) {
        isValid = false;
        showError(field, `${field.getAttribute('name').replace('_', ' ')} must be numeric`);
      }
    });

    
    // Validate Materials (Alphabetic characters and spaces only)
    materialFields.forEach(function(material, index) {
      if (material.value.trim() === "") {
        isValid = false;
        showError(material, `Material ${index + 1} is required`);
      } else if (!/^[A-Za-z\s]+$/.test(material.value)) {  // Regular expression for alphabetic characters and spaces
        isValid = false;
        showError(material, `Material ${index + 1} must contain only alphabetic characters and spaces`);
      }
    });

   // Validate quantity (numeric values including decimals only)
quantityFields.forEach(function(quantity, index) {
  if (quantity.value.trim() === "") {
    isValid = false;
    showError(quantity, `Quantity ${index + 1} is required`);
  } else if (!/^\d+(\.\d+)?$/.test(quantity.value)) {  // Allow numeric values including decimals
    isValid = false;
    showError(quantity, `Quantity ${index + 1} must contain only numeric values`);
  }
});

    // Validate unit (Alphabetic characters and spaces only)
    unitFields.forEach(function(unit, index) {
      if (unit.value.trim() === "") {
        isValid = false;
        showError(unit, `Unit ${index + 1} is required`);
      } else if (!/^[A-Za-z\s]+$/.test(unit.value)) {  // Regular expression for alphabetic characters and spaces
        isValid = false;
        showError(unit, `Unit ${index + 1} must contain only alphabetic characters and spaces`);
      }
    });

  
    // Validate Wholesale and Retail Price (Numeric and greater than 0)
    if (wholesalePrice.value.trim() === "" || isNaN(wholesalePrice.value) || wholesalePrice.value <= 0) {
      isValid = false;
      showError(wholesalePrice, "Wholesale Unit Price must be a number greater than 0");
    }
    if (retailPrice.value.trim() === "" || isNaN(retailPrice.value) || retailPrice.value <= 0) {
      isValid = false;
      showError(retailPrice, "Retail Unit Price must be a number greater than 0");
    }

    // Validate SGST and CGST (Numeric percentage)
    if (sgst.value.trim() === "" || isNaN(sgst.value) || sgst.value < 0) {
      isValid = false;
      showError(sgst, "SGST must be a valid percentage");
    }
    if (cgst.value.trim() === "" || isNaN(cgst.value) || cgst.value < 0) {
      isValid = false;
      showError(cgst, "CGST must be a valid percentage");
    }

    // Return validation result
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
</script>

<script>
    // Set today's date as the default value in the input field
    document.addEventListener("DOMContentLoaded", function () {
        const billDateField = document.getElementById("date");
        const today = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD
        billDateField.value = today;
    });
</script>


