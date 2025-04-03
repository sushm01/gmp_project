
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <?php if ($this->session->flashdata('success_message')) { ?>
        <div id="successMessage" class="alert alert-success">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php } ?>

    <style>
      #successMessage {
      background-color: green; /* Change to your desired color */
      border-color: green;
      color: #ffffff; /* Change to your desired text color */
  /*    //max-height: 350px;*/
      max-width: 350px;
      font-size: 16px; /* Change to your desired font size */
      padding: 10px 20px; /* Adjust padding as needed */
      margin-bottom: 20px; /* Adjust margin as needed */
  }

/*  .card-body {
    background-color: whitesmoke;
}*/

</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Raw Material Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Raw Material Stock</li>
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
           <!--  <div class="card-header">
              <h3 class="card-title">DataTable</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                <th>SL. No</th>
                <th>Material Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                 </tr>
                  </thead>
 <tbody>
<?php if (!empty($getpurchaseOrder)): ?> <!-- Check if array is not empty -->
    <?php $i = 1; ?>
    <?php foreach ($getpurchaseOrder as $r): ?> <!-- Iterate over the result array -->
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo htmlspecialchars($r->raw_materials ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($r->remaining_qty ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($r->unit_name ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">No materials found</td>
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

   <script>
    // Enable Print Button if a Buyer is Selected
    function togglePrintButton() {
        const selectedBuyer = document.getElementById('filterName').value;
        const printButton = document.getElementById('printButton');
        printButton.disabled = !selectedBuyer; // Enable only if a buyer is selected
    }

    // Automatically Enable Print Button if Buyer Name Exists
    document.addEventListener("DOMContentLoaded", () => {
        const selectedBuyer = document.getElementById('filterName').value;
        if (selectedBuyer) {
            document.getElementById('printButton').disabled = false;
        }
    });

    // Redirect on Print
    function redirectToInvoice() {
        const selectedBuyer = document.getElementById('filterName').value;
        if (!selectedBuyer) {
            alert("Please select a buyer before printing!");
            return;
        }
      const baseUrl = "<?php echo base_url('print-multiples/'); ?>";
        window.location.href = baseUrl + encodeURIComponent(selectedBuyer);

    }
</script>