<div class="container user-form-container">
    <div class="page-marker">
        <a href="view-user.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>Edit User</h5>
    </div>
    <?php
    require('includes/connection.php');
    if (isset($_POST['edit'])) {
        $user_id = $_POST['user_id'];

        $query = "SELECT * FROM `bora_users` WHERE `user_id` = '$user_id'";
        $result = mysqli_query($connection, $query);

        $user_name = "";
        $user_contact = "";
        $user_password = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $user_name = $row['user_name'];
            $user_contact = $row['user_contact'];
            $user_password = $row['user_password'];
        }
    }
    ?>
    <form class="add-user-form" method="POST" action="edit-user-success.php">
        <input type="text" name="user_id" value="<?php echo $user_id ?>" hidden>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full Name</label>
            <input type="text" name="user_name" required class="form-control" value="<?php echo $user_name ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="contactNumber" class="form-label">Contact Number</label>
            <input type="number" name="user_contact" maxlength="10" required class="form-control" value="<?php echo $user_contact ?>" id="contactNumber">
        </div>
        <div class="mb-3">
            <label for="userPassword" class="form-label">Password</label>
            <input type="password" name="user_password" value="<?php echo $user_password ?>" class="form-control" required id="userPassword">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Generate User ID</button>
    </form>
</div>