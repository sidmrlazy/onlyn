<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<div class="d-flex container-fluid">
    <?php include('navbar/school-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <a href="configure-fee-structure-school.php" class="custom-tab">
            <ion-icon class="tab-icon" name="cog-outline"></ion-icon>
            <p>Configure Fee Structure</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="view-class-wise-fee.php" class="custom-tab">
            <ion-icon class="tab-icon" name="color-filter-outline"></ion-icon>
            <p>View class-wise fee structure</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="select-class-collect-fee.php" class="custom-tab">
            <ion-icon class="tab-icon" name="receipt-outline"></ion-icon>
            <p>Collect Fee</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="select-class-default.php" class="custom-tab">
            <ion-icon class="tab-icon" name="shapes-outline"></ion-icon>
            <p>Check Fee Defaulters</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="#" class="custom-tab">
            <ion-icon class="tab-icon" name="search-outline"></ion-icon>
            <p>Fee Collection Status</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
        <!-- <a href="assign-student-fee-structure.php" class="custom-tab custom-tab-mobile">
            <ion-icon class="tab-icon" name="cash-outline"></ion-icon>
            <p>Assign fee structure to student</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a> -->
    </div>
</div>
<?php include('main/footer.php'); ?>