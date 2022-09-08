<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/parent-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn w-100">
        <a href="student-view-exam-2.php" class="custom-tab">
            <ion-icon class="tab-icon" name="stopwatch-outline"></ion-icon>
            <p>New Offline Exams | Tests</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="student-view-result.php" class="custom-tab">
            <ion-icon class="tab-icon" name="ribbon-outline"></ion-icon>
            <p>Results</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>