<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="easel" class="section-heading-icon"></ion-icon>
                Showing all Homework
            </h3>
            <p class="section-desc">Caption required</p>
        </div>

        <div class="tab-wrap-view">
            <?php
            $query = "SELECT * FROM users WHERE user_id = $session_user_id";
            $result = mysqli_query($connection, $query);
            $user_contact = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $user_contact = $row['user_contact'];
            }

            $student = "SELECT * FROM students WHERE student_father_contact = $user_contact";
            $student_r = mysqli_query($connection, $student);
            $student_id = "";
            while ($row = mysqli_fetch_assoc($student_r)) {
                $student_id = $row['student_id'];
            }

            $query = "SELECT * FROM `student_diary` WHERE `diary_student_id` = '$student_id'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if ($count == 0) {
            ?>
            <div class="alert alert-danger" role="alert">No data found for this class on this date!</div>
            <?php
            } else if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $diary_id = $row['diary_id'];
                    $diary_student_id = $row['diary_student_id'];
                    $diary_topic = $row['diary_topic'];
                    $diary_details = $row['diary_details'];
                    $diary_added_date = $row['diary_added_date'];
                ?>
            <form action="" method="POST" class="hw-card">
                <button type="submit" name="open" class="hw-btn">
                    <input type="text" name="diary_id" value="<?php echo $diary_id ?>" hidden>
                    <p class="hw-card-title"><?php echo $diary_topic ?></p>
                    <p class="hw-card-date"><?php echo $diary_added_date ?></p>
                </button>
            </form>
            <?php
                }
            }

            if (isset($_POST['open'])) {
                $diary_id = $_POST['diary_id'];
                echo "<script>hwModal()</script>";
            }
            ?>

        </div>

        <!-- ============== HOMEWORK MODAL START ============== -->
        <div class="modal fade" id="hwModalOpen" tabindex="-1" aria-labelledby="hwModalOpenLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hwModalOpenLabel">Homework Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?php
                    $modal_query = "SELECT * FROM `student_diary` WHERE `diary_id` = $diary_id";
                    $modal_res = mysqli_query($connection, $modal_query);
                    if ($modal_res) {
                        while ($row = mysqli_fetch_assoc($modal_res)) {
                            $diary_id = $row['diary_id'];
                            $diary_topic = $row['diary_topic'];
                            $diary_details = $row['diary_details'];
                            $diary_added_date = $row['diary_added_date'];
                        }
                    }
                    ?>
                    <div class="modal-body">
                        <input type="text" name="diary_id" value="<?php echo $diary_id ?>" hidden>
                        <p class="hw-modal-title"><?php echo $diary_topic; ?></p>
                        <p class="hw-modal-details"><?php echo $diary_details; ?></p>
                        <p class="hw-modal-date"><?php echo $diary_added_date ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" name="del" class="btn btn-primary">Delete</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============== HOMEWORK MODAL END ============== -->

    </div>

</div>
<?php include('main/footer.php'); ?>