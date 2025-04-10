<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'admin') {
    // Rediriger vers la page de connexion
    header('Location: index.php');
    exit;
}

// Récupérer les informations de l'administrateur
$admin = $_SESSION['id_user'] ?? [
    'nom' => 'Administrateur',
    'prenom' => '',
    'email' => 'admin@ge-it.com',
    'photo' => './img/avatar-admin.png'
];

$nom = $admin['nom'] ?? 'Administrateur';
$prenom = $admin['prenom'] ?? '';
$email = $admin['email'] ?? 'admin@ge-it.com';
$photo = $admin['photo'] ?? './img/utilisateur.png';

// Données fictives pour la démonstration (dans un vrai système, ces données viendraient de la base de données)
$statistiques = [
    'etudiants' => 450,
    'enseignants' => 34,
    'cours' => 28,
    'paiements_mois' => 15000000,
    'taux_presence' => 92,
    'taux_reussite' => 87
];

$niveaux = ['L1', 'L2', 'L3', 'M1', 'M2'];

// Données pour les étudiants
$etudiants = [
    ['id' => 1, 'matricule' => 'ET2023001', 'nom' => 'RAKOTO', 'prenom' => 'Jean', 'niveau' => 'L1', 'email' => 'jean.rakoto@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 2, 'matricule' => 'ET2023002', 'nom' => 'RABE', 'prenom' => 'Marie', 'niveau' => 'L1', 'email' => 'marie.rabe@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 3, 'matricule' => 'ET2023003', 'nom' => 'RANDRIA', 'prenom' => 'Paul', 'niveau' => 'L2', 'email' => 'paul.randria@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 4, 'matricule' => 'ET2023004', 'nom' => 'RAZAFY', 'prenom' => 'Sophie', 'niveau' => 'L2', 'email' => 'sophie.razafy@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 5, 'matricule' => 'ET2023005', 'nom' => 'ANDRIA', 'prenom' => 'Luc', 'niveau' => 'L3', 'email' => 'luc.andria@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 6, 'matricule' => 'ET2022001', 'nom' => 'RAKOTONDRABE', 'prenom' => 'Soa', 'niveau' => 'M1', 'email' => 'soa.rakotondrabe@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 7, 'matricule' => 'ET2022002', 'nom' => 'RABEMANANJARA', 'prenom' => 'Eric', 'niveau' => 'M2', 'email' => 'eric.rabemananjara@etudiant.ge-it.com', 'statut' => 'Actif'],
    ['id' => 8, 'matricule' => 'ET2021001', 'nom' => 'JOHNSON', 'prenom' => 'Sarah', 'niveau' => 'M2', 'email' => 'sarah.johnson@etudiant.ge-it.com', 'statut' => 'Inactif'],
];

// Données pour les enseignants
$enseignants = [
    ['id' => 1, 'nom' => 'RAKOTO', 'prenom' => 'Jean', 'titre' => 'Dr.', 'specialite' => 'Algorithmique et Programmation', 'email' => 'jean.rakoto@ge-it.com', 'statut' => 'Permanent'],
    ['id' => 2, 'nom' => 'RABE', 'prenom' => 'Marie', 'titre' => 'Prof.', 'specialite' => 'Mathématiques pour l\'informatique', 'email' => 'marie.rabe@ge-it.com', 'statut' => 'Permanent'],
    ['id' => 3, 'nom' => 'RANDRIA', 'prenom' => 'Paul', 'titre' => 'M.', 'specialite' => 'Architecture des ordinateurs', 'email' => 'paul.randria@ge-it.com', 'statut' => 'Vacataire'],
    ['id' => 4, 'nom' => 'JOHNSON', 'prenom' => 'Sarah', 'titre' => 'Mme.', 'specialite' => 'Anglais technique', 'email' => 'sarah.johnson@ge-it.com', 'statut' => 'Vacataire'],
    ['id' => 5, 'nom' => 'RAZAFY', 'prenom' => 'Michel', 'titre' => 'Dr.', 'specialite' => 'Réseaux informatiques', 'email' => 'michel.razafy@ge-it.com', 'statut' => 'Permanent'],
    ['id' => 6, 'nom' => 'ANDRIAMASINORO', 'prenom' => 'Luc', 'titre' => 'M.', 'specialite' => 'Programmation orientée objet', 'email' => 'luc.andriamasinoro@ge-it.com', 'statut' => 'Vacataire'],
    ['id' => 7, 'nom' => 'RAKOTONDRABE', 'prenom' => 'Soa', 'titre' => 'Prof.', 'specialite' => 'Bases de données', 'email' => 'soa.rakotondrabe@ge-it.com', 'statut' => 'Permanent'],
    ['id' => 8, 'nom' => 'RABEMANANJARA', 'prenom' => 'Eric', 'titre' => 'M.', 'specialite' => 'Développement web', 'email' => 'eric.rabemananjara@ge-it.com', 'statut' => 'Vacataire'],
];

// Données pour les cours
$cours = [
    ['id' => 1, 'code' => 'ALG101', 'titre' => 'Algorithmique et Programmation', 'niveau' => 'L1', 'credits' => 6, 'enseignant' => 'Dr. RAKOTO Jean'],
    ['id' => 2, 'code' => 'MAT101', 'titre' => 'Mathématiques pour l\'informatique', 'niveau' => 'L1', 'credits' => 4, 'enseignant' => 'Prof. RABE Marie'],
    ['id' => 3, 'code' => 'ARC101', 'titre' => 'Architecture des ordinateurs', 'niveau' => 'L1', 'credits' => 3, 'enseignant' => 'M. RANDRIA Paul'],
    ['id' => 4, 'code' => 'ANG101', 'titre' => 'Anglais technique', 'niveau' => 'L1', 'credits' => 2, 'enseignant' => 'Mme. JOHNSON Sarah'],
    ['id' => 5, 'code' => 'RES101', 'titre' => 'Réseaux informatiques', 'niveau' => 'L1', 'credits' => 4, 'enseignant' => 'Dr. RAZAFY Michel'],
    ['id' => 6, 'code' => 'POO201', 'titre' => 'Programmation orientée objet', 'niveau' => 'L2', 'credits' => 6, 'enseignant' => 'M. ANDRIAMASINORO Luc'],
    ['id' => 7, 'code' => 'BDD201', 'titre' => 'Bases de données', 'niveau' => 'L2', 'credits' => 5, 'enseignant' => 'Prof. RAKOTONDRABE Soa'],
    ['id' => 8, 'code' => 'WEB201', 'titre' => 'Développement web', 'niveau' => 'L2', 'credits' => 4, 'enseignant' => 'M. RABEMANANJARA Eric'],
];

