<?php include('main/header.php') ?>
<?php include('navbar/navbar-admin.php') ?>

<div class="d-flex container-fluid">
    <?php include('navbar/admin-side-nav.php') ?>
    <div class="school-main-dashboard container ">
        <?php
        if (isset($_POST['upload'])) {
            $promotions_img = $_FILES['promotions_img']['name'];
            $promotions_img_temp = $_FILES['promotions_img']['tmp_name'];
            $upload_folder = "assets/images/promotional-banners/" . $promotions_img;
            $promotions_to = $_POST['promotions_to'];
            $promotions_status = 1;

            $query = "INSERT INTO `promotions`(
                `promo_file`,
                `promo_to`,
                `promo_status`
            )
            VALUES(
                '$promotions_img',
                '$promotions_to', 
                '$promotions_status'
                )";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die(mysqli_error($connection));
            } else {
                if (move_uploaded_file($promotions_img_temp, $upload_folder)) {
                    echo "<div class='alert alert-success mb-3' role='alert'>
                    Promotion Active!
                  </div>";
                } else {
                    echo "<div class='alert alert-danger mb-3' role='alert'>
                    Error!
                  </div>";
                }
            }
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data" class="card p-3 col-md-6">
            <div class="mb-3">
                <label class="mb-2" for="floatingInput">Upload Promotional Banner Image</label>
                <input type="file" class="form-control" name="promotions_img" id="floatingInput"
                    placeholder="name@example.com">
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="promotions_to" id="floatingSelect" name="promotions_to"
                    aria-label="Floating label select example">
                    <option selected>Display to</option>
                    <?php
                    $fetch_users = "SELECT * FROM users GROUP BY user_type";
                    $fetch_users_result = mysqli_query($connection, $fetch_users);

                    while ($row = mysqli_fetch_assoc($fetch_users_result)) {
                        $user_type = $row['user_type'];

                        if ($user_type == 1) {
                            $user_type_name = "Admin";
                        }
                        if ($user_type == 2) {
                            $user_type_name = "School";
                        }
                        if ($user_type == 3) {
                            $user_type_name = "Teacher";
                        }
                        if ($user_type == 4) {
                            $user_type_name = "Parent";
                        }
                        if ($user_type == 5) {
                            $user_type_name = "Class Teacher";
                        }
                        if ($user_type == 6) {
                            $user_type_name = "University";
                        }
                        if ($user_type == 7) {
                            $user_type_name = "Pre-School";
                        }
                        if ($user_type == 8) {
                            $user_type_name = "College";
                        }
                        if ($user_type == 9) {
                            $user_type_name = "High School";
                        }

                    ?>
                    <option value="<?php echo $user_type ?>"><?php echo $user_type_name ?></option>
                    <?php } ?>
                </select>
                <label for="floatingSelect">Click here for options</label>
            </div>

            <button type="submit" name="upload" class="btn btn-outline-primary">Upload</button>
        </form>
    </div>
</div>
<?php include('main/footer.php') ?>