<?php

$base_url = dirname($_SERVER["PHP_SELF"]);

$base_url = rtrim($base_url, '/view');
?>

<link rel="stylesheet" href="../css/navbarLateral.css">

<!-- volume para dar espaçamento -->
<div class="col-2 navbar-lateral-fantasma">
  <!-- sem conteúdo -->
</div>

<!-- ------------------------- navbar-lateral fixada ------------------------- -->
<div class="navbar-lateral text-center m-0">
  <div class="row g-4">
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/home.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Voltar para a tela inicial">
        <div>
          <img src="../assets/images/iconTituloPg.png" alt="" class="img-fluid" />
          <p>Home</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/centroCusto.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Visualize e gerencie suas despesas e receitas">
        <div>
          <i class="bi bi-receipt"></i>
          <p>Contas</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/metas.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Defina metas">
        <div>
          <i class="bi bi-flag"></i>
          <p>Metas</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/relatorios.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Veja um resumo de suas finanças">
        <div>
          <i class="bi bi-graph-up"></i>
          <p>Relatórios</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/configuracoes.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Configurações">
        <div>
          <i class="bi bi-gear"></i>
          <p>Configurações</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/ajuda.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Encontre como resolver seus problemas e dúvidas">
        <div>
          <i class="bi bi-info-circle"></i>
          <p>Ajuda</p>
        </div>
      </a>
    </div>
    <div class="col-12">
      <a href="<?php echo $base_url; ?>/blog.php" data-bs-toggle="popover" data-bs-trigger="hover focus"
        data-bs-content="Veja dicas para melhorar suas finanças">
        <div>
          <i class="bi bi-card-text"></i>
          <p>Blog</p>
        </div>
      </a>
    </div>
  </div>
</div>
<!-- ------------------------- navbar-lateral fixada fim ------------------------- -->