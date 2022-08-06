<div class="container section-container">
    <div class="section-header">
        <h3>Add Class</h3>
        <p>Mention details below to add class and setup your school</p>
    </div>
    <?php
    require_once('main/config.php');
    if (!empty($_SESSION['user_type'])) {
        $session_user_id = $_SESSION['user_id'];
    } else {
        $session_user_id = 0;
    }

    if (isset($_POST['submit'])) {
        $class_name = $_POST['class_name'];
        $class_section = $_POST['class_section'];
        $class_added_by = $session_user_id;
        $class_status = 1;

        $query = "INSERT INTO `classes`(
            `class_name`, 
            `class_section`, 
            `class_added_by`, 
            `class_status`) VALUES (
                '$class_name',
                '$class_section',
                '$class_added_by',
                '$class_status')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Oops! Classes could not be added!" . mysqli_error($connection));
        } else {
            echo "<div class='alert alert-success' role='alert'>
                 $class_name $class_section has been added!
               </div>";
        }
    }
    ?>
    <form method="POST" action="" class="card p-5">
        <div id='new-input-field' class='d-flex justify-content-center align-items-center w-100'>
            <div class='form-floating mb-3 w-100 m-1'>
                <input type='text' name='class_name' class='form-control' id='floatingInput'
                    placeholder='name@example.com'>
                <label for='floatingInput'>Class Name</label>
            </div>
            <div class='form-floating mb-3 w-100 m-1'>
                <input type='text' name='class_section' class='form-control' id='floatingPassword'
                    placeholder='Password'>
                <label for='floatingPassword'>Section</label>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-outline-primary mb-3 mt-3">Add Class</button>
    </form>

    <div class="section-header mt-5 mb-5">
        <h5>View Added Clases</h5>
        <div class="mt-4">
            <div class="tab-wrap-view">
                <?php
                if (isset($_POST['delete'])) {
                    $class_id = $_POST['class_id'];
                    $delete_query = "DELETE FROM `classes` WHERE class_id = $class_id";
                    $delete_result = mysqli_query($connection, $delete_query);
                    if (!$delete_result) {
                        die(mysqli_error($connection));
                    }
                }

                $fetch_subjects = "SELECT * FROM `classes` WHERE class_added_by = $session_user_id";
                $fetch_subjects_result = mysqli_query($connection, $fetch_subjects);
                while ($row = mysqli_fetch_assoc($fetch_subjects_result)) {
                    $class_id = $row['class_id'];
                    $class_name = $row['class_name'];
                    $class_section = $row['class_section'];
                    $class_status = $row['class_status'];
                ?>
                <form action="" method="POST" class="subject-wrapper-card">
                    <div class="d-flex justify-content-center align-items-center">
                        <input type="text" name="class_id" value="<?php echo $class_id; ?>" hidden>
                        <p class="setup-subject-name"><?php echo $class_name . $class_section; ?></p>
                        <button type="submit" name="delete" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Delete <?php echo $class_name ?>" class="btn btn-sm cross-button">X</button>
                    </div>
                </form>
                <?php
                } ?>
            </div>
        </div>
    </div>

    <div class="section-header mt-5 mb-5">
        <h5>Assign Class Teacher</h5>

        <?php
        if (isset($_POST['update'])) {
            $class_id = $_POST['class_id'];
            $class_teacher = $_POST['class_teacher'];
            $update_class = "UPDATE `classes` SET `class_teacher`= $class_teacher WHERE class_id = $class_id";
            $update_class_result = mysqli_query($connection, $update_class);
            if (!$update_class_result) {
                die("ERROR 404: " . mysqli_error($connection));
            } else {
                echo "<div class='alert alert-warning mt-3' role='alert'>Class Teacher Assigned! <a href='manage.php' style='text-decoration: none !important;'>Click here</a> to go back to Menu</div>";
            }
        }
        ?>
        <form method="POST" action="" class="card p-5 mt-3">
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
            <button type="submit" name="update" class="btn btn-outline-primary mb-3 mt-3">Assign Class Teacher</button>
        </form>


    </div>


</div>