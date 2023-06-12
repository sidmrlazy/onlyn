<?php
require('includes/connection.php');
require('tcpdf/tcpdf.php');

if (isset($_POST['invoice'])) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator('Bora Institute');
    $pdf->SetAuthor('Bora Institute');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('Invoice, Bora Institute');

    $pdf->SetHeaderData('', 0, 'Bora Institute of Allied Health Sciences', 'Bora Institute of Nursing & Paramedical Sciences. Sewa Nagar, NH-24 Sitaur Road. Lucknow - 226201.', ['+91 9569863933 | +91 9305748634'], ['abc@xyz.com'], ['borainstitute.com']);

    $pdf->setFooterData(['0' => ['|Page {PAGENO}|']]);
    $pdf->SetFont('dejavusans', '', 12);

    $pdf->AddPage();

    $content = 'invoice-format.php';

    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->Output('invoice.pdf', 'I');

    exit;
}
