<?php
//se não está definida a session["logado"] ou
//se não é igual a sim, usuário NÃO está LOGADO
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] == 'nao') {
    //direciona navegador para a página index
    header("Location: ../views/entrar.php?login=erro2");
}
