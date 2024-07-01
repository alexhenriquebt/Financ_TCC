<?php
session_start();
if (!empty($_SESSION['usuario'])) {
  header('Location: home.php');

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/entrar_cadastrar.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="shortcut icon" href="../img/icon_title.png">
	<title>Entrar</title>
</head>


<body>
	<!-- ------------------------- form LOGIN ------------------------- -->
	<div class="">
		<div class="fundo m-5">
			<div class="row">
				<div class="col-12 col-md-6 bloco-entrar">
					<div class="card_entrar">
						<h2 class="text-center">Entrar</h2>
						<form action="../php/valida_login.php" class="form" method="post">
							<div class="text-center p-2">
								<input type="email" class="box w-100" name="email" placeholder="E-mail" required>
							</div>
							<div class="text-center p-2">
								<input type="password" name="senha" class="box w-100" placeholder="Senha" required>
							</div>
							<div class="d-grid gap-2 col-6 mx-auto p-2">
								<button class="btn btn-danger" type="submit">Entrar</button>
							</div>

							<?php
							//Validação de usuario
							if (isset($_GET['login']) && ($_GET['login'] == 'erro')) { ?>
								<div class="text-center">
									Usuário ou senha inválido(s)
								</div>
							<?php
							}
							?>

							<?php
							if (isset($_GET['login']) && ($_GET['login'] == 'erro2')) { ?>
								<div class="text-center">
									Faça login antes de acessar as páginas protegidas
								</div>
							<?php
							}
							?>
						</form>
					</div>
				</div>



				<!-- ------------------------- img LOGIN ------------------------- -->
				<div class="col-12 col-md-6 bloco-img-login">
					<img class="img-fluid h-100
					" src="../img/img_login.png" alt="ícone com gráficos - remetendo a finanças">
					<div class="">
						<a class="btn-wrap" href="cadastrar.php"><button class="btn btn-danger w-50">Não tem uma conta? Clique aqui</button></a>
					</div>
				</div>
				<!-- ------------------------- img fim ------------------------- -->


			</div>
		</div>
	</div>
	<!-- ------------------------- form LOGIN fim ------------------------- -->
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>