<div class="container contact-form ">

    <div class="contact-section col-md-6">
        <img src="assets/images/other/contact-img.webp" alt="">
    </div>

    <div class="contact-form-section col-md-6">
        <form class="custom-form" action="" method="post">
            <?php
            if (isset($_POST['submit'])) {
                $contact_first_name = $_POST['contact_first_name'];
                $contact_last_name = $_POST['contact_last_name'];
                $contact_email = $_POST['contact_email'];
                $contact_mobile = $_POST['contact_mobile'];
                $error_msg = "<div class='alert alert-danger text-center' role='alert'>Oops! Looks like you have missed out a field.</div>";
                $success_msg = "<div class='alert alert-success text-center' role='alert'>Form Submitted! We will connect with you soon</div>";

                if (
                    $contact_first_name === "" ||
                    $contact_last_name === "" ||
                    $contact_email === "" ||
                    $contact_mobile === ""
                ) {
                    echo $error_msg;
                } else {

                    $insert = "INSERT INTO `contact_form`(                
                `contact_first_name`, 
                `contact_last_name`, 
                `contact_email`, 
                `contact_mobile`) VALUES (
                    '$contact_first_name',
                    '$contact_last_name',
                    '$contact_email',
                    '$contact_mobile')";

                    if ($connection->query($insert) === TRUE) {
                        echo $success_msg;
                    } else {
                        echo "Error: " . $insert . "</br>" . $connection->error;
                    }

                    $connection->close();
                }
            };
            ?>
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <div class="inner-form-input">
                    <input type="text" name="contact_first_name" class="form-control" placeholder="First Name">
                    <input type="text" name="contact_last_name" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="contact_email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Your Email Address">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mobile phone</label>

                <input type="number" class="form-control noscroll" name="contact_mobile" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="+91">

            </div>

            <button type="submit" name="submit" class="contact-form-btn btn-primary">Submit</button>

            <p>This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
        </form>
    </div>
</div>