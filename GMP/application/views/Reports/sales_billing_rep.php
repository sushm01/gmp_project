<style>
   tfoot tr {
    background-color: #f2f2f2; /* Light gray background for the footer */
    font-weight: bold; /* Bold text for totals */
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-4">
          <h1>Sales Stock</h1>
        </div>
        <div class="col-sm-8">
          <ol class="breadcrumb float-sm-right">
            <form method="get" action="<?php echo base_url('welcome/sales_report'); ?>">
              <div class="input-group mb-3">
                <!-- Dropdown for Supplier Names -->
                <div class="input-group-prepend">
                    <span class="input-group-text fw-bold">Filter Name</span>
                </div>
                <select class="form-control" name="filtername">
                    <option value="">Select Supplier</option>
                    <?php foreach ($supp_name as $supplier): ?>
                        <option value="<?php echo $supplier['supp_name']; ?>" 
                            <?php echo ($this->input->get('filtername') == $supplier['supp_name']) ? 'selected' : ''; ?>>
                            <?php echo $supplier['supp_name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Input for Bill No -->
                <div class="input-group-prepend">
                    <span class="input-group-text fw-bold">Bill No</span>
                </div>
                <input class="form-control" name="filterbillno" type="text" placeholder="Bill No" 
                       value="<?php echo $this->input->get('filterbillno'); ?>">

                <!-- Input for Bill Date -->
                <div class="input-group-prepend">
                    <span class="input-group-text fw-bold">Bill Date</span>
                </div>
                <input class="form-control" name="filterbilldate" type="date" 
                       value="<?php echo $this->input->get('filterbilldate'); ?>">

                <!-- Search Button -->
                <div class="input-group-prepend">
                   <button class="btn" type="submit" style="color: white; background-color: DarkCyan;">Search</button>
                </div>

                <!-- Reset Button -->
                <div class="input-group-prepend">
                    <a href="<?php echo base_url('welcome/sales_report'); ?>">
                        <button class="btn" type="button"  style="color: white; background-color: DarkSalmon;">Reset</button>
                    </a>
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl.No</th>
                  <th>Product Name</th>
                  <th>Bill No</th>
                  <th>HSN Code</th>
                  <th>Bill Date</th>
                  <th>Supplier</th>
                  <th>Pcs/Pkt</th>
                  <th>Pkt Avl</th>
                  <th>Dzn Avl</th>
                  <th>Num of Dzn</th>
                  <th>Price/Dzn</th>
                  <th>Price/Pkt</th>
                  <th>Gross Amt</th>
                  <th>GST Amt</th>
                  <th>Line Total</th>
                  <th>Payable Amt</th>
                  <th>Paid Amt</th>
                  <th>Balance Amt</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $total_ppp = 0;
                  $total_pktavl = 0;
                  $total_dznavl = 0;
                  $total_numdzn = 0;
                  $total_pdzn = 0;
                  $total_ppkt = 0;
                  $total_gross = 0;
                  $total_gst = 0;
                  $total_lt = 0;
                  $total_pm = 0;
                  $total_paid = 0;
                  $total_bal = 0;

                  if ($getsales !== null && !empty($getsales)): ?>
                    <?php $i = 1; ?>
                    <?php foreach ($getsales as $r): 
                         // Accumulate totals
                        $total_ppp += $r['s_pieces_pkt'];
                        $total_pktavl += $r['s_pkt_avl'];
                        $total_dznavl += $r['s_dzn_avl'];
                        $total_numdzn += $r['s_dozens'];
                        $total_pdzn += $r['s_price_dzn'];
                        $total_ppkt += $r['s_price_pkt'];
                        $total_gross += $r['s_gross_amt'];
                        $total_gst += $r['s_gst_amt'];
                        $total_lt += $r['s_line_total'];
                        $total_pm += $r['s_payable_amt'];
                        $total_paid += $r['s_paid_amt'];
                        $total_bal += $r['s_balance_amt'];
                    ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $r['product_name'] ?></td>
                      <td><?php echo $r['bill_no'] ?></td>
                      <td><?php echo $r['s_hsn_code'] ?></td>
                      <td><?php echo $r['bill_date'] ?></td>
                      <td><?php echo $r['supp_name'] ?></td>
                      <td><?php echo $r['s_pieces_pkt'] ?></td>
                      <td><?php echo $r['s_pkt_avl'] ?></td>
                      <td><?php echo $r['s_dzn_avl'] ?></td>
                      <td><?php echo $r['s_dozens'] ?></td>
                      <td><?php echo $r['s_price_dzn'] ?></td>
                      <td><?php echo $r['s_price_pkt'] ?></td>
                      <td><?php echo $r['s_gross_amt'] ?></td>
                      <td><?php echo $r['s_gst_amt'] ?></td>
                      <td><?php echo $r['s_line_total'] ?></td>
                      <td><?php echo $r['s_payable_amt'] ?></td>
                      <td><?php echo $r['s_paid_amt'] ?></td>
                      <td><?php echo $r['s_balance_amt'] ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="9">No products found</td>
                  </tr>
                <?php endif; ?>
              </tbody>

              <tfoot>
                <tr>
                    <td colspan="6" class="text-center"><strong>Total:</strong></td>
                    <td id="total_ppp"><?php echo $total_ppp; ?></td>
                    <td id="total_pktavl"><?php echo $total_pktavl; ?></td>
                    <td id="total_dznavl"><?php echo $total_dznavl; ?></td>
                    <td id="total_numdzn"><?php echo $total_numdzn; ?></td>
                    <td id="total_pdzn"><?php echo $total_pdzn; ?></td>
                    <td id="total_ppkt"><?php echo $total_ppkt; ?></td>
                    <td id="total_gross"><?php echo $total_gross; ?></td>
                    <td id="total_gst"><?php echo $total_gst; ?></td>
                    <td id="total_lt"><?php echo $total_lt; ?></td>
                    <td id="total_pm"><?php echo $total_pm; ?></td>
                    <td id="total_paid"><?php echo $total_paid; ?></td>
                    <td id="total_bal"><?php echo $total_bal; ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
$(function () {
  var table = $("#example1").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print"],
    "searching": true, // Ensures that searching is enabled
    "columnDefs": [
      {
        "targets": [1, 2, 3, 4, 5, 6, 7, 8], // Columns to include for searching
        "searchable": true
      }
    ],
    "footerCallback": function (row, data, start, end, display) {
      var api = this.api();

      // Function to sum up a column's data for the current page or filtered data
      var sumColumn = function (columnIndex) {
        return api.column(columnIndex, { page: 'current' }).data().reduce(function (a, b) {
          return parseFloat(a) + parseFloat(b);
        }, 0);
      };

      // Round the totals to two decimal places
      var roundToTwoDecimals = function (value) {
        return value ? (Math.round(value * 100) / 100).toFixed(2) : '0.00'; // Ensure it's rounded to 2 decimals
      };

      // Calculate totals for each relevant column (based on current visible data after filtering/searching)
      var total_ppp = sumColumn(6); // Column index for s_pieces_pkt
      var total_pktavl = sumColumn(7); // Column index for s_pkt_avl
      var total_dznavl = sumColumn(8); // Column index for s_dzn_avl
      var total_numdzn = sumColumn(9); // Column index for s_dozens
      var total_pdzn = sumColumn(10); // Column index for s_price_dzn
      var total_ppkt = sumColumn(11); // Column index for s_price_pkt
      var total_gross = sumColumn(12); // Column index for s_gross_amt
      var total_gst = sumColumn(13); // Column index for s_gst_amt
      var total_lt = sumColumn(14); // Column index for s_line_total
      var total_pm = sumColumn(15); // Column index for s_payable_amt
      var total_paid = sumColumn(16); // Column index for s_paid_amt
      var total_bal = sumColumn(17); // Column index for s_balance_amt

      // Update the footer with the rounded totals
      $('#total_ppp').html(roundToTwoDecimals(total_ppp));
      $('#total_pktavl').html(roundToTwoDecimals(total_pktavl));
      $('#total_dznavl').html(roundToTwoDecimals(total_dznavl));
      $('#total_numdzn').html(roundToTwoDecimals(total_numdzn));
      $('#total_pdzn').html(roundToTwoDecimals(total_pdzn));
      $('#total_ppkt').html(roundToTwoDecimals(total_ppkt));
      $('#total_gross').html(roundToTwoDecimals(total_gross));
      $('#total_gst').html(roundToTwoDecimals(total_gst));
      $('#total_lt').html(roundToTwoDecimals(total_lt));
      $('#total_pm').html(roundToTwoDecimals(total_pm));
      $('#total_paid').html(roundToTwoDecimals(total_paid));
      $('#total_bal').html(roundToTwoDecimals(total_bal));
    }
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

</script>
