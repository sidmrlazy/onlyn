<?php
require('includes/db.php');

if (isset($_POST['download'])) {
    // Fetch all records from the user_form table
    $fetch = "SELECT * FROM `user_form` ORDER BY `user_form_submit_date` DESC";
    $fetch_r = mysqli_query($connection, $fetch);

    $count = mysqli_num_rows($fetch_r);

    if ($count > 0) {
        // Create a temporary directory for storing the CSV and Zip file
        $tempDir = 'temp/';
        if (!is_dir($tempDir)) {
            mkdir($tempDir);
        }

        // Generate a unique filename for the CSV file
        $csvFilename = $tempDir . 'user_form_data.csv';

        // Open the CSV file for writing
        $csvFile = fopen($csvFilename, 'w');

        // Output CSV column headers
        fputcsv($csvFile, array(
            'REFERENCE NUMBER',
            'EMP ID',
            'EMP MOBILE NUMBER',
            'EMP EMAIL ID',
            'CANDIDATE CONTACT',
            'CANDIDATE NAME',
            'CANDIDATE E-MAIL ID',
            'POSITION APPLIED FOR',
            'APPLIED DATE'
        ));

        // Output data from user_form table to the CSV file
        while ($row = mysqli_fetch_assoc($fetch_r)) {
            fputcsv($csvFile, array(
                $row['user_form_ref_number'],
                $row['user_form_emp_id'],
                $row['user_form_contact'],
                $row['user_form_email'],
                $row['user_form_ref_contact'],
                $row['user_form_ref_name'],
                $row['user_form_ref_email'],
                $row['user_form_ref_position'],
                date('d-M-Y h:i', strtotime($row['user_form_submit_date']))
            ));
        }

        // Close the CSV file
        fclose($csvFile);

        // Create a ZipArchive
        $zip = new ZipArchive();
        $zipFilename = $tempDir . 'user_form_data.zip';

        // Open the Zip archive for writing
        if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Add the CSV file to the Zip archive
            $zip->addFile($csvFilename, basename($csvFilename));

            // Close the Zip archive
            $zip->close();

            // Output headers to force a download of the Zip file
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="user_form_data.zip"');
            header('Content-Length: ' . filesize($zipFilename));

            // Read the Zip file and output its contents
            readfile($zipFilename);

            // Remove the temporary directory and files
            unlink($csvFilename);
            unlink($zipFilename);
            rmdir($tempDir);

            // Exit to prevent any additional output
            exit;
        }
    }
}
