<?php

require_once "conexao.php";
$conexao = novaConexao();

//ESCOLHE CATEGORIA
$sqlCat = "SELECT * FROM tblCategoria WHERE catNome = :c ";
$cmdCat = $conexao->prepare($sqlCat);
$cmdCat->bindValue(':c', $_POST['categoria']);
$cmdCat->execute();
$resultado = $cmdCat->fetch();
$idCategoria = $resultado[0];
$_SESSION = $resultado[1];

//iNSERE NA TBLRECEITA
$sql = "INSERT INTO tblReceita(recNome, recDescricao, recSituacao, recData, recValor, recIdUsuario, recIdCategoria) VALUES (:nom, :de, :sit, :dat, :val, :idu, :idc)";
$cmd = $conexao->prepare($sql);
$cmd-> bindValue(':nom', $_POST['nome']);
$cmd-> bindValue(':de', $_POST['descricao']);
$cmd-> bindValue(':sit', $_POST['situacao']);
$cmd-> bindValue(':dat', $_POST['data']);
$cmd-> bindValue(':val', $_POST['saldo']);
$cmd-> bindValue(':idu', $_SESSION['idUsuario']);
$cmd-> bindValue(':idc', $idCategoria);
$cmd->execute();

$consulta = "SELECT * FROM tblReceitas WHERE recIdUsuario = :idu";
$cmdConsulta = $conexao->prepare($consulta);
$cmdConsulta-> bindValue(':idu', $_SESSION['idUsuario']);
$cmdConsulta->execute();
$resulConsulta = $cmdConsulta->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['nomeReceita'] = $resultado[1];
$_SESSION['descricaoReceita'] = $resultado[2];
$_SESSION['situacaoReceita'] = $resultado[3];
$_SESSION['dataReceita'] = $resultado[4];
$_SESSION['valorReceita'] = $resultado[5];

header("Location: ../php/receitas.php");

/*
        <?php
          if (count($resProduto) > 0) {
    $mensagem = 'true'; // Defina uma variável para a mensagem
  } else {
    $mensagem = 'false'; // Defina uma variável para a mensagem
  }

        if ($mensagem == 'true') {
          //----- LISTA AS LINHAS(REGISTROS) EM UMA TABELA -----
          for ($i = 0; $i < count($resProduto); $i++) {
            //Pega os registros presentes na matriz $resCliente
            echo '<tr>';
            foreach ($resProduto[$i] as $key => $value) {
              if ($key != 'proNome' && $key != 'proIdCliente') {
                echo '<td>' . $value . '</td>';
              }
            }
            echo '<td><a href="pagamento.php"><button class="btn btn-warning">
            Pagar
            </button>
          </a></td>';
            echo '</tr>';
          }
        } else {
          ?>

          <tr>
            <p><b>----- SEM MANUTENÇÕES -----<b></p>
          </tr>
          <?php
        }
        ?>