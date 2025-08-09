<?php
    include "../conexao.php";

    if(isset($_POST['emailRecuperacao'])) {
        if(strlen($_POST['emailRecuperacao']) == 0){
        echo "Preencha seu email de recuperação";
        }
        else{
        $mysqli = new mysqli("localhost", "root", "", "acolhe_food");
        //$mysqli = new mysqli("localhost", "root", "", "acolhe_food");
        $emailRecuperacao = $mysqli->real_escape_string($_POST['emailRecuperacao']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$emailRecuperacao'";
        $sql_query = $mysqli->prepare($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $sql_query->execute();
        $resultado = $sql_query->get_result();

        $dados = $resultado->fetch_assoc();
        if($resultado->num_rows > 0 ){ 
            if(!isset($_SESSION)){
            session_start();
            }
            $_SESSION['id'] = $dados['id'];
            $_SESSION['nome'] = $dados['usuario'];
            
            $dadosUser = array("id" => "{$dados['id']}", "usuario" => "{$dados['usuario']}");

            //header("Location: codigoRecuperando.php?email={$dados['id']}");
            $sucess = "<p id='falhaLogin' style='color: green'>Verifique o link de recuperação em seu email.</p>";
        }
        else{
            $loginFalhou = "<p id='falhaLogin' style='color: red'>Não existe nenhuma conta cadastrada com esse email!</p>";
        }
        
    }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Recuperação de senha</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #4A7856;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 22px;
            font-weight: 600;
        }

        header p {
            font-size: 14px;
            opacity: 0.9;
        }

        nav {
            background-color: white;
            padding: 10px;
            display: flex;
            justify-content: center;
            gap: 15px;
            border-bottom: 1px solid #ddd;
        }

        nav a {
            color: #4A7856;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #3b6246;
            text-decoration: underline;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .card h2 {
            color: #4A7856;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
            color: #4A7856;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4A7856;
        }

        button {
            background-color: #4A7856;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #3b6246;
        }

        #msgErro2 {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        #msg2 {
            color: green;
            font-size: 14px;
            margin-top: 10px;
        }

        footer {
            background-color: #4A7856;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Acolhe Food</h1>
        <p>Digite seu e-mail para enviar o código de recuperação!</p>
    </header>

    <nav>
        <a href="../login.php">Voltar</a>
        <a href="../registrarForm.php">Registrar-se</a>
    </nav>

    <main>
        <div class="card">
            <h2>Recuperação de senha</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="emailRecuperacao">Digite seu e-mail de recuperação:</label>
                    <input type="email" id="emailRecuperacao" name="emailRecuperacao" required>
                </div>
                <button type="submit" onclick="mandarEmail()">Enviar</button>
                <?php if(isset($loginFalhou)) { echo "<p id='msgErro2'>$loginFalhou</p>"; } ?>
                <?php if(isset($sucess)) { echo "<p id='msg2'>$sucess</p>"; } ?>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Acolhe Food. Todos os direitos reservados.</p>
    </footer>

<script>
    function mandarEmail() {
        var dados = <?php echo json_encode($dados); ?>;
        const email = document.getElementById('emailRecuperacao');
        if (!email) {
            console.error("Campo #emailRecuperacao não encontrado");
            return;
        }

        console.log("Enviando email para:", email.value);

        fetch('http://localhost:3000/link-recuperacao', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email.value, id: dados.id, usuario: dados.usuario })
        })
        .then(response => response.text())
        .then(data => {
            console.log("Resposta do servidor:", data);
            document.getElementById('msgErro2').innerText = data;
        })
        .catch(error => {
            console.error('Erro ao enviar o e-mail:', error);
            document.getElementById('msgErro2').innerText = 'Erro ao enviar o e-mail.';
        });
    }
</script>
</body>
</html>
