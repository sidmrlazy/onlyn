<?php
include('main/config.php');
$output = "";
if (isset($_POST['download'])) {
    $attendance_class_id = $_POST['attendance_class_id'];
    $attendance_from_date = date('d-m-Y', strtotime($_POST['attendance_from_date']));
    $attendance_to_date = date('d-m-Y', strtotime($_POST['attendance_to_date']));
    $attendance_file_type = $_POST['attendance_file_type'];

    if ($attendance_file_type == 1) {
        $fetch_records = "SELECT `attendance_date`, `attendance_student_name`, `attendance_value`, `attendance_class_id` FROM `student_attendance` WHERE `attendance_class_id` = '$attendance_class_id' AND `attendance_date` >= '$attendance_from_date' AND `attendance_date` <= '$attendance_to_date'";
        $records_res = mysqli_query($connection, $fetch_records);
        $record_count = mysqli_num_rows($records_res);
        if ($record_count > 0) {
            $fetch_class = "SELECT * FROM `classes` WHERE `class_id` = $attendance_class_id";
            $fetch_class_r = mysqli_query($connection, $fetch_class);
            $class_name = "";
            $class_section = "";
            while ($row = mysqli_fetch_assoc($fetch_class_r)) {
                $class_name = $row['class_name'];
                $class_section = $row['class_section'];
            }
            echo "<div><h3>Showing Attendance log for Class" . $class_name . $class_section . "</h3><br><br><br></div>";
            $output .= '
                    <div class="table-responsive card p-3 mb-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead><tbody>';
            while ($row = mysqli_fetch_array($records_res)) {

                if ($row["attendance_value"] == "1") {
                    $row["attendance_value"] = "PRESENT";
                }
                if ($row["attendance_value"] == "2") {
                    $row["attendance_value"] = "ABSENT";
                }

                $output .= '                        
                            <tr>
                                <td>' . $row["attendance_date"] . '</td>
                                <td>' . $row["attendance_student_name"] . '</td>
                                <td>' . $row["attendance_value"] . '</td>
                            </tr>';
            }
            $output .= '
                        </tbody>
                    </table>
                    </div> 
                    ';
            $fileName = "attendance-log-" . $attendance_from_date . " to " . $attendance_to_date . ".xls";
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Type: application/vnd.ms-excel");
            echo $output;
        }
    }
}