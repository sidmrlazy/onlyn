<script>
function showToast(msg) {
    $(document).ready(function() {
        $("#liveToast").toast("show");
    });
}
</script>
<div class="dashboard w-100">
    <div class="add-press-release-form-container w-50">
        <?php
        require('main/db.php');
        if (isset($_POST['add'])) {
            $press_release_img = $_FILES["press_release_img"]["name"];
            $tempname_press_release_img = $_FILES["press_release_img"]["tmp_name"];
            $folder_press_release = "assets-admin/press/" . $press_release_img;

            $press_release_title = mysqli_real_escape_string($connection, $_POST['press_release_title']);
            $press_release_content = mysqli_real_escape_string($connection, $_POST['press_release_content']);
            $press_release_link = mysqli_real_escape_string($connection, $_POST['press_release_link']);

            if (empty($press_release_img)) {
                $title_message = "Error: Image";
                $message = "Image field cannot be empty";
                $style = "color: red;";

                echo "<script>showToast();</script>";
            } else if (empty($press_release_title)) {
                $title_message = "Error: Title";
                $message = "Title cannot be empty";
                $style = "color: red;";

                echo "<script>showToast();</script>";
            } else if (empty($press_release_content)) {
                $title_message = "Error: Content";
                $message = "Content cannot be empty";
                $style = "color: red;";

                echo "<script>showToast();</script>";
            } else {

                $insert = "INSERT INTO `press_release`(
                    `press_release_img`,
                    `press_release_title`,
                    `press_release_content`,
                    `press_release_link`
                )
                VALUES(
                    '$press_release_img',
                    '$press_release_title',
                    '$press_release_content',
                    '$press_release_link'
                )";
                $result = mysqli_query($connection, $insert);

                if ($result) {
                    move_uploaded_file($tempname_press_release_img, $folder_press_release);
                    $title_message = "Success";
                    $message = "Press release uploaded!";
                    $style = "color: green;";

                    echo "<script>showToast();</script>";
                } else {
                    $title_message = "Failed";
                    $message = "Looks like there was some error uploading this press release. Please retry!";
                    $style = "color: red;";

                    echo "<script>showToast();</script>";
                }
            }
        }
        ?>
        <form action="" method="POST" class="add-press-release-form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Press Release Image</label>
                <input type="file" name="press_release_img" class="form-control" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="press_release_title" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="press_release_content" placeholder="Leave a comment here"
                    id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Content</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="press_release_link" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Add Link</label>
            </div>
            <button type="submit" name="add" class="btn btn-outline-primary w-100">Add</button>
        </form>
    </div>





    <div class="table-container">
        <div class="table-responsive table-box">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Title</th>
                        <!-- <th scope="col">Action</th> -->
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['del'])) {
                        $press_release_id = $_POST['press_release_id'];

                        $delete_query = "DELETE FROM `press_release` WHERE `press_release_id` = '$press_release_id'";
                        $delete_query_r = mysqli_query($connection, $delete_query);

                        if ($delete_query_r) {
                            $title_message = "Deleted";
                            $message = "Press release deleted!";
                            $style = "color: red;";

                            echo "<script>showToast();</script>";
                        }
                    }

                    $results_per_page = 10;
                    $fetch_press = "SELECT * FROM `press_release`";
                    $fetch_press_r = mysqli_query($connection, $fetch_press);
                    $number_of_result = mysqli_num_rows($fetch_press_r);
                    $number_of_page = ceil($number_of_result / $results_per_page);
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }
                    $page_first_result = ($page - 1) * $results_per_page;

                    $query = "SELECT *FROM `press_release` LIMIT " . $page_first_result . ',' . $results_per_page;
                    $result = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $press_release_id = $row['press_release_id'];
                        $press_release_title = $row['press_release_title'];
                    ?>
                    <tr>
                        <th scope="row"><?php echo $press_release_id ?></th>
                        <td><?php echo $press_release_title ?></td>
                        <!-- <td>
                                <form action="" method="POST">
                                    <input type="text" name="press_release_id" value="<?php echo $press_release_id ?>" hidden>
                                    <button class="btn btn-sm btn-outline-dark">Edit</button>
                                </form>
                            </td> -->
                        <td>
                            <form action="" method="POST">
                                <input type="text" name="press_release_id" value="<?php echo $press_release_id ?>"
                                    hidden>
                                <button type="submit" name="del" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        echo '<li class="page-item"><a class="page-link" href = "press-release.php?page=' . $page . '">' . $page . ' </a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- =========== TOAST =========== -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" style="<?php echo $style; ?>"><?php echo $title_message ?></strong>
            <!-- <small>11 mins ago</small> -->
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $message ?>
        </div>
    </div>
</div>