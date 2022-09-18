<div class="mt-3 mb-3">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $fetch_promo_query = "SELECT * FROM `promotions` WHERE promo_to = 2";
            $fetch_promo_res = mysqli_query($connection, $fetch_promo_query);

            while ($row = mysqli_fetch_assoc($fetch_promo_res)) {
                $promo_file = "assets/images/promotional-banners/" . $row['promo_file'];
                $promo_status = $row['promo_status'];

                if ($promo_status == 1) { ?>
            <div class="carousel-item active">
                <img src="<?php echo $promo_file ?>" class="d-block w-100" alt="...">
            </div>
            <?php } else if ($promo_status == 2) { ?>
            <div class="d-none carousel-item active">
                <img src="<?php echo $promo_file ?>" class="d-block w-100" alt="...">
            </div>
            <?php }
            } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>