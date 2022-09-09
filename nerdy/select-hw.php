<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="ribbon" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Select class and date to view all past homeworks added by you</p>
        </div>

        <form action="show-all-hw.php" method="POST" enctype="multipart/form-data" class="card p-4 col-md-4">
            <div class="form-floating mb-3">
                <select class="form-select" name="hw_class" id="examSubject" aria-label="Floating label select example">
                    <option selected>Select Class</option>
                    <?php
                    $query = "SELECT * FROM users WHERE user_id = $session_user_id";
                    $result = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_added_by = $row['user_added_by'];
                        $get_subjects = "SELECT * FROM `classes` WHERE `class_added_by` = $user_added_by";
                        $get_result = mysqli_query($connection, $get_subjects);
                        while ($row = mysqli_fetch_assoc($get_result)) {
                            $class_id = $row['class_id'];
                            $class_name = $row['class_name'];
                            $class_section = $row['class_section'];
                    ?>
                    <option value="<?php echo $class_id ?>"><?php echo $class_name . $class_section ?>
                    </option>
                    <?php }
                    } ?>
                </select>
                <label for="examSubject">Click here to get Class list</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" name="hw_date" class="form-control" placeholder="End Date">
                <label for="endDateInput">Date</label>
            </div>

            <div class="mb-3">
                <button type="submit" name="continue" class="btn w-100 btn-success">Continue</button>
            </div>
        </form>
    </div>
</div>
<?php include('main/footer.php'); ?>