
function verificarSenha() {
    const senhaInput = document.getElementById('novaSenha').value;
    const confirmarSenha = document.getElementById('confirmarSenha').value;
    const urlParams = new URLSearchParams(window.location.search);
    const tokenDaUrl = urlParams.get('token');
    const idDoUsuario = urlParams.get('id');
    if( senhaInput.length < 6) {
        document.getElementById('msgErro2').innerText = 'A senha deve ter pelo menos 6 caracteres.';
        return;
    }
    else if(senhaInput !== confirmarSenha) {
        document.getElementById('msgErro2').innerText = 'As senhas não conferem.';
        return;
    }
    else{
            console.log("Verificando código:", { token: tokenDaUrl, idUser: idDoUsuario });
            fetch('https://acolhe-food-esqueceusenha.onrender.com/verificar-codigo', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ token: tokenDaUrl, idUser: idDoUsuario })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                        fetch('updateSenha.php', {method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({id: idDoUsuario, novaSenha: senhaInput})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.sucesso) {
                                document.getElementById('msg2').innerText = data.mensagem;
                                setTimeout(() => {
                                window.location.href = '../login.php'; 
                            }, 4000); // Redireciona após 4 segundos
                            }
                            else{
                                document.getElementById('msgErro2').innerText = data.mensagem;
                            }
                        }
                        )
                } 
                else {
                    document.getElementById('msgErro2').innerText = 'Algo deu errado. Tente novamente.';
                }
            })
    }
};

function mostrarSenha(){
    const senha = document.getElementById("novaSenha");
    const senhaC = document.getElementById("confirmarSenha");
    if(senha.type === "password"){
        senha.type = "text";
        senhaC.type = "text";
        document.getElementById("mostrarsenha").innerText = "Esconder";
    }
    else{
        senha.type = "password";
        senhaC.type = "password";
        document.getElementById("mostrarsenha").innerText = "Mostrar";
    }
};

