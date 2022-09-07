<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
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
                $check_status_res = mysqli_query($connection, $check_status);
                $check_status_count = mysqli_num_rows($check_status_res);

                if ($check_status_count > 0) {
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
            <form method="POST" action="" class="card p-3 mt-3 col-md-6">
                <div class="form-floating mb-3">
                    <select class="form-select" name="class_id" id="floatingSelect"
                        aria-label="Floating label select example">
                        <option>Showing available classes</option>
                        <?php
                        $fetch_class_teacher = "SELECT * FROM classes WHERE class_added_by = $session_user_id AND class_teacher = ''";
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
                        <option>Showing available teachers</option>
                        <?php
                        $fetch_class_teacher = "SELECT * FROM users WHERE user_type = 3 OR user_type = 5 AND user_added_by = $session_user_id";
                        $fetch_class_teacher_result = mysqli_query($connection, $fetch_class_teacher);
                        $user_id = "";
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

            <div class="table-responsive mt-3 card p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Class teacher name</th>
                            <th scope="col">Class Assigned</th>
                            <th scope="col">Assigned on</th>
                            <th scope="col">Class Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $results_per_page = 4;

                        $query = "SELECT * FROM `classes`";
                        $result = mysqli_query($connection, $query);
                        $number_of_result = mysqli_num_rows($result);

                        $number_of_page = ceil($number_of_result / $results_per_page);

                        if (!isset($_GET['page'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }

                        $page_first_result = ($page - 1) * $results_per_page;

                        $fetch_class_details = "SELECT * FROM `classes` WHERE `class_added_by` = $session_user_id LIMIT " . $page_first_result . ',' . $results_per_page;;
                        $fetch_class_details_res = mysqli_query($connection, $fetch_class_details);

                        while ($row = mysqli_fetch_assoc($fetch_class_details_res)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                            $class_teacher = $row['class_teacher'];
                            $class_added_date = $row['class_added_date'];
                            $class_status = $row['class_status'];

                            $get_teacher = "SELECT * FROM `users` WHERE `user_id` = '$class_teacher'";
                            $get_teacher_res = mysqli_query($connection, $get_teacher);
                            $user_id = "";
                            while ($row = mysqli_fetch_assoc($get_teacher_res)) {
                                $user_id = $row['user_id'];
                                $user_name = $row['user_name'];
                            }
                        ?>
                        <tr>

                            <?php
                                if ($user_id == $class_teacher) {
                                ?>
                            <td><?php echo $user_name ?></td>
                            <?php } ?>

                            <td><?php echo $class_name . $class_section ?></td>
                            <td><?php echo $class_added_date ?></td>
                            <?php if ($class_status == 1) { ?>
                            <td>Active</td>
                            <?php }
                                if ($class_status == 2) { ?>
                            <td>In-Active</td>
                            <?php } ?>
                            <td class="text-center">
                                <form action="assign-class-teacher-2.php" method="POST">
                                    <input type="text" name="class_teacher" value="<?php echo $class_teacher ?>" hidden>
                                    <button type="submit" name="edit" class="btn btn-sm btn-outline-primary">
                                        <ion-icon name="create-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example" class="mt-4">
                <ul class="pagination">
                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        echo '<li class="page-item"><a class="page-link" href = "assign-class-teacher.php?page=' . $page . '">' . $page . ' </a></>';
                    }

                    ?>


                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>