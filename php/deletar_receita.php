<?php

require_once "classe_receita.php";
$receitas = new Receita();

if (isset($_GET['idReceita'])) {
    $idReceita = addslashes($_GET['idReceita']);
    $receitas->excluirReceita($idReceita);
}