// Données pour les paiements
$paiements = [
    ['id' => 1, 'etudiant' => 'RAKOTO Jean', 'matricule' => 'ET2023001', 'montant' => 600000, 'date' => '15 septembre 2023', 'methode' => 'Mobile Money', 'reference' => 'ECO-2023-001', 'statut' => 'Validé'],
    ['id' => 2, 'etudiant' => 'RABE Marie', 'matricule' => 'ET2023002', 'montant' => 600000, 'date' => '16 septembre 2023', 'methode' => 'Carte bancaire', 'reference' => 'ECO-2023-002', 'statut' => 'Validé'],
    ['id' => 3, 'etudiant' => 'RANDRIA Paul', 'matricule' => 'ET2023003', 'montant' => 600000, 'date' => '18 septembre 2023', 'methode' => 'Au bureau', 'reference' => 'ECO-2023-003', 'statut' => 'Validé'],
    ['id' => 4, 'etudiant' => 'RAZAFY Sophie', 'matricule' => 'ET2023004', 'montant' => 600000, 'date' => '20 septembre 2023', 'methode' => 'Mobile Money', 'reference' => 'ECO-2023-004', 'statut' => 'Validé'],
    ['id' => 5, 'etudiant' => 'ANDRIA Luc', 'matricule' => 'ET2023005', 'montant' => 600000, 'date' => '15 janvier 2024', 'methode' => 'Mobile Money', 'reference' => 'ECO-2024-001', 'statut' => 'Validé'],
    ['id' => 6, 'etudiant' => 'RAKOTONDRABE Soa', 'matricule' => 'ET2022001', 'montant' => 600000, 'date' => '16 janvier 2024', 'methode' => 'Carte bancaire', 'reference' => 'ECO-2024-002', 'statut' => 'Validé'],
    ['id' => 7, 'etudiant' => 'RABEMANANJARA Eric', 'matricule' => 'ET2022002', 'montant' => 600000, 'date' => '18 janvier 2024', 'methode' => 'Au bureau', 'reference' => 'ECO-2024-003', 'statut' => 'Validé'],
    ['id' => 8, 'etudiant' => 'JOHNSON Sarah', 'matricule' => 'ET2021001', 'montant' => 600000, 'date' => '20 janvier 2024', 'methode' => 'Mobile Money', 'reference' => 'ECO-2024-004', 'statut' => 'En attente'],
];

// Formater les montants en Ariary
function formaterMontant($montant) {
    return number_format($montant, 0, ',', ' ') . ' Ar';
}

