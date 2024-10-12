<?php
//Atualiza as senhas antigas para o hash
require_once "../config/conexao.php";
$pdo = novaConexao();

// Selecionar todos os usuários com senhas antigas (menos de 60 caracteres)
$sql = "SELECT usuId, usuSenha FROM tblUsuario WHERE CHAR_LENGTH(usuSenha) < 60";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $senhaAntiga = $usuario['usuSenha'];
    
    // Gerar o hash da senha antiga
    $senhaHash = password_hash($senhaAntiga, PASSWORD_BCRYPT);

    // Atualizar a senha no banco de dados com o hash
    $sqlUpdate = "UPDATE tblUsuario SET usuSenha = :senhaHash WHERE usuId = :id";
    $stmtUpdate = $pdo->prepare($sqlUpdate);
    $stmtUpdate->bindValue(':senhaHash', $senhaHash);
    $stmtUpdate->bindValue(':id', $usuario['usuId']);
    $stmtUpdate->execute();
}

echo "Senhas antigas atualizadas para hash!";
