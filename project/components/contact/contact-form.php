<div class="container">
    <div class="contact-section-header">
        <h2>Contact</h2>
        <p>Fill in the details below. Someone from our team will connect with you shortly!</p>
    </div>
    <?php
    require('includes/db.php');
    if (isset($_POST['submit'])) {
        $contact_name = mysqli_real_escape_string($connection, $_POST['contact_name']);
        $contact_number = mysqli_real_escape_string($connection, $_POST['contact_number']);
        $contact_email = mysqli_real_escape_string($connection, $_POST['contact_email']);
        $contact_details = mysqli_real_escape_string($connection, $_POST['contact_details']);
        $contact_date = date('d-m-Y');

        $find_query = "SELECT * FROM contact_dr_neeraj WHERE `contact_number` = '$contact_number'";
        $find_query_r = mysqli_query($connection, $find_query);
        $count = mysqli_num_rows($find_query_r);
        $fetched_contact_date = "";
        while ($row = mysqli_fetch_assoc($find_query_r)) {
            $fetched_contact_date = $row['contact_date'];
        }

        if ($count > 0 && $fetched_contact_date == $contact_date) { ?>
            <div class="alert alert-info w-100 mt-3 mb-3" role="alert">
                Looks like you have already contacted us before. Please wait, someone from our team will connect with you
                shortly.
            </div>
            <?php
        } else if ($count > 0 && $fetched_contact_date != $contact_date) {
            $insert = "INSERT INTO `contact_dr_neeraj`(
                `contact_name`,
                `contact_number`,
                `contact_email`,
                `contact_details`,
                `contact_date`
            )
            VALUES(
                '$contact_name',
                '$contact_number',
                '$contact_email',
                '$contact_details',
                '$contact_date'
            )";
            $result = mysqli_query($connection, $insert);
            if ($result) { ?>
                <div class="alert alert-success w-100 mt-3 mb-3" role="alert">
                    Looks like you had contacted us before. Someone from our team will connect with you shortly.
                </div>
            <?php
            }
        } else if ($count == 0) {
            $insert = "INSERT INTO `contact_dr_neeraj`(
                `contact_name`,
                `contact_number`,
                `contact_email`,
                `contact_details`,
                `contact_date`
            )
            VALUES(
                '$contact_name',
                '$contact_number',
                '$contact_email',
                '$contact_details',
                '$contact_date'
            )";
            $result = mysqli_query($connection, $insert);
            if ($result) { ?>
                <div class="alert alert-success w-100 mt-3 mb-3" role="alert">
                    Thank you for contacting us. Someone from our team will connect with you shortly!
                </div>
    <?php
            }
        }
    }
    ?>
    <div class="contact-form-container">
        <div class="w-100">
            <div class="contact-details">
                <p class="contact-details-label">
                    <ion-icon name="headset-outline"></ion-icon> Contact
                </p>
                <a class="contact-details-res-link" href="tel:+919935047000">+91 9935047000</a>
                <a class="contact-details-res-link" href="tel:+918887150972"> | +91 8887150972</a>
            </div>
            <div class="contact-details">
                <p class="contact-details-label">
                    <ion-icon name="location-outline"></ion-icon> Address
                </p>
                <p class="contact-details-res">82-83 Sector D, Priyadarshini Colony, Sitapur Road, Lucknow</p>
            </div>

            <div class="contact-details">
                <p class="contact-details-label">
                    <ion-icon name="mail-outline"></ion-icon> Email
                </p>
                <a class="contact-details-res-link" href="mailto:drneerajbora@gmail.com">drneerajbora@gmail.com</a>
            </div>
        </div>

        <form action="" method="POST" class="w-100 contact-form">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Full Name</label>
                <input type="text" name="contact_name" class="form-control" id="exampleFormControlInput1" placeholder="" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Contact Number</label>
                <input type="number" name="contact_number" class="form-control" id="exampleFormControlInput1" placeholder="+91 XXXXX XXXXX" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="contact_email" class="form-control" id="exampleFormControlInput1" placeholder="name@email.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Details</label>
                <textarea name="contact_details" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" name="submit" class="w-100 btn btn-outline-success">Submit</button>
        </form>
    </div>
</div>