// Récupérer le thème préféré de l'utilisateur (cookie ou localStorage)
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="fr" class="<?php echo $theme; ?>-theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - GE-IT</title>
    <link rel="shortcut icon" href="./img/449483797_122095244054398716_1955813011609173289_n-removebg-preview copy.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/dark-theme.css">
    <link rel="stylesheet" href="./css/light-theme.css">

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
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 4px 20px 0 rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variables de couleur pour le mode clair/sombre */
        :root {
            --primary-color: #FF5722;
            --primary-hover: #E64A19;
            --success-color: #10B981;
            --warning-color: #F59E0B;
            --danger-color: #EF4444;
            --info-color: #3B82F6;
        }

        .light-theme {
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --text-tertiary: #718096;
            --bg-primary: #ffffff;
            --bg-secondary: #f7fafc;
            --bg-tertiary: #edf2f7;
            --bg-accent: #FFEBE3;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --input-bg: #ffffff;
            --input-border: #e2e8f0;
            --input-text: #1a202c;
            --input-placeholder: #a0aec0;
            --header-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --sidebar-hover: #f7fafc;
            --sidebar-active: #FFEBE3;
        }

        .dark-theme {
            --text-primary: #f7fafc;
            --text-secondary: #e2e8f0;
            --text-tertiary: #cbd5e0;
            --bg-primary: #1a202c;
            --bg-secondary: #2d3748;
            --bg-tertiary: #4a5568;
            --bg-accent: #4a5568;
            --border-color: #4a5568;
            --card-bg: #2d3748;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
            --input-bg: #2d3748;
            --input-border: #4a5568;
            --input-text: #f7fafc;
            --input-placeholder: #a0aec0;
            --header-bg: #1a202c;
            --sidebar-bg: #1a202c;
            --sidebar-hover: #2d3748;
            --sidebar-active: #4a5568;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-primary);
            background-color: var(--bg-secondary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Styles généraux */
        .text-primary {
            color: var(--text-primary);
        }

        .text-secondary {
            color: var(--text-secondary);
        }

        .text-tertiary {
            color: var(--text-tertiary);
        }

        .bg-primary {
            background-color: var(--bg-primary);
        }

        .bg-secondary {
            background-color: var(--bg-secondary);
        }

        .bg-tertiary {
            background-color: var(--bg-tertiary);
        }

        .bg-card {
            background-color: var(--card-bg);
        }

        .border-theme {
            border-color: var(--border-color);
        }

        /* Sidebar styles */
        .sidebar {
            width: 280px;
            transition: all 0.3s ease;
            background-color: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
        }

        .sidebar-collapsed {
            width: 80px;
        }

        .sidebar-collapsed .sidebar-text {
            display: none;
        }

        .sidebar-collapsed .sidebar-icon {
            margin-right: 0;
        }

        .main-content {
            transition: all 0.3s ease;
            margin-left: 280px;
            width: calc(100% - 280px);
        }

        .main-content-expanded {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 40;
                height: 100%;
            }

            .sidebar-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Navigation */
        .nav-link {
            color: var(--text-primary);
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--primary-color);
        }

        .nav-link.active {
            background-color: var(--sidebar-active);
            color: var(--primary-color);
            font-weight: 500;
        }

        .nav-link.active .sidebar-icon {
            color: var(--primary-color);
        }

        /* Cards */
        .dashboard-card {
            background-color: var(--card-bg);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            border-radius: 1rem;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Carte cliquable */
        .clickable-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clickable-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Progress bar */
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: var(--bg-tertiary);
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            transition: width 0.5s ease;
        }

        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table th {
            text-align: left;
            padding: 1rem;
            font-weight: 600;
            color: var(--text-secondary);
            background-color: var(--bg-tertiary);
        }

        .data-table td {
            padding: 1rem;
            border-top: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .data-table tr:hover {
            background-color: var(--bg-accent);
        }

        /* Tabs */
        .tab-button {
            padding: 0.75rem 1.5rem;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .tab-button:hover {
            color: var(--primary-color);
        }

        .tab-button.active {
            border-bottom: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        /* Inputs */
        input, select, textarea {
            background-color: var(--input-bg);
            border-color: var(--input-border);
            color: var(--input-text);
        }

        input::placeholder, select::placeholder, textarea::placeholder {
            color: var(--input-placeholder);
        }

        /* Animations */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        .animate-pulse-slow {
            animation: pulse 3s infinite;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bg-tertiary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-tertiary);
        }

        /* Boutons */
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-outline {
            border: 1px solid var(--border-color);
            background-color: transparent;
            color: var(--text-primary);
        }

        .btn-outline:hover {
            background-color: var(--bg-tertiary);
        }

        /* Badges */
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10B981;
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
        }

        .badge-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: #EF4444;
        }

        .badge-info {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3B82F6;
        }

        /* Dark mode adjustments */
        .dark-theme .badge-success {
            background-color: rgba(16, 185, 129, 0.2);
            color: #34D399;
        }

        .dark-theme .badge-warning {
            background-color: rgba(245, 158, 11, 0.2);
            color: #FBBF24;
        }

        .dark-theme .badge-danger {
            background-color: rgba(239, 68, 68, 0.2);
            color: #F87171;
        }

        .dark-theme .badge-info {
            background-color: rgba(59, 130, 246, 0.2);
            color: #60A5FA;
        }

        /* Correction pour le bouton mobile */
        #mobile-menu-button {
            display: block;
            cursor: pointer;
            z-index: 50;
        }

        /* Correction pour le menu mobile */
        @media (max-width: 1024px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 280px;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar.sidebar-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Correction pour le header mobile */
        .lg\:hidden {
            display: flex !important;
        }

        @media (min-width: 1024px) {
            .lg\:hidden {
                display: none !important;
            }
        }
    </style>
</head>
<body class="font-sans">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-card py-4 px-6 flex items-center justify-between shadow-sm sticky top-0 z-50">
        <div class="flex items-center">
            <button id="mobile-menu-button" class="mr-4 p-2 rounded-md hover:bg-tertiary focus:outline-none" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            
            <div class="flex items-center">
                <div class="bg-card p-2 rounded-lg shadow-sm">
                    <img src="./img/449483797_122095244054398716_1955813011609173289_n-removebg-preview copy.png" alt="Logo GE-IT" class="h-8 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange">GE-IT Admin</span>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <button id="theme-toggle-mobile" class="p-2 rounded-full bg-tertiary hover:bg-accent focus:outline-none" aria-label="Changer de thème">
                <span id="theme-icon-mobile">
                    <?php if ($theme === 'dark'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <?php endif; ?>
                </span>
            </button>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar fixed top-0 left-0 h-full shadow-custom z-30 overflow-y-auto">
        <div class="p-4 border-b border-theme flex items-center justify-between">
            <div class="flex items-center">
                <div class="bg-card p-2 rounded-lg shadow-sm">
                    <img src="./img/449483797_122095244054398716_1955813011609173289_n-removebg-preview copy.png" alt="Logo GE-IT" class="h-8 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange sidebar-text">GE-IT Admin</span>
            </div>
            <button id="toggle-sidebar" class="p-2 rounded-md hover:bg-tertiary focus:outline-none lg:block hidden" aria-label="Réduire le menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </button>
            <button id="close-sidebar" class="p-2 rounded-md hover:bg-tertiary focus:outline-none lg:hidden" aria-label="Fermer le menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="p-4 border-b border-theme">
            <div class="flex items-center">
                <div class="relative">
                    <img src="<?php echo $photo; ?>" alt="Photo de profil" class="h-12 w-12 rounded-full object-cover border-2 border-ge-orange">
                    <div class="absolute bottom-0 right-0 bg-success-color w-3 h-3 rounded-full border-2 border-card"></div>
                </div>
                <div class="ml-3 sidebar-text">
                    <p class="font-semibold"><?php echo $nom . ' ' . $prenom; ?></p>
                    <p class="text-sm text-secondary">Administrateur</p>
                </div>
            </div>
        </div>
        
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#dashboard" class="nav-link flex items-center p-3 active" data-target="dashboard-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="sidebar-text">Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="#etudiants" class="nav-link flex items-center p-3" data-target="etudiants-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="sidebar-text">Étudiants</span>
                    </a>
                </li>
                <li>
                    <a href="#enseignants" class="nav-link flex items-center p-3" data-target="enseignants-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="sidebar-text">Enseignants</span>
                    </a>
                </li>
                <li>
                    <a href="#cours" class="nav-link flex items-center p-3" data-target="cours-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="sidebar-text">Cours</span>
                    </a>
                </li>
                <li>
                    <a href="#emploi-du-temps" class="nav-link flex items-center p-3" data-target="emploi-du-temps-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="sidebar-text">Emploi du temps</span>
                    </a>
                </li>
                <li>
                    <a href="#ecolage" class="nav-link flex items-center p-3" data-target="ecolage-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="sidebar-text">Écolage</span>
                    </a>
                </li>
                <li>
                    <a href="#notes" class="nav-link flex items-center p-3" data-target="notes-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="sidebar-text">Notes</span>
                    </a>
                </li>
                <li class="pt-4 mt-4 border-t border-theme">
                    <a href="#parametres" class="nav-link flex items-center p-3" data-target="parametres-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="sidebar-text">Paramètres</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="nav-link flex items-center p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="sidebar-text">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main id="main-content" class="main-content min-h-screen py-6 px-6">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold">Tableau de bord</h1>
                <p class="text-secondary mt-1">Bienvenue, <?php echo $nom; ?> ! Voici un aperçu de l'activité de l'école.</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <button id="theme-toggle" class="p-2 rounded-full bg-tertiary hover:bg-accent focus:outline-none hidden lg:block" aria-label="Changer de thème">
                    <span id="theme-icon">
                        <?php if ($theme === 'dark'): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <?php endif; ?>
                    </span>
                </button>
            </div>
        </header>

        <!-- Dashboard Section -->
        <section id="dashboard-section" class="content-section space-y-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Carte Étudiants -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='etudiants_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Étudiants</h3>
                        <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Nombre total d'étudiants</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo $statistiques['etudiants']; ?></span>
                        <span class="badge badge-info">Actifs</span>
                    </div>
                </div>
                
                <!-- Carte Enseignants -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='#enseignants'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Enseignants</h3>
                        <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Nombre total d'enseignants</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo $statistiques['enseignants']; ?></span>
                        <span class="badge badge-success">Personnel</span>
                    </div>
                </div>
                
                <!-- Carte Cours -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='#cours'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Cours</h3>
                        <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Nombre total de cours</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo $statistiques['cours']; ?></span>
                        <span class="badge badge-purple">Actifs</span>
                    </div>
                </div>
                
                <!-- Carte Paiements -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='#ecolage'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Paiements</h3>
                        <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Paiements ce mois</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo formaterMontant($statistiques['paiements_mois']); ?></span>
                        <span class="badge badge-warning">Mai 2024</span>
                    </div>
                </div>
                
                <!-- Carte Présence -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='#presence'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Présence</h3>
                        <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-danger-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Taux de présence moyen</p>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-bold"><?php echo $statistiques['taux_presence']; ?>%</span>
                        <span class="badge badge-danger">Tous niveaux</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill bg-danger-color" style="width: <?php echo $statistiques['taux_presence']; ?>%"></div>
                    </div>
                </div>
                
                <!-- Carte Réussite -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='#notes'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Réussite</h3>
                        <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Taux de réussite</p>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-bold"><?php echo $statistiques['taux_reussite']; ?>%</span>
                        <span class="badge badge-success">Année 2023-2024</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill bg-success-color" style="width: <?php echo $statistiques['taux_reussite']; ?>%"></div>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Répartition des étudiants par niveau -->
                <div class="dashboard-card p-6 lg:col-span-2">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Répartition des étudiants par niveau</h3>
                        <a href="#etudiants" class="text-ge-orange hover:text-ge-orange-dark text-sm font-medium nav-link flex items-center" data-target="etudiants-section">
                            Voir tout
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-5 gap-4">
                        <?php foreach ($niveaux as $index => $niveau): ?>
                        <div class="bg-tertiary p-4 rounded-lg text-center">
                            <div class="text-3xl font-bold mb-2 text-ge-orange">
                                <?php 
                                // Simuler un nombre d'étudiants par niveau
                                $nombre = 0;
                                switch ($niveau) {
                                    case 'L1': $nombre = 150; break;
                                    case 'L2': $nombre = 120; break;
                                    case 'L3': $nombre = 90; break;
                                    case 'M1': $nombre = 60; break;
                                    case 'M2': $nombre = 30; break;
                                }
                                echo $nombre;
                                ?>
                            </div>
                            <div class="text-sm font-medium"><?php echo $niveau; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-6">
                        <div class="h-16 bg-tertiary rounded-lg flex overflow-hidden">
                            <?php 
                            $colors = ['bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-red-500'];
                            $percentages = [33, 27, 20, 13, 7]; // Pourcentages pour L1, L2, L3, M1, M2
                            
                            foreach ($percentages as $index => $percentage): 
                            ?>
                            <div class="<?php echo $colors[$index]; ?> h-full" style="width: <?php echo $percentage; ?>%">
                                <div class="h-full flex items-center justify-center text-white font-medium">
                                    <?php echo $percentage; ?>%
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="flex justify-between mt-4">
                            <?php foreach ($niveaux as $index => $niveau): ?>
                            ?>
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full <?php echo $colors[$index]; ?> mr-2"></div>
                                <span class="text-sm"><?php echo $niveau; ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Derniers paiements -->
                <div class="dashboard-card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Derniers paiements</h3>
                        <a href="#ecolage" class="text-ge-orange hover:text-ge-orange-dark text-sm font-medium nav-link flex items-center" data-target="ecolage-section">
                            Voir tout
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <?php 
                        // Afficher seulement les 4 derniers paiements
                        $derniers_paiements = array_slice($paiements, 0, 4);
                        
                        foreach ($derniers_paiements as $paiement): 
                        ?>
                        <div class="p-4 rounded-lg bg-tertiary cursor-pointer" onclick="window.location.href='paiement_details.php?id=<?php echo $paiement['id']; ?>'">
                            <div class="flex justify-between">
                                <h4 class="font-medium"><?php echo $paiement['etudiant']; ?></h4>
                                <span class="text-sm text-tertiary"><?php echo $paiement['date']; ?></span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-sm text-secondary"><?php echo $paiement['matricule']; ?></span>
                                <span class="font-medium"><?php echo formaterMontant($paiement['montant']); ?></span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-sm text-secondary"><?php echo $paiement['methode']; ?></span>
                                <span class="badge <?php echo $paiement['statut'] === 'Validé' ? 'badge-success' : 'badge-warning'; ?>">
                                    <?php echo $paiement['statut']; ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Etudiants Section -->
        <section id="etudiants-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold mb-4 md:mb-0">Gestion des étudiants</h2>
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un étudiant..." class="w-full px-4 py-2 pl-10 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <div class="absolute left-3 top-2.5 text-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter un étudiant
                        </button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex border-b border-theme">
                        <button class="tab-button active" data-tab="niveau-l1">L1</button>
                        <button class="tab-button" data-tab="niveau-l2">L2</button>
                        <button class="tab-button" data-tab="niveau-l3">L3</button>
                        <button class="tab-button" data-tab="niveau-m1">M1</button>
                        <button class="tab-button" data-tab="niveau-m2">M2</button>
                    </div>
                </div>

                <div id="niveau-l1" class="tab-content active">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Filtrer les étudiants par niveau
                                $etudiants_l1 = array_filter($etudiants, function($e) {
                                    return $e['niveau'] === 'L1';
                                });
                                
                                foreach ($etudiants_l1 as $etudiant): 
                                ?>
                                <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                    <td><?php echo $etudiant['matricule']; ?></td>
                                    <td><?php echo $etudiant['nom']; ?></td>
                                    <td><?php echo $etudiant['prenom']; ?></td>
                                    <td><?php echo $etudiant['email']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $etudiant['statut'] === 'Actif' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $etudiant['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir" onclick="event.stopPropagation(); window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier" onclick="event.stopPropagation(); window.location.href='etudiant_edit.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer" onclick="event.stopPropagation(); if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')) window.location.href='etudiant_delete.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="niveau-l2" class="tab-content">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Filtrer les étudiants par niveau
                                $etudiants_l2 = array_filter($etudiants, function($e) {
                                    return $e['niveau'] === 'L2';
                                });
                                
                                foreach ($etudiants_l2 as $etudiant): 
                                ?>
                                <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                    <td><?php echo $etudiant['matricule']; ?></td>
                                    <td><?php echo $etudiant['nom']; ?></td>
                                    <td><?php echo $etudiant['prenom']; ?></td>
                                    <td><?php echo $etudiant['email']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $etudiant['statut'] === 'Actif' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $etudiant['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir" onclick="event.stopPropagation(); window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier" onclick="event.stopPropagation(); window.location.href='etudiant_edit.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer" onclick="event.stopPropagation(); if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')) window.location.href='etudiant_delete.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="niveau-l3" class="tab-content">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Filtrer les étudiants par niveau
                                $etudiants_l3 = array_filter($etudiants, function($e) {
                                    return $e['niveau'] === 'L3';
                                });
                                
                                foreach ($etudiants_l3 as $etudiant): 
                                ?>
                                <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                    <td><?php echo $etudiant['matricule']; ?></td>
                                    <td><?php echo $etudiant['nom']; ?></td>
                                    <td><?php echo $etudiant['prenom']; ?></td>
                                    <td><?php echo $etudiant['email']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $etudiant['statut'] === 'Actif' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $etudiant['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir" onclick="event.stopPropagation(); window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier" onclick="event.stopPropagation(); window.location.href='etudiant_edit.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer" onclick="event.stopPropagation(); if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')) window.location.href='etudiant_delete.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="niveau-m1" class="tab-content">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Filtrer les étudiants par niveau
                                $etudiants_m1 = array_filter($etudiants, function($e) {
                                    return $e['niveau'] === 'M1';
                                });
                                
                                foreach ($etudiants_m1 as $etudiant): 
                                ?>
                                <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                    <td><?php echo $etudiant['matricule']; ?></td>
                                    <td><?php echo $etudiant['nom']; ?></td>
                                    <td><?php echo $etudiant['prenom']; ?></td>
                                    <td><?php echo $etudiant['email']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $etudiant['statut'] === 'Actif' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $etudiant['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir" onclick="event.stopPropagation(); window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier" onclick="event.stopPropagation(); window.location.href='etudiant_edit.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer" onclick="event.stopPropagation(); if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')) window.location.href='etudiant_delete.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="niveau-m2" class="tab-content">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Filtrer les étudiants par niveau
                                $etudiants_m2 = array_filter($etudiants, function($e) {
                                    return $e['niveau'] === 'M2';
                                });
                                
                                foreach ($etudiants_m2 as $etudiant): 
                                ?>
                                <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                    <td><?php echo $etudiant['matricule']; ?></td>
                                    <td><?php echo $etudiant['nom']; ?></td>
                                    <td><?php echo $etudiant['prenom']; ?></td>
                                    <td><?php echo $etudiant['email']; ?></td>
                                    <td>
                                        <span class="badge <?php echo $etudiant['statut'] === 'Actif' ? 'badge-success' : 'badge-danger'; ?>">
                                            <?php echo $etudiant['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir" onclick="event.stopPropagation(); window.location.href='etudiant_details.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier" onclick="event.stopPropagation(); window.location.href='etudiant_edit.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer" onclick="event.stopPropagation(); if(confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?')) window.location.href='etudiant_delete.php?id=<?php echo $etudiant['id']; ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm text-secondary">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">8</span> sur <span class="font-medium">450</span> étudiants
                    </div>
                    
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary disabled:opacity-50" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-2 rounded-md border border-theme bg-ge-orange text-white hover:bg-ge-orange-dark">
                            1
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            2
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            3
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Enseignants Section -->
        <section id="enseignants-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold mb-4 md:mb-0">Gestion des enseignants</h2>
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un enseignant..." class="w-full px-4 py-2 pl-10 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <div class="absolute left-3 top-2.5 text-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter un enseignant
                        </button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex border-b border-theme">
                        <button class="tab-button active" data-tab="enseignants-permanents">Permanents</button>
                        <button class="tab-button" data-tab="enseignants-vacataires">Vacataires</button>
                    </div>
                </div>
                
                <div class="overflow-x-auto rounded-lg">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="rounded-tl-lg">Titre</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Spécialité</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th class="rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($enseignants as $enseignant): ?>
                            <tr>
                                <td><?php echo $enseignant['titre']; ?></td>
                                <td><?php echo $enseignant['nom']; ?></td>
                                <td><?php echo $enseignant['prenom']; ?></td>
                                <td><?php echo $enseignant['specialite']; ?></td>
                                <td><?php echo $enseignant['email']; ?></td>
                                <td>
                                    <span class="badge <?php echo $enseignant['statut'] === 'Permanent' ? 'badge-success' : 'badge-info'; ?>">
                                        <?php echo $enseignant['statut']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm text-secondary">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">8</span> sur <span class="font-medium">34</span> enseignants
                    </div>
                    
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary disabled:opacity-50" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-2 rounded-md border border-theme bg-ge-orange text-white hover:bg-ge-orange-dark">
                            1
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            2
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cours Section -->
        <section id="cours-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold mb-4 md:mb-0">Gestion des cours</h2>
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un cours..." class="w-full px-4 py-2 pl-10 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <div class="absolute left-3 top-2.5 text-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter un cours
                        </button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex border-b border-theme">
                        <button class="tab-button active" data-tab="cours-l1">L1</button>
                        <button class="tab-button" data-tab="cours-l2">L2</button>
                        <button class="tab-button" data-tab="cours-l3">L3</button>
                        <button class="tab-button" data-tab="cours-m1">M1</button>
                        <button class="tab-button" data-tab="cours-m2">M2</button>
                    </div>
                </div>
                
                <div class="overflow-x-auto rounded-lg">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="rounded-tl-lg">Code</th>
                                <th>Titre</th>
                                <th>Niveau</th>
                                <th>Crédits</th>
                                <th>Enseignant</th>
                                <th class="rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cours as $c): ?>
                            <tr class="cursor-pointer hover:bg-tertiary" onclick="window.location.href='cours_details.php?id=<?php echo $c['id']; ?>'">
                                <td><?php echo $c['code']; ?></td>
                                <td><?php echo $c['titre']; ?></td>
                                <td><?php echo $c['niveau']; ?></td>
                                <td><?php echo $c['credits']; ?></td>
                                <td><?php echo $c['enseignant']; ?></td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Supprimer">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm text-secondary">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">8</span> sur <span class="font-medium">28</span> cours
                    </div>
                    
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary disabled:opacity-50" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-2 rounded-md border border-theme bg-ge-orange text-white hover:bg-ge-orange-dark">
                            1
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            2
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emploi du temps Section -->
        <section id="emploi-du-temps-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-6">Gestion de l'emploi du temps</h2>
                
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="md:w-1/4">
                        <label for="niveau" class="block text-sm font-medium mb-2">Niveau</label>
                        <select id="niveau" name="niveau" class="w-full px-4 py-2 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <option value="">Sélectionnez un niveau</option>
                            <?php foreach ($niveaux as $niveau): ?>
                            <option value="<?php echo $niveau; ?>"><?php echo $niveau; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="md:w-1/4">
                        <label for="semaine" class="block text-sm font-medium mb-2">Semaine</label>
                        <select id="semaine" name="semaine" class="w-full px-4 py-2 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <option value="">Sélectionnez une semaine</option>
                            <option value="1">Semaine 1 (1-7 mai 2024)</option>
                            <option value="2">Semaine 2 (8-14 mai 2024)</option>
                            <option value="3">Semaine 3 (15-21 mai 2024)</option>
                            <option value="4">Semaine 4 (22-28 mai 2024)</option>
                        </select>
                    </div>
                    
                    <div class="md:w-1/2 flex items-end">
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Générer l'emploi du temps
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="border border-theme p-2 bg-tertiary">Horaire</th>
                                <th class="border border-theme p-2 bg-tertiary">Lundi</th>
                                <th class="border border-theme p-2 bg-tertiary">Mardi</th>
                                <th class="border border-theme p-2 bg-tertiary">Mercredi</th>
                                <th class="border border-theme p-2 bg-tertiary">Jeudi</th>
                                <th class="border border-theme p-2 bg-tertiary">Vendredi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $horaires = ['08:00 - 10:00', '10:15 - 12:15', '13:30 - 15:30', '15:45 - 17:45'];
                            
                            foreach ($horaires as $horaire):
                            ?>
                            <tr>
                                <td class="border border-theme p-2 font-medium"><?php echo $horaire; ?></td>
                                <td class="border border-theme p-2 hover:bg-tertiary cursor-pointer min-h-[80px]"></td>
                                <td class="border border-theme p-2 hover:bg-tertiary cursor-pointer min-h-[80px]"></td>
                                <td class="border border-theme p-2 hover:bg-tertiary cursor-pointer min-h-[80px]"></td>
                                <td class="border border-theme p-2 hover:bg-tertiary cursor-pointer min-h-[80px]"></td>
                                <td class="border border-theme p-2 hover:bg-tertiary cursor-pointer min-h-[80px]"></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-end">
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Exporter l'emploi du temps
                    </button>
                </div>
            </div>
        </section>

        <!-- Ecolage Section -->
        <section id="ecolage-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold mb-4 md:mb-0">Gestion des paiements</h2>
                    
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Rechercher un paiement..." class="w-full px-4 py-2 pl-10 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <div class="absolute left-3 top-2.5 text-tertiary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Enregistrer un paiement
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto rounded-lg">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="rounded-tl-lg">Référence</th>
                                <th>Étudiant</th>
                                <th>Matricule</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Méthode</th>
                                <th>Statut</th>
                                <th class="rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paiements as $paiement): ?>
                            <tr>
                                <td><?php echo $paiement['reference']; ?></td>
                                <td><?php echo $paiement['etudiant']; ?></td>
                                <td><?php echo $paiement['matricule']; ?></td>
                                <td><?php echo formaterMontant($paiement['montant']); ?></td>
                                <td><?php echo $paiement['date']; ?></td>
                                <td><?php echo $paiement['methode']; ?></td>
                                <td>
                                    <span class="badge <?php echo $paiement['statut'] === 'Validé' ? 'badge-success' : 'badge-warning'; ?>">
                                        <?php echo $paiement['statut']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="p-1 rounded-md hover:bg-tertiary text-info-color" title="Voir">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-success-color" title="Valider">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                        <button class="p-1 rounded-md hover:bg-tertiary text-danger-color" title="Annuler">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="flex justify-between items-center mt-6">
                    <div class="text-sm text-secondary">
                        Affichage de <span class="font-medium">1</span> à <span class="font-medium">8</span> sur <span class="font-medium">120</span> paiements
                    </div>
                    
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary disabled:opacity-50" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="p-2 rounded-md border border-theme bg-ge-orange text-white hover:bg-ge-orange-dark">
                            1
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            2
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            3
                        </button>
                        <button class="p-2 rounded-md border border-theme hover:bg-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Notes Section -->
        <section id="notes-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-6">Gestion des notes</h2>
                
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="md:w-1/4">
                        <label for="niveau-notes" class="block text-sm font-medium mb-2">Niveau</label>
                        <select id="niveau-notes" name="niveau-notes" class="w-full px-4 py-2 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <option value="">Sélectionnez un niveau</option>
                            <?php foreach ($niveaux as $niveau): ?>
                            <option value="<?php echo $niveau; ?>"><?php echo $niveau; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="md:w-1/4">
                        <label for="cours-notes" class="block text-sm font-medium mb-2">Cours</label>
                        <select id="cours-notes" name="cours-notes" class="w-full px-4 py-2 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <option value="">Sélectionnez un cours</option>
                            <?php foreach ($cours as $c): ?>
                            <option value="<?php echo $c['id']; ?>"><?php echo $c['titre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="md:w-1/4">
                        <label for="semestre-notes" class="block text-sm font-medium mb-2">Semestre</label>
                        <select id="semestre-notes" name="semestre-notes" class="w-full px-4 py-2 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            <option value="">Sélectionnez un semestre</option>
                            <option value="1">Semestre 1</option>
                            <option value="2">Semestre 2</option>
                        </select>
                    </div>
                    
                    <div class="md:w-1/4 flex items-end">
                        <button class="btn btn-primary w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Rechercher
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto rounded-lg">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="rounded-tl-lg">Matricule</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Note CC</th>
                                <th>Note Examen</th>
                                <th>Note Finale</th>
                                <th>Mention</th>
                                <th class="rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 5; $i++): 
                                $etudiant = $etudiants[$i];
                                // Simuler des notes
                                $note_cc = rand(10, 20);
                                $note_examen = rand(10, 20);
                                $note_finale = round(($note_cc * 0.4) + ($note_examen * 0.6), 1);
                                
                                // Déterminer la mention
                                $mention = '';
                                if ($note_finale >= 16) {
                                    $mention = 'Très bien';
                                } elseif ($note_finale >= 14) {
                                    $mention = 'Bien';
                                } elseif ($note_finale >= 12) {
                                    $mention = 'Assez bien';
                                } elseif ($note_finale >= 10) {
                                    $mention = 'Passable';
                                } else {
                                    $mention = 'Insuffisant';
                                }
                            ?>
                            <tr>
                                <td><?php echo $etudiant['matricule']; ?></td>
                                <td><?php echo $etudiant['nom']; ?></td>
                                <td><?php echo $etudiant['prenom']; ?></td>
                                <td><?php echo $note_cc; ?>/20</td>
                                <td><?php echo $note_examen; ?>/20</td>
                                <td class="font-medium"><?php echo $note_finale; ?>/20</td>
                                <td>
                                    <span class="badge <?php echo $note_finale >= 14 ? 'badge-success' : ($note_finale >= 10 ? 'badge-info' : 'badge-danger'); ?>">
                                        <?php echo $mention; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="p-1 rounded-md hover:bg-tertiary text-warning-color" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6 flex justify-end space-x-4">
                    <button class="btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Importer des notes
                    </button>
                    
                    <button class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Exporter les notes
                    </button>
                </div>
            </div>
        </section>

        <!-- Parametres Section -->
        <section id="parametres-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-8">Paramètres</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informations personnelles
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label for="nom" class="block text-sm font-medium mb-2">Nom</label>
                                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="prenom" class="block text-sm font-medium mb-2">Prénom</label>
                                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="photo" class="block text-sm font-medium mb-2">Photo de profil</label>
                                <div class="flex items-center">
                                    <img src="<?php echo $photo; ?>" alt="Photo de profil" class="h-16 w-16 rounded-full object-cover mr-4">
                                    <label for="upload-photo" class="btn btn-outline cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Changer la photo
                                    </label>
                                    <input id="upload-photo" type="file" class="hidden" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Sécurité
                        </h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label for="ancien_mot_de_passe" class="block text-sm font-medium mb-2">Ancien mot de passe</label>
                                <input type="password" id="ancien_mot_de_passe" name="ancien_mot_de_passe" placeholder="Entrez votre ancien mot de passe" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="nouveau_mot_de_passe" class="block text-sm font-medium mb-2">Nouveau mot de passe</label>
                                <input type="password" id="nouveau_mot_de_passe" name="nouveau_mot_de_passe" placeholder="Entrez votre nouveau mot de passe" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="confirmer_mot_de_passe" class="block text-sm font-medium mb-2">Confirmer le mot de passe</label>
                                <input type="password" id="confirmer_mot_de_passe" name="confirmer_mot_de_passe" placeholder="Confirmez votre nouveau mot de passe" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div class="pt-6">
                                <h4 class="font-medium mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Préférences
                                </h4>
                                
                                <div class="flex items-center justify-between p-4 bg-tertiary rounded-lg">
                                    <div>
                                        <p class="font-medium mb-1">Mode sombre</p>
                                        <p class="text-sm text-secondary">Activer le mode sombre pour l'interface</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="theme-toggle-settings" class="sr-only peer" <?php echo $theme === 'dark' ? 'checked' : ''; ?>>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-ge-orange peer-focus:ring-opacity-20 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-ge-orange"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <button class="btn btn-primary py-3 px-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du menu mobile
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    if (sidebar) {
                        sidebar.classList.toggle('sidebar-open');
                        console.log('Menu mobile toggled');
                    }
                });
            }
            
            if (closeSidebar) {
                closeSidebar.addEventListener('click', function() {
                    if (sidebar) {
                        sidebar.classList.remove('sidebar-open');
                    }
                });
            }
            
            // Gestion du thème
            const themeToggle = document.getElementById('theme-toggle');
            const themeToggleMobile = document.getElementById('theme-toggle-mobile');
            const themeToggleSettings = document.getElementById('theme-toggle-settings');
            
            function toggleTheme() {
                const html = document.documentElement;
                const body = document.body;
                
                // Vérifier le thème actuel
                const isDarkMode = html.classList.contains('dark-theme');
                const newTheme = isDarkMode ? 'light' : 'dark';
                
                // Supprimer les anciennes classes
                html.classList.remove('light-theme', 'dark-theme');
                body.classList.remove('light-theme', 'dark-theme');
                
                // Ajouter les nouvelles classes
                html.classList.add(newTheme + '-theme');
                body.classList.add(newTheme + '-theme');
                
                // Mettre à jour les icônes
                updateThemeIcons(newTheme === 'dark');
                
                // Sauvegarder la préférence
                localStorage.setItem('theme', newTheme);
                document.cookie = `theme=${newTheme}; path=/; max-age=31536000`;
                
                console.log('Thème changé pour:', newTheme);
            }
            
            function updateThemeIcons(isDark) {
                const themeIcon = document.getElementById('theme-icon');
                const themeIconMobile = document.getElementById('theme-icon-mobile');
                
                const sunIcon = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                `;
                
                const moonIcon = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                `;
                
                if (themeIcon) {
                    themeIcon.innerHTML = isDark ? sunIcon : moonIcon;
                }
                
                if (themeIconMobile) {
                    themeIconMobile.innerHTML = isDark ? sunIcon : moonIcon;
                }
                
                if (themeToggleSettings) {
                    themeToggleSettings.checked = isDark;
                }
            }
            
            // Attacher les écouteurs d'événements pour le thème
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
            
            if (themeToggleMobile) {
                themeToggleMobile.addEventListener('click', toggleTheme);
            }
            
            if (themeToggleSettings) {
                themeToggleSettings.addEventListener('change', toggleTheme);
            }
            
            // Gestion des onglets
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const tabId = button.getAttribute('data-tab');
                    
                    // Retirer la classe active de tous les boutons et contenus
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    
                    // Ajouter la classe active au bouton et contenu correspondant
                    button.classList.add('active');
                    document.getElementById(tabId).classList.add('active');
                });
            });
            
            // Gestion de la navigation
            const navLinks = document.querySelectorAll('.nav-link');
            const contentSections = document.querySelectorAll('.content-section');
            const pageTitle = document.querySelector('h1');
            
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    const targetId = link.getAttribute('data-target');
                    
                    // Retirer la classe active de tous les liens et sections
                    navLinks.forEach(navLink => navLink.classList.remove('active'));
                    contentSections.forEach(section => section.classList.add('hidden'));
                    
                    // Ajouter la classe active au lien et section correspondant
                    link.classList.add('active');
                    document.getElementById(targetId).classList.remove('hidden');
                    
                    // Mettre à jour le titre de la page
                    if (pageTitle) {
                        const linkText = link.querySelector('.sidebar-text')?.textContent || link.textContent;
                        pageTitle.textContent = linkText.trim();
                    }
                    
                    // Fermer la sidebar sur mobile après la navigation
                    if (window.innerWidth < 1024) {
                        sidebar.classList.remove('sidebar-open');
                    }
                });
            });
            
            // Initialiser la page avec la première section active
            if (navLinks.length > 0 && contentSections.length > 0) {
                navLinks[0].classList.add('active');
                contentSections[0].classList.remove('hidden');
            }
            
            // Initialiser les icônes du thème
            const isDarkMode = document.documentElement.classList.contains('dark-theme');
            updateThemeIcons(isDarkMode);
            
            // Gestion du toggle sidebar
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const mainContent = document.getElementById('main-content');
            
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', function() {
                    // Si la sidebar n'est pas déjà réduite, on peut la réduire
                    if (!sidebar.classList.contains('sidebar-collapsed')) {
                        sidebar.classList.add('sidebar-collapsed');
                        mainContent.classList.add('main-content-expanded');
                        
                        // Mettre à jour l'icône du toggle
                        toggleSidebar.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>`;
                    }
                    // On ne permet pas de développer la sidebar une fois réduite
                });
            }
        });
    </script>
</body>
</html>
