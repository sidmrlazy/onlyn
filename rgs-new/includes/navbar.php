<div class="top-nav">
    <img src="assets/logo/logo.svg" alt="rgs-college-brand-logo">

    <div class="top-nav-row">
        <div class="top-nav-item">
            <p class="top-nav-link">
                <ion-icon class="top-nav-icon" name="call-outline"></ion-icon> +91 9305889899
            </p>
        </div>

        <div class="top-nav-item">
            <p class="top-nav-link">
                <ion-icon class="top-nav-icon" name="mail-outline"></ion-icon> rgscp23@gmail.com
            </p>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets/logo/logo.svg" alt="rgs-college-brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <?php if ($title === "Top College of Pharmacy in Lucknow | RGS College of Pharmacy") {  ?>
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    <?php } else { ?>
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Who We Are | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="who-we-are.php">Who we are</a>
                    <?php } else { ?>
                    <a class="nav-link" href="who-we-are.php">Who we are</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Courses | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="courses.php">Courses</a>
                    <?php } else { ?>
                    <a class="nav-link" href="courses.php">Courses</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "RGS Edge | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="rgs-edge.php">RGS Edge</a>
                    <?php } else { ?>
                    <a class="nav-link" href="rgs-edge.php">RGS Edge</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Resources | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="resources.php">Resources</a>
                    <?php } else { ?>
                    <a class="nav-link" href="resources.php">Resources</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Admissions | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="admissions.php">Admissions</a>
                    <?php } else { ?>
                    <a class="nav-link" href="admissions.php">Admissions</a>
                    <?php } ?>
                </li>
                <li class="nav-item dropdown">
                    <?php if ($title === "Departments | RGS College of Pharmacy" || $title === "Calendar | RGS College of Pharmacy") { ?>
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Academics
                    </a>
                    <?php } else { ?>
                    <a class="nav-link  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Academics
                    </a>
                    <?php } ?>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="departments.php">Departments</a></li>
                        <li><a class="dropdown-item" href="calendar.php">Calendar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <?php if ($title == "Research & Development | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="research.php">Research & Development</a>
                    <?php } else { ?>
                    <a class="nav-link" href="research.php">Research & Development</a>
                    <?php } ?>
                </li>

                <li class="nav-item">
                    <?php if ($title === "IQAC | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="iqac.php">IQAC</a>
                    <?php } else { ?>
                    <a class="nav-link" href="iqac.php">IQAC</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Brochures | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="brochures.php">Brochures</a>
                    <?php } else { ?>
                    <a class="nav-link" href="brochures.php">Brochures</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Videos | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="videos.php">Videos</a>
                    <?php } else { ?>
                    <a class="nav-link" href="videos.php">Videos</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Events | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="events.php">Events</a>
                    <?php } else { ?>
                    <a class="nav-link" href="events.php">Events</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if ($title === "Contact Us | RGS College of Pharmacy") { ?>
                    <a class="nav-link active" href="contact.php">Contact</a>
                    <?php } else { ?>
                    <a class="nav-link" href="contact.php">Contact</a>
                    <?php } ?>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>