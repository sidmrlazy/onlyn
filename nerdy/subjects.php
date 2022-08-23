<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="library" class="section-heading-icon"></ion-icon>
                Add Subjects
            </h3>
            <p class="section-desc">Add or Delete Subjects</p>
        </div>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['submit'])) {
            $subject_name = $_POST['subject_name'];
            $subject_added_by = $session_user_id;
            $subject_status = 1;

            if ($subject_name == "") {
                echo "<div class='alert alert-danger' role='alert'>Oops! Looks like you forgot to mention the subjects name.</div>";
            } else {
                $query = "INSERT INTO `subjects`(
            `subject_name`,
            `subject_added_by`, 
            `subject_status`) VALUES (
                '$subject_name',
                '$subject_added_by',
                '$subject_status')";
                $result = mysqli_query($connection, $query);

                if (!$result) {
                    die("<div class='alert alert-danger' role='alert'>ERROR 404!</div>" . mysqli_error($connection));
                } else {
                    echo "<div class='alert alert-success' role='alert'>$subject_name has been added!</div>";
                }
            }
        }

        ?>
        <form method="POST" action="" class="card p-3">
            <div class="btn-row w-100">
                <div class="form-floating mb-3 w-100">
                    <input type="text" name="subject_name" class="w-100 form-control" id="floatingInput"
                        placeholder="name@example.com">
                    <label for="floatingInput">Subject Name</label>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-outline-warning mb-3">ADD SUBJECT</button>
        </form>

        <div class="section-header mt-5 mb-5">
            <div class="section-header">
                <h3 class="section-heading">
                    <ion-icon name="library" class="section-heading-icon"></ion-icon>
                    View Subjects
                </h3>
                <p class="section-desc">View all subjects added by you</p>
            </div>
            <div class="mt-4">
                <div class="tab-wrap-view">
                    <?php
                    if (isset($_POST['delete'])) {
                        $subject_id = $_POST['subject_id'];
                        $delete_query = "DELETE FROM `subjects` WHERE subject_id = $subject_id";
                        $delete_result = mysqli_query($connection, $delete_query);
                        if (!$delete_result) {
                            die(mysqli_error($connection));
                        }
                    }

                    $fetch_subjects = "SELECT * FROM `subjects` WHERE subject_added_by = $session_user_id";
                    $fetch_subjects_result = mysqli_query($connection, $fetch_subjects);
                    while ($row = mysqli_fetch_assoc($fetch_subjects_result)) {
                        $subject_id = $row['subject_id'];
                        $subject_name = $row['subject_name'];
                        $subject_status = $row['subject_status'];
                    ?>
                    <form action="" method="POST" class="subject-wrapper-card">
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="text" name="subject_id" value="<?php echo $subject_id; ?>" hidden>
                            <p class="setup-subject-name"><?php echo $subject_name; ?></p>
                            <button type="submit" name="delete" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Delete <?php echo $subject_name ?>" class="btn btn-sm cross-button">X</button>
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