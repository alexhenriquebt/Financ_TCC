<?php
class Usuario
{
    private $pdo;
    //CONEXÃO COM BANCO DE DADOS
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

    public function loginResultado()
    {
        $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :e AND usuSenha = :s";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':e', $_POST['email']);
        $cmd->bindValue(':s', $_POST['senha']);
        $cmd->execute();

        $res = $cmd->fetch();
        return $res;
    }

    public function loginConsulta()
    {
        $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :e AND usuSenha = :s";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':e', $_POST['email']);
        $cmd->bindValue(':s', $_POST['senha']);
        $cmd->execute();

        return $cmd;
    }

    public function alterarInformacoes()
    {
        //email em uso
        $consultaEmail = $this->pdo->prepare("SELECT * FROM tblUsuario WHERE usuEmail = :eme ");
        $consultaEmail->bindValue(':eme', $_POST['email']);
        $consultaEmail->execute();
        $resConsultaEmail = $consultaEmail->fetch();

        if ($consultaEmail->rowCount() == 1 && $resConsultaEmail[2] != $_SESSION['email']) {
            header('Location: ../views/configuracoes.php?email=erro');
        } else {
            $cmdNome = $this->pdo->prepare("UPDATE tblUsuario SET usuNome = :nom WHERE usuId = :idu");
            $cmdNome->bindValue(':nom', $_POST['nome']);
            $cmdNome->bindValue(':idu', $_SESSION['idUsuario']);
            $cmdNome->execute();

            $cmdEmail = $this->pdo->prepare("UPDATE tblUsuario SET usuEmail = :eme WHERE usuId = :idu");
            $cmdEmail->bindValue(':eme', $_POST['email']);
            $cmdEmail->bindValue(':idu', $_SESSION['idUsuario']);
            $cmdEmail->execute();

            $cmdTel = $this->pdo->prepare("UPDATE tblUsuario SET usuTelefone = :cel WHERE usuId = :idu");
            $cmdTel->bindValue(':cel', $_POST['telefone']);
            $cmdTel->bindValue(':idu', $_SESSION['idUsuario']);
            $cmdTel->execute();

            $consulta = $this->pdo->prepare("SELECT * FROM tblUsuario WHERE usuId = :idu");
            $consulta->bindValue(':idu', $_SESSION['idUsuario']);
            $consulta->execute();
            $res = $consulta->fetch();

            $_SESSION['usuario'] = $res[1];
            $_SESSION['email'] = $res[2];
            $_SESSION['telefone'] = $res[4];
            header("Location: ../views/configuracoes.php");
        }
    }

    public function excluirConta()
    {
        $sql = "DELETE FROM tblUsuario WHERE usuId = :i";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':i', $_SESSION['idUsuario']);
        $cmd->execute();
        session_destroy();
        header("Location: ../index.html");
    }

    public function adicionarTelefone()
    {
        $cmd = $this->pdo->prepare("UPDATE tblUsuario SET usuTelefone = :cel WHERE usuId = :idu");
        $cmd->bindValue(':cel', $_POST['telefone']);
        $cmd->bindValue(':idu', $_SESSION['idUsuario']);
        $cmd->execute();

        $consulta = $this->pdo->prepare("SELECT * FROM tblUsuario WHERE usuId = :idu");
        $consulta->bindValue(':idu', $_SESSION['idUsuario']);
        $consulta->execute();
        $resultado = $consulta->fetch();

        $_SESSION['telefone'] = $resultado[4];
        header("Location: ../views/configuracoes.php");
    }
}
