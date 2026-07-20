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