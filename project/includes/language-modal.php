<div class="modal fade hide" id="languageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="index.php" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="languageModalLabel">Please select your language: </h5>
            </div>
            <div class="modal-body">
                <div class="lang-selection-radio">
                    <input type="text" name="session_user_id" value="<?php echo $sessionId ?>" hidden>
                    <div class="form-check lang-options">
                        <input id="languageSelect" class="form-check-input" type="radio" value="1"
                            name="session_selected_lang" id="flexRadioDefault1">
                        <img src="assets/images/eng-lang.png" alt="">
                        <label class="form-check-label" for="flexRadioDefault1">
                            English
                        </label>
                    </div>
                    <div class="form-check lang-options">
                        <input id="languageSelect" class="form-check-input" type="radio" value="2"
                            name="session_selected_lang" id="flexRadioDefault2" checked>
                        <img src="assets/images/hindi-lang.png" alt="">
                        <label class="form-check-label" for="flexRadioDefault2">
                            हिंदी
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" name="store" class="btn btn-primary" id="languageSubmit">Submit</button>
            </div>
        </form>
    </div>
</div>