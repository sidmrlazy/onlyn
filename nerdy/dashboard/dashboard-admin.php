<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container mt-3">
        <p>Dashboard</p>

        <div class="admin-dashboard-grid">
            <div class="admin-dashboard-pills">
                <ion-icon name="bulb-outline" id="icon-green"></ion-icon>
                <p>Schools Onboarded</p>
                <?php
                $query = "SELECT * FROM `users` WHERE user_type = 2";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                ?>
                <p class="pill-count"><?php echo $count ?></p>
            </div>

            <div class="admin-dashboard-pills">
                <ion-icon name="checkbox-outline" id="icon-blue"></ion-icon>
                <p>Total Active Schools</p>
                <?php
                $query = "SELECT * FROM `setup_status` WHERE setup_payment_status = 1";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                ?>
                <p class="pill-count"><?php echo $count ?></p>
            </div>
        </div>
    </div>
</div>