<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <a href="add-student.php" class="custom-tab">
            <ion-icon class="tab-icon" name="person-add-outline"></ion-icon>
            <p>Add Student</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="view-student.php" class="custom-tab">
            <ion-icon class="tab-icon" name="eye-outline"></ion-icon>
            <p>View | Edit Student Data</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="parent-login.php" class="custom-tab">
            <ion-icon class="tab-icon" name="lock-open-outline"></ion-icon>
            <p>Generate Parent Login</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>