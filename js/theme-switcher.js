document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le bouton de changement de thème
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    
    // Vérifier si un thème est déjà enregistré dans localStorage
    const currentTheme = localStorage.getItem('theme') || 'light-theme';
    
    // Appliquer le thème actuel
    applyTheme(currentTheme);
    
    // Ajouter un écouteur d'événement pour le changement de thème
    themeToggle.addEventListener('click', function() {
        // Basculer entre les thèmes
        const newTheme = document.documentElement.classList.contains('dark-theme') 
            ? 'light-theme' 
            : 'dark-theme';
        
        // Appliquer le nouveau thème
        applyTheme(newTheme);
        
        // Enregistrer le thème dans localStorage
        localStorage.setItem('theme', newTheme);
    });
    
    // Fonction pour appliquer le thème
    function applyTheme(theme) {
        if (theme === 'dark-theme') {
            document.documentElement.classList.add('dark-theme');
            document.documentElement.classList.remove('light-theme');
            document.body.classList.add('dark-theme');
            document.body.classList.remove('light-theme');
            themeIcon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            `;
        } else {
            document.documentElement.classList.add('light-theme');
            document.documentElement.classList.remove('dark-theme');
            document.body.classList.add('light-theme');
            document.body.classList.remove('dark-theme');
            themeIcon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            `;
        }
    }
});
