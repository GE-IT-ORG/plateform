<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Vous pouvez ajouter ici le reste du code PHP de votre page d'accueil
$pageTitle = "GE-IT - Grande Ecole de l'Innovation Technologique";
$currentYear = date("Y");

// Calendar data could be stored in arrays for easier maintenance
$calendarL1 = [
    'semester1' => [
        ['title' => 'Rentrée académique', 'date' => '15 septembre 2023'],
        ['title' => 'Examens de mi-parcours', 'date' => '10 - 15 novembre 2023'],
        ['title' => 'Vacances de fin d\'année', 'date' => '20 décembre 2023 - 5 janvier 2024'],
        ['title' => 'Examens finaux', 'date' => '15 - 25 janvier 2024']
    ],
    'semester2' => [
        ['title' => 'Début des cours', 'date' => '5 février 2024'],
        ['title' => 'Examens de mi-parcours', 'date' => '1 - 5 avril 2024'],
        ['title' => 'Vacances de Pâques', 'date' => '8 - 15 avril 2024'],
        ['title' => 'Examens finaux', 'date' => '10 - 20 juin 2024'],
        ['title' => 'Vacances d\'été', 'date' => '1 juillet - 31 août 2024']
    ]
];

// Specialized tracks data
$specializedTracks = [
    [
        'name' => 'Infrastructures Cloud et DevOps',
        'bg_class' => 'bg-cloud-bg',
        'icon_class' => 'text-yellow-500',
        'icon_path' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
        'diploma' => 'Master en Infrastructures Cloud et DevOps'
    ],
    [
        'name' => 'Développement web et application mobile',
        'bg_class' => 'bg-web-bg',
        'icon_class' => 'text-ge-orange',
        'icon_path' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'diploma' => 'Master en Développement web et application mobile'
    ],
    [
        'name' => 'Intelligence Artificielle et Big Data',
        'bg_class' => 'bg-ai-bg',
        'icon_class' => 'text-red-500',
        'icon_path' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        'diploma' => 'Master en Intelligence Artificielle et Big Data'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr" class="light-theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="shortcut icon" href="./img/GE-IT.svg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ge-orange': '#FF5722',
                        'ge-orange-dark': '#E64A19',
                        'ge-light-bg': '#f2f3f5',
                        'cloud-bg': '#FFF8E1',
                        'web-bg': '#FFEBE3',
                        'ai-bg': '#FFF0F0',
                    }
                }
            }
        }
    </script>
    <!-- Inclure les fichiers CSS -->
    <link rel="stylesheet" href="css/light-theme.css">
    <link rel="stylesheet" href="css/dark-theme.css">
    <style>
        /* Custom animations */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 0.5rem;
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }
        
        .dropdown-content a {
            color: #4B5563;
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: block;
            transition: all 0.2s;
        }
        
        .dropdown-content a:hover {
            background-color: #F3F4F6;
            color: #FF5722;
        }
        
        .dropdown:hover .dropdown-content {
            display: block;
        }
        
        /* Active tab styles */
        .tab-active {
            color: #FF5722;
            background-color: #FFEBE3;
            border-color: #FF5722;
        }
        
        /* Menu item hover effect */
        .menu-item {
            position: relative;
            transition: color 0.3s;
        }
        
        .menu-item::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #FF5722;
            transition: width 0.3s;
        }
        
        .menu-item.active::after,
        .menu-item:hover::after {
            width: 100%;
        }
        
        /* Calendar event styles */
        .calendar-event {
            padding: 0.75rem;
            border-radius: 0.5rem;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .calendar-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-white light-theme">
    <!-- Navigation -->
    <nav class="bg-white py-4 px-6 flex items-center justify-between shadow-sm sticky top-0 z-50 transition-shadow duration-300">
        <div class="flex items-center">
            <button id="mobile-menu-button" class="mr-4 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <div class="flex items-center">
                <div class="bg-white p-2 rounded-lg">
                    <img src="./img/logo.jpeg" alt="Logo" class="h-10 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange">GE-IT</span>
            </div>
        </div>
        
        <div class="hidden lg:flex items-center space-x-8">
            <a href="#" class="menu-item active text-ge-orange font-medium">Accueil</a>
            <div class="dropdown">
                <a href="#" class="menu-item text-gray-700 font-medium flex items-center">
                    À propos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <div class="dropdown-content">
                    <a href="#">Notre histoire</a>
                    <a href="#">Notre équipe</a>
                    <a href="#">Nos valeurs</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" class="menu-item text-gray-700 font-medium flex items-center">
                    Parcours
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                <div class="dropdown-content">
                    <a href="#">Licence</a>
                    <a href="#">Master</a>
                    <a href="#">Formation continue</a>
                </div>
            </div>
            <a href="#" class="menu-item text-gray-700 font-medium">Contact</a>
            <a href="#" class="menu-item text-gray-700 font-medium">Actualités</a>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Bouton de changement de thème -->
            <button id="theme-toggle" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium p-2 rounded-full transition-all duration-300">
                <span id="theme-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </span>
            </button>
            
            <!-- Bouton de connexion -->
            <a href="#" id="login-btn" class="bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-2 px-6 rounded-full transition-all duration-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                S'identifier
            </a>
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-white py-4 px-6 hidden shadow-md">
        <a href="#" class="block py-2 text-ge-orange font-medium">Accueil</a>
        <a href="#" class="block py-2 text-gray-700 font-medium">À propos</a>
        <a href="#" class="block py-2 text-gray-700 font-medium">Parcours</a>
        <a href="#" class="block py-2 text-gray-700 font-medium">Contact</a>
        <a href="#" class="block py-2 text-gray-700 font-medium">Actualités</a>
    </div>
    
    <!-- Modal de connexion -->
    <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="login-modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Identification Étudiant</h2>
                <button id="close-login-modal" class="text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div id="login-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 hidden" role="alert">
                <span class="block sm:inline">Identifiants incorrects. Veuillez réessayer.</span>
            </div>
            
            <form id="login-form">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-medium mb-2">username</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">mot de passe</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required>
                </div>
                <div class="mb-6">
                    <label for="niveau" class="block text-gray-700 text-sm font-medium mb-2">Niveau</label>
                    <select id="niveau" name="niveau" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required>
                        <option value="">Sélectionnez votre niveau</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                        <option value="M1">M1</option>
                        <option value="M2">M2</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-2 px-4 rounded-md transition-colors duration-300">
                    Se connecter
                </button>
            </form>
        </div>
    </div>
    
    <!-- Le reste du contenu de la page reste inchangé -->
    
    <!-- Hero Section -->
    <section class="bg-ge-light-bg py-16 px-6 md:px-12 lg:px-16 relative overflow-hidden">
        <!-- Contenu de la section hero inchangé -->
        <!-- ... -->
    </section>
    
    <!-- Calendrier des semestres -->
    <section class="py-16 px-6 bg-white">
        <!-- Contenu du calendrier inchangé -->
        <!-- ... -->
    </section>
    
    <!-- Parcours spécialisés -->
    <section class="py-16 px-6 bg-gray-50">
        <!-- Contenu des parcours inchangé -->
        <!-- ... -->
    </section>
    
    <!-- Inscription Button (Fixed) -->
    <div class="fixed bottom-6 right-6 z-50">
        <!-- Bouton d'inscription inchangé -->
        <!-- ... -->
    </div>
    
    <!-- Inscription Modal -->
    <div id="inscription-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <!-- Contenu du modal d'inscription inchangé -->
        <!-- ... -->
    </div>
    
    <!-- Chat Button -->
    <div class="fixed bottom-6 left-6 z-50">
        <!-- Bouton de chat inchangé -->
        <!-- ... -->
    </div>
    
    <!-- Chat Widget -->
    <div id="chat-widget" class="fixed bottom-20 left-6 z-50 bg-white rounded-lg shadow-xl w-80 hidden transform transition-all duration-300 scale-95 opacity-0">
        <!-- Contenu du widget de chat inchangé -->
        <!-- ... -->
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 px-6">
        <!-- Contenu du footer inchangé -->
        <!-- ... -->
    </footer>
    
    <!-- Inclure les fichiers JavaScript -->
    <script src="js/theme-switcher.js"></script>
    <script src="js/login.js"></script>
    <script src="js/main.js"></script>
</body>
</html>