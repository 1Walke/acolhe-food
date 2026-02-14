<?php 

require "conexao.php";
    $verificando = 0;
    if(isset($_POST['registrar'])){
        session_start();
        $cep = $_POST['cep'];
        $cepNumerico = str_replace("-", "", $cep);
        $_SESSION['cep'] = $cepNumerico; // SALVA O CEP NA SESSÃO
        $_SESSION['nome'] = $_POST['nome'];
        $_SESSION['sobrenome'] = $_POST['sobrenome'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['telefone'] = $_POST['telefone'];
        $_SESSION['cidade'] = $_POST['cidade'];
        $_SESSION['bairro'] = $_POST['bairro'];
        $_SESSION['rua'] = $_POST['rua'];
        $_SESSION['numeroEndereco'] = $_POST['numero'];
        $_SESSION['complemento'] = $_POST['complemento'];
        $_SESSION['estado'] = $_POST['estados'];
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento']; 

        list($dia, $mes, $ano) = explode("/", $nascimento); // SEPARA O DIA, MES E ANO PARA SALVAR NO BANCO DE DADOS
        $limpo = str_replace(["(", ")"],"", $telefone); // RETIRA OS PARENTESES DO TELEFONE
        $ddd = substr($limpo, 0, 2); // SEPARA O DDD DO TELEFONE
        $numero = substr($limpo, 2); // SEPARA O NÚMERO DO TELEFONE

        $_SESSION['ddd'] = $ddd; // SALVA O DDD NA SESSÃO
        $_SESSION['telefone'] = $numero; // SALVA O NÚMERO NA SESSÃO
        $_SESSION['data_nascimento'] = "$ano-$mes-$dia"; // SALVA A DATA DE NASCIMENTO NA SESSÃO

        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? OR usuario = ?");
        $stmt->bind_param("ss", $email, $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $resultado = "<p style='color:red'>Email ou usuário já cadastrados!</p>";
        } else {
            // Redireciona para verificação de email
            header("Location: verificarEmail.php?email=$email&verificando=1");
            exit();
        }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - Acolhe Food</title>
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6f7;
            margin: 0;
            padding: 0;
        }

        /* Cabeçalho */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
        }

        header h1 {
            color: #215732;
            font-size: 22px;
        }

        header nav a {
            text-decoration: none;
            color: #215732;
            margin-left: 15px;
            font-weight: bold;
            font-size: 14px;
        }

        header p {
            font-size: 14px;
            color: #444;
        }

        /* Centralização do formulário */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        /* Card do formulário */
        .form-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-box h2 {
            text-align: center;
            color: #215732;
            margin-bottom: 20px;
        }

        /* Inputs */
        .form-group {
            margin-bottom: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Botão */
        button {
            width: 100%;
            padding: 10px;
            background-color: #43a047;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #388e3c;
        }

        /* Link de mostrar senha */
        #mostrarsenha {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #215732;
            cursor: pointer;
        }

        /* Rodapé */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #215732;
            color: white;
            font-size: 12px;
            margin-top: 50px;
        }
    </style>
    <script>
        function mostrarSenha() {
            const senha = document.getElementById("senha");
            if (senha.type === "password") {
                senha.type = "text";
                document.getElementById("mostrarsenha").innerText = "Esconder";
            } else {
                senha.type = "password";
                document.getElementById("mostrarsenha").innerText = "Mostrar";
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Acolhe Food</h1>
        <nav>
            <a href="login.php">Voltar</a>
        </nav>
    </header>

<div class="container">
    <div class="form-box">
        <h2>Registrar</h2>
        <form id="form" method="POST">
            <div class="form-group">
                <input type="text" id="nome" name="nome" placeholder="Nome" required
                       value="<?php echo isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required
                       value="<?php echo isset($_POST['sobrenome']) ? htmlspecialchars($_POST['sobrenome']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="nascimento" name="nascimento" placeholder="Data de nascimento" required
                       value="<?php echo isset($_POST['nascimento']) ? htmlspecialchars($_POST['nascimento']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="tel" id="telefone" name="telefone" placeholder="Telefone" required
                       value="<?php echo isset($_POST['telefone']) ? htmlspecialchars($_POST['telefone']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="cep" name="cep" placeholder="CEP" required
                       value="<?php echo isset($_POST['cep']) ? htmlspecialchars($_POST['cep']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="cidade" name="cidade" placeholder="Cidade" required
                       value="<?php echo isset($_POST['cidade']) ? htmlspecialchars($_POST['cidade']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="bairro" name="bairro" placeholder="Bairro" required
                       value="<?php echo isset($_POST['bairro']) ? htmlspecialchars($_POST['bairro']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="rua" name="rua" placeholder="Rua" required
                       value="<?php echo isset($_POST['rua']) ? htmlspecialchars($_POST['rua']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="number" id="numero" name="numero" placeholder="Número" required
                       value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="text" id="complemento" name="complemento" placeholder="Complemento (opcional)"
                       value="<?php echo isset($_POST['complemento']) ? htmlspecialchars($_POST['complemento']) : ''; ?>">
            </div>
            <div class="form-group">
                <select name="estados" id="lista_estados" required>
                    <option value="">Selecione o estado</option>
                    <?php
                    $estados = [
                        "SP", "RJ", "MG", "RS", "BA", "PR", "PE", "CE", "SC", "GO", "DF", "ES", "MA",
                        "AM", "PA", "MT", "MS", "AL", "PB", "PI", "SE", "RN", "AC", "AP", "RO", "RR", "TO"
                    ];
                    foreach ($estados as $uf) {
                        $selected = (isset($_POST['estados']) && $_POST['estados'] === $uf) ? 'selected' : '';
                        echo "<option value=\"$uf\" $selected>$uf</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" id="usuario" name="usuario" placeholder="Usuário" required
                       value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>">
            </div>
            <div class="form-group">
                <input type="password" id="senha" name="senha" placeholder="Senha" required>
                <span id="mostrarsenha" onclick="mostrarSenha()">Mostrar</span>
            </div>
            <div class="form-group">
                <button type="submit" name="registrar">Registrar</button>
                <p id="msgErro" style="color:red; font-size: 14px"></p>
                <?php if(isset($resultado)) { echo $resultado; } ?>
            </div>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2025 Acolhe Food. Todos os direitos reservados.</p>
</footer>
<script src="app.js"></script>

</body>
</html>