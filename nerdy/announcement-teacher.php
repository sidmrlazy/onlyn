<?php include('main/header.php'); ?>
<?php include('navbar/navbar.php'); ?>
<?php include('toasts.php'); ?>
<div class="d-flex">
    <?php include('navbar/teacher-side-nav.php') ?>
    <div class="school-main-dashboard container section-container mb-5 animate__animated animate__fadeIn">
        <div class="section-header">
            <h3 class="section-heading">
                <ion-icon name="megaphone-outline" class="section-heading-icon"></ion-icon>
                Announcements
            </h3>
            <p class="section-desc">Click on read more button to get full announcement</p>
        </div>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }

        if (isset($_POST['submit'])) {
            $ann_id = $_POST['ann_id'];
            $update = "UPDATE `announcement` SET `ann_status`=2 WHERE ann_id = $ann_id";
            $res = mysqli_query($connection, $update);
            if (!$res) {
                die(mysqli_error($connection));
            } else {
                echo "<script>annRead();</script>";
            }
        }


        $fetch_user_details = "SELECT * FROM users WHERE user_id = $session_user_id";
        $fetch_user_res = mysqli_query($connection, $fetch_user_details);

        $user_added_by = "";
        while ($row = mysqli_fetch_assoc($fetch_user_res)) {
            $user_added_by = $row['user_added_by'];
        }

        $fetch_records = "SELECT * FROM announcement WHERE ann_to = $session_user_id OR ann_to_type = 3 AND ann_by = $user_added_by";
        $fetch_result = mysqli_query($connection, $fetch_records);
        while ($row = mysqli_fetch_assoc($fetch_result)) {
            $ann_id = $row['ann_id'];
            $ann_topic = $row['ann_topic'];
            $ann_details = $row['ann_details'];
            $ann_date = $row['ann_date'];
            $ann_status = $row['ann_status'];
            if ($ann_status == 1) { ?>
        <form action="" method="POST" class="announcement-card mb-3" id="un-read">
            <input type="text" name="ann_id" value="<?php echo $ann_id; ?>" hidden>
            <div class="ann-topic-holder">
                <p class="ann-topic"><?php echo $ann_topic ?></p>
                <p class="ann-details"><?php echo $ann_details ?></p>
                <p class="ann-date"><?php echo date('d-M-Y', strtotime($ann_date)) ?></p>
            </div>
            <button type="submit" name="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                data-bs-target="#announcementModal">
                Mark as read
            </button>
        </form>
        <?php } elseif ($ann_status == 2) { ?>
        <div class="announcement-card mb-3" id="read">
            <input type="text" name="ann_id" value="<?php echo $ann_id; ?>" hidden>
            <div class="ann-topic-holder">
                <p class="ann-topic"><?php echo $ann_topic ?></p>
                <p class="ann-details"><?php echo $ann_details ?></p>
                <p class="ann-date"><?php echo date('d-M-Y', strtotime($ann_date)) ?></p>
            </div>
        </div>


        <?php }
        } ?>




    </div>
</div>
<?php include('main/footer.php'); ?>