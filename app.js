const eNumero = (numero) => /^[0-9]+$/.test(numero);

const cepValido = (cep) => cep.length === 8 && eNumero(cep);

const limparFormulario = () => {
  document.getElementById("rua").value = "";
  document.getElementById("bairro").value = "";
  document.getElementById("cidade").value = "";
  document.getElementById("lista_estados").value = "";
};

const preencherFormulario = (endereco) => {
    document.getElementById("rua").value = endereco.logradouro;
    document.getElementById("bairro").value = endereco.bairro;
    document.getElementById("cidade").value = endereco.localidade;
    document.getElementById("lista_estados").value = endereco.uf;
};
const pesquisarCep = async () => {
  limparFormulario();
  const cep = document.getElementById("cep").value.replace("-", "");
  const url = `https://viacep.com.br/ws/${cep}/json/`;

  if(cepValido(cep)){
    const dados = await fetch(url);
    const endereco = await dados.json();
    if(endereco.hasOwnProperty("erro")) {
        document.getElementById("rua").value = "CEP não encontrado.";
    }
    else{
    preencherFormulario(endereco);
    }
  }
  else {
        document.getElementById("rua").value = "CEP inválido.";
    }
};
document.getElementById("cep").addEventListener("focusout", pesquisarCep)

function mostrarSenha(){
    const senha = document.getElementById("senha");
    if(senha.type === "password"){
        senha.type = "text";
        document.getElementById("mostrarsenha").innerText = "Esconder";
    }
    else{
        senha.type = "password";
        document.getElementById("mostrarsenha").innerText = "Mostrar";
    }
};

document.addEventListener("DOMContentLoaded", function () // FUNÇÃO PARA FORMATAÇÃO DO TELEFONE
        {
            const telInput = document.querySelector('input[name="telefone"]');
            telInput.addEventListener("input", function () 
            {
                let value = this.value.replace(/\D/g, "");
                if (value.length > 11) value = value.slice(0, 11);

                value = value.replace(/^(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");

                this.value = value;
            });
        });

document.addEventListener("DOMContentLoaded", function () // FUNÇÃO PARA FORMATAÇÃO DO CEP
        {
            const cepInput = document.querySelector('input[name="cep"]');
            cepInput.addEventListener("input", function () 
            {
                let value = this.value.replace(/\D/g, "");
                if (value.length > 8) value = value.slice(0, 8);

                value = value.replace(/^(\d{5})(\d{3})/, "$1-$2");

                this.value = value;
            });
        });

document.addEventListener("DOMContentLoaded", function () // FUNÇÃO PARA FORMATAÇÃO DO Complemento
        {
            const ComplementoInput = document.querySelector('input[name="complemento"]');
            ComplementoInput.addEventListener("input", function () 
            {
                let value = this.value
                if (value.length > 130) value = value.slice(0, 130);

                this.value = value;
            });
        });

document.addEventListener("DOMContentLoaded", function () {
    const nascInput = document.querySelector('input[name="nascimento"]');

    nascInput.addEventListener("input", function () {
        let value = this.value.replace(/\D/g, "");
        if (value.length > 8) value = value.slice(0, 8);

        if (value.length >= 5) {
            value = value.replace(/^(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
        } else if (value.length >= 3) {
            value = value.replace(/^(\d{2})(\d{0,2})/, "$1/$2");
        }

        this.value = value;

        if (value.length === 10) {
            const dia = parseInt(value.slice(0, 2), 10);
            const mes = parseInt(value.slice(3, 5), 10);
            const ano = parseInt(value.slice(6, 10), 10);

            const anoAtual = new Date().getFullYear();

            const dataValida = dia >= 1 && dia <= 31 && mes >= 1 && mes <= 12 && ano <= anoAtual;

            if (!dataValida) {
                document.getElementById("msgErro").innerText = "Data de nascimento inválida!";
                document.getElementById("nascimento").value = "";
            } else {
                document.getElementById("msgErro").innerText = "";
            }
        }
    });
});

function mandarEmail() {
    
    const email = document.getElementById('emailV');
    const cdg = "0";
    if (!email) {
        console.error("Campo #emailV não encontrado");
        return;
    }

    console.log("Enviando email para:", email.value);

    fetch('https://acolhe-food.onrender.com/send-email', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email.value, cdg: cdg})
    })
    .then(response => response.text())
    .then(data => {
        console.log("Resposta do servidor:", data);
        document.getElementById('msgErro').innerText = data;
    })
    .catch(error => {
        console.error('Erro ao enviar o e-mail:', error);
        document.getElementById('msgErro').innerText = 'Erro ao enviar o e-mail.';
    });
};

function verificarCodigo() {
    const codigoInput = document.getElementById('codigoEmail').value;
    const email = document.getElementById('emailV').value;
    fetch('https://acolhe-food.onrender.com/verificar-codigo', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, codigoDigitado: codigoInput })
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            document.getElementById('msg2').innerText = 'Código verificado com sucesso!, redirecionando...';
                fetch('registrar.php', {method: 'POST',
                    headers: { 'Content-Type': 'application/json' }
            })
                .then(response => response.text())
                .then(responseText => {
                    console.log("Resposta do servidor:", responseText);
                    setTimeout(() => {
                        window.location.href = 'registrar.php'; 
                    }, 4000); // Redireciona após 4 segundos
                }
                )
        } 
        else {
            document.getElementById('msgErro2').innerText = 'Código inválido. Tente novamente.';
        }
    })

};