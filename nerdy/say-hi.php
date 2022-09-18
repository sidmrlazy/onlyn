<?php include('main/header.php') ?>
<?php include('main/web-navbar.php') ?>

<div class="container d-flex w-100 say-hi-section">
    <div class="col-md-6 say-hi-visual">
        <lottie-player src="https://assets9.lottiefiles.com/private_files/lf30_3lflolyo.json" background="transparent"
            speed="1" class="say-hi-lottie" loop autoplay></lottie-player>
    </div>
    <div class="container col-md-6 ">
        <form action="" class="card p-4 say-hi-form-section">
            <div class="form-floating mb-3">
                <input required type="text" class="form-control" id="clientName" placeholder="Full Name">
                <label for="clientName">Full Name</label>
            </div>
            <div class="form-floating mb-3">
                <input required type="number" class="form-control" id="contactNumberClient" placeholder="Mobile Number">
                <label for="contactNumberClient">Mobile Number</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="clientEmail" placeholder="Email">
                <label for="clientEmail">Email</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Know more about?</option>
                    <option value="Pricing">Pricing</option>
                    <option value="Features">Features</option>
                    <option value="Career">Career</option>
                    <option value="Custom Development">Custom Development</option>
                    <option value="Integration">Integration</option>
                </select>
                <label for="floatingSelect">Click here for options</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 80px"></textarea>
                <label for="floatingTextarea2">What do you want to connect with us about?</label>
            </div>

            <button class="btn btn-outline-info">Connect</button>
        </form>
    </div>
</div>
<?php include('main/footer.php') ?>