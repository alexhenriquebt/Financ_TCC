<?php
class CentroCusto
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

    public function buscarCentroCusto(): array
    {
        $cmd = $this->pdo->prepare( "SELECT * 
FROM tblCentroCusto cen 
JOIN tblDetCentroCusto det ON cen.cenId = det.cenId
JOIN tblLancamento lan ON lan.decId = det.decId
JOIN tblHisCentroCusto his ON his.lanId = lan.lanId
JOIN tblCategoria cat ON cat.catId = cen.catId
WHERE det.usuId = :usuId;
");
        $cmd->bindValue(':usuId', $_SESSION['usuId']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function exibirCategoria($cenId)
    {
        $res = [];
        $cmd = $this->pdo->prepare("SELECT * FROM tblCentroCusto cen JOIN tblCategoria cat WHERE cen.catId = cat.catId AND cen.cenId = :cenId");
        $cmd->bindValue(':cenId', $cenId);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function editarCentroCusto($cenId, $catId, $cenValor, $vencimento, $cenDescricao, $cenTipo, $cenNome, $situacao)
    {
        // Iniciar transação para garantir que todas as atualizações sejam feitas de forma atômica
        $this->pdo->beginTransaction();
    
        try {
            // Atualizar a tabela tblCentroCusto
            $cmd = $this->pdo->prepare("
                UPDATE tblCentroCusto 
                SET cenNome = :nom, cenDescricao = :de, cenTipo = :tip, cenValor = :val, catId = :idc 
                WHERE cenId = :idr
            ");
            $cmd->bindValue(':nom', $cenNome);
            $cmd->bindValue(':de', $cenDescricao);
            $cmd->bindValue(':tip', $cenTipo);
            $cmd->bindValue(':val', $cenValor);
            $cmd->bindValue(':idc', $catId);
            $cmd->bindValue(':idr', $cenId);
            $cmd->execute();
    
            // Buscar o decId relacionado ao cenId na tabela tblDetCentroCusto
            $cmdDet = $this->pdo->prepare("SELECT decId FROM tblDetCentroCusto WHERE cenId = :cenId");
            $cmdDet->bindValue(':cenId', $cenId);
            $cmdDet->execute();
            $detCentroCusto = $cmdDet->fetch(PDO::FETCH_ASSOC);
    
            if (!$detCentroCusto) {
                throw new Exception("Nenhum Detalhe encontrado para este Centro de Custo.");
            }
    
            $decId = $detCentroCusto['decId'];
    
            // Buscar o lanId relacionado ao decId na tabela tblLancamento
            $cmdLancamento = $this->pdo->prepare("SELECT lanId FROM tblLancamento WHERE decId = :decId");
            $cmdLancamento->bindValue(':decId', $decId);
            $cmdLancamento->execute();
            $lancamento = $cmdLancamento->fetch(PDO::FETCH_ASSOC);
    
            if (!$lancamento) {
                throw new Exception("Nenhum Lançamento encontrado para este Detalhe de Centro de Custo.");
            }
    
            $lanId = $lancamento['lanId'];
    
            // Atualizar a tabela tblLancamento
            $cmdAtualizaLancamento = $this->pdo->prepare("
                UPDATE tblLancamento 
                SET lanVencimento = :vencimento, lanSituacao = :situacao 
                WHERE lanId = :lanId
            ");
            $cmdAtualizaLancamento->bindValue(':vencimento', $vencimento);
            $cmdAtualizaLancamento->bindValue(':situacao', $situacao);
            $cmdAtualizaLancamento->bindValue(':lanId', $lanId);
            $cmdAtualizaLancamento->execute();
    
            // Buscar o hceId relacionado ao lanId na tabela tblHisCentroCusto
            $cmdHisCentroCusto = $this->pdo->prepare("SELECT hceId FROM tblHisCentroCusto WHERE lanId = :lanId");
            $cmdHisCentroCusto->bindValue(':lanId', $lanId);
            $cmdHisCentroCusto->execute();
            $hisCentroCusto = $cmdHisCentroCusto->fetch(PDO::FETCH_ASSOC);
    
            if (!$hisCentroCusto) {
                throw new Exception("Nenhum Histórico de Centro de Custo encontrado para este Lançamento.");
            }
    
            $hceId = $hisCentroCusto['hceId'];
    
            // Atualizar o campo hceUltimoRegistro na tabela tblHisCentroCusto com a data/hora atual
            $cmdAtualizaHisCentroCusto = $this->pdo->prepare("
                UPDATE tblHisCentroCusto 
                SET hceUltimoRegistro = NOW() 
                WHERE hceId = :hceId
            ");
            $cmdAtualizaHisCentroCusto->bindValue(':hceId', $hceId);
            $cmdAtualizaHisCentroCusto->execute();
    
            // Se tudo correr bem, commit na transação
            $this->pdo->commit();
        } catch (Exception $e) {
            // Em caso de erro, rollback para desfazer as alterações
            $this->pdo->rollBack();
            throw new Exception("Erro ao atualizar o Centro de Custo: " . $e->getMessage());
        }
        return true;
    }
    
    

    public function adicionarCentroCusto($nome, $descricao, $tipo, $valor, $idCategoria, $vencimento, $situacao, $forma)
    {
        try {
            // Inicia a transação
            $this->pdo->beginTransaction();

            // Insere na tabela tblCentroCusto
            $stmt1 = $this->pdo->prepare("INSERT INTO tblCentroCusto (cenNome, cenDescricao, cenTipo, cenValor, catId) 
                                          VALUES (:cenNome, :cenDescricao, :cenTipo, :cenValor, :catId)");
            $stmt1->execute([
                ':cenNome' => $nome,
                ':cenDescricao' => $descricao,
                ':cenTipo' => $tipo,
                ':cenValor' => $valor,
                ':catId' => $idCategoria
            ]);
            // Captura o ID gerado na tblCentroCusto
            $cenId = $this->pdo->lastInsertId();

            // Insere na tabela tblDetCentroCusto
            $stmt2 = $this->pdo->prepare("INSERT INTO tblDetCentroCusto (cenId, usuId) 
                                          VALUES (:cenId, :usuId)");
            $stmt2->execute([
                ':cenId' => $cenId,
                ':usuId' => $_SESSION['usuId']
            ]);
            // Captura o ID gerado na tblDetCentroCusto
            $decId = $this->pdo->lastInsertId();

            // Insere na tabela tblLancamento
            $stmt3 = $this->pdo->prepare("INSERT INTO tblLancamento (lanVencimento, lanSituacao, lanForma, decId) 
                                          VALUES (:lanVencimento, :lanSituacao, :lanForma, :decId)");
            $stmt3->execute([
                ':lanVencimento' => $vencimento,
                ':lanSituacao' => $situacao,
                ':lanForma' => $forma,
                ':decId' => $decId
            ]);
            // Captura o ID gerado na tblLancamento
            $lanId = $this->pdo->lastInsertId();

            // Insere na tabela tblHisCentroCusto
            $stmt4 = $this->pdo->prepare("INSERT INTO tblHisCentroCusto (hceUltimoRegistro, lanId) 
                                          VALUES (NOW(), :lanId)");
            $stmt4->execute([
                ':lanId' => $lanId
            ]);

            // Finaliza a transação
            $this->pdo->commit();

            echo "Dados inseridos com sucesso!";
        } catch (Exception $e) {
            // Em caso de erro, desfaz todas as inserções
            $this->pdo->rollBack();
            echo "Erro ao inserir os dados: " . $e->getMessage();
        }
    }

    public function excluirCentroCusto($cenId)
    {
        $cmd = $this->pdo->prepare("DELETE FROM tblCentroCusto WHERE cenId = :cenId");
        $cmd->bindValue('cenId', $cenId);
        $cmd->execute();

        return true;
    }

    
    public function somarCreditosDebitos($cenTipo)
    {
        $cmd = $this->pdo->prepare("
SELECT SUM(cen.cenValor) AS totalValor
FROM tblCentroCusto cen 
JOIN tblDetCentroCusto dece ON cen.cenId = dece.cenId
JOIN tblLancamento lan ON lan.decId = dece.decId
JOIN tblHisCentroCusto hce ON hce.lanId = lan.lanId
WHERE cen.cenTipo = :cenTipo
AND dece.usuId = :usuId;

    ");
    $cmd->bindValue(':cenTipo', $cenTipo);
    $cmd->bindValue(':usuId', $_SESSION['usuId']);
    $cmd->execute();
    $res = $cmd->fetch(PDO::FETCH_ASSOC);
    $soma = $res['totalValor'];
    
    return $soma; 
    }

    public function filtrarTipo($cenTipo)
    {
        $cmd = $this->pdo->prepare("SELECT * FROM tblCentroCusto cen
        JOIN tblDetCentroCusto det
        JOIN tblLancamento lan
        JOIN tblCategoria cat
        JOIN tblHisCentroCusto his
        WHERE cen.cenId = det.cenId
        AND
        cen.cenTipo = :cenTipo
        AND
        det.usuId = :usuId
        AND
        lan.decId = det.decId
        AND
        his.lanId = lan.lanId
        AND
        cat.catId = cen.catId
        ");
        $cmd->bindValue('usuId', $_SESSION['usuId']);
        $cmd->bindValue('cenTipo', $cenTipo);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function filtrarPendencias($cenTipo) {
        $cmd = $this->pdo->prepare("
        SELECT * FROM tblCentroCusto cen 
        JOIN tblDetCentroCusto det 
        JOIN tblLancamento lan 
        WHERE cen.cenTipo = :cenTipo
        AND
        det.usuId = :usuId
        AND
        cen.cenId = det.cenId
        AND
        lan.decId = det.decId
        AND
        lan.lanSituacao = :lanSituacao");
        $cmd->bindValue(':cenTipo', $cenTipo);
        $cmd->bindValue(':usuId', $_SESSION['usuId']);
        $cmd->bindValue(':lanSituacao', value: 'Pendente');
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function filtrarDespesasReceitasCategoria($cenTipo)
    {
        $cmd = $this->pdo->prepare("
            SELECT cat.catNome, SUM(cen.cenValor) AS totalValor
            FROM tblCentroCusto cen
            JOIN tblDetCentroCusto dece ON cen.cenId = dece.cenId
            JOIN tblCategoria cat ON cat.catId = cen.catId
            WHERE cen.cenTipo = :cenTipo
            AND dece.usuId = :usuId
            GROUP BY cat.catNome
            ORDER BY totalValor DESC
            LIMIT 12
        ");
        $cmd->bindValue(':cenTipo', $cenTipo);
        $cmd->bindValue(':usuId', $_SESSION['usuId']);
        $cmd->execute();
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        
        return $res; 
    }
    
}
