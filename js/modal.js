const modalPrincipal = document.querySelector("#modalAdicionar");
const modalAlterar = document.getElementById("modalAlterar");
const modalOrcAddDes = document.getElementById("despesasExistentes");

//abrir modal de add

function abrirModalAdicionar() {
  modalPrincipal.showModal();
}

function fecharModalAdicionar() {
  modalPrincipal.close();
}

function abrirModalAlterar() {
  modalAlterar.showModal();
}

function fecharModalAlterar() {
  modalAlterar.close();
}

function abrirModalOrcAddDes() {
  modalOrcAddDes.showModal();
}

function fecharModalOrcAddDes() {
  modalOrcAddDes.close();
}