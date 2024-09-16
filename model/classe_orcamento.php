<?php
class Orcamento
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

    public function buscarOrcamentos()
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblOrcamento WHERE orcIdUsuario = :idu");
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarOrcamentosUpdate($idOrcamento)
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblOrcamento r JOIN tblCategoria c ON r.orcIdCategoria = c.idCategoria WHERE r.idOrcamento = :idr");
        $cmd->bindValue(':idr', $idOrcamento);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarOrcamentos($idOrcamento, $idCategoria, $saldo, $data, $descricao, $nome)
    {
        $cmd = $this->pdo->prepare("UPDATE tblOrcamento SET orcNome = :nom, orcDescricao = :de, orcData = :dat, orcSaldo = :sal, orcIdCategoria = :idc WHERE idOrcamento = :idr");
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':sal', $saldo);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->bindValue(':idr', $idOrcamento);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function adicionarOrcamento($nome, $descricao, $data, $saldo, $idUsuario, $idCategoria)
    {
        $sql = "INSERT INTO tblOrcamento(orcNome, orcDescricao, orcData, orcSaldo, orcIdUsuario, orcIdCategoria) VALUES (:nom, :de, :dat, :sal, :idu, :idc)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':sal', $saldo);
        $cmd->bindValue(':idu', $idUsuario);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->execute();
    }

    public function excluirOrcamento($idOrcamento)
    {
        $sql = "DELETE FROM tblOrcamento WHERE orcIdUsuario = :idu and idOrcamento = :idr";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->bindValue(':idr', $idOrcamento);
        $cmd->execute();
        header("Location: ../pg/orcamentos.php");
    }
}
