<?php
    require "../conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Senha - Acolhe Food</title>
    <script>
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

    </script>
    <style>
        :root {
            --primary-color: #3f704d;
            --primary-dark: #2f5a3d;
            --bg-light: #f7f9fa;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--bg-light);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Topo */
        header {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 10px 0 5px 0;
        }

        header h1 {
            margin: 0;
            font-size: 20px;
        }

        header p {
            margin: 0;
            font-size: 14px;
        }

        /* Links superiores */
        .top-links {
            background: white;
            text-align: center;
            padding: 8px 0;
        }

        .top-links a {
            margin: 0 10px;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
        }

        .top-links a:hover {
            text-decoration: underline;
        }

        /* Formulário central */
        .form-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 400px;
            margin: 40px auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            text-align: center;
        }

        .form-container h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 18px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            background: var(--primary-color);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* Mensagem inferior */
        .info-msg {
            margin-top: 10px;
            font-size: 13px;
            color: var(--primary-color);
        }
        #mostrarsenha {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #215732;
            cursor: pointer;
        }

        /* Rodapé */
        footer {
            background: var(--primary-color);
            color: white;
            text-align: center;
            padding: 8px 0;
            font-size: 12px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Topo -->
    <header>
        <h1>Acolhe Food</h1>
        <p>Digite sua nova senha para atualizar o acesso!</p>
    </header>

    <!-- Links superiores -->
    <div class="top-links">
        
    </div>

    <!-- Conteúdo -->
    <div class="form-container">
        <h2>Nova Senha</h2>
        <form action="/nova-senha" method="POST">
            <div class="form-group">
                <label for="novaSenha">Nova senha:</label>
                <input type="password" id="novaSenha" name="senha" placeholder="Digite sua nova senha" required>
            </div>

            <div class="form-group">
                <label for="confirmarSenha">Confirmar senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha" placeholder="Confirme sua nova senha" required>
                <span id="mostrarsenha" onclick="mostrarSenha()">Mostrar</span>
            </div>

            <button onclick="verificarSenha()" type="button" class="btn-primary">Salvar</button>
            <p id="msgErro2" style="color: red; font-size:14px"></p>
            <p id="msg2" style="color: green; font-size:14px"></p>

            <div class="info-msg">
                Sua senha será atualizada imediatamente após a confirmação.
            </div>
        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        © 2025 Acolhe Food. Todos os direitos reservados.
    </footer>
    <script src="esqueceuSenha.js"></script>
</body>
</html>

