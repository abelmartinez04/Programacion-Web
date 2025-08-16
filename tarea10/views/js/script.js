document.addEventListener("DOMContentLoaded", function() {

    const registroForm = document.getElementById("registroForm");
    if (registroForm) {
        registroForm.addEventListener("submit", function(event) {
            let nombre = document.getElementById("nombre").value.trim();
            let email = document.getElementById("email").value.trim();
            let telefono = document.getElementById("telefono").value.trim();
            let password = document.getElementById("password").value.trim();

            // Validaciones
            if (!nombre || !email || !telefono || !password) {
                alert("Por favor, completa todos los campos.");
                event.preventDefault(); 
                return;
            }

            let emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!emailRegex.test(email)) {
                alert("Ingresa un correo electrónico válido.");
                event.preventDefault();
                return;
            }

            if (password.length < 6) {
                alert("La contraseña debe tener al menos 6 caracteres.");
                event.preventDefault();
                return;
            }
        });
    }

    // Mostrar/Ocultar contraseña
    const togglePassword = document.querySelector('#togglePassword');
    const passwordField = document.querySelector('#password');
    if (togglePassword && passwordField) {
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (icon) {
                if (type === 'password') {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            }
        });
    }

    // Mostrar/Ocultar contraseña en formularios con botón .btn-show-password
    document.querySelectorAll('.btn-show-password').forEach(btn => {
        const input = btn.parentElement.querySelector('input');
        const icon = btn.querySelector('i');

        btn.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });



});
