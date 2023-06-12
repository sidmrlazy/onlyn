<?php include('includes/header.php') ?>
<?php include('components/navbar/user-navbar.php') ?>
<div class="container user-form-container">
    <div class="page-marker">
        <a href="index.php">
            <ion-icon name="arrow-back-outline"></ion-icon>
        </a>
        <h5>View Students</h5>
    </div>

    <div class="w-100">
        <form action="user-search-student-data.php" method="POST" class="filter-row w-100">
            <input type="text" name="student_search" class="form-control filter-input-box" id="exampleFormControlInput1" placeholder="Enter Mobile Number, Aadhaar card number, Roll number, Name or Course to search user">
            <button type="submit" name="search" class="btn btn-outline-success">Search</button>
        </form>
    </div>

    <div class="table-responsive user-table">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Course</th>
                    <th scope="col">Roll No.</th>
                    <th scope="col">Admission Date</th>
                    <th scope="col">Added By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('includes/connection.php');

                $results_per_page = 10;

                $fetch_students = "SELECT * FROM `bora_student` ORDER BY student_added_date DESC";
                $fetch_res = mysqli_query($connection, $fetch_students);
                $count = mysqli_num_rows($fetch_res);

                $number_of_page = ceil($count / $results_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $page_first_result = ($page - 1) * $results_per_page;
                $page_query = "SELECT * FROM `bora_student` LIMIT "  . $page_first_result . ',' . $results_per_page;
                $page_result = mysqli_query($connection, $page_query);

                while ($row = mysqli_fetch_assoc($page_result)) {
                    $student_id = $row['student_id'];
                    $student_img = "assets/student/" . $row['student_img'];
                    $student_name = $row['student_name'];
                    $student_contact = $row['student_contact'];
                    $student_course = $row['student_course'];
                    $student_roll = $row['student_roll'];
                    $student_admission_date = $row['student_admission_date'];
                    $student_added_by = $row['student_added_by']; ?>
                    <tr>
                        <th scope="row"><?php echo $student_name ?></th>
                        <td><?php echo $student_contact ?></td>
                        <td><?php echo $student_course ?></td>
                        <td><?php echo $student_roll ?></td>
                        <td><?php echo $student_admission_date ?></td>
                        <td><?php echo $student_added_by ?></td>
                        <td>
                            <form action="user-student-details.php" method="post">
                                <input type="text" value="<?php echo $student_id ?>" name="student_id" hidden>
                                <button type="submit" name="edit" class="btn btn-sm btn-outline-success">View
                                    Details</button>
                            </form>
                        </td>
                        <td>
                            <form action="user-collect-fee.php" method="POST">
                                <input type="text" value="<?php echo $student_id ?>" name="student_id" hidden>
                                <button type="submit" name="collect" class="btn btn-sm btn-outline-warning">Collect
                                    Fee</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example" class="w-100 mt-3">
            <ul class="pagination">
                <?php
                for ($page = 1; $page <= $number_of_page; $page++) {
                    echo '<li class="page-item"><a class="page-link" href="user-view-students.php?page=' . $page . '">' . $page . ' </a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</div>
<?php include('includes/footer.php') ?>