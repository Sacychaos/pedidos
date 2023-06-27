function capitalizeWords(str) {
    return str.toLowerCase().replace(/\b\w/g, function(l) {
      return l.toUpperCase();
    });
  }

function validarNumericoo(input) {
    input.value = input.value.replace(/\D/g, '');
}
