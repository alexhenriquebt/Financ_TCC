<?php
class Metas
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

    public function buscarMetas(): array
    {
        $cmd = $this->pdo->prepare( "SELECT * 
FROM tblMetas meta
JOIN tblCategoria cat ON cat.catId = meta.catId
WHERE meta.usuId = :usuId;
");
        $cmd->bindValue(':usuId', $_SESSION['usuId']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarMetas($metaId, $catId, $metaValorInicial, $metaValor, $vencimento, $metaDescricao, $metaNome, $situacao)
    {
        // Iniciar transação para garantir que todas as atualizações sejam feitas de forma atômica
        $this->pdo->beginTransaction();
    
        try {
            // Atualizar a tabela tblMetas
            $cmd = $this->pdo->prepare("
                UPDATE tblMetas 
                SET metaNome = :nom, metaDataVencimento = :dat , metaSituacao = :sit ,metaDescricao = :de, metaValorInicial = :val, metaValor = :vai, catId = :idc 
                WHERE metaId = :idr
            ");
            $cmd->bindValue(':idr', $metaId);
            $cmd->bindValue(':nom', $metaNome);
            $cmd->bindValue(':val', $metaValorInicial);
            $cmd->bindValue(':vai', $metaValor);
            $cmd->bindValue(':dat', $vencimento);
            $cmd->bindValue(':sit', $situacao);
            $cmd->bindValue(':de', $metaDescricao);
            $cmd->bindValue(':idc', $catId);
            $cmd->execute();
    
        } catch (Exception $e) {
            // Em caso de erro, rollback para desfazer as alterações
            $this->pdo->rollBack();
            throw new Exception("Erro ao atualizar o Centro de Custo: " . $e->getMessage());
        }
        
        return true;
    }
    
    

    public function adicionarMetas($nome, $descricao, $valorInicial, $valor, $idCategoria, $vencimento, $situacao)
    {
        try {
            // Inicia a transação
            $this->pdo->beginTransaction();

            // Insere na tabela tblMetas
            $stmt1 = $this->pdo->prepare("INSERT INTO tblMetas (metaNome, metaDescricao, metaValorInicial, metaValor, metaDataVencimento, metaSituacao, catId) 
                                          VALUES (:metaNome, :metaDescricao, :metaValorInicial , :metaValor, :metaDataVencimento, :metaSituacao, :catId)");
            $stmt1->execute([
                ':metaNome' => $nome,
                ':metaDescricao' => $descricao,
                ':metaValorInicial' => $valorInicial,
                ':metaValor' => $valor,
                ':metaDataVencimento' => $vencimento,
                ':metaSituacao' => $situacao,
                ':catId' => $idCategoria
            ]);
            // Captura o ID gerado na tblMeta
            $metaId = $this->pdo->lastInsertId();

            // Finaliza a transação
            $this->pdo->commit();

            echo "Dados inseridos com sucesso!";
        } catch (Exception $e) {
            // Em caso de erro, desfaz todas as inserções
            $this->pdo->rollBack();
            echo "Erro ao inserir os dados: " . $e->getMessage();
        }
    }

    public function excluirMetas($metaId)
    {
        $cmd = $this->pdo->prepare("DELETE FROM tblMetas WHERE metaId = :metaId");
        $cmd->bindValue('metaId', $metaId);
        $cmd->execute();

        return true;
    
        $cmd->bindValue(':cenTipo', $cenTipo);
        $cmd->bindValue(':usuId', $_SESSION['usuId']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        
        return $res; 
    }
    
}
