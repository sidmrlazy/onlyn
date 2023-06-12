<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>View User</h5>
    </div>

    <form action="" method="POST" class="form-row">
        <div class="form-floating w-100">
            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Enter Mobile Number or Name </label>
        </div>
        <button class="btn btn-outline-primary">Search</button>
    </form>


    <div class="user-table">

        <?php
        require('includes/connection.php');

        $results_per_page = 10;

        $query = "SELECT * FROM `bora_users` WHERE `user_type` = '2'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);

        $number_of_page = ceil($count / $results_per_page);

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $page_first_result = ($page - 1) * $results_per_page;
        $page_query = "SELECT * FROM `bora_users` WHERE `user_type` = '2' LIMIT "  . $page_first_result . ',' . $results_per_page;
        $page_result = mysqli_query($connection, $page_query);

        if ($count == 0) { ?>
            <div>
                <p>No user found</p>
            </div>
            <?php
        } else {
            while ($row = mysqli_fetch_assoc($page_result)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_contact = $row['user_contact'];

            ?>
                <div class="user-card">
                    <h6><?php echo $user_name ?></h6>
                    <p><?php echo $user_contact ?></p>
                    <form action="edit-user.php" method="POST" class="view-btn">
                        <input type="text" value="<?php echo $user_id ?>" name="user_id" hidden>
                        <button type="submit" name="edit" class=" btn btn-sm btn-outline-secondary">Edit</button>
                    </form>
                    <form action="" method="POST" class="view-btn">
                        <input type="text" value="<?php echo $user_id ?>" name="user_id" hidden>
                        <button type="submit" name="delete" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <nav aria-label="Page navigation example" class="w-100 mt-3">
        <ul class="pagination">
            <?php
            for ($page = 1; $page <= $number_of_page; $page++) {
                echo '<li class="page-item"><a class="page-link" href="view-user.php?page=' . $page . '">' . $page . ' </a></li>';
            }
            ?>
        </ul>
    </nav>

</div>