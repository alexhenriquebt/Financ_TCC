const button = document.getElementById("abrir1")
const modal = document.querySelector("dialog")
const buttonClose = document.querySelector("dialog button")
let contar = 0;


// modal
button.onclick = function() {
    if(contar == 0) {
        modal.show()
        contar++
    } 
    else if(contar == 1) {
        modal.close()
        contar = 0
    }
}

buttonClose.onclick = function() {
    modal.close()
}

// funções

