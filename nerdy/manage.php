<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <a href="subjects.php" class="custom-tab">
            <ion-icon class="tab-icon" name="library-outline"></ion-icon>
            <p>Add|Edit Subjects</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <!-- <a href="edit-tt-class.php" class="custom-tab">
            <ion-icon class="tab-icon" name="calendar-outline"></ion-icon>
            <p>Edit Time Table (To Be Developed)</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a> -->

        <a href="add-class-setup.php" class="custom-tab">
            <ion-icon class="tab-icon" name="business-outline"></ion-icon>
            <p>Add|Edit Classes</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="assign-class-teacher.php" class="custom-tab">
            <ion-icon class="tab-icon" name="ribbon-outline"></ion-icon>
            <p>Assign a Class teacher</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <a href="" class="custom-tab custom-tab-mobile">
            <ion-icon class="tab-icon" name="cash-outline"></ion-icon>
            <p>Fee (To Be Developed)</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php'); ?>