<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Course Settings</h5>
    </div>

    <div class="user-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Tenure</th>
                    <th scope="col">Semester Name</th>
                    <th scope="col">Fee</th>
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                require('includes/connection.php');
                $fetch_semester = "SELECT * FROM `bora_semester`";
                $fetch_sem_res = mysqli_query($connection, $fetch_semester);
                while ($row = mysqli_fetch_assoc($fetch_sem_res)) {
                    $semester_course_id = $row['semester_course_id'];


                    $semester_name = $row['semester_name'];
                    $semester_fee = $row['semester_fee'];

                ?>
                <tr>
                    <th scope="row"><?php
                                        if ($semester_course_id) {
                                            $fetch_course = "SELECT * FROM `bora_course` WHERE `course_id` = '$semester_course_id'";
                                            $fetch_course_res = mysqli_query($connection, $fetch_course);
                                            $course_name = "";
                                            $course_tenure = "";
                                            while ($row = mysqli_fetch_assoc($fetch_course_res)) {
                                                $course_name = $row['course_name'];
                                                $course_tenure = $row['course_tenure'];
                                            }
                                        }
                                        echo $course_name ?></th>
                    <td><?php echo $course_tenure ?></td>
                    <td><?php echo $semester_name ?></td>
                    <td>₹<?php echo $semester_fee ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>