<div class="container-fluid mb-5">
    <div class="press-release-wrapper">
        <?php
        require('includes/db.php');
        $query = "SELECT * FROM `press_release`";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $press_release_id = $row['press_release_id'];
            $press_release_img = "admin/assets-admin/press/" . $row['press_release_img'];
            $press_release_title = $row['press_release_title'];
            $press_release_content = $row['press_release_content'];
            $press_release_link = $row['press_release_link'];
            $press_release_date = $row['press_release_date'];
        ?>
            <form action="press-release-solo.php" method="POST" class="press-release-card">
                <input type="text" name="press_release_id" value="<?php echo $press_release_id ?>" hidden>
                <img src="<?php echo $press_release_img ?>" alt="">
                <div class="press-release-card-content-holder">
                    <h2><?php echo $press_release_title  ?></h2>
                    <p class="press-release-content"><?php echo $press_release_content ?></p>

                    <p><?php echo date('d M Y', strtotime($press_release_date))  ?></p>
                    <button type="submit" name="read" class="press-release-btn">Read Full Story</button>
                </div>
            </form>
        <?php } ?>
    </div>
</div>