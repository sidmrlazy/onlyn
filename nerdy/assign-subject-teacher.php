<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="mb-5 col-md-6">
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="glasses" class="section-heading-icon"></ion-icon>
                    Assign Subject Teacher
                </h3>
                <p class="section-desc">Assign Teacher and class to a subject</p>
            </div>

            <div class="card p-3">
                <?php
                if (isset($_POST['assign'])) {
                    $user_id = $_POST['teacher_assigned'];
                    $teacher_assigned_subject = $_POST['teacher_assigned_subject'];
                    $teacher_assigned_class = $_POST['teacher_assigned_class'];

                    $assign_teacher_query = "INSERT INTO `teacher_class_assignment`(
                         `teacher_assigned`, 
                         `teacher_assigned_subject`, 
                         `teacher_assigned_class`, 
                         `teacher_assigned_by`) VALUES (
                             '$user_id',
                             '$teacher_assigned_subject',
                             '$teacher_assigned_class',
                             '$session_user_id')";
                    $assign_teacher_result = mysqli_query($connection, $assign_teacher_query);
                    if ($assign_teacher_result) {
                        echo "<script>subjectAssign()</script>";
                    } else {
                        die("Failed" . mysqli_error($connection));
                    }
                }
                ?>
                <form action="" method="POST">
                    <div class="mob-flex d-flex">
                        <!-- <input type="text" name="teacher_assigned" value="<?php echo $user_name ?>" hidden> -->
                        <!-- Subject -->
                        <select class="form-select equal-flex m-1" name="teacher_assigned"
                            aria-label="Default select example">
                            <option selected>Select Teacher</option>
                            <?php
                            $get_teacher = "SELECT * FROM users WHERE user_added_by = $session_user_id";
                            $get_teacher_result = mysqli_query($connection, $get_teacher);
                            $count_subjects = mysqli_num_rows($get_teacher_result);
                            while ($row = mysqli_fetch_array($get_teacher_result)) {
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                                $user_type = $row['user_type'];
                                if ($user_type == 3 || $user_type  == 5) {
                            ?>
                            <option value="<?php echo $user_id ?>"><?php echo $user_name ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>

                        <!-- Subject -->
                        <select class="form-select equal-flex m-1" name="teacher_assigned_subject"
                            aria-label="Default select example">
                            <option selected>Select Subject</option>
                            <?php
                            $get_subject = "SELECT * FROM subjects WHERE subject_added_by = $session_user_id";
                            $get_subject_result = mysqli_query($connection, $get_subject);
                            $count_subjects = mysqli_num_rows($get_subject_result);
                            while ($row = mysqli_fetch_array($get_subject_result)) {
                                $subject_name = $row['subject_name'];

                            ?>
                            <option value="<?php echo $subject_name ?>">
                                <?php echo $subject_name ?></option>
                            <?php
                            }

                            ?>
                        </select>

                        <!-- Class -->
                        <select class="form-select equal-flex m-1" name="teacher_assigned_class"
                            aria-label="Default select example">
                            <option selected>Select Class</option>
                            <?php
                            $get_classes = "SELECT * FROM classes WHERE class_added_by = $session_user_id";
                            $get_classes_result = mysqli_query($connection, $get_classes);
                            $count_subjects = mysqli_num_rows($get_classes_result);
                            while ($row = mysqli_fetch_array($get_classes_result)) {
                                $class_id = $row['class_id'];
                                $class_name = $row['class_name'];
                                $class_section = $row['class_section'];

                            ?>
                            <option value="<?php echo $class_id ?>">
                                <?php echo $class_name . $class_section ?></option>
                            <?php
                            }

                            ?>
                        </select>

                    </div>
                    <button type="submit" name="assign" class="btn btn-outline-primary w-100 mt-3">Assign</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>