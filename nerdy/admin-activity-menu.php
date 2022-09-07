<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container mt-3">
        <p>Activity Menu</p>

        <a href="admin-upload-activity.php" class="custom-tab">
            <ion-icon class="tab-icon" name="document-attach-outline"></ion-icon>
            <p>Upload Acitivity</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>

        <a href="admin-view-uploaded-activity.php" class="custom-tab">
            <ion-icon class="tab-icon" name="document-text-outline"></ion-icon>
            <p>View all uploaded activities</p>
            <ion-icon class="tab-icon-right" name="caret-forward-outline"></ion-icon>
        </a>
    </div>
</div>
<?php include('main/footer.php') ?>