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
        input.value = input.value
        .replace(/[^\d.,]/g, '') // Remove caracteres não numéricos, exceto ".", ",".
        .replace(',', '.'); // Substitui a "," por ".".

        // Lógica extra para tratar múltiplas ocorrências de "." ou ",".
        const parts = input.value.split('.');
        if (parts.length > 2) {
        input.value = parts.slice(0, -1).join('') + '.' + parts.slice(-1);
        }
    });
});

    // Array para controlar o estado de envio de cada formulário
    const formEnvioStatus = [];

    // Loop through each form.
    for (let index = 0; index < 100; index++) { // use a higher number here if you expect more than 100 forms.
        const orderForm = document.getElementById(`orderForm${index}`);
        if (!orderForm) break;

        // Inicializa o estado de envio do formulário como "false"
        formEnvioStatus[index] = false;

        orderForm.addEventListener('submit', (event) => {
            event.preventDefault();

            // Verifica se o formulário já foi enviado
            if (formEnvioStatus[index]) {
                alert('O pedido já foi enviado. Por favor, aguarde.');
                return;
            }

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

            // Atualiza o estado de envio do formulário para "true"
            formEnvioStatus[index] = true;

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
                // Quebrar a mensagem para exibição
                const messageLines = [
                    'Pedido feito com sucesso!',
                    'Verifique a aba "Meus Pedidos"'
                ];
                const message = messageLines.join('\n');
                alert(message);
                // Limpar o formulário
                orderForm.reset();
                // Redefinir o estado de envio do formulário para "false"
                formEnvioStatus[index] = false;
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
                // Redefinir o estado de envio do formulário para "false"
                formEnvioStatus[index] = false;
            });
        });
    }
});



