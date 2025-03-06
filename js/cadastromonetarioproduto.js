const botaoAdicionar = document.getElementById('botaoAdicionar');
const visualizarDiv = document.getElementById('visualizar');
const adicionarDiv = document.getElementById('adicionar');
const adicionarEsquecer = document.getElementById ('adicionarEsquecer')
const adicionarSalvar = document.getElementById ('adicionarSalvar')

botaoAdicionar.addEventListener('click', () => {
    visualizarDiv.style.display = 'none'; // Oculta a div de visualizar
    adicionarDiv.style.display = 'block'; // Mostra a div de adicionar
});

adicionarEsquecer.addEventListener('click', () => {
    visualizarDiv.style.display = 'block';
    adicionarDiv.style.display = 'none';
});

adicionarSalvar.addEventListener('click', () => {
    visualizarDiv.style.display = 'block'; 
    adicionarDiv.style.display = 'none'; 
});
