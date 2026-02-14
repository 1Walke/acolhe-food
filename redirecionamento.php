<?php 

if(!isset($_SESSION)){
    session_start();
    header("Location: painelLogado.php?vl=" . $_SESSION['possuiPlano']);
}

if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Redirecionando</title>
  <link rel="stylesheet" href="../style.css">
  <link rel="shortcut icon" href="logoacolhe.png" type="image/x-icon">
</head>