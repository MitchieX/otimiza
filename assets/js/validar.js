// EBOOKs

function validar() {
  if (nome1.value == "" || email1.value == "" || telefone1.value == "") {
    alert("Preencha seus dados corretamente!");
    return false;
  } else {
    window.location.href = "../download/planodeensino.pdf";
  }
}
