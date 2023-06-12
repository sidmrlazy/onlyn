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
            <input type="text" name="student_search" class="form-control filter-input-box" id="exampleFormControlInput1"
                placeholder="Enter Mobile Number, Aadhaar card number, Roll number, Name or Course to search user">
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
                    <th scope="col">Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('includes/connection.php');
                if (isset($_POST['search'])) {
                    $student_search = $_POST['student_search'];

                    $query = "SELECT * FROM `bora_student` WHERE `student_name` LIKE '%$student_search%' OR `student_contact` LIKE '%$student_search%' OR `student_roll` LIKE '%$student_search%' OR `student_course` LIKE '%$student_search%' OR `student_aadhar_number` LIKE '%$student_search%'";
                    $res = mysqli_query($connection, $query);
                    if ($res) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $student_id = $row['student_id'];
                            $student_img = "assets/student/" . $row['student_img'];
                            $student_name = $row['student_name'];
                            $student_contact = $row['student_contact'];
                            $student_course = $row['student_course'];
                            $student_roll = $row['student_roll'];
                            $student_admission_date = $row['student_admission_date'];
                            $student_added_by = $row['student_added_by'];
                ?>
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
                    } else {
                        echo "Not Found";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer.php') ?>