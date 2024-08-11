<?php

require_once "classe_despesa.php";
$despesas = new Despesa();

if (isset($_GET['idDespesa'])) {
    $idDespesa = addslashes($_GET['idDespesa']);
    $despesas->excluirDespesa($idDespesa);
}
