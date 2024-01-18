<?php
require('includes/db.php');

if (isset($_POST['download'])) {
    // Fetch all records from the user_form table
    $fetch = "SELECT * FROM `user_form` ORDER BY `user_form_submit_date` DESC";
    $fetch_r = mysqli_query($connection, $fetch);

    $count = mysqli_num_rows($fetch_r);

    if ($count > 0) {
        // Output headers to force a download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_form_data.csv"');

        // Open the output stream
        $output = fopen('php://output', 'w');

        // Output CSV column headers
        fputcsv($output, array(
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

        // Output data from user_form table
        while ($row = mysqli_fetch_assoc($fetch_r)) {
            fputcsv($output, array(
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

        // Close the output stream
        fclose($output);

        // Exit to prevent any additional output
        exit;
    }
}
