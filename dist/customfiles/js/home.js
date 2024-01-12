/***************************** fa-bars **********************/

$(document).ready(function () {
  $(".menu").click(function () {
    $(this).find("i").toggleClass("fa-bars fa-times");
    $(".navbar").toggleClass("nav-toggle");
  });
});

// Get references to the message and submit buttons
document.addEventListener("DOMContentLoaded", function () {
  const submitButton = document.querySelector(".submit");
  const message = document.getElementById("message");
  const okButton = message.querySelector("button[type='button']");

  submitButton.addEventListener("click", function () {
    // Show the message by adding the "open-message" class
    message.classList.add("open-message");
  });

  okButton.addEventListener("click", function () {
    // Close the message by removing the "open-message" class
    message.classList.remove("open-message");
  });
});

/***************************** all buttons **********************/

const buttons = document.querySelectorAll(".navigateButton");

buttons.forEach((button) => {
  button.addEventListener("click", function () {
    const target = this.getAttribute("data-target");
    window.location.href = target;
  });
});
