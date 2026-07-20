document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert').forEach(function (alert) {
        setTimeout(function () {
            alert.classList.add('alert-fade-out');
            setTimeout(function () { alert.remove(); }, 400);
        }, 4000);
    });

    document.querySelectorAll('form[data-confirm]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            if (!window.confirm(form.getAttribute('data-confirm'))) {
                e.preventDefault();
                return;
            }
            var btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = 'Traitement...';
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const champNumero = document.getElementById('numero');
    if (champNumero) {
        champNumero.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
    }
});