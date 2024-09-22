<?php
class Despesa
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

    public function buscarDespesas()
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblDespesa WHERE usuId = :idu");
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function buscarDespesasUpdate($idDespesa)
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblDespesa r JOIN tblCategoria c ON r.catId = c.catId WHERE r.desId = :idr");
        $cmd->bindValue(':idr', $idDespesa);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarDespesas($idDespesa, $idCategoria, $valor, $data, $descricao, $situacao, $nome)
    {
        $cmd = $this->pdo->prepare("UPDATE tblDespesa SET desNome = :nom, desDescricao = :de, desSituacao = :dess, desData = :dat, desValor = :val, catId = :idc WHERE desId = :idr");
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dess', $situacao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->bindValue(':idr', $idDespesa);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function adicionarDespesa($nome, $descricao, $situacao, $data, $valor, $idUsuario, $idCategoria)
    {
        $sql = "INSERT INTO tblDespesa(desNome, desDescricao, desSituacao, desData, desValor, usuId, catId) VALUES (:nom, :de, :dess, :dat, :val, :idu, :idc)";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':nom', $nome);
        $cmd->bindValue(':de', $descricao);
        $cmd->bindValue(':dess', $situacao);
        $cmd->bindValue(':dat', $data);
        $cmd->bindValue(':val', $valor);
        $cmd->bindValue(':idu', $idUsuario);
        $cmd->bindValue(':idc', $idCategoria);
        $cmd->execute();
    }

    public function excluirDespesa($idDespesa)
    {
        $sql = "DELETE FROM tblDespesa WHERE usuId = :idu and desId = :idd";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->bindValue(':idd', $idDespesa);
        $cmd->execute();
        header("Location: ../views/despesas.php");
    }
     public function principaisDespesas()
     {
        $sql = "SELECT * FROM tblDespesa WHERE usuId = :idu ORDER BY desValor DESC LIMIT 3";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
        
     }
}