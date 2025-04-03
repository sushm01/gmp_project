
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
            <h1>Raw Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Raw Details</li>
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
            <h3 class="card-title">Raw Form</h3>
          </div>
          <!-- /.card-header -->
          <form method="post" id="addBag" action="<?=base_url('welcome/insertRaw')?>">
          <div class="card-body">
            <div class="row">
               <div class="col-sm-6">
               <div class="form-group inline-block">
                <label class="col-form-label" for="inputSuccess"></i>Raw Materials</label>
                <input type="text" name="raw_materials" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..." pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed." autocomplete="off" required>
              </div>
            </div>
           <div class="col-sm-6">
            <div class="form-group inline-block">
            <label class="col-form-label" for="inputSuccess"></i>Units</label>
            <select type="text" name="unit_id" class="form-control is-valid" id="inputSuccess" placeholder="Enter ..." autocomplete="off">
                <option value="">Select Units</option>
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
          </div>
        </div>
        <!-- /.card-body -->
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
                    <th>Raw Materials</th>
                    <th>Units</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($getRaw)): ?>
    <?php $i = 1; ?>
    <?php foreach ($getRaw as $r): ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $r->raw_materials; ?></td>
            <td><?php echo $r->units; ?></td>
            <td>
                <a class="far fa-edit" onclick="setDataFunction(
                    '<?php echo $r->id; ?>',
                    '<?php echo htmlspecialchars($r->raw_materials, ENT_QUOTES); ?>',
                    '<?php echo htmlspecialchars($r->unit_id, ENT_QUOTES); ?>'
                )" style="font-size: 25px; color: SteelBlue;"></a>

                &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="fas fa-trash-alt" onclick="setDeleteFunction('<?php echo $r->id; ?>')" style="font-size:25px; color: RosyBrown;"></a>
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
                    <p>Are you sure you want to delete this Supplier deatails?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="post" action="<?php echo base_url('welcome/deleteRaw')?>">
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
            <form method="post" action="<?=base_url('welcome/updateRaw')?>" id="editParty">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group inline-block">
                                <label class="inline-block">Raw Materials</label>
                                <input type="hidden" name="id" id="party_id"> 
                                <input type="text" name="raw_materials" id="raw_id" class="form-control inline-block" placeholder="Enter Party Name"/>
                            </div>
                        </div>
                    <div class="col-sm-6">
                    <div class="form-group inline-block">
                    <label class="inline-block">Units</label>
                    <select type="text" name="unit_id" class="form-control" placeholder="Enter ...">
                        <option value="">Select Units</option>
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
  function setDataFunction(id, raw_materials, unit_id) {
  // alert("Button clicked! ID: " + id); // Alert message to check button click
  // console.log("ID:", id); // Log the ID
  // console.log("Party Name:", party_name); // Log the Bag Name
  // console.log("Mobile:", mobile_no); // Log the Weight
  $('#party_id').val(id); // Set hidden ID field
  $('#raw_id').val(raw_materials);
  $('#units_id').val(unit_id); // Set Bag Name field
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

    //-----------------Validations
    function validateUnits() {
    const unitsInput = document.getElementById('inputSuccess').value;
    const regex = /^[A-Za-z\s]+$/;

    if (!regex.test(unitsInput)) {
      alert('Please enter only letters and spaces.');
      return false;
    }
    return true;
  }
//-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds

</script>
