<?php
    require "conexao.php";
    require "admin/logsCode.php";

    if(isset($_POST['usuario']) || isset($_POST['senha'])) {
        if(strlen($_POST['usuario']) == 0){
        echo "Preencha seu usuario";
        }
        else if(strlen($_POST['senha']) == 0){
        echo "Preencha sua senha";
        }
        else{
        $usuario = $conn->real_escape_string($_POST['usuario']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $sql_query = $conn->prepare($sql_code) or die("Falha na execução do código SQL: " . $conn->error);
        $sql_query->execute();
        $resultado = $sql_query->get_result();

        $dados = $resultado->fetch_assoc();
        if($resultado->num_rows > 0 && password_verify($senha, $dados['senha'])){ 
            if(!isset($_SESSION)){
            session_start();
            }
            $_SESSION['id'] = $dados['id'];
            $_SESSION['nome'] = $dados['usuario'];
            $_SESSION['possuiPlano'] = $dados['possui_plano'];
            $_SESSION['admin'] = $dados['staff'];
            logUserActionDB($conn, $_SESSION['id'], "LOGIN_SUCCESS", "O usuario '{$_SESSION['nome']}' logou no servidor!"); // ADICIONA O REGISTRO DE LOGIN NAS LOGS

            header("Location: painelLogado.php?vl=" .$_SESSION['possuiPlano']);
        }
        else{
            $loginFalhou = "<p id='falhaLogin' style='color: red'>Usuário ou senha incorretos!</p>";
        }
        
    }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="shortcut icon" href="logo2.png" type="image/x-icon">
    <style>
        /* ===== RESET BÁSICO ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, sans-serif;
  background-color: #f8f9fa;
  color: #333;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

/* ===== CABEÇALHO ===== */
header.topo {
  background: #ffffff;
  padding: 1rem 2rem;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.logo-nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo h1 {
  color: #2e6042;
}

.nav-links a {
  text-decoration: none;
  color: #2e6042;
  margin-left: 1rem;
  font-weight: 500;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #4caf50;
}

.subtitulo {
  margin-top: 0.5rem;
  text-align: center;
  color: #555;
  font-size: 0.95rem;
}

/* ===== CONTAINER LOGIN ===== */
.container {
  background: #ffffff;
  max-width: 400px;
  margin: 4rem auto;
  padding: 4rem;
  border-radius: 10px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.1);
}

.container h2 {
  text-align: center;
  color: #2e6042;
  margin-bottom: 1.5rem;
}

.form-group {
  margin-bottom: 1.2rem;
}

label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #2e6042;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 0.6rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 1rem;
}

#mostrarsenha {
  display: inline-block;
  margin-top: 0.3rem;
  color: #4caf50;
  font-size: 0.9rem;
  transition: color 0.3s ease;
}

#mostrarsenha:hover {
  color: #2e6042;
}

/* Botão Entrar */
button[type="submit"] {
  width: 100%;
  padding: 0.8rem;
  background: #4caf50;
  border: none;
  border-radius: 5px;
  color: white;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}

button[type="submit"]:hover {
  background: #2e6042;
}

.container p a {
  color: #4caf50;
  text-decoration: none;
}

.container p a:hover {
  text-decoration: underline;
}

/* ===== FOOTER ===== */
footer {
  background: #2e6042;
  color: white;
  text-align: center;
  padding: 4rem;
  margin-top: auto;
}

    </style>
</head>
<body>
    <header class="topo">
        <div class="logo-nav">
            <div class="logo">
                <h1>Acolhe Food</h1>
            </div>
            <nav class="nav-links">
                <a href="index.php">Voltar</a>
                <a href="registrarForm.php">Registrar</a>
            </nav>
        </div>
        <p class="subtitulo">Faça login para ficar por dentro do mundo nutritivo!</p>
    </header>
    <div class="container">
        <h2>Entrar</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="senha" required>
                <span id="mostrarsenha" onclick="mostrarSenha()" style="cursor: pointer">Mostrar</span>
            </div>
            <button type="submit">Entrar</button>
            <?php if(isset($loginFalhou)) { echo $loginFalhou; } ?>
        </form> 
        <p><a href="esqueceuSenha/esqueceuSenha.php">Esqueci a senha</a></p>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Acolhe Food. Todos os direitos reservados.</p>
    </footer>
<script defer>
    function mostrarSenha() {
    const senha = document.getElementById("password");
    if(senha.type === "password"){
        senha.type = "text";
        document.getElementById("mostrarsenha").innerText = "Esconder";
    }
    else{
        senha.type = "password";
        document.getElementById("mostrarsenha").innerText = "Mostrar";
    }
};
</script>
</body>
</html>