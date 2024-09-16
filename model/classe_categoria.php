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

    public function buscarCategorias($idCategoria)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tblCategoria WHERE idCategoria = :c");
        $cmd->bindValue(':c', $idCategoria);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarCategoriasAlterar($categoria)
    {
        $sqlCat = "SELECT * FROM tblCategoria WHERE catNome = :c ";
        $cmdCat = $this->pdo->prepare($sqlCat);
        $cmdCat->bindValue(':c', $categoria);
        $cmdCat->execute();
        $resultado = $cmdCat->fetch();
        $idCategoria = $resultado[0];
        return $idCategoria;
    }
}
