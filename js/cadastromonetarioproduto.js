const botaoAdicionar = document.getElementById("botaoAdicionar");
const visualizarDiv = document.getElementById("visualizar");
const adicionarDiv = document.getElementById("adicionar");
const adicionarEsquecer = document.getElementById("adicionarEsquecer");
const adicionarSalvar = document.getElementById("adicionarSalvar");
const botaoEditar = document.getElementById("botaoEditar");
const editarDiv = document.getElementById("editar");
const editarVoltar = document.getElementById("editarVoltar");

botaoAdicionar.addEventListener("click", () => {
  visualizarDiv.style.display = "none"; // Oculta a div de visualizar
  adicionarDiv.style.display = "flex"; // Mostra a div de adicionar
});

adicionarEsquecer.addEventListener("click", () => {
  visualizarDiv.style.display = "block";
  adicionarDiv.style.display = "none";
});

adicionarSalvar.addEventListener("click", () => {
  visualizarDiv.style.display = "block";
  adicionarDiv.style.display = "none";
});

botaoEditar.addEventListener("click", () => {
  visualizarDiv.style.display = "none";
  editarDiv.style.display = "flex";
});

editarVoltar.addEventListener("click", () => {
  visualizarDiv.style.display = "block";
  editarDiv.style.display = "none";
});

function atualizarItem(id, nome, tipo, descricao) {
  document.getElementById("atualizar-id").value = id;
  document.getElementById("atualizar-nome").value = nome;
  document.getElementById("atualizar-tipo").value = tipo;
  document.getElementById("atualizar-descricao").value = descricao;

  document.getElementById("editar").style.display = "none";
  document.getElementById("atualizar").style.display = "block";
}

document.getElementById("atualizarVoltar").addEventListener("click", () => {
  document.getElementById("visualizar").style.display = "block";
  document.getElementById("atualizar").style.display = "none";
});

document
  .getElementById("formAtualizar")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    this.submit();
  });

const img = document.getElementById("lixo");
img.addEventListener("mouseover", function () {
  img.src = "/imgs/redcan.png";
});

img.addEventListener("mouseout", function () {
  img.src = "/imgs/trashcan.png"; // Caminho da imagem original
});

// Função para mostrar a imagem selecionada no lugar da imagem original
function showSelectedImage(input, imgClass) {
  var file = input.files[0];
  var reader = new FileReader();

  reader.onload = function (e) {
    // Substitui a imagem atual com a imagem selecionada
    var img = document.querySelector("." + imgClass);
    img.src = e.target.result;
  };

  if (file) {
    reader.readAsDataURL(file); // Lê o arquivo como URL de dados
  }
}

// Função para mostrar o botão de salvar quando qualquer alteração ocorrer
function showSaveButton() {
  var saveButton = document.getElementById("save-button");
  saveButton.style.display = "inline-block"; // Exibe o botão de "Salvar"
}

// Função para mostrar o botão de salvar quando qualquer alteração ocorrer
function showSaveButton() {
  var saveButton = document.getElementById("save-button");
  saveButton.style.display = "inline-block"; // Exibe o botão de "Salvar"
}

// Função para permitir edição do nome
function makeEditable() {
  var nomeTexto = document.getElementById("nome-texto");
  var nomeInput = document.getElementById("nome-input");

  nomeTexto.style.display = "none"; // Esconde o nome visível
  nomeInput.style.display = "inline-block"; // Exibe o campo de input
  nomeInput.focus(); // Dá foco no campo de input
}

// Detecta alterações no input de nome
document.getElementById("nome-input").addEventListener("input", function () {
  showSaveButton();
});

// Detecta alterações nas imagens (perfil e banner)
document.getElementById("perfil").addEventListener("change", function () {
  showSaveButton();
});
document.getElementById("banner").addEventListener("change", function () {
  showSaveButton();
});

function submitForm() {
  // Envia o formulário quando o input perde o foco (blur)
  document.getElementById("form-upload").submit();
}
