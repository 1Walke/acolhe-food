<?php
require 'conexao.php';


$email = $_GET['email'] ?? '';
$verificando = $_GET['verificando'] ?? '';

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email - Acolhe Food</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Cabeçalho no padrão do index */
        header {
            background-color: #4A7856;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            font-size: 14px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Container central */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        main h2 {
            color: #4A7856;
            margin-bottom: 20px;
            font-size: 18px;
            text-align: center;
            max-width: 500px;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #4A7856;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            background-color: #4A7856;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #3b6246;
        }

        #msgErro2 {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        #msg2 {
            color: green;
            font-size: 14px;
            text-align: center;
        }

        /* Rodapé no padrão do index */
        footer {
            background-color: #4A7856;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Acolhe Food</h1>
    </header>

    <main>
        <h2>Digite o código de verificação que foi enviado para <?php echo $email; ?></h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="emailV">Email:</label>
                <input type="text" id="emailV" name="emailVerificar" value="<?php echo $email;?>" readonly required>
            </div>
            <div class="form-group">
                <label for="codigoEmail">Código:</label>
                <input type="number" id="codigoEmail" name="codigoEmail" required>
            </div>
            <p id="msgErro2"></p>
            <p id="msg2"></p>
            <button type="button" onclick="verificarCodigo()">Verificar</button>
        </form>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Acolhe Food. Todos os direitos reservados.</p>
    </footer>

    <script src="app.js"></script>
    <?php if($verificando == 1) { ?>
        <script>mandarEmail();</script>
    <?php } ?>
</body>
</html>

