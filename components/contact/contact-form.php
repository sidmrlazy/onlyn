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
                $contact_firstname = mysqli_real_escape_string($connection, $_POST['contact_firstname']);
                $contact_lastname = mysqli_real_escape_string($connection, $_POST['contact_lastname']);
                $contact_email = mysqli_real_escape_string($connection, $_POST['contact_email']);
                $contact_number = mysqli_real_escape_string($connection, $_POST['contact_number']);
                $contact_service = mysqli_real_escape_string($connection, $_POST['contact_service']);

                $query = "INSERT INTO `contact`(
                    `contact_firstname`,
                    `contact_lastname`,
                    `contact_email`,
                    `contact_number`,
                    `contact_service`
                )
                VALUES(
                    '$contact_firstname',
                    '$contact_lastname',
                    '$contact_email',
                    '$contact_number',
                    '$contact_service'
                )";

                $result = mysqli_query($connection, $query);

                if ($result) {
                    $to = "connectonlyn@gmail.com";
                    $subject = "Website Visitor!";

                    $message = "
                            <html>
                            <head>
                            </head>
                            <body>
                            <table>
                            <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Contacting For</th>
                            <th>Date</th>
                            </tr>
                            <tr>
                            <td>$contact_firstname $contact_lastname</td>
                            <td>$contact_email</td>
                            <td>$contact_number</td>
                            <td>$contact_service</td>
                            </tr>
                            </table>
                            </body>
                            </html>
                            ";

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    mail($to, $subject, $message, $headers);

            ?>
            <div class="alert alert-success mt-3 mb-3" role="alert">
                Thanks for dropping by! We'll be in touch before you know it.
            </div>
            <?php
                }
            }
            ?>
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <div class="inner-form-input">
                    <input type="text" name="contact_firstname" class="form-control" placeholder="First Name" required>
                    <input type="text" name="contact_lastname" class="form-control" placeholder="Last Name" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="contact_email" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Your Email Address">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mobile phone</label>

                <input type="number" class="form-control noscroll" name="contact_number" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="+91" required>

            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Select a Service</label>
                <select class="form-select contact-form-dropdown" name="contact_service"
                    aria-label="Default select example">
                    <option selected>Select a Service</option>
                    <option value="Software Development">Software Development </option>
                    <option value="Web Application development">Web Application development
                    </option>
                    <option value="UI/UX Design">UI/UX Design </option>
                    <option value="Digital Marketing Services">Digital Marketing Services
                    </option>
                    <option value="Offline Marketing Design">Offline Marketing Design </option>
                    <option value="Online Branding Services">Online Branding Services</option>
                    <option value="Offline Branding Services">Offline Branding Services</option>
                    <option value="Graphic Design Services ">Graphic Design Services </option>
                    <option value="Printing Solutions">Printing Solutions </option>
                </select>
            </div>

            <button type="submit" name="submit" class="contact-form-btn btn-primary">Submit</button>

            <p>This site is protected by reCAPTCHA and the Google Privacy Policy and Terms of Service apply.</p>
        </form>
    </div>
</div>