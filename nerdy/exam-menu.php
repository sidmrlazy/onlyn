<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <a href="upload-online-exam.php" class="custom-tab">
            <ion-icon class="tab-icon" name="stopwatch-outline"></ion-icon>
            <p>Upload Online Exam | Test</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="class-teacher-upload-result.php" class="custom-tab">
            <ion-icon class="tab-icon" name="ribbon-outline"></ion-icon>
            <p>Upload Results</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="select-class-view-result.php" class="custom-tab">
            <ion-icon class="tab-icon" name="rocket-outline"></ion-icon>
            <p>View Results</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="edit-teacher-upload-result.php" class="custom-tab">
            <ion-icon class="tab-icon" name="newspaper-outline"></ion-icon>
            <p>Edit Exam | Test Data</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>