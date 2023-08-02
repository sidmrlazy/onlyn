<div class="homepage-section-5-container">
    <div class="container-fluid">
        <h4>PRESS RELEASES</h4>
        <p>Check out all the latest press releases by Dr. Neeraj Bora</p>
    </div>

    <div class="homepage-section-5-press-release-row">
        <?php
        require('includes/db.php');
        $fetch_news = "SELECT * FROM `press_release`";
        $fetch_news_r = mysqli_query($connection, $fetch_news);
        while ($row = mysqli_fetch_assoc($fetch_news_r)) {
            $press_release_id = $row['press_release_id'];
            $press_release_title = $row['press_release_title'];
        ?>
        <form action="press-release-solo.php" method="POST" class="homepage-section-5-press-release-card">
            <input type="text" name="press_release_id" value="<?php echo $press_release_id ?>" hidden>
            <h5 class="homepage-section-5-press-release-content"><?php echo $press_release_title ?></h5>
            <button type="submit" name="read" class="homepage-section-5-read-more-btn">
                <p>Read More</p>
            </button>
        </form>
        <?php } ?>
    </div>
</div>