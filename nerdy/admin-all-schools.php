<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container mt-3">
        <p>Onboarded Schools</p>

        <div class="admin-dashboard-grid">
            <?php
            if (isset($_POST['open'])) {
                $user_id = $_POST['user_id'];
            }

            $query = "SELECT * FROM users WHERE user_type = 2 AND user_added_by = 0";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $user_school_logo = "assets/images/school-logo/" . $row['user_school_logo'];
                $user_school_name = $row['user_school_name'];
            ?>
            <form action="" method="POST" class="admin-circle">
                <input type="text" name="user_id" value="<?php echo $user_id ?>" hidden>
                <button type="submit" name="open" class="school-logo-img-holder">
                    <img src="<?php echo $user_school_logo ?>" alt="" class="school-logo-img">
                </button>
                <p class="school-circle-name"><?php echo $user_school_name ?></p>

            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php include('main/footer.php') ?>