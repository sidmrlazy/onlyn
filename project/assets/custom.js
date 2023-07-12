// ============ CHANGE LANGUAGE MODAL ============ //
window.addEventListener("DOMContentLoaded", function () {
  $("#languageModal").modal("show");
});

// ============ HOMEPAGE SECTION 3 MAP ============ //
var controller = new ScrollMagic.Controller();
var scene = new ScrollMagic.Scene({
  triggerElement: ".homepage-section-3-container",
  triggerHook: "onEnter",
  duration: "100%",
})
  .addTo(controller)
  .on("progress", function (event) {
    var opacity = event.progress.toFixed(2);
    var container = document.querySelector(".homepage-section-3-container");
    container.style.opacity = opacity;
    if (opacity >= 0.3) {
      container.classList.add("visible");
    } else {
      container.classList.remove("visible");
    }
  });
