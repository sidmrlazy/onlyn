<!-- =========================== DESKTOP SIDE NAVBAR  =========================== -->
<div class="side-navbar">
    <div class="side-navbar-brand">
        <img src="assets-admin/logo/4.png" alt="">
    </div>
    <ul class="side-nav-link">
        <li>
            <a href="index.php">
                <ion-icon name="apps-outline"></ion-icon> Dashboard
            </a>
        </li>
        <li>
            <a href="press-release.php">
                <ion-icon name="megaphone-outline"></ion-icon> Press Release
            </a>
        </li>
        <li>
            <a href="logout.php">
                <ion-icon name="log-out-outline"></ion-icon> Logout
            </a>
        </li>
    </ul>
</div>

<!-- =========================== MOBILE NAVBAR =========================== -->
<nav class="navbar navbar-dark navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="assets-admin/logo/4.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">
                        <ion-icon name="apps-outline"></ion-icon> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <ion-icon name="megaphone-outline"></ion-icon> Press Release
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <ion-icon name="log-out-outline"></ion-icon> Logout
                    </a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>