<?php 
session_start();

require 'conexao.php';

$nome = $_SESSION['nome'] ?? '';
$sobrenome = $_SESSION['sobrenome'] ?? '';
$email = $_SESSION['email'] ?? '';
$ddd = $_SESSION['ddd'] ?? '';
$telefone = $_SESSION['telefone'] ?? '';
$cidade = $_SESSION['cidade'] ?? '';
$bairro = $_SESSION['bairro'] ?? '';
$rua = $_SESSION['rua'] ?? '';
$numeroEndereco = $_SESSION['numeroEndereco'] ?? '';
$complemento = $_SESSION['complemento'] ?? '';
$estado = $_SESSION['estado'] ?? '';
$usuario = $_SESSION['usuario'] ?? '';
$senha = $_SESSION['senha'] ?? '';
$cepNumerico = $_SESSION['cep'] ?? '';
$data_nascimento = $_SESSION['data_nascimento'] ?? '';

$sql = "insert into usuarios (nome, sobrenome, data_nascimento, email, ddd, telefone, usuario, senha) values (?, ?, ?, ?, ?, ?, ?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nome, $sobrenome,$data_nascimento, $email, $ddd, $telefone, $usuario, $senha);


if($stmt->execute()){
        $id_user = $conn-> insert_id;
        $sqlEndereco = "INSERT INTO endereco_usuario (cep, cidade, bairro, rua, numero, complemento, estado, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt2 = $conn->prepare($sqlEndereco);
        $stmt2->bind_param("issssssi", $cepNumerico, $cidade,$bairro, $rua, $numeroEndereco, $complemento, $estado, $id_user);
        
        if($stmt2->execute()){
        echo "<p style='color: green'>Registro realizado com sucesso!</p>";       
        } 
        else {
                echo "<p>Erro ao registrar endereço: " . $conn->error . "</p>";
            }
        } 
        else {
                echo "<p>Erro ao registrar usuario: " . $conn->error . "</p>";
            }


?>