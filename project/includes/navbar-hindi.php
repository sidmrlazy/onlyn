<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="index.php" method="POST" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Please select your language:</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="lang-selection-radio">
                    <input type="text" name="session_user_id" value="<?php echo $sessionId ?>" hidden>
                    <div class="form-check lang-options">
                        <input id="languageSelect" class="form-check-input" type="radio" value="1" name="session_selected_lang" id="flexRadioDefault1">
                        <img src="assets/images/eng-lang.png" alt="">
                        <label class="form-check-label" for="flexRadioDefault1">
                            English
                        </label>
                    </div>
                    <div class="form-check lang-options">
                        <input id="languageSelect" class="form-check-input" type="radio" value="2" name="session_selected_lang" id="flexRadioDefault2" checked>
                        <img src="assets/images/hindi-lang.png" alt="">
                        <label class="form-check-label" for="flexRadioDefault2">
                            हिंदी
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="update_lang" class="btn btn-primary">Change</button>
            </div>
        </form>
    </div>
</div>

<div class="top-nav">
    <a href="https://up.bjp.org/" target="_Blank" class="top-nav-brand">
        <img src="assets/icons/bjp-logo.png" alt="">
    </a>
    <div class="top-nav-row">
        <div class="top-nav-row">
            <p>इ-मेल</p>
            <a href="mailto:office.bora2@gmail.com">office.bora2@gmail.com</a>
        </div>
        <div class="top-nav-row">
            <p>कॉन्टैक्ट:</p>
            <a href="tel:05222771141">0522-2771141</a>
            <a href="tel:05222771115">| 0522-2771115</a>
        </div>

        <div class="top-nav-row">
            <button type="button" class="btn btn-sm btn-primary change-lang-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <ion-icon name="language"></ion-icon>
                भाषा बदलें
            </button>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo/1.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                <?php
                if ($title == 'Home | Dr. Neeraj Bora') { ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hindi active" aria-current="page" href="index.php">होम</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hindi" aria-current="page" href="index.php">होम</a>
                    </li>
                <?php } ?>

                <?php
                if ($title == 'About Me | Dr. Neeraj Bora') { ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hindi active" aria-current="page" href="about-me.php">मेरे बारे में </a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link nav-link-hindi" aria-current="page" href="about-me.php">मेरे बारे में </a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="#">विकास कार्य </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="#">गैलरी</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="#">संपर्क करें</a>
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