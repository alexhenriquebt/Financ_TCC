const modalPrincipal = document.querySelector("#modalAdicionar");
const modalAlterar = document.getElementById("modalAlterar");

//abrir modal de add
function abrirModalAdicionar() {
  modalPrincipal.showModal();
}

function fecharModalAdicionar() {
  modalPrincipal.close();
}

//abrir modal de alterar
function abrirModalAlterar() {
  modalAlterar.showModal();
}

function fecharModalAlterar() {
  modalAlterar.close();
}
