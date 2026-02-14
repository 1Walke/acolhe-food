<?php 
if(!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['id'])){
    die("Acesso negado. Você precisa fazer login primeiro. <a href='login.php'>Clique aqui para fazer login</a>");
}

?>