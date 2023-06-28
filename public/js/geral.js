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

            fetch('/orders', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    // Se a resposta não for OK (por exemplo, 422), ainda queremos interpretar o corpo como JSON
                    return response.json().then(errorData => {
                        // Neste ponto, "errorData" será um objeto com as informações de erro retornadas pelo servidor
                        throw errorData; // Rejeitamos a promessa com os dados de erro
                    });
                }
            })
            .then(data => {
                // Pedido processado com sucesso
                alert(data.message);
                // Limpar o formulário
                orderForm.reset();
            })
            .catch(error => {
                // Se chegarmos aqui, ou houve um erro de rede, ou a resposta do servidor foi um erro (não OK)
                if (error.message) {
                    // Se o erro tem uma propriedade de "message", presumimos que é um erro do servidor e mostramos a mensagem
                    alert(error.message);
                } else {
                    // Caso contrário, é provavelmente um erro de rede
                    console.error('Erro ao enviar o formulário:', error);
                }
            });
        });
    }
});
