<div class="dashboard w-100">
    <div class="dashboard-container">
        <?php
        require('main/db.php');
        if (isset($_COOKIE['user_id'])) {
            $user_email = $_COOKIE['user_id'];
            $fetch_data = "SELECT * FROM `user` WHERE `user_email` = '$user_email'";
            $fetch_res = mysqli_query($connection, $fetch_data);
            $user_name = "";
            while ($row = mysqli_fetch_assoc($fetch_res)) {
                $user_name = $row['user_name'];
            }
        }
        ?>
        <div class="welcome-message">
            <h1>Welcome,</h1>
            <p><?php echo $user_name ?></p>
        </div>
    </div>
</div>