<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="business" class="section-heading-icon"></ion-icon>
                Add Class
            </h3>
            <p class="section-desc">View past announcements made by you</p>
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
        <form method="POST" action="" class="card p-3">
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
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="business" class="section-heading-icon"></ion-icon>
                    View Class
                </h3>
                <p class="section-desc">View or Delete classes added by you</p>
            </div>
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
                                title="Delete <?php echo $class_name ?>" class="btn btn-sm cross-button">
                                <ion-icon name="trash-outline" class="m-0"></ion-icon>
                            </button>
                        </div>
                    </form>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('main/footer.php'); ?>