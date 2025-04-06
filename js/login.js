document.addEventListener('DOMContentLoaded', function() {
    const loginBtn = document.getElementById('login-btn');
    const loginModal = document.getElementById('login-modal');
    const modalContent = document.getElementById('login-modal-content');
    const closeLoginModal = document.getElementById('close-login-modal');
    const loginForm = document.getElementById('login-form');

    loginBtn.addEventListener('click', function(e) {
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

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(loginForm);

        fetch('/projetGE-IT/auth/signin.php', {
            method: 'POST',
            body: formData 
        })
        .then(response => {
            if (!response.ok) {
                // Affiche un message d'erreur détaillé si la réponse n'est pas ok
                throw new Error('Erreur de serveur: ' + response.statusText);
            }
            return response.text();  // On récupère la réponse brute
        })
        .then(responseText => {
            console.log('Réponse du serveur:', responseText);  // Affiche la réponse brute

            try {
                // Si la réponse est une page HTML d'erreur (comme une erreur 404)
                if (responseText.includes('<html>')) {
                    throw new Error('La réponse du serveur est une page HTML d\'erreur');
                }
                
                const data = JSON.parse(responseText);  // On tente de parser la réponse JSON
                if (data.success) {
                    window.location.href = '../home.php';
                } else {
                    document.getElementById('login-error').textContent = data.message;
                    document.getElementById('login-error').classList.remove('hidden');
                }
            } catch (error) {
                console.error('Erreur de parsing JSON:', error);
                document.getElementById('login-error').textContent = 'Erreur de connexion. Vérifiez vos identifiants.';
                document.getElementById('login-error').classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            document.getElementById('login-error').textContent = 'Erreur lors de la connexion. Veuillez réessayer.';
            document.getElementById('login-error').classList.remove('hidden');
        });
    });
});
