<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    var toastTrigger = document.getElementById('liveToastBtn')
    var toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
        toastTrigger.addEventListener('click', function() {
            var toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        })
    }
});
</script> -->



<div class="container">

    <button type="submit" class="btn btn-primary" id="liveToastBtn">Show live toast</button>



    <!-- Toast Start -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="productModal" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!-- <img src="..." class="rounded me-2" alt="..."> -->
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>
    <!-- Toast End -->
</div>