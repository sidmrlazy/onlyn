<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <a href="update-student-diary.php" class="custom-tab">
            <ion-icon class="tab-icon" name="book-outline"></ion-icon>
            <p>Update Student Diary</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="class-teacher-edit-student-diary.php" class="custom-tab">
            <ion-icon class="tab-icon" name="newspaper-outline"></ion-icon>
            <p>Edit Student Diary</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>