<div class="rectangle-row">
    <div class="col-md-6 rectangle">
        <ion-icon name="search-circle-outline" class="rectangle-icon"></ion-icon>
        <h3>Start-up consultancy</h3>
        <p>If you are a start-up, we can help you refine your business operations and management through our robust
            Marketing and Software departments. You will be offered just the perfect combination of Marketing and
            branding strategies teamed with the required technical and software products for your Start-Up.</p>
    </div>

    <div class="col-md-6 rectangle">
        <ion-icon name="code-slash-outline" class="rectangle-icon"></ion-icon>
        <!-- <ion-icon name="construct-outline" ></ion-icon> -->
        <h3>Software Consultancy </h3>
        <p>Who tells you what the right software, operating system,web platforms or even the right Software Design is
            for your Business? A Software Consultant is someone who will understand the nature of your business and what
            is the desired goal you want to achieve off the software- through this understanding a software consultant
            will Design the perfect Software architecture and work on developing the same for you.

        </p>
    </div>
</div>
<div class="rectangle-row">
    <div class="col-md-6 rectangle">
        <ion-icon name="logo-steam" class="rectangle-icon"></ion-icon>
        <h3>Marketing & Branding Consultancy</h3>
        <p>As your Marketing and Branding Consultancy we work closely with your Business in designing social media
            strategies, offline & online Branding strategies, Brand designing/redesigning. We understand how important
            it is for businesses to be backed by the RIGHT & SMART marketing and branding Designs. We also work with the
            businesses in helping them generate more leads for their businesses, work on expansion and Growth and
            increase sales/customers. Using new age technology and tools we work with Small Businesses to </p>
    </div>

    <div class="col-md-6 rectangle">
        <form action="" class="w-100 pt-4 pb-4" method="POST">
            <?php
            include('database/connection.php');
            if (isset($_POST['submit'])) {
                $consultancy_fullname = $_POST['consultancy_fullname'];
                $consultancy_email = $_POST['consultancy_email'];
                $consultancy_contact = $_POST['consultancy_contact'];
                $consultancy_option = $_POST['consultancy_option'];

                $error_msg = "<div class='alert alert-danger text-center' role='alert'>Oops! Looks like there's something wrong. Please Retry!.</div>";
                $success_msg = "<div class='alert alert-success text-center' role='alert'>Form Submitted! We will connect you soon</div>";

                $insert = "INSERT INTO `consultancyform`(                
                `consultancy_fullname`, 
                `consultancy_email`, 
                `consultancy_contact`, 
                `consultancy_option`) VALUES (
                    '$consultancy_fullname',
                    '$consultancy_email',
                    '$consultancy_contact',
                    '$consultancy_option')";

                $to = "connectonlyn@onlynus.com";
                $subject = "Visitor Alert - $consultancy_option";
                $message = "$consultancy_fullname has filled the Consultancy form for $consultancy_option from the website. Please contact them on $consultancy_contact or $consultancy_email !";

                if ($connection->query($insert) === TRUE) {
                    echo $success_msg;
                    mail($to, $subject, $message,);
                } else {
                    echo "Error: " . $insert . "</br>" . $connection->error;
                }

                $connection->close();
            };
            ?>
            <div class="w-100 form-floating mb-3">
                <input type="text" name="consultancy_fullname" class="form-control" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Full Name</label>
            </div>
            <div class="w-100 form-floating mb-3">
                <input type="email" name="consultancy_email" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Email</label>
            </div>
            <div class="w-100 form-floating mb-3">
                <input type="number" name="consultancy_contact" class="form-control" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Contact Number</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="consultancy_option" id="floatingSelect"
                    aria-label="Floating label select example">
                    <option selected>---- Required Consultancy ----</option>
                    <option name="consultancy_option" value="Start-up Consultancy">Start-up Consultancy</option>
                    <option name="consultancy_option" value="Software Consultancy">Software Consultancy</option>
                    <option name="consultancy_option" value="Marketing Consultancy">Marketing Consultancy</option>
                </select>
                <label for="floatingSelect">Required Consultancy</label>
            </div>

            <button type="submit" name="submit" class="contact-form-btn btn-primary">Submit</button>
        </form>
        <!-- <ion-icon name="logo-steam" class="rectangle-icon"></ion-icon>
        <h3>Marketing & Branding Consultancy</h3>
        <p>As your Marketing and Branding Consultancy we work closely with your Business in designing social media
            strategies, offline & online Branding strategies, Brand designing/redesigning. We understand how important
            it is for businesses to be backed by the RIGHT & SMART marketing and branding Designs. We also work with the
            businesses in helping them generate more leads for their businesses, work on expansion and Growth and
            increase sales/customers. Using new age technology and tools we work with Small Businesses to </p> -->
    </div>
</div>