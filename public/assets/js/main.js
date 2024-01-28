var closeButton = document.querySelector(".alert-message-close");
if (closeButton) {
    closeButton.addEventListener("click", (e) => {
        document.querySelector(".alert-message-wrapper").style.display = "none";
    });
}
