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
<div class="col-sm-4">
<h1>Farmer Report</h1>
</div>
<div class="col-sm-8">
<ol class="breadcrumb float-sm-right">
<form method="get" action="<?php echo base_url('Purchase_controller/page_reportFarmer'); ?>">
    <div class="input-group">
          <!-- Dropdown for Buyer Names -->
        <div class="input-group-prepend">
            <span class="input-group-text fw-bold">Filter Name</span>
        </div>
        <select class="form-control" id="filterName" name="filtername" onchange="togglePrintButton()">
            <option value="">Select Farmer</option>
            <?php foreach ($farmer_names as $farmer): ?>
                <option value="<?php echo $farmer['farmer_name']; ?>" 
                        <?php echo ($this->input->get('filtername') == $farmer['farmer_name']) ? 'selected' : ''; ?>>
                    <?php echo $farmer['farmer_name']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Other Inputs -->
        <div class="input-group-prepend">
            <span class="input-group-text fw-bold">From Date</span>
        </div>
        <input class="form-control" name="fromdate" type="date" 
               value="<?php echo $this->input->get('fromdate'); ?>">

        <div class="input-group-prepend">
            <span class="input-group-text fw-bold">To Date</span>
        </div>
        <input class="form-control" name="todate" type="date" 
               value="<?php echo $this->input->get('todate'); ?>">

        <div class="input-group-prepend">
            <span class="input-group-text fw-bold">Rate</span>
        </div>
        <input class="form-control" name="rate" type="text" placeholder="e.g., .50" autocomplete="off"
               value="<?php echo $this->input->get('rate'); ?>">

        <div class="input-group-prepend">
            <button class="input-group-text fw-bold" type="submit">Search</button>
        </div>

        <div class="input-group-prepend">
            <a href="<?php echo base_url('Purchase_controller/page_reportFarmer'); ?>">
                <button class="input-group-text fw-bold" style="background-color:red; color: #fff;" type="button">Reset</button>
            </a>
        </div>

        <!-- Print Button -->
        <div class="input-group-prepend">
            <button id="printButton" 
                    class="input-group-text fw-bold btn btn-success" 
                    type="button" 
                    onclick="redirectToInvoice()" 
                    disabled>
                Print
            </button>
        </div>
    </div>
</form> 
</ol>
</div>
</div>
</div>
</section>
  
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <!-- <th>Al.no</th> -->
                    <th>Lot No</th>
                    <th>Inward Number</th>
                    <th>Farmer Name</th>
                    <th>Item Name</th>
                    <th>Date</th>
                    <th>Bags</th>
                    <th>Rate</th>
                    <th>P Bag</th>
                    <th>P Bod</th>
                    <th>G Bag</th>
                    <th>G Bod</th>
                    <th>Gross Weight</th>
                    <th>Less Bag</th>
                    <th>Net Weight</th>
                    <th>Hamali</th>
                    <th>Kata Fee</th>
                    <th>Tal</th>
                    <th>Freight</th>
                    <th>Advance</th>
                   <!--  <th>SGST</th>
                    <th>CGST</th> -->
                    <th>Gross Amount</th>
                    <th>Less Expenses</th>
                    <th>Net Amount</th>
                     <th>Action</th> 
                  </tr>
                  </thead>
                  <tbody>
             <?php if ($buyers !== null && $buyers->num_rows() > 0): ?>
    <?php foreach ($buyers->result() as $r): ?>
        <?php 
        // Calculate the total bags
        $total_bags = $r->p_bag + $r->p_bod + $r->g_bag + $r->g_bod;
        
        // Check if total_bags matches no_of_bags
        if ($total_bags == $r->no_of_bags): 
        ?>
            <tr>
                <td><?php echo $r->lot_no ?></td>
                <td><?php echo $r->inward_no ?></td> 
                <td><?php echo $r->farmer_name ?></td>
                <td><?php echo $r->item_name ?></td>
                <td><?php echo date('d-m-Y', strtotime($r->date)); ?></td>
                <td><?php echo $r->no_of_bags ?></td>
                <td><?php echo $r->rate ?></td>
                <td><?php echo $r->p_bag ?></td>
                <td><?php echo $r->p_bod ?></td>
                <td><?php echo $r->g_bag ?></td>
                <td><?php echo $r->g_bod ?></td>
                <td><?php echo $r->gross_wtg ?></td>
                <td><?php echo $r->less_bag ?></td>
                <td><?php echo $r->net_wtg ?></td>
                <td><?php echo $r->hamali ?></td>
                <td><?php echo $r->kata_fee ?></td>
                <td><?php echo $r->tal ?></td>
                <td><?php echo $r->freight ?></td>
                <td><?php echo $r->advance ?></td>
                <td><?php echo $r->gross_amount ?></td>
                <td><?php echo $r->less_exp ?></td>
                <td><?php echo $r->netAmt ?></td>
                <td>
                    <a class="fas fa-file-invoice" href="<?php echo base_url('Purchase_controller/page_invoice_farmer/'. $r->id); ?>" style="font-size: 18px; color: blue;"></a>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="22">No products found</td>
    </tr>
<?php endif; ?>

                  </tbody> 
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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