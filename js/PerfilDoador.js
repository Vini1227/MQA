function openInferior(Nm){
    let inferior = document.getElementById(Nm);

    if(typeof inferior == 'undefined' || inferior === null)
        return;

        inferior.style.display = 'Block';
}