<div class="press-release-solo-container">
    <div class="container">
        <?php

        require('includes/db.php');
        if (isset($_POST['read'])) {
            $press_release_id = $_POST['press_release_id'];

            $fetch_news = "SELECT * FROM `press_release` WHERE `press_release_id` = '$press_release_id'";
            $fetch_news_r = mysqli_query($connection, $fetch_news);

            $press_release_title = "";
            $press_release_content = "";
            $press_release_img = "";
            $press_release_link = "";

            while ($row = mysqli_fetch_assoc($fetch_news_r)) {
                $press_release_title = $row['press_release_title'];
                $press_release_content = $row['press_release_content'];
                $press_release_img = "admin/assets-admin/press/" . $row['press_release_img'];
                $press_release_link = $row['press_release_link'];
            }
        }
        ?>
        <div class="solo-press-release-tab">
            <img src="<?php echo $press_release_img; ?>" alt="">
            <h2><?php echo $press_release_title; ?></h2>
            <p><?php echo $press_release_content; ?></p>
            <?php
            if (empty($press_release_link)) { ?>
                <a target="_blank" class="d-none" href="<?php echo $press_release_link; ?>">Go to link</a>
            <?php } else { ?>
                <a target="_blank" href="<?php echo $press_release_link; ?>">Go to link</a>
            <?php } ?>

        </div>
    </div>
</div>