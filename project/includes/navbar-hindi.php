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
                        <input id="languageSelect" class="form-check-input" type="radio" value="1"
                            name="session_selected_lang" id="flexRadioDefault1">
                        <img src="assets/images/eng-lang.webp"
                            alt="BJP MLA from Lucknow North, Uttar Pradesh - 2017 Election Winner - Bharatiya Janata Party (BJP) Leader">
                        <label class="form-check-label" for="flexRadioDefault1">
                            English
                        </label>
                    </div>
                    <div class="form-check lang-options">
                        <input id="languageSelect" class="form-check-input" type="radio" value="2"
                            name="session_selected_lang" id="flexRadioDefault2">
                        <img src="assets/images/hindi-lang.webp"
                            alt="Bharatiya Janata Party (BJP) MLA for Lucknow North, Uttar Pradesh. Elected in 2017">
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
        <img src="assets/icons/bjp-logo.webp" alt="Dr. Neeraj Bora - BJP MLA from Lucknow North, Uttar Pradesh.">
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
            <button type="button" class="btn btn-sm btn-primary change-lang-btn" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <ion-icon name="language"></ion-icon>
                भाषा बदलें
            </button>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="assets/logo/1.webp"
                alt="BJP MLA from Lucknow, Uttar Pradesh, representing Bharatiya Janata Party. Elected in 2017 UP election for Lucknow North constituency">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto me-auto mb-2 mb-lg-0">
                <?php
                if ($title == 'होम | डॉ नीरज बोरा') { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi active" aria-current="page" href="index.php">होम</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="index.php">होम</a>
                </li>
                <?php } ?>

                <?php
                if ($title == 'मेरे बारे में | डॉ नीरज बोरा ') { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-hindi active dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        मुझे जानें
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="about-me.php">मेरे बारे में</a></li>
                        <li><a class="dropdown-item" href="achievements.php">उपलब्धियाँ</a></li>
                        <li><a class="dropdown-item" href="inspiration.php">मेरे प्रेरणा स्रोत</a></li>
                    </ul>
                </li>
                <?php } else if ($title == 'उपलब्धियाँ | डॉ नीरज बोरा') { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-hindi active dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        मुझे जानें
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="about-me.php">मेरे बारे में</a></li>
                        <li><a class="dropdown-item" href="achievements.php">उपलब्धियाँ</a></li>
                        <li><a class="dropdown-item" href="inspiration.php">मेरे प्रेरणा स्रोत</a></li>
                    </ul>
                </li>
                <?php } else if ($title == 'प्रेरणा | डॉ नीरज बोरा') { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-hindi active dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        मुझे जानें
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="about-me.php">मेरे बारे में</a></li>
                        <li><a class="dropdown-item" href="achievements.php">उपलब्धियाँ</a></li>
                        <li><a class="dropdown-item" href="inspiration.php">मेरे प्रेरणा स्रोत</a></li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-hindi dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        मुझे जानें
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="about-me.php">मेरे बारे में</a></li>
                        <li><a class="dropdown-item" href="achievements.php">उपलब्धियाँ</a></li>
                        <li><a class="dropdown-item" href="inspiration.php">मेरे प्रेरणा स्रोत</a></li>
                    </ul>
                </li>
                <?php } ?>

                <!-- <?php
                        if ($title == 'विकास कार्य | डॉ नीरज बोरा') { ?>
                <li class="nav-item">
                    <a class="nav-link active nav-link-hindi" aria-current="page" href="development-work.php">विकास
                        कार्य </a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="development-work.php">विकास कार्य </a>
                </li>
                <?php } ?> -->

                <?php
                if ($title == 'प्रेस रिलीज़ | डॉ नीरज बोरा') { ?>
                <li class="nav-item">
                    <a class="nav-link active nav-link-hindi" aria-current="page" href="press-release.php">प्रेस
                        रिलीज़</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="press-release.php">प्रेस रिलीज़</a>
                </li>
                <?php } ?>

                <?php
                if ($title == 'संपर्क करें | डॉ नीरज बोरा') { ?>
                <li class="nav-item">
                    <a class="nav-link active nav-link-hindi" aria-current="page" href="contact.php">संपर्क करें</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hindi" aria-current="page" href="contact.php">संपर्क करें</a>
                </li>
                <?php } ?>
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
            <div class="d-flex mobile-flex">
                <div class="navbar-social-media-icons">
                    <a href="https://www.facebook.com/NeerajBoraLKO/" target="_blank">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                    <a href="https://twitter.com/DrNeerajBora" target="_blank">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                    <a href="https://www.instagram.com/drneerajboraofficial/" target="_blank">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </div>

                <div class="top-nav-row desktop-view">
                    <button type="button" class="btn btn-sm btn-primary change-lang-btn" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <ion-icon name="language"></ion-icon>
                        भाषा बदलें
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>