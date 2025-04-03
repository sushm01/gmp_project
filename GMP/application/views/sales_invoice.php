
<?php
// Initialize totals
$total_cgst = 0;
$total_sgst = 0;
$total_gst = 0;
$total_amount = 0;

// Calculate totals
foreach ($items as $item) {
    $total_cgst += $item['s_cgst'];
    $total_sgst += $item['s_sgst'];
    $total_gst += $item['s_gst_amt'];
    $total_amount += $item['s_line_total'];
}

// Optionally calculate total taxable value and total value
$total_taxable_value = $total_amount - $total_gst; // Assuming GST is already part of line total
$total_value = $total_amount;


function convertNumberToWords($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
    ];

    if (!is_numeric($number)) {
        return false;
    }

    // Handle negative numbers
    if ($number < 0) {
        return $negative . convertNumberToWords(abs($number));
    }

    // Split the number into the integer and decimal parts
    $integerPart = (int) $number;
    $fractionalPart = round($number - $integerPart, 2) * 100;

    $string = '';

    // Convert the integer part
    if ($integerPart > 0) {
        $string = convertNumberToWordsInteger($integerPart, $dictionary, $hyphen, $conjunction, $separator);
    } else {
        $string = $dictionary[0];
    }

    // Convert the fractional part if it exists
    if ($fractionalPart > 0) {
        $string .= $decimal;
        foreach (str_split((string) $fractionalPart) as $digit) {
            $string .= $dictionary[$digit] . ' ';
        }
        $string = rtrim($string);
    }

    return $string;
}

function convertNumberToWordsInteger($number, $dictionary, $hyphen, $conjunction, $separator) {
    switch (true) {
        case $number < 21:
            return $dictionary[$number];
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            return $dictionary[$tens] . ($units ? $hyphen . $dictionary[$units] : '');
        case $number < 1000:
            $hundreds = (int) ($number / 100);
            $remainder = $number % 100;
            return $dictionary[$hundreds] . ' ' . $dictionary[100] . ($remainder ? $conjunction . convertNumberToWordsInteger($remainder, $dictionary, $hyphen, $conjunction, $separator) : '');
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            return convertNumberToWordsInteger($numBaseUnits, $dictionary, $hyphen, $conjunction, $separator) . ' ' . $dictionary[$baseUnit] . ($remainder ? $separator . convertNumberToWordsInteger($remainder, $dictionary, $hyphen, $conjunction, $separator) : '');
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        /* Your custom CSS styles here to match the image format */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .invoice {
            border: 1px solid #ccc;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between; /* Align content on both sides */
            align-items: flex-start;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .invoice-header p {
            margin: 0;
        }

        .invoice-header .bill-number {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        .invoice-header .company-info {
            text-align: left;
        }

        .bill-to p {
            margin: 0; /* Remove extra distance between lines */
        }
    </style>
</head>
<body>
    <div class="invoice">
         <div class="invoice-header">
            <!-- Company Logo and Info -->
            <div class="company-logo-info">
                <img src="<?php echo base_url() ?>assets/dist/img/img.jpg" alt="Company Logo" style="width: 110px; height: 110px;">
                <div class="company-info">
                    <p>AUYABAD ROAD INDUSTRIAL AREA VIJAYAPURA, VIJAYAPURA, KA (29) 586104, IN</p>
                    <p><strong>GSTIN:</strong> 29AAACJ9541H1Z1, <strong>PAN:</strong> AACJ9541B</p>
                </div>
            </div>
           <h3 style="margin: 0; font-family: Fantasy; text-align: center;">TAX INVOICE</h3>
            <!-- Bill Number -->
            <div class="bill-number">
                <p>Original for recipient</p>
                <p><strong>#<?= $bill_no ?></strong></p>
            </div>
        </div>

          <div style="width: 30%; margin-left: auto; border: 1px solid black; padding: 10px; text-align: center; font-weight: bold; font-size: 14px; background-color: #008B8B; color: white;">
                Amount Due
          </div>


        <table style="width: 30%; margin-top: 10px; margin-left: auto; text-align: right; border-collapse: collapse; font-size: 12px;">
            <tr>
                <td><strong>Issue Date:</strong></td>
                <td><?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td><strong>Due Date:</strong></td>
                <td><?= date('d-m-Y') ?></td>
            </tr>
            <tr>
                <td><strong>Place for Supply:</strong></td>
                <td colspan="3">KA(26)</td>
            </tr>
        </table>

        <div class="bill-to">
            <p style="font-weight: bold;"><strong>Bill To</strong></p>
            <p>Chandrakant</p>
            <p>gulbarga, GULBARGA, KA (29) IN</p>
        </div>

        <table>
            <thead style="background-color: #008B8B; color: white;">
                <tr>
                    <td>S.No</td>
                    <td>Product Name</td>
                    <td>HSN Code</td>
                    <td>Qty</td>
                    <td>Pieces/Pkts</td>
                    <td>Taxable Value(gst)</td>
                    <td>CGST</td>
                    <td>SGST</td>
                    <td>Line Total Amt</td>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($items as $item): ?>
                <tr>
                    <td><strong><?= $i++ ?></strong></td>
                    <td><strong><?= $item['product_name'] ?></strong></td>
                    <td><strong><?= $item['s_hsn_code'] ?></strong></td>
                    <td><strong><?= $item['s_dozens'] ?></strong></td>
                    <td><strong><?= $item['s_pieces_pkt'] ?></strong></td>
                    <td><strong><?= number_format($item['s_gst_amt'], 2) ?></strong></td>
                    <td><strong><?= number_format($item['s_cgst'], 2) ?></strong></td>
                    <td><strong><?= number_format($item['s_sgst'], 2) ?></strong></td>
                    <td><strong><?= number_format($item['s_line_total'], 2) ?></strong></td>
                </tr>
                <?php endforeach; ?>
                <tr style="background-color: #e0f7fa; color: #007bb5;">
                    <td colspan="5">Total @ 18%</td>
                    <td><?= number_format($total_gst, 2) ?></td>
                    <td><?= number_format($total_cgst, 2) ?></td>
                    <td><?= number_format($total_sgst, 2) ?></td>
                    <td><?= number_format($total_amount, 2) ?></td>
                </tr>

            </tbody>
            <tfoot>
                <tr  style="background-color: #e0f7fa; color: #007bb5;">
                    <td colspan="5">Total Taxable Value</td>
                    <td colspan="4">₹<?= number_format($total_gst, 2) ?></td>
                </tr>
                <tr  style="background-color: #e0f7fa; color: #007bb5;">
                    <td colspan="5">Total Value(in figure)</td>
                    <td colspan="4">₹<?= number_format($total_amount, 2) ?></td>
                </tr>
                <tr  style="background-color: #e0f7fa; color: #007bb5;">
                    <td colspan="5">Total Value (in words)</td>
                    <td colspan="4">Rs. <?= ucwords(convertNumberToWords($total_amount)) ?> Only</td>
                </tr>


            </tfoot>
        </table>
    </div>
</body>
</html>
