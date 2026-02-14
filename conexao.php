<?php
/*
$servername = "sql308.infinityfree.com";
$username = "if0_39520080";
$password = "misaeldev";
$dbname = "if0_39520080_acolhe_food";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Conexão falhou: " . $conn->connect_error);
}
*/
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acolhe_food";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Conexão falhou: " . $conn->connect_error);
}

?>