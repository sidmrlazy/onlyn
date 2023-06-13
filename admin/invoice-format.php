<?php
require('includes/connection.php');
require('tcpdf/tcpdf.php');

if (isset($_POST['invoice'])) {
    $bora_receipt_number = $_POST['bora_receipt_number'];
    $bora_invoice_date = isset($_POST['bora_invoice_date']) ? $_POST['bora_invoice_date'] : '';

    $query = "SELECT * FROM `bora_invoice` WHERE `bora_invoice_number` = '$bora_receipt_number'";
    $res = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($res)) {
        $bora_invoice_number = $row['bora_invoice_number'];
        $bora_invoice_date = $row['bora_invoice_date'];
        $bora_invoice_student = $row['bora_invoice_student'];
        $bora_invoice_student_address = $row['bora_invoice_student_address'];
        $bora_invoice_student_contact = $row['bora_invoice_student_contact'];
        $bora_invoice_student_course = $row['bora_invoice_student_course'];
        $bora_invoice_for = $row['bora_invoice_for'];
        $bora_invoice_tenure = $row['bora_invoice_tenure'];
        $bora_invoice_value = $row['bora_invoice_value'];
        $bora_invoice_disc = $row['bora_invoice_disc'];

        $bora_invoice_payment_mode = $row['bora_invoice_payment_mode'];

        if ($bora_invoice_payment_mode == 'cheque') {
            $bora_invoice_payment_mode = 'CHEQUE';
        } else if ($bora_invoice_payment_mode == 'online') {
            $bora_invoice_payment_mode = 'ONLINE';
        } else if ($bora_invoice_payment_mode == 'DemandDraft') {
            $bora_invoice_payment_mode = 'DD';
        } else if ($bora_invoice_payment_mode == 'cash') {
            $bora_invoice_payment_mode = 'CASH';
        }

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAutoPageBreak(true, 0);

        $imageFile = '../assets/images/logo/brand-logo.webp';
        $imageWidth = 50; // Set the desired width of the image
        $imageHeight = 50; // Set the desired height of the image
        $imageX = 10; // Set the X coordinate for image placement
        $imageY = 10; // Set the Y coordinate for image placement

        $pdf->Image($imageFile, $imageX, $imageY, $imageWidth, $imageHeight);

        $pdf->SetCreator('BIAHS');
        $pdf->SetAuthor('Bora Institute of Allied Health Sciences');
        $pdf->SetTitle($bora_invoice_number);

        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        $pdf->SetDisplayMode('fullwidth', 'single');
        ob_start();

        $content = '
<!doctype html>
<html lang="en">

<head>
    <meta name="robots" content="noindex" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- =========== SEO =========== -->
    <meta name="keywords" content="">
    <meta name="description" content="">

    <!-- =========== JQUERY =========== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- =========== FAVICON =========== -->
    <link rel="shortcut icon" href="../assets/images/logo/brand-favicon.webp" type="image/x-icon">

    <!-- =========== LOTTIE =========== -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- =========== GOOGLE FONTS =========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">


    <title>Admin | BIAHS</title>

    <!-- =========== BOOTSTRAP =========== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>   
    <div>
        <div>
            <h1>Bora Institute of Allied Health Sciences</h1>
            <p>Bora Institute of Nursing & Paramedical Sciences. Sewa Nagar, NH-24 Sitaur Road. Lucknow - 226201.
                <strong>Contact:</strong> +91 9569863933 | +91 9305748634. <br><strong>Email:</strong> abc@xyz.com.
                <strong>Website:</strong> borainstitute.com
            </p>
        </div>

        <table style="margin-bottom: 5px;">
            <thead>
                <tr>
                    <th scope="col" colspan="4" style="border: 1px solid #000"> INVOICE NUMBER</th>
                    <th scope="col" colspan="4" style="border: 1px solid #000"> INVOICE DATE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;" colspan="4"><p><strong> ' . $bora_invoice_number . '</strong></p></td>
                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;" colspan="4"><p><strong> ' . $bora_invoice_date . ' </strong></p></td>
                </tr>
            </tbody>
        </table>
        
        
        <table style="margin-top: 5px;">
            <thead>
                <tr>
                    <th scope="col" colspan="4" style="border: 1px solid #000"> BILL TO:<strong> ' . $bora_invoice_student . '</strong></th>
                    <th scope="col" colspan="4" style="border: 1px solid #000"> BILLING FOR: <strong>' . $bora_invoice_student_address . "|" . $bora_invoice_student_contact . '</strong></th>
                </tr>
            </thead>
        </table>

       
        
    
        <table class="table table-bordered ">
            <thead style="border: 1px solid #000">
                <tr>
                    <th style="border: 1px solid #000" scope="col"> ITEM</th>
                    <th style="border: 1px solid #000" scope="col"> SEMESTER</th>
                    <th style="border: 1px solid #000" scope="col"> COLLECTED AMOUNT</th>
                    <th style="border: 1px solid #000" scope="col"> DISCOUNT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;">
                        <p> ' . $bora_invoice_for . '</p>
                    </td>
                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;">
                        <p> ' . $bora_invoice_tenure . '</p>
                    </td>

                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;">
                        <p> Rs.' . $bora_invoice_value . '</p>
                    </td>

                    <td scope="row" style="border: 1px solid #000; padding: 10px !important;">
                        <p> Rs.' . $bora_invoice_disc . '</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-top: 5px;">
        <thead>
            <tr>
                <th scope="col" colspan="4" style="border: 1px solid #000">PAYMENT MODE:<strong> ' . $bora_invoice_payment_mode . '</strong></th>
            </tr>
        </thead>
    </table>

        <div>
            <p>Authorized Signatory: </p>
        </div>

    </div>


<!-- ========= BOOTSTRAP ========= -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

<!-- ========= JAVASCRIPT ========= -->
<script src="assets/custom.js"></script>

<!-- ========= IONICONS ========= -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
';

        $pdf->writeHTML($content, true, false, true, false, '');

        ob_end_clean();

        $pdf->Output('assets/invoice/invoice.pdf', 'I');
    }
}
