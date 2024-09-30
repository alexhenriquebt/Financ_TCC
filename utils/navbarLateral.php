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
      <a
        href="<?php echo $base_url; ?>/home.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Voltar para a tela inicial">
        <img src="../img/icon_title.png" alt="" class="img-fluid" />
        <p>Home</p>
      </a>
    </div>
    <div class="col-12">
      <a
        href="<?php echo $base_url; ?>/centroCusto.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Visualize e gerencie suas contas">
        <i class="bi bi-graph-down-arrow"></i>
        <p>Centro de custo</p>
      </a>
    </div>
    <div class="col-12">
      <a
        href="<?php echo $base_url; ?>/metas.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Defina metas">
        <i class="bi bi-bullseye"></i>
        <p>Metas</p>
      </a>
    </div>
    <div class="col-12">
      <a
        href="<?php echo $base_url; ?>/relatorios.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Veja um resumo de suas finanças">
        <i class="bi bi-graph-up"></i>
        <p>Relatórios</p>
      </a>
    </div>
    <div class="col-12">
      <a
        href="<?php echo $base_url; ?>/configuracoes.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Configurações">
        <i class="bi bi-gear"></i>
        <p>Configurações</p>
      </a>
    </div>
    <div class="col-12">
      <a
        href="<?php echo $base_url; ?>/ajuda.php"
        data-bs-toggle="popover"
        data-bs-trigger="hover focus"
        data-bs-content="Encontre como resolver seus problemas e dúvidas">
        <i class="bi bi-info-circle"></i>
        <p>Ajuda</p>
      </a>
    </div>
  </div>
</div>
<!-- ------------------------- navbar-lateral fixada fim ------------------------- -->