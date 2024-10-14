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
	<link rel="stylesheet" href="../../css/entrarCadastrar.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
	<link rel="shortcut icon" href="../../assets/images/iconTituloPg.png">
	<title>Criar senha nova</title>
</head>


<body>
	<div class="mt-5">
		<div class="fundo m-5">
			<div class="row">
				<div class="col-12">
					<div class="cardRecuperar">
						<h3 class="text-center mt-3 mb-3">Criar senha</h3>
						<form action="../../model/recuperarSenha/gerarNovaSenha.php" class="form" method="post">
							<div class="p-1">
								<label>Insira sua nova senha:</label>
								<input type="password" class="box w-100" name="senha" placeholder="Senha" required>
							</div>
							<div class="p-1">
								<label>Confirme sua senha:</label>
								<input type="password" class="box w-100" name="confirmarSenha" placeholder="Confirmar senha" required>
							</div>
							<div class="d-grid gap-2 col-6 mx-auto p-1">
								<button class="btn btn-danger" type="submit">Criar nova senha</button>
							</div>

							<?php
							//Validação de usuario
							if (isset($_GET['login']) && ($_GET['login'] == 'codigoInvalido')) { ?>
							<div class="text-center">
								Código inválido!
							</div>
							<?php
							}
							?>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- ------------------------- form LOGIN fim ------------------------- -->
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
	crossorigin="anonymous"></script>

</html>