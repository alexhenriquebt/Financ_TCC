<?php
class Categoria
{
    private $pdo;

    public function __construct()
    {
        try {
            require_once "../config/conexao.php";
            $this->pdo = novaConexao();
        } catch (Exception $e) {
            echo 'Erro ao genérico: ' . $e->getMessage();
            exit();
        }
    }

    public function buscarCategorias($catId)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tblCategoria WHERE catId = :catId");
        $cmd->bindValue(':catId', $catId);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarCategoriasGeral()
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tblCategoria");
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarCategoriasAlterar($catNome)
    {
        $sqlCat = "SELECT * FROM tblCategoria WHERE catNome = :catNome ";
        $cmdCat = $this->pdo->prepare($sqlCat);
        $cmdCat->bindValue(':catNome', $catNome);
        $cmdCat->execute();
        $resultado = $cmdCat->fetch();
        $catId = $resultado[0];
        return $catId;
    }
}
