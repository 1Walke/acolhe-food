<?php 

require '../conexao.php';

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['novaSenha']) && isset($data['id'])){
    $novaSenha = $data['novaSenha'];
    $id = $data['id'];

    $senha = password_hash($novaSenha, PASSWORD_DEFAULT);


    $sql_code = "UPDATE usuarios SET senha = ? WHERE id = ?";
    $sql_query = $conn->prepare($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    $sql_query->bind_param("si", $senha, $id);

    if($sql_query->execute()){
       echo json_encode(["sucesso" => true, "mensagem" => "Senha atualizada com sucesso!, redirecionando..."]);       
    } 
    else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao atualizar a senha: " . $conn->error]);
    }
}
else {
    echo json_encode(["sucesso" => false, "mensagem" => "Dados inválidos!"]); 
}

?>