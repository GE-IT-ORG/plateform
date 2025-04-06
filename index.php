<?php
// Démarrer la session
session_start();


// Vérifier si l'utilisateur est connecté
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Vous pouvez ajouter ici le reste du code PHP de votre page d'accueil
$pageTitle = "GE-IT - Grande Ecole de l'Innovation Technologique";
$currentYear = date("Y");

// Données pour les calendriers académiques par niveau
$calendars = [
    'L1' => [
        'semester1' => [
            ['title' => 'Rentrée académique', 'date' => '06 juin 2022 ', 'color' => 'blue'],
            ['title' => 'Examens de mi-parcours', 'date' => '10 - 15 novembre 2023', 'color' => 'orange'],
            ['title' => 'Vacances de fin d\'année', 'date' => '20 décembre 2023 - 5 janvier 2024', 'color' => 'green'],
            ['title' => 'Examens finaux', 'date' => '15 - 25 janvier 2024', 'color' => 'red']
        ],
        'semester2' => [
            ['title' => 'Début des cours', 'date' => '5 février 2024', 'color' => 'blue'],
            ['title' => 'Examens de mi-parcours', 'date' => '1 - 5 avril 2024', 'color' => 'orange'],
            ['title' => 'Vacances de Pâques', 'date' => '8 - 15 avril 2024', 'color' => 'green'],
            ['title' => 'Examens finaux', 'date' => '10 - 20 juin 2024', 'color' => 'red'],
            ['title' => 'Vacances d\'été', 'date' => '1 juillet - 31 août 2024', 'color' => 'green']
        ]
    ],
    'L2' => [
        'semester1' => [
            ['title' => 'Rentrée académique', 'date' => '12 septembre 2023', 'color' => 'blue'],
            ['title' => 'Examens de mi-parcours', 'date' => '8 - 13 novembre 2023', 'color' => 'orange'],
            ['title' => 'Vacances de fin d\'année', 'date' => '20 décembre 2023 - 5 janvier 2024', 'color' => 'green'],
            ['title' => 'Examens finaux', 'date' => '15 - 25 janvier 2024', 'color' => 'red']
        ],
        'semester2' => [
            ['title' => 'Début des cours', 'date' => '5 février 2024', 'color' => 'blue'],
            ['title' => 'Examens de mi-parcours', 'date' => '1 - 5 avril 2024', 'color' => 'orange'],
            ['title' => 'Vacances de Pâques', 'date' => '8 - 15 avril 2024', 'color' => 'green'],
            ['title' => 'Examens finaux', 'date' => '10 - 20 juin 2024', 'color' => 'red'],
            ['title' => 'Vacances d\'été', 'date' => '1 juillet - 31 août 2024', 'color' => 'green']
        ]
    ],
    'L3' => [
        'semester1' => [
            ['title' => 'Rentrée académique', 'date' => '10 septembre 2023', 'color' => 'blue'],
            ['title' => 'Choix de spécialisation', 'date' => '15 - 20 septembre 2023', 'color' => 'purple'],
            ['title' => 'Examens de mi-parcours', 'date' => '5 - 10 novembre 2023', 'color' => 'orange'],
            ['title' => 'Examens finaux', 'date' => '10 - 20 janvier 2024', 'color' => 'red']
        ],
        'semester2' => [
            ['title' => 'Début des cours spécialisés', 'date' => '1 février 2024', 'color' => 'blue'],
            ['title' => 'Examens de mi-parcours', 'date' => '25 - 30 mars 2024', 'color' => 'orange'],
            ['title' => 'Stage en entreprise', 'date' => '1 mai - 30 juin 2024', 'color' => 'indigo'],
            ['title' => 'Soutenance de stage', 'date' => '10 - 15 juillet 2024', 'color' => 'purple']
        ]
    ],
    'M1' => [
        'semester1' => [
            ['title' => 'Rentrée académique', 'date' => '5 septembre 2023', 'color' => 'blue'],
            ['title' => 'Cours avancés de spécialisation', 'date' => 'Septembre - Décembre 2023', 'color' => 'indigo'],
            ['title' => 'Examens finaux', 'date' => '5 - 15 janvier 2024', 'color' => 'red']
        ],
        'semester2' => [
            ['title' => 'Projet de recherche', 'date' => 'Février - Mai 2024', 'color' => 'purple'],
            ['title' => 'Stage professionnel', 'date' => '1 juin - 31 août 2024', 'color' => 'indigo'],
            ['title' => 'Rapport de stage', 'date' => '15 septembre 2024', 'color' => 'orange']
        ]
    ],
    'M2' => [
        'semester1' => [
            ['title' => 'Rentrée académique', 'date' => '1 septembre 2023', 'color' => 'blue'],
            ['title' => 'Séminaires spécialisés', 'date' => 'Septembre - Décembre 2023', 'color' => 'indigo'],
            ['title' => 'Examens finaux', 'date' => '1 - 10 janvier 2024', 'color' => 'red']
        ],
        'semester2' => [
            ['title' => 'Mémoire de fin d\'études', 'date' => 'Février - Juin 2024', 'color' => 'purple'],
            ['title' => 'Soutenance', 'date' => 'Juillet 2024', 'color' => 'orange'],
            ['title' => 'Remise des diplômes', 'date' => 'Septembre 2024', 'color' => 'green']
        ]
    ]
];

