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

// Selecionar o botão e o texto padrão
const dropdownButton = document.querySelector('.dropdown-button');
const dropdownSelected = document.getElementById('dropdown-selected');
const dropdownItems = document.querySelectorAll('.dropdown-content a');

// Adicionar evento a cada item da lista
dropdownItems.forEach(item => {
    item.addEventListener('click', (event) => {
        event.preventDefault(); // Evitar comportamento padrão do link

        // Capturar o texto da opção selecionada
        const selectedText = item.textContent;

        // Atualizar o texto do botão
        dropdownSelected.textContent = selectedText;
    });
});

// Selecionar os elementos do dropdown
const dropdownBtn = document.querySelector('.dropdown-button');
const selectedTextElement = document.getElementById('dropdown-selected');
const dropdownLinks = document.querySelectorAll('.dropdown-content a');
const hiddenField = document.getElementById('selected-item');

// Adicionar evento para capturar a opção selecionada
dropdownLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault(); // Prevenir comportamento padrão do link

        // Obter texto e valor do item selecionado
        const itemText = link.textContent;
        const itemValue = link.getAttribute('data-value');

        // Atualizar o botão com o texto selecionado
        selectedTextElement.textContent = itemText;

        // Atualizar o campo oculto com o valor selecionado
        hiddenField.value = itemValue;
    });
});

// Função para validar o formulário
function validateForm() {
    const selectedItemValue = hiddenField.value;

    // Verificar se o usuário selecionou um item válido
    if (!selectedItemValue) {
        alert("Por favor, selecione um item válido na lista.");
        return false; // Bloqueia o envio do formulário
    }

    return true; // Permite o envio do formulário
}
