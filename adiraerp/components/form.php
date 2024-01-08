<script>
    function successModal() {
        $(document).ready(function() {
            $("#openModal").modal("show");
        });
    }

    function emptyModal() {
        $(document).ready(function() {
            $("#empty").modal("show");
        });
    }

    function fileModal() {
        $(document).ready(function() {
            $("#fileType").modal("show");
        });
    }

    function positionModal() {
        $(document).ready(function() {
            $("#position").modal("show");
        });
    }
</script>
<div class="form-body">
    <div class="container ">
        <div class="brand-img-row">
            <div class="brand-img">
                <img src="assets/brand-logo.png" alt="">
            </div>
            <div class="brand-img-real-me">
                <img src="assets/real-me-logo.png" alt="">
            </div>
        </div>
        <div class="form-details-container">
            <h1>Employee Reference Tracker</h1>
            <p>Refer a Friend / Source a CV of candidate from your market, Upload his / her Resume and your own details.
                Our HR will validate every candidate and if your referred candidate is appointed you will be suitably rewarded.</p>
        </div>
        <div class="form-container">

            <?php
            if (isset($_POST['submit'])) {
                $user_form_emp_id = mysqli_real_escape_string($connection, $_POST['user_form_emp_id']);
                $user_form_contact = mysqli_real_escape_string($connection, $_POST['user_form_contact']);
                $user_form_email = mysqli_real_escape_string($connection, $_POST['user_form_email']);
                $user_form_ref_contact = mysqli_real_escape_string($connection, $_POST['user_form_ref_contact']);
                $user_form_ref_name = mysqli_real_escape_string($connection, $_POST['user_form_ref_name']);
                $user_form_ref_email = mysqli_real_escape_string($connection, $_POST['user_form_ref_email']);
                $user_form_ref_position = mysqli_real_escape_string($connection, $_POST['user_form_ref_position']);

                $user_form_ref_cv = $_FILES["user_form_ref_cv"]["name"];
                $tempname_user_form_ref_cv = $_FILES["user_form_ref_cv"]["tmp_name"];
                $folder_cv = "cv/" . $user_form_ref_cv;

                $randomNumber = rand(100000, 999999);
                $user_form_ref_number = "REF" . date('dmY') . $randomNumber;

                $to = $user_form_email;
                $subject = "Adira Employee Reference Scheme: " . $user_form_ref_number;
                $message = "Thank you for refering (" . $user_form_ref_name . " / " . $user_form_ref_contact . " / " . $user_form_ref_email . " ) for position of (" . $user_form_ref_position . "). The HR will examine the candidature. You will be suitably rewarded once your refered candidate completes first two business months. Your reference number is: " . $user_form_ref_number;
                $headers = "From: ibasthana@adiratele.com";

                if (empty($user_form_ref_cv)) {
                    echo "<script>emptyModal();</script>";
                }
                if (empty($user_form_ref_position) || $user_form_ref_position == 'null') {
                    echo "<script>emptyModal();</script>";
                } else {
                    $file_extension = pathinfo($user_form_ref_cv, PATHINFO_EXTENSION);
                    if (strtolower($file_extension) !== "pdf") {
                        echo "<script>fileModal();</script>";
                    } else {
                        $insert_query = "INSERT INTO `user_form`(
                            `user_form_emp_id`,
                            `user_form_contact`,
                            `user_form_email`,
                            `user_form_ref_contact`,
                            `user_form_ref_name`,
                            `user_form_ref_email`,
                            `user_form_ref_position`,
                            `user_form_ref_cv`,
                            `user_form_ref_number`
                        )
                        VALUES(
                            '$user_form_emp_id',
                            '$user_form_contact',
                            '$user_form_email',
                            '$user_form_ref_contact',
                            '$user_form_ref_name',
                            '$user_form_ref_email',
                            '$user_form_ref_position',
                            '$user_form_ref_cv',
                            '$user_form_ref_number'
                        )";

                        $insert_r = mysqli_query($connection, $insert_query);
                        if ($insert_r) {
                            $move_file = move_uploaded_file($tempname_user_form_ref_cv, $folder_cv);
                            if ($move_file) {
                                mail($to, $subject, $message, $headers);
                                echo "<script>successModal();</script>";
                            }
                        }
                    }
                }
            }
            ?>

            <!-- =============== SUCCESS MODAL START =============== -->
            <div class="modal fade hide" id="openModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thank you!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>Congratulations! 🎉 Your application has been submitted. An email with your reference number will be sent shortly. Thank you!</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <a href="admin-past-payments.php" class="btn btn-primary">Go back</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============== SUCCESS MODAL END =============== -->

            <!-- =============== EMPTY MODAL START =============== -->
            <div class="modal fade hide" id="empty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Please Upload CV!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>Oops! It seems you haven't uploaded CV. Uploading the CV greatly enhances your application. Please consider attaching it for a comprehensive review. Thank you!</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <a href="admin-past-payments.php" class="btn btn-primary">Go back</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============== EMPTY MODAL END =============== -->

            <!-- =============== FILE TYPE MODAL START =============== -->
            <div class="modal fade hide" id="fileType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Check File Format!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>Whoops! It appears you haven't uploaded your CV in PDF format. Please ensure your CV is in PDF format for a successful application. Thank you!</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <a href="admin-past-payments.php" class="btn btn-primary">Go back</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============== FILE TYPE MODAL END =============== -->


            <!-- =============== POSITION START =============== -->
            <div class="modal fade hide" id="position" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Check File Format!</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p>Whoops! It appears you haven't selected a position you are referring the candiadate. Please select one from the dropdown. Thank you!</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <a href="admin-past-payments.php" class="btn btn-primary">Go back</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============== POSITION END =============== -->


            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="employeeId" class="form-label form-data-label">Employee ID</label>
                    <input type="text" name="user_form_emp_id" class="form-control" id="employeeId" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label form-data-label">Employee Mobile Number</label>
                    <input type="number" name="user_form_contact" class="form-control" id="contactNumber" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="employeeEmail" class="form-label form-data-label">Employee Email-ID</label>
                    <input type="email" name="user_form_email" class="form-control" id="employeeEmail" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label form-data-label">Mobile No. of Candidate (Referred by Employee)</label>
                    <input type="number" name="user_form_ref_contact" class="form-control" id="contactNumber" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label form-data-label">Name of Candidate (Referred by Employee)</label>
                    <input type="text" name="user_form_ref_name" class="form-control" id="contactNumber" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label form-data-label">Email-ID of Candidate (Referred by Employee)</label>
                    <input type="text" name="user_form_ref_email" class="form-control" id="contactNumber" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label form-data-label">Position Applied for</label>
                    <select name="user_form_ref_position" class="form-select" aria-label="Default select example">
                        <option value="null">Open this menu</option>
                        <option value="Realme Advisor">Realme Advisor</option>
                        <option value="Cluster Sales Incharge">Cluster Sales Incharge</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label form-data-label">Upload CV for reference</label>
                    <input class="form-control" name="user_form_ref_cv" type="file" id="formFile" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary form-btn">Submit</button>
            </form>
        </div>
    </div>
</div>