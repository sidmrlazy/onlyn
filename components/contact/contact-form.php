<div class="mt-5 contact-form-heading">
    <h1>Ready to start a Project?</h1>
    <p>To start, use form below to tell us about you and the project</p>
</div>

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
                $contact_service = $_POST['contact_service'];
                $error_msg = "<div class='alert alert-danger text-center' role='alert'>Oops! Looks like you have missed out a field.</div>";
                $success_msg = "<div class='alert alert-success text-center' role='alert'>Form Submitted! We will connect with you soon</div>";

                if (
                    $contact_first_name === "" ||
                    $contact_last_name === "" ||
                    $contact_email === "" ||
                    $contact_mobile === "" ||
                    $contact_service
                ) {
                    echo $error_msg;
                } else {

                    $insert = "INSERT INTO `contact_form`(                
                `contact_first_name`, 
                `contact_last_name`, 
                `contact_email`, 
                `contact_mobile`,
                `contact_service`,) VALUES (
                    '$contact_first_name',
                    '$contact_last_name',
                    '$contact_email',
                    '$contact_mobile',
                    '$contact_service')";

                    $to = "connectonlyn@onlynus.com";
                    $subject = "Visitor Alert";
                    $message = "Someone has filled the contact form from the website. Please check Database !";

                    if ($connection->query($insert) === TRUE) {
                        echo $success_msg;
                        mail($to, $subject, $message,);
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
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Select a Service</label>
                <select class="form-select contact-form-dropdown" aria-label="Default select example">
                    <option selected>Select a Service</option>
                    <option name="contact_service" value="Software Development">Software Development </option>
                    <option name="contact_service" value="Web Application development">Web Application development
                    </option>
                    <option name="contact_service" value="UI/UX Design">UI/UX Design </option>
                    <option name="contact_service" value="Digital Marketing Services">Digital Marketing Services
                    </option>
                    <option name="contact_service" value="Offline Marketing Design">Offline Marketing Design </option>
                    <option name="contact_service" value="Online Branding Services">Online Branding Services</option>
                    <option name="contact_service" value="Offline Branding Services">Offline Branding Services</option>
                    <option name="contact_service" value="Graphic Design Services ">Graphic Design Services </option>
                    <option name="contact_service" value="Printing Solutions">Printing Solutions </option>
                </select>
            </div>

            <button type="submit" name="submit" class="contact-form-btn btn-primary">Submit</button>

            <p>This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
        </form>
    </div>
</div>