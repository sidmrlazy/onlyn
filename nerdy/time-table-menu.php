<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard w-100 animate__animated animate__fadeIn">
        <a href="class-teacher-select-day-tt.php" class="custom-tab">
            <ion-icon class="tab-icon" name="calendar-outline"></ion-icon>
            <p>Configure Time Table</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="view-tt.php" class="custom-tab">
            <ion-icon class="tab-icon" name="business-outline"></ion-icon>
            <p>View Time Table</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>