<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <style>
        tfoot tr {
            background-color: #f2f2f2; /* Light gray background for the footer */
            font-weight: bold; /* Bold text for totals */
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ready MFD Stock</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                       <form method="get" action="<?php echo base_url('welcome/ready_mfd_report'); ?>">
                          <div class="input-group mb-3">
                            <!-- Dropdown for Supplier Names -->
                            <div class="input-group-prepend">
                                <span class="input-group-text fw-bold">Filter Name</span>
                            </div>
                            <select class="form-control" name="filtername">
                                <option value="">Select Product Name</option>
                                <?php foreach ($product_name as $supplier): ?>
                                    <option value="<?php echo $supplier['product_name']; ?>" 
                                        <?php echo ($this->input->get('filtername') == $supplier['product_name']) ? 'selected' : ''; ?>>
                                        <?php echo $supplier['product_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <!-- Input for Bill Date -->
                <div class="input-group-prepend">
                    <span class="input-group-text fw-bold">Bill Date</span>
                </div>
                <input class="form-control" name="filterdate" type="date" 
                       value="<?php echo $this->input->get('filterdate'); ?>">


                            <!-- Search Button -->
                            <div class="input-group-prepend">
                               <button class="btn" type="submit" style="color: white; background-color: DarkCyan;">Search</button>
                            </div>

                            <!-- Reset Button -->
                            <div class="input-group-prepend">
                                <a href="<?php echo base_url('welcome/ready_mfd_report'); ?>">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Dates</th>
                                    <th>Pieces Per Packet</th>
                                    <th>Quantity (Kg)</th>
                                    <th>Quantity (Pieces)</th>
                                    <th>Quantity (Packets)</th>
                                    <th>Quantity (Dozens)</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $total_pp = 0;
    $total_kg = 0;
    $total_qinp = 0;
    $total_qinpkt = 0;
    $total_qid = 0;
    if (!empty($getdailyStocks)): ?>
        <?php $i = 1; ?>
        <?php foreach ($getdailyStocks as $stock):
            // Calculate totals
            $total_pp += $stock->pieces_pp;
            $total_kg += $stock->qty_in_kg;
            $total_qinp += $stock->qty_in_pieces;
            $total_qinpkt += $stock->qty_in_packet;
            $total_qid += $stock->qty_in_dozens;
        ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo htmlspecialchars($stock->product_name); ?></td>
                <td><?php echo htmlspecialchars($stock->date); ?></td>
                <td><?php echo htmlspecialchars($stock->pieces_pp); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_kg); ?></td>
                <td><?php echo htmlspecialchars($stock->qty_in_pieces); ?></td>
                <td><?php echo htmlspecialchars($stock->remaining_qty_in_packet); ?></td> <!-- Display remaining packets -->
                <td><?php echo htmlspecialchars($stock->remaining_qty_in_dozens); ?></td> <!-- Display remaining dozens -->
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No stock entries found</td>
        </tr>
    <?php endif; ?>
</tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-center"><strong>Total:</strong></td>
                                    <td id="total_pp"><?php echo $total_pp; ?></td>
                                    <td id="total_kg"><?php echo $total_kg; ?></td>
                                    <td id="total_qinp"><?php echo $total_qinp; ?></td>
                                    <td id="total_qinpkt"><?php echo $total_qinpkt; ?></td>
                                    <td id="total_qid"><?php echo $total_qid; ?></td>
                                </tr>
                            </tfoot>
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

<!-- <script> // clculation for footer total using footer script
  $(document).ready(function () {
    // Initialize DataTable
    var table = $("#example1").DataTable();

    // Function to calculate and update totals
    function updateTotals() {
        let totalPP = 0, totalKg = 0, totalQinP = 0, totalQinPkt = 0, totalQid = 0;

        // Loop through only the visible rows
        table.rows({ search: 'applied' }).every(function () {
            let row = $(this.node());
            totalPP += parseFloat(row.find("td:eq(3)").text()) || 0;
            totalKg += parseFloat(row.find("td:eq(4)").text()) || 0;
            totalQinP += parseFloat(row.find("td:eq(5)").text()) || 0;
            totalQinPkt += parseFloat(row.find("td:eq(6)").text()) || 0;
            totalQid += parseFloat(row.find("td:eq(7)").text()) || 0;
        });

        // Update footer totals
        $("#total_pp").text(totalPP);
        $("#total_kg").text(totalKg);
        $("#total_qinp").text(totalQinP);
        $("#total_qinpkt").text(totalQinPkt);
        $("#total_qid").text(totalQid);
    }

    // Listen for DataTable search event
    table.on('search.dt', function () {
        updateTotals();
    });

    // Initial calculation
    updateTotals();
  });
</script> -->

<script>
$(function () {
    $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "searching": true,
        "columnDefs": [
            { 
                "targets": [1, 2, 3, 4, 5, 6, 7], 
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
            var total_pp = sumColumn(3); // Column index for Pieces Per Packet
            var total_kg = sumColumn(4); // Column index for Quantity in Kg
            var total_qinp = sumColumn(5); // Column index for Quantity in Pieces
            var total_qinpkt = sumColumn(6); // Column index for Quantity in Packets
            var total_qid = sumColumn(7); // Column index for Quantity in Dozens

            // Update the footer with the rounded totals
            $('#total_pp').html(roundToTwoDecimals(total_pp));
            $('#total_kg').html(roundToTwoDecimals(total_kg));
            $('#total_qinp').html(roundToTwoDecimals(total_qinp));
            $('#total_qinpkt').html(roundToTwoDecimals(total_qinpkt));
            $('#total_qid').html(roundToTwoDecimals(total_qid));
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
 