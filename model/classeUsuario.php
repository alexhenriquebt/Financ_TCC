<?php
class Usuario
{
    private $pdo;

    // CONEXÃO COM BANCO DE DADOS
    public function __construct()
    {
        try {
            require_once "../config/conexao.php";
            $this->pdo = novaConexao();
        } catch (Exception $e) {
            echo 'Erro genérico: ' . htmlspecialchars($e->getMessage());
            exit();
        }
    }

    public function loginResultado($email, $senha)
    {
        $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :email";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':email', $email);
        $cmd->execute();
        $usuario = $cmd->fetch(PDO::FETCH_ASSOC);
    
        // Verificar a senha com o hash armazenado
        if ($usuario && password_verify($senha, $usuario['usuSenha'])) {
            return $usuario; // Login correto, retorna dados do usuário
        }
    
        return false; // Login incorreto
    }
    

    public function registrarUsuario($nome, $email, $senhaHash)
    {
        // Consulta se o e-mail já está registrado no banco de dados
        $consulta = "SELECT * FROM tblUsuario WHERE usuEmail = :e";
        $cmd = $this->pdo->prepare($consulta);
        $cmd->bindValue(':e', $email);
        $cmd->execute();
    
        // Verifica se o e-mail já existe na tblUsuario
        if ($cmd->rowCount() > 0) {
            // Redireciona para a página de cadastro com erro se o e-mail já estiver em uso
            header('Location: ../views/cadastrar.php?cadastro=emailExistente');
            exit();
        } else {
            // Insere o novo usuário no banco de dados
            $sql = "INSERT INTO tblUsuario(usuNome, usuEmail, usuSenha) VALUES (:n, :e, :s)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':n', $nome);
            $stmt->bindValue(':e', $email);
            $stmt->bindValue(':s', $senhaHash);
            $stmt->execute();
    
            // Consulta o nome do usuário registrado
            $sqlConsulta = "SELECT * FROM tblUsuario WHERE usuEmail = :e";
            $consultaNome = $this->pdo->prepare($sqlConsulta);
            $consultaNome->bindValue(':e', $email);
            $consultaNome->execute();
            $dados = $consultaNome->fetch();
    
            // Iniciar a sessão com as informações do usuário logado
            $_SESSION['usuId'] = $dados['usuId'];
            $_SESSION['email'] = $email;
            $_SESSION['usuario'] = $dados['usuNome'];
            $_SESSION['telefone'] = $dados['usuTelefone'];
            $_SESSION['logado'] = 'sim';
    
            // Redireciona o usuário para a página home
            header('Location: ../views/home.php');
            exit();
        }
    }
    
    public function alterarInformacoes($nome, $email, $telefone, $senhaHash)
    {
        // Verificar se o email já está em uso
        $consultaEmail = $this->pdo->prepare("SELECT * FROM tblUsuario WHERE usuEmail = :email");
        $consultaEmail->bindValue(':email', $email);
        $consultaEmail->execute();
        $resConsultaEmail = $consultaEmail->fetch(PDO::FETCH_ASSOC);

        if ($consultaEmail->rowCount() == 1 && $resConsultaEmail['usuId'] != $_SESSION['usuId']) {
            header('Location: ../views/configuracoes.php?email=erro');
            exit();
        }

        // Atualizar informações do usuário
        $cmdUpdate = $this->pdo->prepare("UPDATE tblUsuario SET usuNome = :nome, usuEmail = :email, usuSenha = :senha, usuTelefone = :telefone WHERE usuId = :id");
        $cmdUpdate->bindValue(':nome', $nome);
        $cmdUpdate->bindValue(':email', $email);
        $cmdUpdate->bindValue(':senha', $senhaHash);
        $cmdUpdate->bindValue(':telefone', $telefone);
        $cmdUpdate->bindValue(':id', $_SESSION['usuId']);
        $cmdUpdate->execute();

        // Atualizar informações da sessão
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $telefone;

        return true;
    }

    public function excluirConta()
    {
        $sql = "DELETE FROM tblUsuario WHERE usuId = :id";
        $cmd = $this->pdo->prepare($sql);
        $cmd->bindValue(':id', $_SESSION['usuId']);
        $cmd->execute();
    }

    public function adicionarTelefone($telefone)
    {
        $cmd = $this->pdo->prepare("UPDATE tblUsuario SET usuTelefone = :telefone WHERE usuId = :id");
        $cmd->bindValue(':telefone', $telefone);
        $cmd->bindValue(':id', $_SESSION['usuId']);
        $cmd->execute();

        // Atualizar informações da sessão
        $_SESSION['telefone'] = $telefone;
    }
}
