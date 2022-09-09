<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid dashboard-structure">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <div class="section-header mt-3">
            <h3 class="section-heading">
                <ion-icon name="ribbon" class="section-heading-icon"></ion-icon>
                Select Class
            </h3>
            <p class="section-desc">Select class and date to view all past homeworks added by you</p>
        </div>

        <form action="student-show-all-hw.php" method="POST" enctype="multipart/form-data" class="card p-4 col-md-4">
            <?php
            $user = "SELECT * FROM users WHERE user_id = $session_user_id";
            $user_res = mysqli_query($connection, $user);
            $user_contact = "";
            while ($row = mysqli_fetch_assoc($user_res)) {
                $user_contact = $row['user_contact'];
            }

            $query = "SELECT * FROM `students` WHERE `student_father_contact` = '$user_contact'";
            $result = mysqli_query($connection, $query);
            $hw_class = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $hw_class = $row['student_assigned_class'];
            } ?>
            <input type="text" name="hw_class" value="<?php echo $hw_class ?>" placeholder="<?php echo $hw_class ?>"
                hidden>
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