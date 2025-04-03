  <div class="content-wrapper">
    <style>
        tfoot tr {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MFD Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <form method="get" action="<?php echo base_url('welcome/mfd_stock_report'); ?>">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text fw-bold">Filter Name</span>
                                </div>
                                <select id="filterName" class="form-control" name="filtername">
                                    <option value="">Select Product Name</option>
                                    <?php foreach ($product_name as $supplier): ?>
                                        <option value="<?php echo $supplier['product_name']; ?>" 
                                            <?php echo ($this->input->get('filtername') == $supplier['product_name']) ? 'selected' : ''; ?>>
                                            <?php echo $supplier['product_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="input-group-prepend">
                                    <span class="input-group-text fw-bold">HSN Code</span>
                                </div>
                                <input class="form-control" name="filterhsncode" type="text" placeholder="HSN Code" 
                                    value="<?php echo $this->input->get('filterhsncode'); ?>">

                                     <!-- Input for Bill Date -->
                <div class="input-group-prepend">
                    <span class="input-group-text fw-bold">Bill Date</span>
                </div>
                <input class="form-control" name="filterdate" type="date" 
                       value="<?php echo $this->input->get('filterdate'); ?>">

                                <div class="input-group-prepend">
                                    <button class="btn" type="submit" style="color: white; background-color: DarkCyan;">Search</button>
                                </div>

                                <div class="input-group-prepend">
                                    <a href="<?php echo base_url('welcome/mfd_stock_report'); ?>">
                                        <button class="btn" type="button" style="color: white; background-color: DarkSalmon;">Reset</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </ol>
                </div>
            </div>
        </div>
    </section>

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
                                    <th>HSN Code</th>
                                    <th>Date</th>
                                    <th>Pieces Per Packet</th>
                                    <th>Quantity (Kg)</th>
                                    <th>Quantity (Pieces)</th>
                                    <th>Quantity (Packets)</th>
                                    <th>Quantity (Dozens)</th>
                                    <th>Materials Used</th>
                                    <th>Wholesale Price (Per Dozen)</th>
                                    <th>Retail Price (Per Dozen)</th>
                                    <th>SGST%</th>
                                    <th>CGST%</th>
                                </tr>
                            </thead>
                           <tbody>
    <?php
    $total_pp = 0;
    $total_qik = 0;
    $total_qip = 0;
    $total_qinp = 0;
    $total_qind = 0;
    $total_wp = 0;
    $total_rp = 0;
    $total_sgst = 0;
    $total_cgst = 0;

    if (!empty($stockData)): 
        $rowIndex = 1;
        foreach ($stockData as $row): 
            // Calculate totals
            $total_pp += $row['pieces_pp'];
            $total_qik += $row['qty_in_kg'];
            $total_qip += $row['qty_in_pieces'];
            $total_qinp += $row['qty_in_packet'];
            $total_qind += $row['qty_in_dozens'];
            $total_wp += $row['wholesale_price'];
            $total_rp += $row['retail_price'];
            $total_sgst += $row['sgst'];
            $total_cgst += $row['cgst'];
    ?>
        <tr>
            <td><?php echo $rowIndex++; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['hsn_code']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['pieces_pp']; ?></td>
            <td><?php echo $row['qty_in_kg']; ?></td>
            <td><?php echo $row['qty_in_pieces']; ?></td>
            <td><?php echo $row['qty_in_packet']; ?></td>
            <td><?php echo $row['qty_in_dozens']; ?></td>
            <td><?php echo $row['materials_used']; ?></td>
            <td><?php echo $row['wholesale_price']; ?></td>
            <td><?php echo $row['retail_price']; ?></td>
            <td><?php echo $row['sgst']; ?></td>
            <td><?php echo $row['cgst']; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="13" class="text-center">No data available</td>
        </tr>
    <?php endif; ?>
</tbody>

                            <tfoot>
    <tr>
        <td colspan="4" class="text-center"><strong>Total:</strong></td>
        <td id="total_pp"><?php echo $total_pp; ?></td>
        <td id="total_qik"><?php echo $total_qik; ?></td>
        <td id="total_qip"><?php echo $total_qip; ?></td>
        <td id="total_qinp"><?php echo $total_qinp; ?></td>
        <td id="total_qind"><?php echo $total_qind; ?></td>
        <td></td>
        <td id="total_wp"><?php echo $total_wp; ?></td>
        <td id="total_rp"><?php echo $total_rp; ?></td>
        <td id="total_sgst"><?php echo $total_sgst; ?></td>
        <td id="total_cgst"><?php echo $total_cgst; ?></td>
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
    $("#example1").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "searching": true,
        "columnDefs": [
            { 
                "targets": [1, 2, 3, 4, 5, 6, 7, 8], 
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
            var total_pp = sumColumn(5); // Column index for total_pp
            var total_qik = sumColumn(6); // Column index for total_qik
            var total_qip = sumColumn(7); // Column index for total_qip
            var total_qinp = sumColumn(8); // Column index for total_qinp
            var total_qind = sumColumn(9); // Column index for total_qind
            var total_wp = sumColumn(10); // Column index for total_wp
            var total_rp = sumColumn(11); // Column index for total_rp
            var total_sgst = sumColumn(12); // Column index for total_sgst
            var total_cgst = sumColumn(13); // Column index for total_cgst

            // Update the footer with the rounded totals
            $('#total_pp').html(roundToTwoDecimals(total_pp));
            $('#total_qik').html(roundToTwoDecimals(total_qik));
            $('#total_qip').html(roundToTwoDecimals(total_qip));
            $('#total_qinp').html(roundToTwoDecimals(total_qinp));
            $('#total_qind').html(roundToTwoDecimals(total_qind));
            $('#total_wp').html(roundToTwoDecimals(total_wp));
            $('#total_rp').html(roundToTwoDecimals(total_rp));
            $('#total_sgst').html(roundToTwoDecimals(total_sgst));
            $('#total_cgst').html(roundToTwoDecimals(total_cgst));
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
