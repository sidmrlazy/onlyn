<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header mb-5">
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="glasses" class="section-heading-icon"></ion-icon>
                    Assign Class Teacher
                </h3>
                <p class="section-desc">Assign a class teacher to a class from the dropdown</p>
            </div>

            <?php
            if (isset($_POST['update'])) {
                $class_id = $_POST['class_id'];
                $class_teacher = $_POST['class_teacher'];

                $check_status = "SELECT * FROM `classes` WHERE class_teacher = $class_teacher AND class_id = $class_id";
                if (mysqli_query($connection, $check_status)) {
                    echo "<div class='alert alert-warning mt-3 mb-3' role='alert'>This teacher has already been assigned a class</div>";
                } else {
                    $update_class = "UPDATE `classes` SET `class_teacher`= $class_teacher WHERE class_id = $class_id";
                    $update_class_result = mysqli_query($connection, $update_class);
                    if (!$update_class_result) {
                        die("ERROR 404: " . mysqli_error($connection));
                    } else {
                        $update_user_type = "UPDATE `users` SET `user_type` = 5 WHERE user_id = $class_teacher";
                        $update_user_type_result = mysqli_query($connection, $update_user_type);
                        echo "<div class='alert alert-warning mt-3 mb-3' role='alert'>Class Teacher Assigned! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu</div>";
                    }
                }
            }
            ?>
            <form method="POST" action="" class="card p-3 mt-3">
                <div class="form-floating mb-3">
                    <select class="form-select" name="class_id" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option>Click here to get options</option>
                        <?php
                        $fetch_class_teacher = "SELECT * FROM classes WHERE class_added_by = $session_user_id";
                        $fetch_class_teacher_result = mysqli_query($connection, $fetch_class_teacher);
                        while ($row = mysqli_fetch_assoc($fetch_class_teacher_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                        ?>
                        <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?></option>
                        <?php
                        } ?>
                    </select>
                    <label for="floatingSelect">Select Class</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="class_teacher" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option>Click here to get options</option>
                        <?php
                        $fetch_class_teacher = "SELECT * FROM users WHERE user_type = 3 AND user_added_by = $session_user_id";
                        $fetch_class_teacher_result = mysqli_query($connection, $fetch_class_teacher);
                        while ($row = mysqli_fetch_assoc($fetch_class_teacher_result)) {
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name']; ?>
                        <option value="<?php echo $user_id ?>"><?php echo $user_name ?></option>
                        <?php
                        } ?>
                    </select>
                    <label for="floatingSelect">Select Class Teacher</label>
                </div>
                <button type="submit" name="update" class="btn btn-outline-primary mb-3 mt-3">Assign Class
                    Teacher</button>
            </form>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>