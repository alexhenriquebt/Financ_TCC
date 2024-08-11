<?php
class Receita
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
        $cmd = $this->pdo->prepare("SELECT * FROM tblReceita r JOIN tblCategoria c ON r.recIdCategoria = c.idCategoria WHERE r.idReceita = :idr");
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

    public function adicionarReceita($nome, $descricao, $situacao, $data, $valor, $idUsuario, $idCategoria)
    {
        $sql = "INSERT INTO tblReceita(recNome, recDescricao, recSituacao, recData, recValor, recIdUsuario, recIdCategoria) VALUES (:nom, :de, :sit, :dat, :val, :idu, :idc)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':sit', $situacao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idu', $idUsuario);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->execute();
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

    public function principaisReceitas()
    {
       $sql = "SELECT * FROM tblReceita WHERE recIdUsuario = :idu ORDER BY recValor DESC LIMIT 3";
       $cmd = $this->pdo->prepare($sql);
       $cmd->bindValue(':idu', $_SESSION['idUsuario']);
       $cmd->execute();
       $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
       return $res;
       
    }
}
