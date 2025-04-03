
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Customer Details</li>
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
      <div class="col-md-5">
        <!-- General form elements -->
        <div class="card card-warning">
          <div class="card-header" style="background-color: #8FBC8F; border-color: #8FBC8F;">
            <h3 class="card-title">Customer Form</h3>
          </div>
          <!-- /.card-header -->
          <form method="post" id="addBag" action="<?=base_url('welcome/insertCustomer')?>">
  <div class="card-body">
    <div class="row">
      
      <!-- Name Validation (Only characters) -->
      <div class="col-sm-6">
        <div class="form-group inline-block">
          <label class="col-form-label" for="inputSuccess">Name</label>
          <input type="text" name="cust_name" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..." required pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces" autocomplete="off">
        </div>
      </div>

     <!-- Mobile No Validation (Starts with 7, 8, or 9 and has exactly 10 digits) -->
<div class="col-sm-6">
  <div class="form-group inline-block">
    <label class="col-form-label" for="inputSuccess">Mobile No</label>
    <input
      type="text"
      name="cust_mobile_no"
      class="form-control is-valid"
      id="inputSuccess"
      placeholder="Enter ..."
      required
      maxlength="10"
      pattern="[789]\d{9}"
      title="Mobile number should start with 7, 8, or 9 and be exactly 10 digits"
      autocomplete="off"
    >
  </div>
</div>

      <!-- Address Validation (Alphanumeric) -->
      <div class="col-sm-6">
        <div class="form-group inline-block">
          <label class="col-form-label" for="inputSuccess">Address</label>
          <input type="text" name="cust_address" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..." required pattern="[A-Za-z0-9\s,.'-]+" title="Address should contain only letters, numbers, and basic punctuation" autocomplete="off">
        </div>
      </div>

      <!-- GSTIN Validation (Only numbers) -->
      <div class="col-sm-6">
        <div class="form-group inline-block">
          <label class="col-form-label" for="inputSuccess">GSTIN</label>
          <input type="text" name="cust_gstin" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..." required pattern="[A-Za-z0-9]+" title="GSTIN should only contain numbers" autocomplete="off">
        </div>
      </div>

    </div>
  </div>

  <!-- Submit Button -->
  <div class="card-footer">
    <button type="submit" style="background-color: #8FBC8F; border-color: #8FBC8F;" class="btn btn-primary addBrand-save">Submit</button>
  </div>
</form>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <!-- right column -->
          <!-- /.card -->
   <div class="col-md-7">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-outline card-success custom-outline">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Name</th>
                    <th>Mobile.no</th>
                    <th>Address</th>
                    <th>GSTIN</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if ($getCustomer !== null && $getCustomer->num_rows() > 0): ?>
                  <?php $i = 1; ?>
                  <?php foreach ($getCustomer->result() as $r): ?>
                    <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $r->cust_name ?></td>
                    <td><?php echo $r->cust_mobile_no ?></td>
                    <td><?php echo $r->cust_address ?></td>
                    <td><?php echo $r->cust_gstin ?></td>
                   <td>
                   <a class="far fa-edit" onclick="setDataFunction(
                    '<?php echo $r->id; ?>',
                    '<?php echo htmlspecialchars($r->cust_name, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($r->cust_mobile_no, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($r->cust_address, ENT_QUOTES, 'UTF-8'); ?>',
                    '<?php echo htmlspecialchars($r->cust_gstin, ENT_QUOTES, 'UTF-8'); ?>'
                )" style="font-size: 25px; color: SteelBlue;"></a>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a  class="fas fa-trash-alt"  onclick="setDeleteFunction('<?php echo $r->id; ?>')" style="font-size:25px; color: RosyBrown"></a> 
                    </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">No products found</td>
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
                    <p>Are you sure you want to delete this customer deatails?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteCustomer')?>">
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
                <h5 class="modal-title" id="editModalLabel">Edit Customer Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?=base_url('welcome/updateCustomer')?>" id="editParty">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group inline-block">
                                <label class="inline-block">Name</label>
                                <input type="hidden" name="id" id="party_id"> 
                                <input type="text" name="cust_name" id="nam_id" class="form-control inline-block" placeholder="Enter Party Name"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group inline-block">
                                <label class="inline-block">Mobile.No</label>
                                <input type="text" name="cust_mobile_no" id="mbl_id" class="form-control inline-block" placeholder="Enter Mobile Number"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group inline-block">
                                <label class="inline-block">Addres</label>
                                <input type="text" name="cust_address" id="add_id" class="form-control inline-block" placeholder="Enter Address"/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group inline-block">
                                <label class="inline-block">GSTIN</label>
                                <input type="text" name="cust_gstin" id="gst_id" class="form-control inline-block" placeholder="Enter GSTIN"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="color: SteelBlue" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" style="color: RosyBrown" class="btn btn-light editBrand-save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
//-------------------------START Edit operation-------------------------------------------//
  function setDataFunction(id, cust_name, cust_mobile_no, cust_address, cust_gstin) {
  // alert("Button clicked! ID: " + id); // Alert message to check button click
  // console.log("ID:", id); // Log the ID
  // console.log("Party Name:", party_name); // Log the Bag Name
  // console.log("Mobile:", mobile_no); // Log the Weight
  $('#party_id').val(id); // Set hidden ID field
  $('#nam_id').val(cust_name); // Set Bag Name field
  $('#mbl_id').val(cust_mobile_no); // Set Weight field
  $('#add_id').val(cust_address);
  $('#gst_id').val(cust_gstin);
  $('#editModal').modal('show'); // Show the modal
  }      
//--------------------------END Edit operation-------------------------------------------//

//-----------------------START Delete operation-----------------------------------------//
    function setDeleteFunction(dlt_id){
       // alert(dlt_id)
      $('#dlt_id').val(dlt_id); 
      $('#deleteModal').modal('show');
    }
//--------------------------END Delete operation----------------------------------------//
    
    //-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds

</script>
