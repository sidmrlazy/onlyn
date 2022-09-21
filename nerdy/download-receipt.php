        <?php
        require('fpdf/fpdf.php');
        require('main/config.php');
        if (isset($_POST['download'])) {

            $fee_month = $_POST['fee_month'];
            $fee_contact = $_POST['fee_contact'];

            $search_student_query = "SELECT * FROM `students` WHERE `student_father_contact` = '$fee_contact'";
            $search_student_result = mysqli_query($connection, $search_student_query);

            $student_id = "";
            $student_roll_number = "";
            $student_name = "";
            $student_assigned_class = "";
            $student_assigned_school = "";
            $student_address = "";
            $student_city = "";
            $student_state = "";
            $student_pincode = "";
            while ($row = mysqli_fetch_assoc($search_student_result)) {
                $student_id  = $row['student_id'];
                $student_roll_number  = $row['student_roll_number'];
                $student_name  = $row['student_name'];
                $student_assigned_class  = $row['student_assigned_class'];
                $student_assigned_school  = $row['student_assigned_school'];
                $student_address  = $row['student_address'];
                $student_city  = $row['student_city'];
                $student_state  = $row['student_state'];
                $student_pincode  = $row['student_pincode'];
            }

            // // PDF Data
            $html = '<!DOCTYPE html>';
            $html .= '<html lang="en">';
            $html .= '<head>';
            $html .= '<meta charset="utf-8" />';
            $html .= '<meta name="viewport" content="width=device-width, initial-scale=1" />';
            $html .= '<link
                  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
                  rel="stylesheet"
                  integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
                  crossorigin="anonymous"
                />';
            $html .= '</head>';
            $html = '<style>
              .custom-table {
                width: 50%;
              }
              </style>';

            $html = '<table class="table table-bordered custom-table">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th scope="col">Student Name</th>';
            $html .= '<th scope="col">Address</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $html .= '<tr>';
            $html .= '<td>' . $student_name . '</td>';
            $html .= '<td>' . $student_address . ", " . $student_city . ". " . $student_state . " - " . $student_pincode . '</td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            // // $html .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>';


            $query = "SELECT * FROM `fee_collection` WHERE `fee_school_student_id` = '$student_id' AND `fee_collection_date` = '$fee_month'";
            $result = mysqli_query($connection, $query);

            // // Paid Fee Details
            $html .= '<table class="table table-bordered">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th scope="col">Receipt Number</th>';
            $html .= '<th scope="col">TXN Date</th>';
            $html .= '<th scope="col">Fee Type</th>';
            $html .= '<th scope="col">Amount Paid</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                $fee_collection_added_date = $row['fee_collection_added_date'];
                $fee_collection_type = $row['fee_collection_type'];

                $fee_collection_amount = $row['fee_collection_amount'];
                $fee_collection_receipt = $row['fee_collection_receipt'];
                if ($fee_collection_type == 1) {
                    $fee_collection_type_name = "Registration Fee";
                }
                if ($fee_collection_type == 2) {
                    $fee_collection_type_name = "Monthly Fee";
                }
                if ($fee_collection_type == 3) {
                    $fee_collection_type_name = "Uniform | School Dress Fee";
                }
                if ($fee_collection_type == 4) {
                    $fee_collection_type_name = "Admission Fee";
                }
                if ($fee_collection_type == 5) {
                    $fee_collection_type_name = "Sports Fee";
                }

                $html .= '<tr>';
                $html .= '<td>' . $fee_collection_receipt . '</td>';
                $html .= '<td>' . date('d-M-Y', strtotime($fee_collection_added_date)) . '</td>';
                $html .= '<td>' . $fee_collection_type_name . '</td>';
                $html .= '<td>' . "₹" . $fee_collection_amount . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</body>';
            $html .= '</html>';

            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(30, 10, 'Hello World', 1);
            $pdf->Output();
        }