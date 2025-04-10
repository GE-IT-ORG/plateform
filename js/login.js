document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('login-btn');
    const loginModal = document.getElementById('login-modal');
    const modalContent = document.getElementById('login-modal-content');
    const closeLoginModal = document.getElementById('close-login-modal');
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');

    loginBtn.addEventListener('click', function (e) {
        e.preventDefault();
        loginModal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    });

    function closeLoginModalHandler() {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            loginModal.classList.add('hidden');
        }, 300);
    }

    closeLoginModal.addEventListener('click', closeLoginModalHandler);

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(loginForm);

        fetch('auth/signin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur de serveur: ' + response.statusText);
            }
            return response.text();
        })
        .then(responseText => {
            console.log('Réponse brute du serveur :', responseText);

            try {
                if (responseText.includes('<html>')) {
                    loginError.textContent = 'Erreur serveur. Essayez encore.';
                    loginError.classList.remove('hidden');
                    return;
                }

                const data = JSON.parse(responseText);

                if (data.success) {
                    // Redirection dynamique selon le rôle
                    window.location.href = data.redirect;
                } else {
                    loginError.textContent = data.message;
                    loginError.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erreur de parsing JSON:', error);
                loginError.textContent = 'Erreur de connexion. Vérifiez vos identifiants.';
                loginError.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Erreur de requête fetch :', error);
            loginError.textContent = 'Erreur lors de la connexion. Veuillez réessayer.';
            loginError.classList.remove('hidden');
        });
    });
});
