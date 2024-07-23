<?php

require_once "classe_orcamento.php";
$orcamentos = new Orcamento();

if (isset($_GET['idOrcamento'])) {
    $idOrcamento = addslashes($_GET['idOrcamento']);
    $orcamentos->excluirOrcamento($idOrcamento);
}