// Statistiques de l'école
$stats = [
    ['number' => '1853', 'label' => 'Livres', 'description' => 'Des ouvrages numériques en tout genre', 'icon' => 'book'],
    ['number' => '34+', 'label' => 'Experts', 'description' => 'Des enseignants maître dans leur domaine', 'icon' => 'target'],
    ['number' => '100%', 'label' => 'Encadrement', 'description' => 'Un suivi rigoureux et individuel', 'icon' => 'award']
];

// Avantages de l'école
$advantages = [
    [
        'title' => 'Pédagogie innovante',
        'description' => 'Une approche par projets adaptée à la réalité du marché',
        'icon' => 'lightbulb'
    ],
    [
        'title' => 'Partenariat industriel',
        'description' => 'Accompagnement dans la vie professionnelle grâce au stage d\'embauche',
        'icon' => 'briefcase'
    ],
    [
        'title' => 'Expertise de pointe',
        'description' => 'Des enseignants passionnés et des programmes axés sur l\'innovation',
        'icon' => 'code'
    ],
    [
        'title' => 'Environnement optimal',
        'description' => 'Un espace idéal pour l\'apprentissage des futurs étudiants en informatique',
        'icon' => 'layout'
    ]
];

// Specialized tracks data
$specializedTracks = [
    [
        'name' => 'Infrastructures Cloud et DevOps',
        'bg_class' => 'bg-cloud-bg',
        'icon_class' => 'text-yellow-500',
        'icon_path' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
        'diploma' => 'Master en Infrastructures Cloud et DevOps',
        'description' => 'Maîtrisez les technologies cloud, l\'automatisation et les pratiques DevOps pour concevoir et gérer des infrastructures modernes et évolutives.'
    ],
    [
        'name' => 'Développement web et application mobile',
        'bg_class' => 'bg-web-bg',
        'icon_class' => 'text-ge-orange',
        'icon_path' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'diploma' => 'Master en Développement web et application mobile',
        'description' => 'Développez des applications web et mobiles innovantes en utilisant les frameworks et technologies les plus récents du marché.'
    ],
    [
        'name' => 'Intelligence Artificielle et Big Data',
        'bg_class' => 'bg-ai-bg',
        'icon_class' => 'text-red-500',
        'icon_path' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        'diploma' => 'Master en Intelligence Artificielle et Big Data',
        'description' => 'Explorez le monde de l\'IA, du machine learning et de l\'analyse de données massives pour résoudre des problèmes complexes.'
    ]
];
?>
<!DOCTYPE html>
<html lang="fr" class="light-theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="shortcut icon" href="./img/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/dark-theme.css">
    <link rel="stylesheet" href="./css/light-theme.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
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
        
        /* Timeline styles */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #FF5722;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
            border-radius: 3px;
        }
        
        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: white;
            border: 4px solid #FF5722;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        
        .left {
            left: 0;
        }
        
        .right {
            left: 50%;
        }
        
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid #f2f3f5;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent #f2f3f5;
        }
        
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid #f2f3f5;
            border-width: 10px 10px 10px 0;
            border-color: transparent #f2f3f5 transparent transparent;
        }
        
        .right::after {
            left: -10px;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background-color: #f2f3f5;
            position: relative;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* Responsive timeline */
        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-container::before {
                left: 60px;
                border: medium solid #f2f3f5;
                border-width: 10px 10px 10px 0;
                border-color: transparent #f2f3f5 transparent transparent;
            }
            
            .left::after, .right::after {
                left: 21px;
            }
            
            .right {
                left: 0%;
            }
        }
        
        /* Stats counter animation */
        .counter-value {
            transition: all 0.5s ease-in-out;
        }
        
        /* 3D Card effect */
        .card-3d {
            transition: transform 0.5s ease;
            transform-style: preserve-3d;
        }
        
        .card-3d:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Modern calendar styles */
        .fc-header-toolbar {
            margin-bottom: 1.5em !important;
        }
        
        .fc-toolbar-title {
            font-size: 1.5em !important;
            font-weight: 600 !important;
            color: #333;
        }
        
        .fc-button-primary {
            background-color: #FF5722 !important;
            border-color: #FF5722 !important;
        }
        
        .fc-button-primary:hover {
            background-color: #E64A19 !important;
            border-color: #E64A19 !important;
        }
        
        .fc-daygrid-day-number {
            font-weight: 500;
            color: #333;
        }
        
        .fc-event {
            border-radius: 4px !important;
            padding: 2px 4px !important;
            font-size: 0.85em !important;
        }
        
        .fc-event-title {
            font-weight: 500 !important;
        }
        
        .fc-day-today {
            background-color: rgba(255, 87, 34, 0.1) !important;
        }
        
        /* Gradient text */
        .gradient-text {
            background: linear-gradient(90deg, #FF5722, #FF9800);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        
        /* Animated background */
        .animated-bg {
            background: linear-gradient(-45deg, #f2f3f5, #ffffff, #f9f9f9, #f5f5f5);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        /* Dark mode styles */
        .dark-theme .animated-bg {
            background: linear-gradient(-45deg, #1a1a1a, #2d2d2d, #252525, #1f1f1f);
        }
        
        .dark-theme .gradient-text {
            background: linear-gradient(90deg, #FF5722, #FF9800);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .dark-theme .fc-toolbar-title,
        .dark-theme .fc-daygrid-day-number {
            color: #e0e0e0;
        }
        
        .dark-theme .fc-day-today {
            background-color: rgba(255, 87, 34, 0.2) !important;
        }
        
        .dark-theme .calendar-event {
            background-color: #2d2d2d;
            color: #e0e0e0;
        }
        
        .dark-theme .dropdown-content {
            background-color: #2d2d2d;
        }
        
        .dark-theme .dropdown-content a {
            color: #e0e0e0;
        }
        
        .dark-theme .dropdown-content a:hover {
            background-color: #3d3d3d;
        }
        
        /* 3D illustration styles */
        .illustration-container {
            position: relative;
            height: 400px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }
        
        .illustration-element {
            position: absolute;
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
        }
        
        .illustration-element:hover {
            transform: translateZ(20px);
        }
        
        .element-1 {
            top: 10%;
            right: 20%;
            animation: float 4s ease-in-out infinite;
        }
        
        .element-2 {
            bottom: 20%;
            left: 15%;
            animation: float 5s ease-in-out infinite 1s;
        }
        
        .element-3 {
            top: 30%;
            left: 25%;
            animation: float 6s ease-in-out infinite 0.5s;
        }
        
        .element-4 {
            bottom: 10%;
            right: 15%;
            animation: float 7s ease-in-out infinite 1.5s;
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-white light-theme">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 py-4 px-6 flex items-center justify-between shadow-sm sticky top-0 z-50 transition-shadow duration-300">
        <div class="flex items-center">
            <button id="mobile-menu-button" class="mr-4 lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <div class="flex items-center">
                <div class="bg-white dark:bg-gray-700 p-2 rounded-lg">
                    <img src="./img/logo.jpeg" alt="Logo" class="h-10 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange">GE-IT</span>
            </div>
        </div>
        
        <div class="hidden lg:flex items-center space-x-8">
            <a href="#" class="menu-item active text-ge-orange font-medium">Accueil</a>
            <div class="dropdown">
                <a href="#" class="menu-item text-gray-700 dark:text-gray-300 font-medium flex items-center">
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
                <a href="#" class="menu-item text-gray-700 dark:text-gray-300 font-medium flex items-center">
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
            <a href="#" class="menu-item text-gray-700 dark:text-gray-300 font-medium">Contact</a>
            <a href="#" class="menu-item text-gray-700 dark:text-gray-300 font-medium">Actualités</a>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- Bouton de changement de thème -->
            <button id="theme-toggle" class="bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 font-medium p-2 rounded-full transition-all duration-300">
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
    <div id="mobile-menu" class="lg:hidden bg-white dark:bg-gray-800 py-4 px-6 hidden shadow-md">
        <a href="#" class="block py-2 text-ge-orange font-medium">Accueil</a>
        <a href="#" class="block py-2 text-gray-700 dark:text-gray-300 font-medium">À propos</a>
        <a href="#" class="block py-2 text-gray-700 dark:text-gray-300 font-medium">Parcours</a>
        <a href="#" class="block py-2 text-gray-700 dark:text-gray-300 font-medium">Contact</a>
        <a href="#" class="block py-2 text-gray-700 dark:text-gray-300 font-medium">Actualités</a>
    </div>
    
   <!-- Modal de connexion -->
<div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="login-modal-content">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Identification Étudiant</h2>
            <button id="close-login-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div id="login-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 hidden" role="alert">
            <span class="block sm:inline">Identifiants incorrects. Veuillez réessayer.</span>
        </div>
        
        <form id="login-form" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Username</label>
                <input type="text" id="username" name="username" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required placeholder="nom d'utilisateur">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required placeholder="mot de passe">
            </div>
            
            <div class="mb-6">
                <label for="niveau" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Niveau</label>
                <select id="niveau" name="niveau" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
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

    <!-- Hero Section -->
    <section class="bg-ge-light-bg dark:bg-gray-900 py-16 px-6 md:px-12 lg:px-16 relative overflow-hidden animated-bg">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="z-10">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        <span class="gradient-text">Grande Ecole</span><br>
                        <span class="text-3xl md:text-4xl lg:text-5xl dark:text-gray">de l'Innovation</span><br>
                        <span class="text-3xl md:text-4xl lg:text-5xl dark:text-gray">Technologique</span>
                    </h1>
                    
                    <p class="mt-6 text-lg text-gray-700 dark:text-gray-300">
                        <span class="font-semibold">GE-IT</span> est 
                        <span class="font-semibold">une université spécialisée</span> dans le 
                        <span class="font-semibold">domaine du numérique</span> à Madagascar
                    </p>
                    
                    <div class="mt-8">
                        <a href="#" class="bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-3 px-8 rounded-full transition-all duration-300 inline-flex items-center mr-4 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                            </svg>
                            Nos formations
                        </a>
                        <a href="#" class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-ge-orange font-medium py-3 px-8 rounded-full transition-all duration-300 inline-flex items-center border border-ge-orange shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            En savoir plus
                        </a>
                    </div>
                    
                    <div class="mt-10">
                        <h3 class="text-xl font-semibold mb-4 dark:gray">Contactez-nous !</h3>
                        
                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center">
                                <div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow-md mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Email</div>
                                    <a href="mailto:contact@grande-ecole-it.com" class="text-gray-700 dark:text-gray-300 hover:text-ge-orange transition-colors">contact@grande-ecole-it.com</a><br>
                                    <a href="mailto:inscription@grande-ecole-it.com" class="text-gray-700 dark:text-gray-300 hover:text-ge-orange transition-colors">inscription@grande-ecole-it.com</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="bg-white dark:bg-gray-700 p-3 rounded-lg shadow-md mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Téléphone</div>
                                    <a href="tel:+261340708223" class="text-gray-700 dark:text-gray-300 hover:text-ge-orange transition-colors">+261 34 07 082 23</a><br>
                                    <a href="tel:+261340413816" class="text-gray-700 dark:text-gray-300 hover:text-ge-orange transition-colors">+261 34 04 138 16</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="illustration-container">
                        <div class="illustration-element element-1">
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="illustration-element element-2">
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                            </div>
                        </div>
                        <div class="illustration-element element-3">
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                        </div>
                        <div class="illustration-element element-4">
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Background pattern -->
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute w-full h-full">
                <div class="absolute w-40 h-40 border-2 border-ge-orange rounded-full -top-20 -left-20"></div>
                <div class="absolute w-60 h-60 border-2 border-ge-orange rounded-full top-40 right-20"></div>
                <div class="absolute w-80 h-80 border-2 border-ge-orange rounded-full bottom-20 left-40"></div>
            </div>
        </div>
    </section>
    
    <!-- Pourquoi GE-IT Section -->
    <section class="py-16 px-6 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-sm uppercase tracking-wider text-ge-orange font-semibold">Avantages</h2>
                <h3 class="text-4xl font-bold mt-2 mb-4 dark:text-gray">Pourquoi GE-IT ?</h3>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Faisant partie du même groupe que HaiRun Technology, nous adoptons une approche innovante par le biais d'une pédagogie de projets adaptée à la réalité du marché, grâce à notre partenariat avec cette dernière.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <?php foreach ($advantages as $index => $advantage): ?>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 card-3d">
                    <div class="w-14 h-14 bg-ge-orange bg-opacity-10 dark:bg-opacity-20 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <?php if ($advantage['icon'] === 'lightbulb'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            <?php elseif ($advantage['icon'] === 'briefcase'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            <?php elseif ($advantage['icon'] === 'code'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            <?php elseif ($advantage['icon'] === 'layout'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                            <?php endif; ?>
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 dark:text-gray"><?php echo $advantage['title']; ?></h4>
                    <p class="text-gray-600 dark:text-gray-300"><?php echo $advantage['description']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($stats as $stat): ?>
                <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                    <div class="w-16 h-16 bg-ge-orange bg-opacity-10 dark:bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <?php if ($stat['icon'] === 'book'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            <?php elseif ($stat['icon'] === 'target'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            <?php elseif ($stat['icon'] === 'award'): ?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            <?php endif; ?>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold text-gray-800 dark:text-gray mb-2 counter-value"><?php echo $stat['number']; ?></h3>
                    <h4 class="text-xl font-semibold text-ge-orange mb-2"><?php echo $stat['label']; ?></h4>
                    <p class="text-white-600 dark:text-white-600"><?php echo $stat['description']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Calendrier des semestres -->
    <section class="py-16 px-6 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-sm uppercase tracking-wider text-ge-orange font-semibold">Organisation</h2>
                <h3 class="text-4xl font-bold mt-2 mb-4 dark:text-gray">Calendrier Académique</h3>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Consultez le calendrier académique pour chaque niveau d'études et planifiez votre année universitaire.
                </p>
            </div>

            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-md shadow-sm" role="group">
                    <button type="button" id="tab-l1" class="tab-active px-6 py-2 text-sm font-medium bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-l-lg hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-ge-orange focus:text-ge-orange dark:text-gray">
                        L1
                    </button>
                    <button type="button" id="tab-l2" class="px-6 py-2 text-sm font-medium bg-white dark:bg-gray-700 border-t border-b border-r border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-ge-orange focus:text-ge-orange dark:text-gray">
                        L2
                    </button>
                    <button type="button" id="tab-l3" class="px-6 py-2 text-sm font-medium bg-white dark:bg-gray-700 border-t border-b border-r border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-ge-orange focus:text-ge-orange dark:text-gray">
                        L3
                    </button>
                    <button type="button" id="tab-m1" class="px-6 py-2 text-sm font-medium bg-white dark:bg-gray-700 border-t border-b border-r border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-ge-orange focus:text-ge-orange dark:text-gray">
                        M1
                    </button>
                    <button type="button" id="tab-m2" class="px-6 py-2 text-sm font-medium bg-white dark:bg-gray-700 border-t border-b border-r border-gray-200 dark:border-gray-600 rounded-r-lg hover:bg-gray-100 dark:hover:bg-gray-600 focus:z-10 focus:ring-2 focus:ring-ge-orange focus:text-ge-orange dark:text-gray">
                        M2
                    </button>
                </div>
            </div>
            
            <?php foreach ($calendars as $level => $semesters): ?>
            <div id="calendar-<?php echo strtolower($level); ?>" class="calendar-content <?php echo strtolower($level) === 'l1' ? '' : 'hidden'; ?>">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div id="calendar-<?php echo strtolower($level); ?>-container"></div>
                    </div>
                </div>
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 flex items-center dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ge-orange mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Premier Semestre
                        </h3>
                        <div class="space-y-4">
                            <?php foreach ($semesters['semester1'] as $event): ?>
                            <div class="calendar-event border-l-4 border-<?php echo $event['color']; ?>-500 pl-4 dark:bg-gray-700">
                                <p class="font-medium dark:text-gray"><?php echo $event['title']; ?></p>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><?php echo $event['date']; ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="bg-white  ?>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 flex items-center dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-ge-orange mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                            Deuxième Semestre
                        </h3>
                        <div class="space-y-4">
                            <?php foreach ($semesters['semester2'] as $event): ?>
                            <div class="calendar-event border-l-4 border-<?php echo $event['color']; ?>-500 pl-4 dark:bg-gray-700">
                                <p class="font-medium dark:text-gray"><?php echo $event['title']; ?></p>
                                <p class="text-sm text-gray-600 dark:text-gray-300"><?php echo $event['date']; ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <!-- Parcours spécialisés -->
    <section class="py-16 px-6 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-sm uppercase tracking-wider text-ge-orange font-semibold">Formations</h2>
                <h3 class="text-4xl font-bold mt-2 mb-4 dark:text-gray">Nos Parcours Spécialisés</h3>
                <p class="text-center text-lg text-gray-700 dark:text-gray-300 mb-12">À partir de la L3, choisissez parmi nos 3 parcours d'excellence</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php foreach ($specializedTracks as $track): ?>
                <div class="<?php echo $track['bg_class']; ?> dark:bg-gray-700 rounded-xl overflow-hidden shadow-md transition-transform duration-300 hover:scale-105">
                    <div class="p-6">
                        <div class="w-20 h-20 bg-white dark:bg-gray-800 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 <?php echo $track['icon_class']; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo $track['icon_path']; ?>" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Parcours</p>
                            <h3 class="text-xl font-bold mb-2 dark:text-gray"><?php echo $track['name']; ?></h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4"><?php echo $track['description']; ?></p>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">Diplôme obtenu :</p>
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-lg flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <p class="font-medium dark:text-gray"><?php echo $track['diploma']; ?></p>
                            </div>
                            <a href="#" class="inline-block bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-2 px-6 rounded-full transition-colors duration-300">
                                Découvrir la formation
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <!-- Inscription Button (Fixed) -->
    <div class="fixed bottom-6 right-6 z-50">
        <button id="inscription-btn" class="bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-3 px-6 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
            </svg>
            S'inscrire
        </button>
    </div>
    
    <!-- Inscription Modal -->
    <div id="inscription-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Inscription</h2>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form id="inscription-form">
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Nom complet</label>
                    <input type="text" id="nom" name="nom" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required placeholder="nom et prénoms">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required placeholder="xxxxxxx@gmail.com">
                </div>
                
                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required placeholder="+261 XX XXX XXX">
                </div>
                
                <div class="mb-4">
                    <label for="parcours" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Parcours souhaité</label>
                    <select id="parcours" name="parcours" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required>
                        <option value="">Sélectionnez un parcours</option>
                        <option value="master-cloud">Master en Infrastructures Cloud et DevOps</option>
                        <option value="master-web">Master en Développement web et application mobile</option>
                        <option value="master-ai">Master en Intelligence Artificielle et Big Data</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="niveau" class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Niveau souhaité</label>
                    <select id="niveauInsc" name="niveau" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" required>
                        <option value="">Sélectionnez un niveau</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                        <option value="M1">M1</option>
                        <option value="M2">M2</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-ge-orange hover:bg-ge-orange-dark text-white font-medium py-2 px-4 rounded-md transition-colors duration-300">
                    Envoyer ma demande
                </button>
            </form>
            
            <div id="form-success" class="hidden text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Demande envoyée !</h3>
                <p class="text-gray-600 dark:text-gray-300">Nous vous contacterons très prochainement.</p>
                <button id="close-success" class="mt-6 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium py-2 px-6 rounded-md transition-colors duration-300">
                    Fermer
                </button>
            </div>
        </div>
    </div>
    
    <!-- Chat Button -->
    <div class="fixed bottom-6 left-6 z-50">
        <button id="chat-btn" class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-ge-orange font-medium p-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
        </button>
    </div>
    
    <!-- Chat Widget -->
    <div id="chat-widget" class="fixed bottom-20 left-6 z-50 bg-white dark:bg-gray-800 rounded-lg shadow-xl w-80 hidden transform transition-all duration-300 scale-95 opacity-0">
        <div class="bg-ge-orange text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="font-medium">Chat avec GE-IT</h3>
            <button id="close-chat" class="text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div id="chat-messages" class="p-4 h-80 overflow-y-auto">
            <div class="flex mb-4">
                <div class="w-8 h-8 rounded-full bg-ge-orange flex-shrink-0 flex items-center justify-center text-white font-bold">
                    G
                </div>
                <div class="ml-2 py-2 px-3 bg-gray-100 dark:bg-gray-700 rounded-lg rounded-tl-none max-w-[80%]">
                    <p class="text-sm dark:text-white">Bonjour ! Comment puis-je vous aider aujourd'hui ?</p>
                </div>
            </div>
        </div>
        
        <div class="p-4 border-t dark:border-gray-700">
            <div class="flex">
                <input type="text" id="chat-input" placeholder="Écrivez votre message..." class="flex-grow px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-l-md focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                <button id="send-message" class="bg-ge-orange hover:bg-ge-orange-dark text-white px-4 py-2 rounded-r-md transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-white p-2 rounded-lg">
                            <img src="./img/logo.jpeg" alt="Logo" class="h-8 w-auto object-contain">
                        </div>
                        <span class="ml-2 text-xl font-bold text-ge-orange">GE-IT</span>
                    </div>
                    <p class="text-gray-400 mb-4">Grande École de l'Innovation Technologique - L'excellence numérique à Madagascar</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.066 9.645c.183 4.04-2.83 8.544-8.164 8.544-1.622 0-3.131-.476-4.402-1.291 1.524.18 3.045-.244 4.252-1.189-1.256-.023-2.317-.854-2.684-1.995.451.086.895.061 1.298-.049-1.381-.278-2.335-1.522-2.304-2.853.388.215.83.344 1.301.359-1.279-.855-1.641-2.544-.889-3.835 1.416 1.738 3.533 2.881 5.92 3.001-.419-1.796.944-3.527 2.799-3.527.825 0 1.572.349 2.096.907.654-.128 1.27-.368 1.824-.697-.215.671-.67 1.233-1.263 1.589.581-.07 1.135-.224 1.649-.453-.384.578-.87 1.084-1.433 1.489z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Parcours</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Actualités</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Formations</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Licence en Informatique</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Licence en Réseaux</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Master Cloud et DevOps</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Master Développement Web</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Master IA et Big Data</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ge-orange mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-400">Lot 24 Ter Ambohibao Antehiroka près de l'Ambassade des Etats-Unis</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ge-orange mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-400">contact@grande-ecole-it.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-ge-orange mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-400">+261 34 07 082 23</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400">
                <p>&copy; <?php echo $currentYear; ?> Grande École de l'Innovation Technologique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    
    <!-- Inclure les fichiers JavaScript -->
    <script src="js/theme-switcher.js"></script>
    <script src="js/login.js"></script>
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser les calendriers pour chaque niveau
            <?php foreach ($calendars as $level => $semesters): ?>
            var calendarEl<?php echo $level; ?> = document.getElementById('calendar-<?php echo strtolower($level); ?>-container');
            if (calendarEl<?php echo $level; ?>) {
                var calendar<?php echo $level; ?> = new FullCalendar.Calendar(calendarEl<?php echo $level; ?>, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listMonth'
                    },
                    events: [
                        <?php foreach ($semesters['semester1'] as $event): 
                            // Convertir la date en format compatible avec FullCalendar
                            $date = $event['date'];
                            if (strpos($date, ' - ') !== false) {
                                $dates = explode(' - ', $date);
                                $start = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $dates[0] . ' 2023')));
                                $end = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $dates[1] . ' 2024')));
                            } else {
                                $start = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $date . ' 2023')));
                                $end = $start;
                            }
                        ?>
                        {
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            backgroundColor: '<?php echo getColorCode($event['color']); ?>',
                            borderColor: '<?php echo getColorCode($event['color']); ?>',
                            textColor: '#0000',
                            allDay: true
                        },
                        <?php endforeach; ?>
                        
                        <?php foreach ($semesters['semester2'] as $event): 
                            // Convertir la date en format compatible avec FullCalendar
                            $date = $event['date'];
                            if (strpos($date, ' - ') !== false) {
                                $dates = explode(' - ', $date);
                                $start = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $dates[0] . ' 2024')));
                                $end = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $dates[1] . ' 2024')));
                            } else {
                                $start = date('Y-m-d', strtotime(str_replace(['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'], ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'], $date . ' 2024')));
                                $end = $start;
                            }
                        ?>
                        {
                            title: '<?php echo $event['title']; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            backgroundColor: '<?php echo getColorCode($event['color']); ?>',
                            borderColor: '<?php echo getColorCode($event['color']); ?>',
                            textColor: '#0000',
                            allDay: true
                        },
                        <?php endforeach; ?>
                    ],
                    locale: 'fr',
                    firstDay: 1, // Lundi comme premier jour de la semaine
                    buttonText: {
                        today: 'Aujourd\'hui',
                        month: 'Mois',
                        week: 'Semaine',
                        list: 'Liste'
                    }
                });
                calendar<?php echo $level; ?>.render();
            }
            <?php endforeach; ?>
            
            // Fonction pour obtenir le code couleur
            function getColorCode(color) {
                switch(color) {
                    case 'blue': return '#3490dc';
                    case 'orange': return '#f6993f';
                    case 'green': return '#38c172';
                    case 'red': return '#e3342f';
                    case 'purple': return '#9561e2';
                    case 'indigo': return '#6574cd';
                    default: return '#3490dc';
                }
            }
            
            // Animation des compteurs
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200;
            
            counters.forEach(counter => {
                const animate = () => {
                    const value = +counter.getAttribute('data-target');
                    const data = +counter.innerText.replace(/\D/g, '');
                    
                    const time = value / speed;
                    if (data < value) {
                        counter.innerText = Math.ceil(data + time);
                        setTimeout(animate, 1);
                    } else {
                        counter.innerText = value;
                    }
                }
                
                // Définir l'attribut data-target avec la valeur actuelle
                counter.setAttribute('data-target', counter.innerText);
                counter.innerText = '0';
                
                // Démarrer l'animation lorsque l'élément est visible
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animate();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                
                observer.observe(counter);
            });
            
            // Gestion des onglets du calendrier
            const tabButtons = document.querySelectorAll('[id^="tab-"]');
            const calendarContents = document.querySelectorAll('[id^="calendar-"]');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Retirer la classe active de tous les boutons
                    tabButtons.forEach(btn => {
                        btn.classList.remove('tab-active');
                    });
                    
                    // Ajouter la classe active au bouton cliqué
                    button.classList.add('tab-active');
                    
                    // Masquer tous les contenus
                    calendarContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Afficher le contenu correspondant
                    const contentId = button.id.replace('tab-', 'calendar-');
                    document.getElementById(contentId).classList.remove('hidden');
                    
                    // Redimensionner le calendrier pour qu'il s'affiche correctement
                    const calendarId = contentId + '-container';
                    const calendar = document.getElementById(calendarId);
                    if (calendar) {
                        const fcCalendar = eval('calendar' + button.id.replace('tab-', ''));
                        if (fcCalendar) {
                            fcCalendar.updateSize();
                        }
                    }
                });
            });
            
            // Gestion du thème sombre/clair
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const html = document.documentElement;
            
            // Vérifier le thème actuel
            const isDarkMode = html.classList.contains('dark-theme');
            
            // Mettre à jour l'icône en fonction du thème actuel
            if (isDarkMode) {
                themeIcon.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                `;
            } else {
                themeIcon.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                `;
            }
            
            // Ajouter un écouteur d'événement pour le bouton de changement de thème
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    // Basculer entre les classes de thème
                    html.classList.toggle('light-theme');
                    html.classList.toggle('dark-theme');
                    
                    // Mettre à jour l'icône
                    if (html.classList.contains('dark-theme')) {
                        themeIcon.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        `;
                    } else {
                        themeIcon.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        `;
                    }
                    
                    // Enregistrer la préférence de thème dans localStorage
                    localStorage.setItem('theme', html.classList.contains('dark-theme') ? 'dark' : 'light');
                    
                    // Mettre à jour les calendriers pour qu'ils s'adaptent au thème
                    <?php foreach ($calendars as $level => $semesters): ?>
                    if (typeof calendar<?php echo $level; ?> !== 'undefined') {
                        calendar<?php echo $level; ?>.updateSize();
                    }
                    <?php endforeach; ?>
                });
            }
        });
    </script>
</body>
</html>