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
                    <!-- <th scope="col">Fee</th> -->
                    <!-- <th scope="col">Delete</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                require('includes/connection.php');
                $fetch_course = "SELECT * FROM `bora_course`";
                $fetch_result = mysqli_query($connection, $fetch_course);
                while ($row = mysqli_fetch_assoc($fetch_result)) {
                    $course_id = $row['course_id'];
                    $course_name = $row['course_name'];
                    $course_tenure = $row['course_tenure'];
                    $course_semester_name = $row['course_semester_name'];
                    $course_fee = $row['course_fee'];
                    $course_status = $row['course_status'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $course_name ?></th>
                        <td><?php echo $course_tenure ?></td>

                        <!-- ========== COURSE SEMESTER NAME ========== -->
                        <?php
                        if (empty($course_semester_name)) { ?>
                            <td>
                                <form action="add-semester-name.php" method="POST">
                                    <input type="text" value="<?php echo $course_id ?>" name="course_id" hidden>
                                    <button type="submit" name="update_semester" class="btn btn-sm btn-outline-info">Add
                                        Semester</button>
                                </form>
                            </td>
                        <?php } else { ?>
                            <td><?php echo $course_semester_name ?></td>
                        <?php } ?>


                        <!-- ========== COURSE FEE ========== -->
                        <!-- <?php
                                if (empty($course_fee)) { ?>
                    <td>
                        <form action="assign-fee.php" method="POST">
                            <input type="text" value="<?php echo $course_id ?>" name="course_id" hidden>
                            <button type="submit" name="update" class="btn btn-sm btn-outline-primary">Assign Fee to
                                Semester</button>
                        </form>
                    </td>
                    <?php } else { ?>
                    <td>₹<?php echo $course_fee ?></td>
                    <?php } ?> -->

                        <!-- ========== COURSE STATUS ========== -->
                        <!-- <td>
                            <?php if ($course_status == "1") {
                                echo 'Active';
                            } else {
                                echo 'Disabled';
                            }
                            ?>
                        </td> -->

                        <!-- ========== COURSE EDIT ========== -->
                        <!-- <td>
                            <form action="" method="POST">
                                <input type="text" name="course_id" value="<?php echo $course_id ?>" hidden>
                                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                            </form>
                        </td> -->

                        <!-- ========== COURSE DELETE ========== -->
                        <!-- <td>
                            <form action="" method="POST">
                                <input type="text" name="course_id" value="<?php echo $course_id ?>" hidden>
                                <button class="btn btn-sm btn-outline-danger">Del</button>
                            </form>
                        </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>