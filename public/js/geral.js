function capitalizeWords(str) {
    return str.toLowerCase().replace(/\b\w/g, function(l) {
      return l.toUpperCase();
    });
  }

function validarNumericoo(input) {
    input.value = input.value.replace(/\D/g, '');
}

window.addEventListener('DOMContentLoaded', () => {
    const campoNumericoInputs = document.querySelectorAll('.campo-numerico');
    campoNumericoInputs.forEach((input) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '');
        });
    });

    // Loop through each form.
    for (let index = 0; index < 100; index++) { // use a higher number here if you expect more than 100 forms.
        const orderForm = document.getElementById(`orderForm${index}`);
        if (!orderForm) break;

        orderForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const tamanhoGroup = document.getElementById(`tamanho-group-${index}`);
            const pagamentoGroup = document.getElementById(`pagamento-group-${index}`);

            const tamanhoSelected = tamanhoGroup ? tamanhoGroup.querySelector(
                'input[type="radio"]:checked') : null;
            const pagamentoSelected = pagamentoGroup ? pagamentoGroup.querySelector(
                'input[type="radio"]:checked') : null;

            if (!tamanhoSelected) {
                alert('Por favor, selecione um tamanho.');
                return;
            }

            if (!pagamentoSelected) {
                alert('Por favor, selecione uma forma de pagamento.');
                return;
            }

            const formData = new FormData(orderForm);

            fetch('/orders', { // Use the /orders route to make the request
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    // Pedido processado com sucesso
                    alert(data.message);
                    // Limpar o formulário
                    orderForm.reset();
                })
                .catch(error => {
                    console.error('Erro ao enviar o formulário:', error);
                });
        });
    }
});
