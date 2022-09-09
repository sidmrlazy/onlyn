<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="container-fluid">
    <?php include('navbar/class-teacher-side-nav.php') ?>
    <div class="school-main-dashboard animate__animated animate__fadeIn">
        <a href="class-teacher-add-hw.php" class="custom-tab">
            <ion-icon class="tab-icon" name="book-outline"></ion-icon>
            <p>Add Homework</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="select-hw.php" class="custom-tab">
            <ion-icon class="tab-icon" name="easel-outline"></ion-icon>
            <p>View all Homework</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>