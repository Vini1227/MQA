const botaoAdicionar = document.getElementById('botaoAdicionar');
const visualizarDiv = document.getElementById('visualizar');
const adicionarDiv = document.getElementById('adicionar');
const adicionarEsquecer = document.getElementById ('adicionarEsquecer')
const adicionarSalvar = document.getElementById ('adicionarSalvar')
const botaoEditar = document.getElementById ('botaoEditar')
const editarDiv = document.getElementById ('editar')
const editarVoltar = document.getElementById ('editarVoltar')

botaoAdicionar.addEventListener('click', () => {
    visualizarDiv.style.display = 'none'; // Oculta a div de visualizar
    adicionarDiv.style.display = 'flex'; // Mostra a div de adicionar
});

adicionarEsquecer.addEventListener('click', () => {
    visualizarDiv.style.display = 'block';
    adicionarDiv.style.display = 'none';
});

adicionarSalvar.addEventListener('click', () => {
    visualizarDiv.style.display = 'block'; 
    adicionarDiv.style.display = 'none'; 
});

botaoEditar.addEventListener('click', () => {
    visualizarDiv.style.display = 'none';
    editarDiv.style.display = 'flex';
});

editarVoltar.addEventListener('click', () => {
    visualizarDiv.style.display = 'block';
    editarDiv.style.display = 'none';
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

document.getElementById("formAtualizar").addEventListener("submit", function(event) {
    event.preventDefault();

    this.submit();
});

