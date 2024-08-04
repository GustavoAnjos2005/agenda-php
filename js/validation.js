// Exemplo de JavaScript inicial para desabilitar envios de formulário se houver campos inválidos
(function () {
  'use strict'

  // Busca de todos os formulários aos quais queremos aplicar estilos de validação personalizados do Bootstrap
  var forms = document.querySelectorAll('.needs-validation')

  // Loop sobre eles e evite o envio
  Array.prototype.slice.call(forms)
      .forEach(function (form) {
          form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                  event.preventDefault();
                  event.stopPropagation();
              }

              form.classList.add('was-validated');
          }, false);
      });
})();
