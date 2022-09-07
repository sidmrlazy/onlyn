<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard w-100 mb-5">
        <div class="section-header mb-5">
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="glasses" class="section-heading-icon"></ion-icon>
                    Edit Class Teacher
                </h3>
                <p class="section-desc">Assign a class teacher to a class from the dropdown</p>
            </div>
        </div>


        <?php
        if (isset($_POST['update'])) {
            $existing_class_id = $_POST['existing_class_id'];
            $selected_class_id = $_POST['class_id'];

            echo "EXISTING: " . $existing_class_id . "<br>";
            echo "SELECTED: " . $selected_class_id;

            $query = "SELECT * FROM classes WHERE class_id = $existing_class_id";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
                echo "Can be assigned";
            } else if ($count > 0) {

                $selected_class_id = "";
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected_class_id = $row['class_id'];
                    $selected_class_teacher = $row['class_teacher'];
                }
                echo "<script>updateClassTeacherModal()</script>";
            }
        }

        if (isset($_POST['edit'])) {
            $class_teacher = $_POST['class_teacher'];
            $check_status = "SELECT * FROM `classes` WHERE class_teacher = $class_teacher";
            $check_status_res = mysqli_query($connection, $check_status);
            $existing_class_id = "";
            $teacher_id = "";
            while ($row = mysqli_fetch_assoc($check_status_res)) {
                $existing_class_id = $row['class_id'];
                $teacher_id = $row['class_teacher'];
        ?>




        <form method="POST" action="" class="card p-3 mt-3 col-md-6">
            <input type="text" name="existing_class_id" value="<?php echo $existing_class_id ?>" hidden>
            <div class="mb-3">
                <label class="mb-2">Select Class</label>
                <select name="class_id" class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <?php
                            $fetch_class_teacher = "SELECT * FROM `classes` WHERE `class_added_by` = '$session_user_id'";
                            $fetch_class_teacher_result = mysqli_query($connection, $fetch_class_teacher);
                            while ($row = mysqli_fetch_assoc($fetch_class_teacher_result)) {
                                $class_id = $row['class_id'];
                                $class_name = $row['class_name'];
                                $class_section = $row['class_section'];
                            ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Assigned Class Teacher</label>
                <?php
                        $fetch_class_teacher = "SELECT * FROM users WHERE user_id = $teacher_id";
                        $fetch_class_teacher_result = mysqli_query($connection, $fetch_class_teacher);
                        $user_id = "";
                        while ($row = mysqli_fetch_assoc($fetch_class_teacher_result)) {
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];

                            if ($teacher_id == $user_id) { ?>
                <input type="text" disabled class="form-control" value="<?php echo $user_name ?>"
                    id="exampleFormControlInput1" placeholder="name@example.com">
                <?php }
                        } ?>
            </div>
            <button type="submit" name="update" class="btn btn-outline-primary mb-3 mt-3">Update</button>
        </form>

        <?php
            }
        }
        ?>
        <!-- Modal -->
        <div class="modal fade" id="updateClassTeacher" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alert!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="class_id" value="<?php echo $selected_class_id ?>" hidden>
                        <input type="text" name="class_teacher" value="<?php echo $selected_class_teacher ?>" hidden>
                        Are you sure you want to change the class for this teacher?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" name="yes" class="btn btn-success">Yes</button>
                    </div>
                </form>
            </div>
        </div>




    </div>
</div>
<?php include('main/footer.php'); ?>