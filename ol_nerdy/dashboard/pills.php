<div class="tab-wrap-view">
    <div class="info-pill">
        <p class="info-pill-label">Available Teacher Login ID's</p>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        $fetch_count = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
        $fetch_count_result = mysqli_query($connection, $fetch_count);
        while ($row = mysqli_fetch_assoc($fetch_count_result)) {
            $subscription_teacher_limit = $row['subscription_teacher_limit']; ?>
            <p class="info-pill-response"><?php echo $subscription_teacher_limit ?></p>
        <?php
        } ?>
    </div>

    <div class="info-pill">
        <p class="info-pill-label">Available Parent Login ID's</p>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        $fetch_count = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
        $fetch_count_result = mysqli_query($connection, $fetch_count);
        while ($row = mysqli_fetch_assoc($fetch_count_result)) {
            $subscription_parent_limit = $row['subscription_parent_limit']; ?>
            <p class="info-pill-response"><?php echo $subscription_parent_limit ?></p>
        <?php
        } ?>
    </div>


    <div class="info-pill">
        <p class="info-pill-label">Subscription Expiring On</p>
        <?php
        require_once('main/config.php');
        if (!empty($_SESSION['user_type'])) {
            $session_user_id = $_SESSION['user_id'];
        } else {
            $session_user_id = 0;
        }
        $fetch_count = "SELECT * FROM subscription WHERE subscription_user_id = $session_user_id";
        $fetch_count_result = mysqli_query($connection, $fetch_count);
        while ($row = mysqli_fetch_assoc($fetch_count_result)) {
            $subscription_end_date = $row['subscription_end_date'];
            $current_date = date('d-m-Y');

        ?>
            <p class="info-pill-response"><?php echo $subscription_end_date ?></p>
        <?php
        } ?>
    </div>
</div>