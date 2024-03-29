<?php
require('includes/db.php');

// Number of records per page
$recordsPerPage = 10;

// Get the current page
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the starting record for the current page
$startFrom = ($currentPage - 1) * $recordsPerPage;

// Fetch records with pagination
$fetch = "SELECT * FROM `user_form` ORDER BY `user_form_submit_date` DESC LIMIT $startFrom, $recordsPerPage";
$fetch_r = mysqli_query($connection, $fetch);

$count = mysqli_num_rows($fetch_r);

// $fetch = "SELECT * FROM `user_form` ORDER BY `user_form_submit_date` DESC";
// $fetch_r = mysqli_query($connection, $fetch);
// $count = mysqli_num_rows($fetch_r);

if ($count > 0) {
?>
    <div class="container-fluid">
        <div class="go-back-container">
            <a href="index.php"><ion-icon name="arrow-back-circle-outline"></ion-icon> Go Back</a>
        </div>

        <div class="search-box-container">
            <form action="filtered-data.php" method="POST" class="d-flex" role="search">
                <select name="data_number" class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">Employee ID</option>
                    <option value="2">Employee Mobile Number</option>
                    <option value="3">Reference Number</option>
                    <option value="4">Candidate Mobile Number</option>
                </select>
                <input type="text" class="form-control" aria-label="Text input with dropdown button" name="data" placeholder="Type Here">
                <button type="submit" name="filter" class="btn btn-outline-success">Search</button>
            </form>
        </div>



        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="table-text-small" scope="col">REFERENCE NUMBER</th>
                            <th class="table-text-small" scope="col">EMP ID</th>
                            <th class="table-text-small" scope="col">EMP MOBILE NUMBER</th>
                            <th class="table-text-small" scope="col">EMP EMAIL ID</th>
                            <th class="table-text-small" scope="col">CANDIDATE CONTACT</th>
                            <th class="table-text-small" scope="col">CANDIDATE NAME</th>
                            <th class="table-text-small" scope="col">CANDIDATE E-MAIL ID</th>
                            <th class="table-text-small" scope="col">POSITION APPLIED FOR</th>
                            <th class="table-text-small text-center" scope="col">DOWNLOAD CV</th>
                            <th class="table-text-small" scope="col">APPLIED DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($fetch_r)) {
                            $user_form_ref_number = $row['user_form_ref_number'];
                            $user_form_emp_id = $row['user_form_emp_id'];
                            $user_form_contact = $row['user_form_contact'];
                            $user_form_email = $row['user_form_email'];
                            $user_form_ref_contact = $row['user_form_ref_contact'];
                            $user_form_ref_name = $row['user_form_ref_name'];
                            $user_form_ref_email = $row['user_form_ref_email'];
                            $user_form_ref_position = $row['user_form_ref_position'];
                            $user_form_ref_cv = "../adiraerp/cv/" . $row['user_form_ref_cv'];
                            $user_form_submit_date = $row['user_form_submit_date'];
                        ?>
                            <tr>
                                <th class="response-text" scope="row"><?php echo $user_form_ref_number ?></th>
                                <td class="response-text"><?php echo $user_form_emp_id ?></td>
                                <td class="response-text"><?php echo $user_form_contact ?></td>
                                <td class="response-text"><?php echo $user_form_email ?></td>
                                <td class="response-text"><?php echo $user_form_ref_contact ?></td>
                                <td class="response-text"><?php echo $user_form_ref_name ?></td>
                                <td class="response-text"><?php echo $user_form_ref_email ?></td>
                                <td class="response-text"><?php echo $user_form_ref_position ?></td>
                                <?php
                                if (!empty($user_form_ref_cv)) {
                                    $file_extension = pathinfo($user_form_ref_cv, PATHINFO_EXTENSION);
                                    $allowed_image_extensions = array("jpg", "jpeg", "png");
                                    $allowed_word_extensions = array("doc", "docx");
                                    $allowed_pdf_extensions = array("pdf");
                                ?>
                                    <?php if (in_array(strtolower($file_extension), $allowed_image_extensions)) { ?>
                                        <td class="pdf-logo text-center">
                                            <a target="_blank" href="<?php echo $user_form_ref_cv ?>">
                                                <img src="assets/image-icon.png" alt="">
                                            </a>
                                        </td>
                                    <?php } elseif (in_array(strtolower($file_extension), $allowed_word_extensions)) { ?>
                                        <td class="pdf-logo text-center">
                                            <a target="_blank" href="<?php echo $user_form_ref_cv ?>">
                                                <img src="assets/word-icon.png" alt="">
                                            </a>
                                        </td>
                                    <?php } elseif (strtolower($file_extension) === "pdf") { ?>
                                        <td class="pdf-logo text-center">
                                            <a target="_blank" href="<?php echo $user_form_ref_cv ?>">
                                                <img src="assets/pdf-logo.png" alt="">
                                            </a>
                                        </td>
                                    <?php } ?>

                                <?php } ?>

                                <td class="response-text"><?php echo date('d-M-Y h:i', strtotime($user_form_submit_date)) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="pagination-container">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            // Calculate the total number of pages
                            $totalPages = ceil($count / $recordsPerPage);

                            // Generate pagination links
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item " . ($i == $currentPage ? 'active' : '') . "'><a class='page-link' href='?page=$i'>$i</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="empty-container">
        <img src="assets/link.png" alt="">
        <h1>No Data Found!</h1>
    </div>
<?php } ?>