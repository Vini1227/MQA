document.addEventListener("DOMContentLoaded", function() {
    let mensagem = document.querySelector(".error-msg");

    if (mensagem) {
        setTimeout(() => {
            mensagem.style.animation = "fadeOut 0.5s ease-in-out";
            setTimeout(() => {
                mensagem.style.display = "none";
            }, 500);
        }, 3000);
    }
});
