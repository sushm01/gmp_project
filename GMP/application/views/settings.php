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
            <h1>Settings Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Settings Details</li>
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
          <div class="card-header" style="background-color: #8FBC8F; border-color: #8FBC8F;">
            <h3 class="card-title">Settings Form</h3>
          </div>
          <!-- /.card-header -->
          <form method="post" id="addBag" action="<?=base_url('welcome/insert_settings')?>">
          <div class="card-body">
            <div class="row">
               <div class="col-sm-4">
               <div class="form-group inline-block">
                <label class="col-form-label" for="inputSuccess"></i>Pieces Per Kg</label>
                <input type="text" name="pieces_per_kg" class="form-control" id="pieces_per_kg" 
                   value="<?php echo isset($settings['pieces_per_kg']) ? $settings['pieces_per_kg'] : ''; ?>" 
                                               placeholder="Enter" autocomplete="off">
              </div>
            </div>
              <div class="col-sm-4">
               <div class="form-group inline-block">
                <label class="col-form-label" for="inputSuccess"></i>Plastic Packect Per Kg</label>
               <input type="text" name="plastic_packet_per_kg" class="form-control" id="plastic_packet_per_kg"
                   value="<?php echo isset($settings['plastic_packet_per_kg']) ? $settings['plastic_packet_per_kg'] : ''; ?>" placeholder="Enter Hamali" autocomplete="off">
              </div>
            </div>
              <div class="col-sm-4">
               <div class="form-group inline-block">
                <label class="col-form-label" for="inputSuccess"></i>Mfd.Critical Stock Value</label>
               <input type="text" name="mfd_critical_stock" class="form-control" id="mfd_critical_stock "
                  value="<?php echo isset($settings['mfd_critical_stock']) ? $settings['mfd_critical_stock'] : ''; ?>" placeholder="Enter Hamali" autocomplete="off">
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
              <div class="card-footer">
                  <button type="submit" style="background-color: #8FBC8F; border-color: #8FBC8F;" class="btn btn-primary addBrand-save">Update</button>
              </div>
      </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  //-------------------Success Message
  setTimeout(function() {
      $('#successMessage').fadeOut('slow');
      }, 2000); // 2000 milliseconds = 2 seconds
</script>

