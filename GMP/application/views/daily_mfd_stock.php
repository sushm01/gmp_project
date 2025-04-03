
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
            <h1>Daily Manufactural</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daily Stock</li>
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
            <h3 class="card-title"><strong>Daily Manufactural Form</strong></h3>
            </div>
            <!-- /.card-header -->
   <form method="post" id="addBag" action="<?=base_url('welcome/insertDailyStock')?>">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Product Name</label>
                    <select name="product_name_id" id="product_name" class="form-control" placeholder="Enter ...">
    <option value="">Select Product Name</option>
    <?php if (!empty($getPN)): ?>
        <?php 
        // Initialize an array to store unique product names
        $uniqueProductNames = [];
        
        foreach ($getPN as $category): 
            // Check if the product name is not already in the array
            if (!in_array($category->product_name, $uniqueProductNames)):
                $uniqueProductNames[] = $category->product_name; // Add the product name to the array
        ?>
                <option value="<?php echo $category->id; ?>" data-pieces="<?php echo $category->product_name; ?>">
                    <?php echo $category->product_name; ?>
                </option>
        <?php 
            endif;
        endforeach; 
        ?>
    <?php else: ?>
        <option value="">No product_name available</option>
    <?php endif; ?>
</select>


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
                     <div class="col-sm-2">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter ...">
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
                    <input type="text" name="qty_in_packet" id="qty_in_packets" class="form-control" placeholder="Enter ..." readonly>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group inline-block">
                    <label class="col-form-label">Qty (in dozens)</label>
                    <input type="text" name="qty_in_dozens" id="qty_in_dozens" class="form-control" placeholder="Enter ..." readonly>
                  </div>
                </div>                          
                <div class="col-sm-3 d-flex align-items-end justify-content-between">
                  <!-- Save Details Button -->
                  <button type="submit" style="background-color: #E6E6FA; border-color: #E6E6FA; width: 28%; color: black;" class="btn btn-primary addBrand-save"><strong>Save Details</strong></button>

                </div>
              </div>
            </div>
          </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
             <div class="card-header" style="background-color: #E6E6FA; border-color: #E6E6FA;">
              <h3 class="card-title"><strong>Daily Manufactural Data From</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                      <tr>
                        <th>Sl.No</th>
                        <th>Product Name</th>
                        <th>Dates</th>
                        <th>Pieces Per Packets</th>
                        <th>Quantity(in kg)</th>
                        <th>Quantity(in pieces)</th>
                        <th>Quantity(in packets)</th>
                        <th>Quantity(in dozens)</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                   <tbody>
    <?php if (!empty($getdailyStocks)): ?>
        <?php $i = 1; ?>
        <?php foreach ($getdailyStocks as $stock): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($stock->product_name); ?></td>
                <td><?php echo htmlspecialchars($stock->date); ?></td>
                <td><?php echo htmlspecialchars($stock->pieces_pp); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_kg); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_pieces); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_packet); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_dozens); ?></td>
                <td>
                     <a class="btn btn-sm btn-warning" onclick="setDeleteFunction('<?php echo $stock->dailystock_id; ?>')" style="color: Black">Remove</a>
                    <!-- <a class="fas fa-trash-alt" onclick="setDeleteFunction('<?php echo $stock->dailystock_id; ?>')" style="font-size:25px; color: RosyBrown"></a> -->
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No stock entries found</td>
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
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteDailyMfd')?>">
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
    function setDeleteFunction(dlt_id){
       // alert(dlt_id)
      $('#dlt_id').val(dlt_id); 
      $('#deleteModal').modal('show');
    }


  //-------------- add row and remover row
    // document.addEventListener('DOMContentLoaded', () => {
    //     const addBagForm = document.getElementById('addBag');

    //     addBagForm.addEventListener('click', function (event) {
    //         if (event.target.classList.contains('add-row')) {
    //             const parentRow = event.target.closest('.supplier-row');
    //             const newRow = parentRow.cloneNode(true);

    //             // Clear input values in the cloned row
    //             newRow.querySelectorAll('input').forEach(input => input.value = '');

    //             // Append the new row after the current one
    //             parentRow.after(newRow);

    //             // Update all material labels
    //             updateMaterialLabels();
    //         }

    //         if (event.target.classList.contains('remove-row')) {
    //             const rows = addBagForm.querySelectorAll('.supplier-row');
    //             if (rows.length > 1) {
    //                 event.target.closest('.supplier-row').remove();

    //                 // Update material labels after removing a row
    //                 updateMaterialLabels();
    //             } else {
    //                 alert('At least one row is required.');
    //             }
    //         }
    //     });

  //---------------- Function to update material labels dynamically
    //     function updateMaterialLabels() {
    //         const rows = addBagForm.querySelectorAll('.supplier-row');
    //         rows.forEach((row, index) => {
    //             const label = row.querySelector('label.col-form-label');
    //             if (label) {
    //                 label.textContent = `Material ${index + 1}`;
    //             }
    //         });
    //     }
    // });

  //---------------------- Ensure the DOM is fully loaded 1 
    // document.addEventListener('DOMContentLoaded', function () {
    //     const piecesDropdown = document.getElementById('pieces_pp');
    //     const quantityInput = document.getElementById('quantity_kg');

    //     // Event listener for dropdown change
    //     piecesDropdown.addEventListener('change', function () {
    //         if (piecesDropdown.value !== "") {
    //             quantityInput.value = 1; // Set default value to 1
    //         }
    //     });
    // });

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
            qtyInPacketsInput.value = qtyInPackets.toFixed(1); // Rounded to whole number

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

//----------------- Validation function
  function validateForm() {
    let isValid = true;

    // Get all form inputs
    const productnameId = document.querySelector('[name="product_name_id"]');
    const piecesPerPackets = document.querySelector('[name="pieces_packet"]');

    // Clear previous error messages
    const errorMessages = document.querySelectorAll('.error-msg');
    errorMessages.forEach(function(error) {
      error.remove();
    });


    // Validate Supplier Selection (Required)
    if (productnameId.value === "") {
      isValid = false;
      showError(productnameId, "ProductName is required");
    }

    // Validate Payment Mode (Required and must be a valid selection)
    if (piecesPerPackets.value === "") {
      isValid = false;
      showError(piecesPerPackets, "PiecesPerPackets is required");
    }

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
</script>
<script>
    // Set today's date as the default value in the input field
    document.addEventListener("DOMContentLoaded", function () {
        const billDateField = document.getElementById("date");
        const today = new Date().toISOString().split("T")[0]; // Format: YYYY-MM-DD
        billDateField.value = today;
    });
</script>

