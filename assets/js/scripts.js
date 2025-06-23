// Validação de formulário
document.addEventListener('DOMContentLoaded', function() {
    // Validação genérica
    const forms = document.querySelectorAll('.needs-validation');
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Validação específica da placa
    const placaInput = document.getElementById('placa');
    if (placaInput) {
        placaInput.addEventListener('blur', function() {
            const placaRegex = /^[A-Z]{3}\d{4}$/;
            if (!placaRegex.test(this.value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }

    // Confirmação antes de excluir
    document.querySelectorAll('.btn-excluir').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm('Tem certeza que deseja excluir este carro?')) {
                e.preventDefault();
            }
        });
    });
});