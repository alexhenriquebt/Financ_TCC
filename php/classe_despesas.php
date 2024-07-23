<?php
class Despesa
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

    public function buscarDespesas()
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblDespesa WHERE desIdUsuario = :idu");
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarDespesasUpdate($idDespesa)
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblDespesa r JOIN tblCategoria c ON r.desIdCategoria = c.idCategoria WHERE r.idDespesa = :idr");
        $cmd->bindValue(':idr', $idDespesa);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarDespesas($idDespesa, $idCategoria, $valor, $data, $descricao, $nome)
    {
        $cmd = $this->pdo->prepare("UPDATE tblDespesa SET desNome = :nom, desDescricao = :de, desData = :dat, desValorTotal = :val, desIdCategoria = :idc WHERE idDespesa = :idr");
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->bindValue(':idr', $idDespesa);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function adicionarDespesa($nome, $descricao, $data, $valor, $idUsuario, $idCategoria)
    {
        $sql = "INSERT INTO tblDespesa(desNome, desDescricao, desData, desValorTotal, desIdUsuario, desIdCategoria) VALUES (:nom, :de, :dat, :val, :idu, :idc)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idu', $idUsuario);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->execute();
    }

    public function excluirDespesa($idDespesa)
    {
        $sql = "DELETE FROM tblDespesa WHERE desIdUsuario = :idu and idDespesa = :idr";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->bindValue(':idr', $idDespesa);
        $cmd->execute();
        header("Location: ../pg/despesas.php");
    }
}