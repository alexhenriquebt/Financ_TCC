<?php
Class Receita
{
    private $pdo;

    public function __construct()
    {
        try {
            require_once "conexao.php";
            $this->pdo = novaConexao();
        } catch (Exception $e) {
            echo 'Erro ao genérico: ' . $e->getMessage();
            exit();
        }
    }

    public function buscarReceitas()
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblReceita WHERE recIdUsuario = :idu");
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarReceitasUpdate($idReceita)
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblReceita WHERE idReceita = :idr");
        $cmd->bindValue(':idr', $idReceita);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarReceitas($idReceita, $idCategoria, $valor, $data, $descricao, $nome)
    {
        $cmd = $this->pdo->prepare("UPDATE tblReceita SET recNome = :nom, recDescricao = :de, recData = :dat, recValor = :val, recIdCategoria = :idc WHERE idReceita = :idr");
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->bindValue(':idr', $idReceita);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarCategorias($idCategoria)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tblCategoria WHERE idCategoria = :c");
        $cmd->bindValue(':c', $idCategoria);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function excluirReceita($idReceita)
    {
        $sql = "DELETE FROM tblReceita WHERE recIdUsuario = :idu and idReceita = :idr";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->bindValue(':idr', $idReceita);
        $cmd->execute();
        header("Location: ../pg/receitas.php");
    }
}