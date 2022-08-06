<div class="container">
    <div class="container section-container table-responsive">
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['submit'])) {
            $class_id = $_POST['class_id'];
            $query = "SELECT * FROM student_attendance WHERE attendance_class_id = $class_id";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
        ?>

            <div class="notification mb-3">
                <p class="m-0">Total students in this class: <span><?php echo $count ?></span></p>
            </div>


            <div class="card p-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $attendance_student_name = $row['attendance_student_name'];
                            $attendance_date = $row['attendance_date'];
                            $attendance_value = $row['attendance_value'];
                            if ($attendance_value == 1) {
                                $attendance_value = "Present";
                            } else if ($attendance_value == 2) {
                                $attendance_value = "Absent";
                            }
                        ?>
                            <tr>
                                <th scope="row"><?php echo $attendance_date ?></th>
                                <td><?php echo $attendance_student_name ?></td>
                                <td><?php echo $attendance_value ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>