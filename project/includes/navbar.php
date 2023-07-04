<div class="top-nav">
    <a href="https://up.bjp.org/" target="_Blank" class="top-nav-brand">
        <img src="assets/icons/bjp-logo.png" alt="">
    </a>
    <div class="top-nav-row">
        <div class="top-nav-row">
            <p>Email:</p>
            <a href="mailto:office.bora2@gmail.com">office.bora2@gmail.com</a>
        </div>
        <div class="top-nav-row">
            <p>Contact:</p>
            <a href="tel:05222771141">0522-2771141</a>
            <a href="tel:05222771115">| 0522-2771115</a>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo/1.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                <?php
                if ($title == 'Home | Dr. Neeraj Bora') { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">HOME</a>
                </li>
                <?php } ?>

                <?php
                if ($title == 'About Me | Dr. Neeraj Bora') { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="about-me.php">ABOUT ME</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about-me.php">ABOUT ME</a>
                </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">DEVELOPMENT WORK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">GALLERY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">CONTACT</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                </li> -->
            </ul>
            <div class="d-flex">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div>

                </div>
            </div>
        </div>
    </div>
</nav>