document.getElementById("cadastrar-btn").addEventListener("click", function() {
    // Pegando os dados do formulário
    const nome = document.getElementById("nome").value;
    const senha = document.getElementById("senha").value;
    const confirmarSenha = document.getElementById("confirmar_senha").value;
    const email = document.getElementById("email").value;
    const cnpj = document.getElementById("cnpj").value;

    // Validando as senhas
    if (senha !== confirmarSenha) {
        alert("As senhas não coincidem!");
        return;
    }

    // Enviando os dados via POST para o back-end
    fetch("cadastro_ong.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            nome: nome,
            senha: senha,
            email: email,
            cnpj: cnpj,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Cadastro realizado com sucesso!");
            window.location.href = "login.html"; // Redireciona para página de login
        } else {
            alert("Erro ao cadastrar ONG: " + data.error);
        }
    })
    .catch(error => {
        alert("Erro ao enviar os dados: " + error);
    });
});