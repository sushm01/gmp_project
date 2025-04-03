
    <style>
        #successMessage {
            background-color: green;
            border-color: green;
            color: #ffffff;
            max-width: 350px;
            font-size: 16px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #printableArea, #printableArea * {
                visibility: visible;
            }
            #printableArea {
                position: absolute;
                left: 0;
                top: 0;
            }
            .btn, .breadcrumb, .input-group { 
                display: none; 
            }
        }

 table {
    width: 100%;
    border-collapse: collapse;
  }
  
  table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
  }
  
  tfoot tr {
    background-color: #f2f2f2; /* Light gray background for the footer */
    font-weight: bold; /* Bold text for totals */
  }
  
  tfoot td {
    border-top: 2px solid #000; /* Solid border to separate totals from data rows */
    padding: 10px;
  }
  
  tfoot td[colspan] {
    text-align: right; /* Align the "Total" label to the right */
  }

    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Purchase Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <form method="get" action="<?php echo base_url('welcome/purchase_report_page'); ?>">
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
                    <span class="input-group-text fw-bold">Invoice No</span>
                </div>
                <input class="form-control" name="filterinvoiceno" type="text" placeholder="Bill No" 
                       value="<?php echo $this->input->get('filterinvoiceno'); ?>">

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
                    <a href="<?php echo base_url('welcome/purchase_report_page'); ?>">
                        <button class="btn" type="button"  style="color: white; background-color: DarkSalmon;">Reset</button>
                    </a>
                </div>
              </div>
            </form>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="printableArea">
                                     <table id="example1" class="table table-bordered table-striped">
                                        <thead>
        <tr>
            <th>#</th>
            <th>Invoice No</th>
            <th>Bill Date</th>
            <th>Supplier</th>
            <th>Material</th>
            <th>Quantity</th>
            <th>Purchase Price</th>
            <th>Gross Amount</th>
            <th>SGST%</th>
            <th>CGST%</th>
            <th>GST Amt</th>
            <th>Line Total</th>
            <th>Cash Discount%</th>
            <th>Payable Amt</th>
            <th>Paid Amt</th>
            <th>Balance Amt</th>
        </tr>
    </thead>
    <tbody>
    <?php
     $total_qty = 0;
     $total_purchasePrice = 0;
     $total_gross = 0;
     $total_sgst = 0;
     $total_cgst = 0;
     $total_gstAmt = 0;
     $total_lineTotal = 0;
     $total_payable = 0;
     $total_discount = 0;
     $total_paid = 0;
     $total_balance = 0;
     if (!empty($getPurchase)): ?>
        <?php foreach ($getPurchase as $key => $order): 
            // Accumulate totals
            $total_qty += $order->quantity;
            $total_purchasePrice += $order->purchase_price;
            $total_gross += $order->gross_amt;
            $total_sgst += $order->sgst;
            $total_cgst += $order->cgst;
            $total_gstAmt += $order->gst_amt;
            $total_lineTotal += $order->line_total;
            $total_payable += $order->payable_amt;
            $total_discount += $order->cash_discount;
            $total_paid += $order->paid_amt;
            $total_balance += $order->balance_amt;
        ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $order->invoice_no; ?></td>
                <td><?php echo date('Y-m-d', strtotime($order->bill_date)); ?></td>
                <td><?php echo $order->supplier_name; ?></td>
                <td><?php echo $order->raw_materials; ?></td>
                <td><?php echo $order->quantity; ?></td>
                <td><?php echo $order->purchase_price; ?></td>
                <td><?php echo $order->gross_amt; ?></td>
                <td><?php echo $order->sgst; ?>%</td>
                <td><?php echo $order->cgst; ?>%</td>
                <td><?php echo $order->gst_amt; ?></td>
                <td><?php echo $order->line_total; ?></td>
                <td><?php echo $order->cash_discount; ?>%</td>
                <td><?php echo $order->payable_amt; ?></td>
                <td><?php echo $order->paid_amt; ?></td>
                <td><?php echo $order->balance_amt; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="16" class="text-center">No purchase orders available</td>
        </tr>
    <?php endif; ?>
</tbody>

                     <tfoot>
    <tr>
      <td colspan="5">Total:</td>
      <td id="total_qty"><?php echo $total_qty; ?></td>
      <td id="total_purchasePrice"><?php echo $total_purchasePrice; ?></td>
      <td id="total_gross"><?php echo $total_gross; ?></td>
      <td id="total_sgst"><?php echo $total_sgst; ?></td>
      <td id="total_cgst"><?php echo $total_cgst; ?></td>
      <td id="total_gstAmt"><?php echo $total_gstAmt; ?></td>
      <td id="total_lineTotal"><?php echo $total_lineTotal; ?></td>
      <td id="total_payable"><?php echo $total_payable; ?></td>
      <td id="total_discount"><?php echo $total_discount; ?></td>
      <td id="total_paid"><?php echo $total_paid; ?></td>
      <td id="total_balance"><?php echo $total_balance; ?></td>
    </tr>
  </tfoot>

              </table>
                                </div>
                            </div>
                        </div>
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
        return value ? (Math.round(value * 100) / 100).toFixed() : '0.00'; // Ensure it's rounded to 2 decimals
      };

      // Calculate totals for each relevant column (based on current visible data after filtering/searching)
      var total_qty = sumColumn(5); // Column index for total_qty
      var total_purchasePrice = sumColumn(6); // Column index for total_purchasePrice
      var total_gross = sumColumn(7); // Column index for total_gross
      var total_sgst = sumColumn(8); // Column index for total_sgst
      var total_cgst = sumColumn(9); // Column index for total_cgst
      var total_gstAmt = sumColumn(10); // Column index for total_gstAmt
      var total_lineTotal = sumColumn(11); // Column index for total_lineTotal
      var total_payable = sumColumn(12); // Column index for total_payable
      var total_discount = sumColumn(13); // Column index for total_payable
      var total_paid = sumColumn(14); // Column index for total_paid
      var total_balance = sumColumn(15); // Column index for total_balance

      // Update the footer with the rounded totals
      $('#total_qty').html(roundToTwoDecimals(total_qty));
      $('#total_purchasePrice').html(roundToTwoDecimals(total_purchasePrice));
      $('#total_gross').html(roundToTwoDecimals(total_gross));
      $('#total_sgst').html(roundToTwoDecimals(total_sgst));
      $('#total_cgst').html(roundToTwoDecimals(total_cgst));
      $('#total_gstAmt').html(roundToTwoDecimals(total_gstAmt));
      $('#total_lineTotal').html(roundToTwoDecimals(total_lineTotal));
      $('#total_payable').html(roundToTwoDecimals(total_payable));
      $('#total_discount').html(roundToTwoDecimals(total_discount));
      $('#total_paid').html(roundToTwoDecimals(total_paid));
      $('#total_balance').html(roundToTwoDecimals(total_balance));
    }
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>

