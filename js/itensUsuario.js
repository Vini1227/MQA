const card1 = document.getElementById("donatetype-card");
const card2 = document.getElementById("iten-donate-card");
const showCard1Button = document.getElementById("card-toggle-2");
const showCard2Button = document.getElementById("card-toggle-1");

// Botão para mostrar o primeiro card
showCard1Button.addEventListener("click", () => {
    card1.style.display = "flex"; // Exibe o Card 1
    card2.style.display = "none"; // Oculta o Card 2
});

// Botão para mostrar o segundo card
showCard2Button.addEventListener("click", () => {
    card1.style.display = "none"; // Oculta o Card 1
    card2.style.display = "flex"; // Exibe o Card 2
});

const decrementButton = document.querySelector(".count-decrement");
const incrementButton = document.querySelector(".count-increment");
const numberInput = document.getElementById("number-input");

// Função para decrementar o valor
decrementButton.addEventListener("click", () => {
    let currentValue = parseInt(numberInput.value) || 0;
    const minValue = parseInt(numberInput.min) || 0;
    if (currentValue > minValue) {
        numberInput.value = currentValue - 1;
    }
});

// Função para incrementar o valor
incrementButton.addEventListener("click", () => {
    let currentValue = parseInt(numberInput.value) || 0;
    const maxValue = parseInt(numberInput.max) || Infinity;
    if (currentValue < maxValue) {
        numberInput.value = currentValue + 1;
    }
});



