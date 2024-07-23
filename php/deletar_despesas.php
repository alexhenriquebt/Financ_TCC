<?php

require_once "classe_despesas.php";
$despesas = new Despesa();

if (isset($_GET['idDespesa'])) {
    $idDespesa = addslashes($_GET['idDespesa']);
    $despesas->excluirDespesa($idDespesa);

    $sql = "DELETE FROM tblDespesa WHERE desIdUsuario = :idu ande idDespesa = :idr";
    $cmd = $this->pdo->prepre($sql);
    $cmd->bindValue(':idu', $_SESSION['idUsuario']);
    $cmd->bindValue(':idr', $idUsuario);
    $cmd->execute();
    header("Location: ../pg/despesas.php");
}
