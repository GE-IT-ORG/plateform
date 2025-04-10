<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté et est un étudiant
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['role'] !== 'etudiant') {
    header('Location: index.php');
    exit;
}

// Récupérer les informations de l'étudiant depuis la session
$etudiant = [
    'username' => $_SESSION['username'] ?? '',
    'niveau' => $_SESSION['niveau'] ?? 'L1',
    'id_etudiant' => $_SESSION['id_etudiant'] ?? '',
    'nom' => $_SESSION['nom'] ?? 'Étudiant',
    'prenom' => $_SESSION['prenom'] ?? '',
    'matricule' => $_SESSION['matricule'] ?? '000000',
    'email' => $_SESSION['email'] ?? 'etudiant@ge-it.com',
    'photo' => $_SESSION['photo'] ?? './img/avatar-default.png'
];

// Données fictives pour la démonstration (dans un vrai système, ces données viendraient de la base de données)
$ecolage = [
    'montant_total' => 1800000,
    'montant_paye' => 1200000,
    'reste_a_payer' => 600000,
    'prochaine_echeance' => '15 juin 2024',
    'historique' => [
        ['date' => '15 septembre 2023', 'montant' => 600000, 'statut' => 'Payé', 'reference' => 'ECO-2023-001'],
        ['date' => '15 janvier 2024', 'montant' => 600000, 'statut' => 'Payé', 'reference' => 'ECO-2024-001'],
        ['date' => '15 juin 2024', 'montant' => 600000, 'statut' => 'En attente', 'reference' => ''],
    ]
];

// Données fictives pour la présence
$presence = [
    'total_cours' => 120,
    'present' => 110,
    'absent' => 10,
    'taux_presence' => 91.67, // (110/120) * 100
    'derniere_absence' => '12 mai 2024',
    'historique' => [
        ['date' => '12 mai 2024', 'cours' => 'Développement web', 'statut' => 'Absent', 'justifie' => 'Non'],
        ['date' => '5 mai 2024', 'cours' => 'Bases de données', 'statut' => 'Absent', 'justifie' => 'Oui'],
        ['date' => '28 avril 2024', 'cours' => 'Réseaux informatiques', 'statut' => 'Absent', 'justifie' => 'Non'],
    ]
];

$notes = [
    'semestre1' => [
        ['matiere' => 'Algorithmique et Programmation', 'credit' => 6, 'note' => 15.5, 'appreciation' => 'Très bien'],
        ['matiere' => 'Mathématiques pour l\'informatique', 'credit' => 4, 'note' => 14, 'appreciation' => 'Bien'],
        ['matiere' => 'Architecture des ordinateurs', 'credit' => 3, 'note' => 12.5, 'appreciation' => 'Assez bien'],
        ['matiere' => 'Anglais technique', 'credit' => 2, 'note' => 16, 'appreciation' => 'Très bien'],
        ['matiere' => 'Réseaux informatiques', 'credit' => 4, 'note' => 13, 'appreciation' => 'Bien'],
    ],
    'semestre2' => [
        ['matiere' => 'Programmation orientée objet', 'credit' => 6, 'note' => 14, 'appreciation' => 'Bien'],
        ['matiere' => 'Bases de données', 'credit' => 5, 'note' => 16.5, 'appreciation' => 'Très bien'],
        ['matiere' => 'Développement web', 'credit' => 4, 'note' => 15, 'appreciation' => 'Très bien'],
        ['matiere' => 'Systèmes d\'exploitation', 'credit' => 3, 'note' => 12, 'appreciation' => 'Assez bien'],
        ['matiere' => 'Gestion de projet', 'credit' => 2, 'note' => 13.5, 'appreciation' => 'Bien'],
    ],
    'moyenne_generale' => 14.2,
    'credits_valides' => 39,
    'credits_total' => 39,
    'mention' => 'Bien'
];

$cours = [
    ['titre' => 'Algorithmique et Programmation', 'enseignant' => 'Dr. RAKOTO Jean', 'lien' => 'https://drive.google.com/drive/folders/1234567890', 'date_maj' => '10 mai 2024'],
    ['titre' => 'Mathématiques pour l\'informatique', 'enseignant' => 'Prof. RABE Marie', 'lien' => 'https://drive.google.com/drive/folders/0987654321', 'date_maj' => '5 mai 2024'],
    ['titre' => 'Architecture des ordinateurs', 'enseignant' => 'M. RANDRIA Paul', 'lien' => 'https://drive.google.com/drive/folders/1122334455', 'date_maj' => '12 mai 2024'],
    ['titre' => 'Anglais technique', 'enseignant' => 'Mme. JOHNSON Sarah', 'lien' => 'https://drive.google.com/drive/folders/5566778899', 'date_maj' => '8 mai 2024'],
    ['titre' => 'Réseaux informatiques', 'enseignant' => 'Dr. RAZAFY Michel', 'lien' => 'https://drive.google.com/drive/folders/9988776655', 'date_maj' => '15 mai 2024'],
    ['titre' => 'Programmation orientée objet', 'enseignant' => 'M. ANDRIAMASINORO Luc', 'lien' => 'https://drive.google.com/drive/folders/1212343456', 'date_maj' => '11 mai 2024'],
    ['titre' => 'Bases de données', 'enseignant' => 'Prof. RAKOTONDRABE Soa', 'lien' => 'https://drive.google.com/drive/folders/6545343212', 'date_maj' => '9 mai 2024'],
    ['titre' => 'Développement web', 'enseignant' => 'M. RABEMANANJARA Eric', 'lien' => 'https://drive.google.com/drive/folders/9876543210', 'date_maj' => '14 mai 2024'],
];

$emploi_du_temps = [
    'lundi' => [
        ['heure' => '08:00 - 10:00', 'matiere' => 'Algorithmique et Programmation', 'salle' => 'Salle 101', 'enseignant' => 'Dr. RAKOTO Jean'],
        ['heure' => '10:15 - 12:15', 'matiere' => 'Mathématiques pour l\'informatique', 'salle' => 'Salle 102', 'enseignant' => 'Prof. RABE Marie'],
        ['heure' => '13:30 - 15:30', 'matiere' => 'TP Algorithmique', 'salle' => 'Labo Info 1', 'enseignant' => 'M. RANDRIA Paul'],
    ],
    'mardi' => [
        ['heure' => '08:00 - 10:00', 'matiere' => 'Architecture des ordinateurs', 'salle' => 'Salle 103', 'enseignant' => 'M. RANDRIA Paul'],
        ['heure' => '10:15 - 12:15', 'matiere' => 'Anglais technique', 'salle' => 'Salle 104', 'enseignant' => 'Mme. JOHNSON Sarah'],
    ],
    'mercredi' => [
        ['heure' => '08:00 - 10:00', 'matiere' => 'Réseaux informatiques', 'salle' => 'Salle 101', 'enseignant' => 'Dr. RAZAFY Michel'],
        ['heure' => '10:15 - 12:15', 'matiere' => 'TP Réseaux', 'salle' => 'Labo Info 2', 'enseignant' => 'Dr. RAZAFY Michel'],
        ['heure' => '13:30 - 15:30', 'matiere' => 'Programmation orientée objet', 'salle' => 'Salle 102', 'enseignant' => 'M. ANDRIAMASINORO Luc'],
    ],
    'jeudi' => [
        ['heure' => '08:00 - 10:00', 'matiere' => 'Bases de données', 'salle' => 'Salle 103', 'enseignant' => 'Prof. RAKOTONDRABE Soa'],
        ['heure' => '10:15 - 12:15', 'matiere' => 'TP Bases de données', 'salle' => 'Labo Info 1', 'enseignant' => 'Prof. RAKOTONDRABE Soa'],
        ['heure' => '13:30 - 15:30', 'matiere' => 'Développement web', 'salle' => 'Salle 104', 'enseignant' => 'M. RABEMANANJARA Eric'],
    ],
    'vendredi' => [
        ['heure' => '08:00 - 10:00', 'matiere' => 'TP Développement web', 'salle' => 'Labo Info 2', 'enseignant' => 'M. RABEMANANJARA Eric'],
        ['heure' => '10:15 - 12:15', 'matiere' => 'Gestion de projet', 'salle' => 'Salle 101', 'enseignant' => 'Dr. RAKOTO Jean'],
        ['heure' => '13:30 - 16:30', 'matiere' => 'Projet tutoré', 'salle' => 'Salle de conférence', 'enseignant' => 'Équipe pédagogique'],
    ],
];

$notifications = [
    ['date' => '18 mai 2024', 'titre' => 'Rappel : Remise du projet tutoré', 'contenu' => 'N\'oubliez pas de remettre votre projet tutoré avant le 25 mai.', 'lue' => false],
    ['date' => '15 mai 2024', 'titre' => 'Modification de l\'emploi du temps', 'contenu' => 'Le cours de Réseaux du mercredi 22 mai est reporté au jeudi 23 mai.', 'lue' => false],
    ['date' => '10 mai 2024', 'titre' => 'Nouveaux documents disponibles', 'contenu' => 'De nouveaux supports de cours ont été ajoutés pour le module de Développement web.', 'lue' => true],
    ['date' => '5 mai 2024', 'titre' => 'Rappel de paiement', 'contenu' => 'N\'oubliez pas d\'effectuer le paiement de la dernière tranche avant le 15 juin.', 'lue' => true],
];

// Calculer le nombre de notifications non lues
$notifications_non_lues = 0;
foreach ($notifications as $notification) {
    if (!$notification['lue']) {
        $notifications_non_lues++;
    }
}

// Fonction pour calculer le pourcentage de progression
function calculerPourcentage($valeur, $total) {
    return ($total > 0) ? round(($valeur / $total) * 100) : 0;
}

// Calculer le pourcentage de paiement
$pourcentage_paiement = calculerPourcentage($ecolage['montant_paye'], $ecolage['montant_total']);

// Calculer le pourcentage de crédits validés
$pourcentage_credits = calculerPourcentage($notes['credits_valides'], $notes['credits_total']);

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
    <title>Tableau de bord étudiant - GE-IT</title>
    <link rel="shortcut icon" href="./img/logo.jpeg" type="image/x-icon">
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

        /* Emploi du temps */
        .timetable-day {
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .timetable-header {
            padding: 0.75rem 1rem;
            font-weight: 600;
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .timetable-slot {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border-color);
            background-color: var(--card-bg);
            transition: background-color 0.2s ease;
        }

        .timetable-slot:hover {
            background-color: var(--bg-accent);
        }

        .timetable-slot:last-child {
            border-radius: 0 0 0.5rem 0.5rem;
            border-bottom: none;
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
                    <img src="./img/logo.jpeg" alt="Logo GE-IT" class="h-8 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange">GE-IT</span>
            </div>
        </div>
        
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button id="mobile-notifications-button" class="p-2 rounded-md hover:bg-tertiary focus:outline-none relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <?php if ($notifications_non_lues > 0): ?>
                    <span class="notification-badge"><?php echo $notifications_non_lues; ?></span>
                    <?php endif; ?>
                </button>
            </div>
            
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
                    <img src="./img/logo.jpeg" alt="Logo GE-IT" class="h-8 w-auto object-contain">
                </div>
                <span class="ml-2 text-xl font-bold text-ge-orange sidebar-text">GE-IT</span>
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
                    <img src="<?php echo $etudiant['photo']; ?>" alt="Photo de profil" class="h-12 w-12 rounded-full object-cover border-2 border-ge-orange">
                    <div class="absolute bottom-0 right-0 bg-success-color w-3 h-3 rounded-full border-2 border-card"></div>
                </div>
                <div class="ml-3 sidebar-text">
                    <p class="font-semibold"><?php echo $etudiant['nom'] . ' ' . $etudiant['prenom']; ?></p>
                    <p class="text-sm text-secondary"><?php echo $etudiant['niveau']; ?> - <?php echo $etudiant['matricule']; ?></p>
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
                    <a href="#ecolage" class="nav-link flex items-center p-3" data-target="ecolage-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="sidebar-text">Écolage</span>
                    </a>
                </li>
                <li>
                    <a href="#presence" class="nav-link flex items-center p-3" data-target="presence-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="sidebar-text">Présence</span>
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
                <li class="pt-4 mt-4 border-t border-theme">
                    <a href="#notifications" class="nav-link flex items-center p-3" data-target="notifications-section">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 sidebar-icon text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="sidebar-text">Notifications</span>
                        <?php if ($notifications_non_lues > 0): ?>
                        <span class="ml-auto bg-ge-orange text-white text-xs font-bold px-2 py-1 rounded-full sidebar-text"><?php echo $notifications_non_lues; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li>
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
                <p class="text-secondary mt-1">Bienvenue, <?php echo $etudiant['prenom']; ?> ! Voici un aperçu de votre parcours académique.</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="relative hidden lg:block">
                    <button id="notifications-button" class="p-2 rounded-md hover:bg-tertiary focus:outline-none relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <?php if ($notifications_non_lues > 0): ?>
                        <span class="notification-badge"><?php echo $notifications_non_lues; ?></span>
                        <?php endif; ?>
                    </button>
                </div>
                
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Carte Progression -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='notes_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Progression</h3>
                        <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Crédits validés</p>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-bold"><?php echo $notes['credits_valides']; ?>/<?php echo $notes['credits_total']; ?></span>
                        <span class="text-sm font-medium text-success-color"><?php echo $pourcentage_credits; ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill bg-success-color" style="width: <?php echo $pourcentage_credits; ?>%"></div>
                    </div>
                </div>
                
                <!-- Carte Écolage -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='ecolage_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Écolage</h3>
                        <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Paiement effectué</p>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-bold"><?php echo formaterMontant($ecolage['montant_paye']); ?></span>
                        <span class="text-sm font-medium text-info-color"><?php echo $pourcentage_paiement; ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill bg-info-color" style="width: <?php echo $pourcentage_paiement; ?>%"></div>
                    </div>
                </div>
                
                <!-- Carte Présence -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='presence_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Présence</h3>
                        <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Taux de présence</p>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-2xl font-bold"><?php echo $presence['present']; ?>/<?php echo $presence['total_cours']; ?></span>
                        <span class="text-sm font-medium text-purple-600 dark:text-purple-400"><?php echo $presence['taux_presence']; ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill bg-purple-600 dark:bg-purple-400" style="width: <?php echo $presence['taux_presence']; ?>%"></div>
                    </div>
                </div>
                
                <!-- Carte Moyenne -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='notes_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Moyenne</h3>
                        <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Moyenne générale</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo $notes['moyenne_generale']; ?>/20</span>
                        <span class="badge <?php echo $notes['moyenne_generale'] >= 14 ? 'badge-success' : ($notes['moyenne_generale'] >= 12 ? 'badge-info' : 'badge-warning'); ?>"><?php echo $notes['mention']; ?></span>
                    </div>
                </div>
                
                <!-- Carte Prochaine échéance -->
                <div class="dashboard-card p-6 clickable-card" onclick="window.location.href='ecolage_details.php'">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Prochaine échéance</h3>
                        <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-danger-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-lin  viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-secondary mb-2">Paiement écolage</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold"><?php echo formaterMontant($ecolage['reste_a_payer']); ?></span>
                        <span class="badge badge-danger"><?php echo $ecolage['prochaine_echeance']; ?></span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Emploi du temps de la semaine -->
                <div class="dashboard-card p-6 lg:col-span-2">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Emploi du temps de la semaine</h3>
                        <a href="#emploi-du-temps" class="text-ge-orange hover:text-ge-orange-dark text-sm font-medium nav-link flex items-center" data-target="emploi-du-temps-section">
                            Voir tout
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <?php 
                        // Afficher seulement les 3 premiers jours pour le résumé
                        $jours_semaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
                        $jours_affiches = array_slice($jours_semaine, 0, 3);
                        
                        foreach ($jours_affiches as $jour): 
                            if (isset($emploi_du_temps[$jour]) && !empty($emploi_du_temps[$jour])):
                        ?>
                        <div class="timetable-day">
                            <div class="timetable-header flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?php echo ucfirst($jour); ?>
                            </div>
                            <?php foreach ($emploi_du_temps[$jour] as $index => $cours): ?>
                            <div class="timetable-slot <?php echo $index === count($emploi_du_temps[$jour]) - 1 ? 'rounded-b-lg' : ''; ?>">
                                <div class="flex justify-between">
                                    <span class="font-medium"><?php echo $cours['matiere']; ?></span>
                                    <span class="text-sm text-secondary"><?php echo $cours['heure']; ?></span>
                                </div>
                                <div class="text-sm text-secondary mt-1 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <?php echo $cours['salle']; ?> 
                                    <span class="mx-2">•</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <?php echo $cours['enseignant']; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                </div>
                
                <!-- Notifications récentes -->
                <div class="dashboard-card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">Notifications récentes</h3>
                        <a href="#notifications" class="text-ge-orange hover:text-ge-orange-dark text-sm font-medium nav-link flex items-center" data-target="notifications-section">
                            Voir tout
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        <?php 
                        // Afficher seulement les 3 premières notifications pour le résumé
                        $notifications_recentes = array_slice($notifications, 0, 3);
                        
                        foreach ($notifications_recentes as $notification): 
                        ?>
                        <div class="p-4 rounded-lg <?php echo $notification['lue'] ? 'bg-tertiary' : 'bg-ge-orange bg-opacity-10 dark:bg-ge-orange dark:bg-opacity-20 border-l-4 border-ge-orange'; ?>">
                            <div class="flex justify-between">
                                <h4 class="font-medium"><?php echo $notification['titre']; ?></h4>
                                <span class="text-xs text-tertiary"><?php echo $notification['date']; ?></span>
                            </div>
                            <p class="text-sm text-secondary mt-2"><?php echo $notification['contenu']; ?></p>
                            <?php if (!$notification['lue']): ?>
                            <button class="mt-2 text-sm text-ge-orange hover:text-ge-orange-dark font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Marquer comme lu
                            </button>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ecolage Section -->
        <section id="ecolage-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6 mb-6">
                <h2 class="text-xl font-bold mb-6">Paiement de l'écolage</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 dark:bg-blue-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Montant total</p>
                        <p class="text-xl font-bold"><?php echo formaterMontant($ecolage['montant_total']); ?></p>
                    </div>
                    
                    <div class="bg-green-50 dark:bg-green-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Montant payé</p>
                        <p class="text-xl font-bold text-success-color"><?php echo formaterMontant($ecolage['montant_paye']); ?></p>
                    </div>
                    
                    <div class="bg-red-50 dark:bg-red-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Reste à payer</p>
                        <p class="text-xl font-bold text-danger-color"><?php echo formaterMontant($ecolage['reste_a_payer']); ?></p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Progression des paiements</h3>
                    <div class="progress-bar h-4">
                        <div class="progress-bar-fill bg-info-color" style="width: <?php echo $pourcentage_paiement; ?>%"></div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-sm text-secondary"><?php echo $pourcentage_paiement; ?>% payé</span>
                        <span class="text-sm text-secondary flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-danger-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Prochaine échéance: <?php echo $ecolage['prochaine_echeance']; ?>
                        </span>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Historique des paiements</h3>
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Date</th>
                                    <th>Montant</th>
                                    <th>Référence</th>
                                    <th class="rounded-tr-lg">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ecolage['historique'] as $paiement): ?>
                                <tr>
                                    <td><?php echo $paiement['date']; ?></td>
                                    <td><?php echo formaterMontant($paiement['montant']); ?></td>
                                    <td><?php echo $paiement['reference'] ?: '-'; ?></td>
                                    <td>
                                        <span class="badge <?php echo $paiement['statut'] === 'Payé' ? 'badge-success' : 'badge-warning'; ?>">
                                            <?php echo $paiement['statut']; ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-card p-6">
                <h3 class="text-lg font-semibold mb-6">Effectuer un paiement</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-secondary mb-6">Pour effectuer un paiement, veuillez utiliser l'une des méthodes suivantes :</p>
                        
                        <div class="space-y-6">
                            <div class="p-5 border border-theme rounded-lg hover:bg-tertiary transition-colors">
                                <div class="flex items-center mb-3">
                                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-info-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-medium">Paiement en ligne</h4>
                                </div>
                                <p class="text-sm text-secondary mb-4">Vous pouvez effectuer un paiement en ligne via notre plateforme sécurisée. Cliquez sur le bouton ci-dessous pour procéder.</p>
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    Payer en ligne
                                </button>
                            </div>
                            
                            <div class="p-5 border border-theme rounded-lg hover:bg-tertiary transition-colors">
                                <div class="flex items-center mb-3">
                                    <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-full mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-medium">Mobile Money</h4>
                                </div>
                                <p class="text-sm text-secondary mb-3">Vous pouvez effectuer un paiement via Mobile Money en utilisant les informations suivantes :</p>
                                <ul class="space-y-2 text-sm text-secondary">
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Numéro : <span class="font-medium ml-1">034 07 082 23</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Nom : <span class="font-medium ml-1">GE-IT Finance</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Référence : <span class="font-medium ml-1"><?php echo $etudiant['matricule']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="p-5 border border-theme rounded-lg hover:bg-tertiary transition-colors">
                                <div class="flex items-center mb-3">
                                    <div class="bg-yellow-100 dark:bg-yellow-900/30 p-2 rounded-full mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <h4 class="font-medium">Paiement au bureau</h4>
                                </div>
                                <p class="text-sm text-secondary mb-3">Vous pouvez également effectuer un paiement directement au bureau de l'administration pendant les heures d'ouverture :</p>
                                <ul class="space-y-2 text-sm text-secondary">
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Lundi au vendredi : 8h00 - 16h00
                                    </li>
                                    <li class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Samedi : 8h00 - 12h00
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bg-tertiary p-6 rounded-lg">
                            <h4 class="font-medium mb-6 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Informations de paiement
                            </h4>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="montant" class="block text-sm font-medium mb-2">Montant à payer</label>
                                    <input type="text" id="montant" name="montant" value="<?php echo formaterMontant($ecolage['reste_a_payer']); ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent" readonly>
                                </div>
                                
                                <div>
                                    <label for="methode" class="block text-sm font-medium mb-2">Méthode de paiement</label>
                                    <select id="methode" name="methode" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                                        <option value="">Sélectionnez une méthode</option>
                                        <option value="carte">Carte bancaire</option>
                                        <option value="mobile">Mobile Money</option>
                                        <option value="bureau">Au bureau</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="reference" class="block text-sm font-medium mb-2">Référence de paiement</label>
                                    <input type="text" id="reference" name="reference" placeholder="Référence de votre paiement" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                                    <p class="text-xs text-tertiary mt-2">Pour les paiements Mobile Money ou au bureau, veuillez indiquer la référence de votre paiement.</p>
                                </div>
                                
                                <button class="btn btn-primary w-full py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Confirmer le paiement
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Présence Section -->
        <section id="presence-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6 mb-6">
                <h2 class="text-xl font-bold mb-6">Gestion de présence</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-purple-50 dark:bg-purple-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Total des cours</p>
                        <p class="text-xl font-bold"><?php echo $presence['total_cours']; ?> séances</p>
                    </div>
                    
                    <div class="bg-green-50 dark:bg-green-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Présences</p>
                        <p class="text-xl font-bold text-success-color"><?php echo $presence['present']; ?> séances</p>
                    </div>
                    
                    <div class="bg-red-50 dark:bg-red-900/30 p-5 rounded-lg">
                        <p class="text-sm text-secondary mb-1">Absences</p>
                        <p class="text-xl font-bold text-danger-color"><?php echo $presence['absent']; ?> séances</p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Taux de présence</h3>
                    <div class="progress-bar h-4">
                        <div class="progress-bar-fill bg-purple-600 dark:bg-purple-400" style="width: <?php echo $presence['taux_presence']; ?>%"></div>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-sm text-secondary"><?php echo $presence['taux_presence']; ?>% de présence</span>
                        <span class="text-sm text-secondary flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-danger-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Dernière absence: <?php echo $presence['derniere_absence']; ?>
                        </span>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Historique des absences</h3>
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Date</th>
                                    <th>Cours</th>
                                    <th>Statut</th>
                                    <th class="rounded-tr-lg">Justifié</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($presence['historique'] as $absence): ?>
                                <tr>
                                    <td><?php echo $absence['date']; ?></td>
                                    <td><?php echo $absence['cours']; ?></td>
                                    <td>
                                        <span class="badge badge-danger">
                                            <?php echo $absence['statut']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo $absence['justifie'] === 'Oui' ? 'badge-success' : 'badge-warning'; ?>">
                                            <?php echo $absence['justifie']; ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-card p-6">
                <h3 class="text-lg font-semibold mb-6">Justifier une absence</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <p class="text-secondary mb-6">Si vous avez été absent à un cours et que vous souhaitez justifier cette absence, veuillez remplir le formulaire ci-contre et joindre un justificatif.</p>
                        
                        <div class="p-5 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning-color mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9   stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-medium mb-2">Note importante</p>
                                    <p class="text-sm text-secondary">Les justificatifs d'absence doivent être fournis dans un délai de 7 jours suivant l'absence. Seuls les justificatifs médicaux, administratifs ou cas de force majeure seront acceptés.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 p-5 border border-theme rounded-lg">
                            <h4 class="font-medium mb-4">Types de justificatifs acceptés :</h4>
                            <ul class="space-y-2 text-sm text-secondary">
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Certificat médical
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Convocation administrative
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Décès d'un proche (acte de décès)
                                </li>
                                <li class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Cas de force majeure (avec justificatif)
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bg-tertiary p-6 rounded-lg">
                            <h4 class="font-medium mb-6 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Formulaire de justification
                            </h4>
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="date_absence" class="block text-sm font-medium mb-2">Date de l'absence</label>
                                    <input type="date" id="date_absence" name="date_absence" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                                </div>
                                
                                <div>
                                    <label for="cours_absence" class="block text-sm font-medium mb-2">Cours concerné</label>
                                    <select id="cours_absence" name="cours_absence" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                                        <option value="">Sélectionnez un cours</option>
                                        <?php foreach ($cours as $c): ?>
                                        <option value="<?php echo $c['titre']; ?>"><?php echo $c['titre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="motif_absence" class="block text-sm font-medium mb-2">Motif de l'absence</label>
                                    <select id="motif_absence" name="motif_absence" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                                        <option value="">Sélectionnez un motif</option>
                                        <option value="medical">Raison médicale</option>
                                        <option value="administratif">Convocation administrative</option>
                                        <option value="deces">Décès d'un proche</option>
                                        <option value="force_majeure">Cas de force majeure</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="description_absence" class="block text-sm font-medium mb-2">Description</label>
                                    <textarea id="description_absence" name="description_absence" rows="3" placeholder="Veuillez décrire brièvement la raison de votre absence" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent"></textarea>
                                </div>
                                
                                <div>
                                    <label for="justificatif" class="block text-sm font-medium mb-2">Justificatif (PDF, JPG, PNG)</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label for="justificatif" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-theme rounded-lg cursor-pointer bg-primary hover:bg-tertiary">
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-ge-orange mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="mb-2 text-sm text-secondary"><span class="font-semibold">Cliquez pour télécharger</span> ou glissez-déposez</p>
                                                <p class="text-xs text-tertiary">PDF, JPG ou PNG (Max. 5 Mo)</p>
                                            </div>
                                            <input id="justificatif" type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                                        </label>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary w-full py-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Soumettre la justification
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Notes Section -->
        <section id="notes-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-xl font-bold mb-4 md:mb-0">Mes notes</h2>
                    
                    <div class="flex items-center space-x-2 bg-tertiary px-4 py-2 rounded-full">
                        <span class="text-sm text-secondary">Moyenne générale :</span>
                        <span class="text-lg font-bold"><?php echo $notes['moyenne_generale']; ?>/20</span>
                        <span class="ml-2 badge <?php echo $notes['moyenne_generale'] >= 14 ? 'badge-success' : ($notes['moyenne_generale'] >= 12 ? 'badge-info' : 'badge-warning'); ?>"><?php echo $notes['mention']; ?></span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <div class="flex border-b border-theme">
                        <button class="tab-button active" data-tab="semestre1">Semestre 1</button>
                        <button class="tab-button" data-tab="semestre2">Semestre 2</button>
                    </div>
                </div>
                
                <div id="semestre1" class="tab-content active">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matière</th>
                                    <th>Crédits</th>
                                    <th>Note</th>
                                    <th class="rounded-tr-lg">Appréciation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notes['semestre1'] as $matiere): ?>
                                <tr>
                                    <td><?php echo $matiere['matiere']; ?></td>
                                    <td><?php echo $matiere['credit']; ?></td>
                                    <td class="font-medium <?php echo $matiere['note'] >= 14 ? 'text-success-color' : ($matiere['note'] >= 10 ? 'text-info-color' : 'text-danger-color'); ?>"><?php echo $matiere['note']; ?>/20</td>
                                    <td><?php echo $matiere['appreciation']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div id="semestre2" class="tab-content">
                    <div class="overflow-x-auto rounded-lg">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="rounded-tl-lg">Matière</th>
                                    <th>Crédits</th>
                                    <th>Note</th>
                                    <th class="rounded-tr-lg">Appréciation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($notes['semestre2'] as $matiere): ?>
                                <tr>
                                    <td><?php echo $matiere['matiere']; ?></td>
                                    <td><?php echo $matiere['credit']; ?></td>
                                    <td class="font-medium <?php echo $matiere['note'] >= 14 ? 'text-success-color' : ($matiere['note'] >= 10 ? 'text-info-color' : 'text-danger-color'); ?>"><?php echo $matiere['note']; ?>/20</td>
                                    <td><?php echo $matiere['appreciation']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-card p-6">
                <h3 class="text-lg font-semibold mb-6">Récapitulatif des crédits</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-tertiary p-5 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-success-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-secondary">Crédits validés</p>
                        </div>
                        <p class="text-xl font-bold text-success-color"><?php echo $notes['credits_valides']; ?></p>
                    </div>
                    
                    <div class="bg-tertiary p-5 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-info-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-sm text-secondary">Crédits totaux</p>
                        </div>
                        <p class="text-xl font-bold"><?php echo $notes['credits_total']; ?></p>
                    </div>
                    
                    <div class="bg-tertiary p-5 rounded-lg">
                        <div class="flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-secondary">Progression</p>
                        </div>
                        <div class="flex items-center">
                            <div class="w-full bg-tertiary border border-theme rounded-full h-2.5 mr-2">
                                <div class="bg-success-color h-2.5 rounded-full" style="width: <?php echo $pourcentage_credits; ?>%"></div>
                            </div>
                            <span class="text-sm font-medium"><?php echo $pourcentage_credits; ?>%</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Cours Section -->
        <section id="cours-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-6">Mes cours sur Google Drive</h2>
                
                <div class="mb-6">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un cours..." class="w-full px-4 py-3 pl-12 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                        <div class="absolute left-4 top-3.5 text-tertiary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($cours as $module): ?>
                    <div class="bg-tertiary rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-5 border-b border-theme flex items-center">
                            <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-info-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="font-medium"><?php echo $module['titre']; ?></h3>
                        </div>
                        <div class="p-5">
                            <p class="text-sm text-secondary mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">Enseignant :</span> <?php echo $module['enseignant']; ?>
                            </p>
                            <p class="text-sm text-secondary mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">Dernière mise à jour :</span> <?php echo $module['date_maj']; ?>
                            </p>
                            <a href="<?php echo $module['lien']; ?>" target="_blank" class="btn btn-primary w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Accéder aux cours
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Emploi du temps Section -->
        <section id="emploi-du-temps-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-6">Emploi du temps</h2>
                
                <div class="space-y-6">
                    <?php 
                    foreach ($jours_semaine as $jour): 
                        if (isset($emploi_du_temps[$jour]) && !empty($emploi_du_temps[$jour])):
                    ?>
                    <div class="timetable-day">
                        <div class="timetable-header flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <?php echo ucfirst($jour); ?>
                        </div>
                        <?php foreach ($emploi_du_temps[$jour] as $index => $cours): ?>
                        <div class="timetable-slot <?php echo $index === count($emploi_du_temps[$jour]) - 1 ? 'rounded-b-lg' : ''; ?>">
                            <div class="flex justify-between">
                                <span class="font-medium"><?php echo $cours['matiere']; ?></span>
                                <span class="text-sm text-secondary"><?php echo $cours['heure']; ?></span>
                            </div>
                            <div class="text-sm text-secondary mt-1 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <?php echo $cours['salle']; ?> 
                                <span class="mx-2">•</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-ge-orange" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <?php echo $cours['enseignant']; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
                
                <div class="mt-8 p-5 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-warning-color mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="font-medium mb-2">Note importante</p>
                            <p class="text-sm text-secondary">L'emploi du temps peut être sujet à des modifications. Veuillez consulter régulièrement cette page pour vous tenir informé des éventuels changements. Les notifications vous seront également envoyées en cas de modification importante.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Notifications Section -->
        <section id="notifications-section" class="content-section hidden space-y-8">
            <div class="dashboard-card p-6">
                <h2 class="text-xl font-bold mb-6">Notifications</h2>
                
                <div class="space-y-4">
                    <?php foreach ($notifications as $notification): ?>
                    <div class="p-5 rounded-lg <?php echo $notification['lue'] ? 'bg-tertiary' : 'bg-ge-orange bg-opacity-10 dark:bg-ge-orange dark:bg-opacity-20 border-l-4 border-ge-orange'; ?>">
                        <div class="flex justify-between">
                            <h4 class="font-medium flex items-center">
                                <?php if (!$notification['lue']): ?>
                                <span class="w-2 h-2 bg-ge-orange rounded-full mr-2"></span>
                                <?php endif; ?>
                                <?php echo $notification['titre']; ?>
                            </h4>
                            <span class="text-xs text-tertiary"><?php echo $notification['date']; ?></span>
                        </div>
                        <p class="text-sm text-secondary mt-3"><?php echo $notification['contenu']; ?></p>
                        <?php if (!$notification['lue']): ?>
                        <button class="mt-3 text-sm text-ge-orange hover:text-ge-orange-dark font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Marquer comme lu
                        </button>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
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
                                <input type="text" id="nom" name="nom" value="<?php echo $etudiant['nom']; ?>" class="w-full px-4 py-3 border border  id="nom" name="nom" value="<?php echo $etudiant['nom']; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="prenom" class="block text-sm font-medium mb-2">Prénom</label>
                                <input type="text" id="prenom" name="prenom" value="<?php echo $etudiant['prenom']; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $etudiant['email']; ?>" class="w-full px-4 py-3 border border-theme rounded-lg focus:outline-none focus:ring-2 focus:ring-ge-orange focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="matricule" class="block text-sm font-medium mb-2">Matricule</label>
                                <input type="text" id="matricule" name="matricule" value="<?php echo $etudiant['matricule']; ?>" class="w-full px-4 py-3 border border-theme rounded-lg bg-tertiary" readonly>
                            </div>
                            
                            <div>
                                <label for="niveau" class="block text-sm font-medium mb-2">Niveau</label>
                                <input type="text" id="niveau" name="niveau" value="<?php echo $etudiant['niveau']; ?>" class="w-full px-4 py-3 border border-theme rounded-lg bg-tertiary" readonly>
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
            
            // Initialiser les notifications
            document.querySelectorAll('.mt-2.text-sm.text-ge-orange, .mt-3.text-sm.text-ge-orange').forEach(button => {
                button.addEventListener('click', function() {
                    const notification = this.closest('.p-4, .p-5');
                    if (notification) {
                        notification.classList.remove('bg-ge-orange', 'bg-opacity-10', 'dark:bg-ge-orange', 'dark:bg-opacity-20', 'border-l-4', 'border-ge-orange');
                        notification.classList.add('bg-tertiary');
                        
                        const indicator = notification.querySelector('.w-2.h-2.bg-ge-orange');
                        if (indicator) indicator.remove();
                        
                        this.style.display = 'none';
                        
                        // Mettre à jour le compteur
                        const unreadCount = document.querySelectorAll('.border-l-4.border-ge-orange').length;
                        document.querySelectorAll('.notification-badge').forEach(badge => {
                            if (unreadCount > 0) {
                                badge.textContent = unreadCount;
                                badge.style.display = 'flex';
                            } else {
                                badge.style.display = 'none';
                            }
                        });
                    }
                });
            });
            
            // Initialiser les icônes du thème
            const isDarkMode = document.documentElement.classList.contains('dark-theme');
            updateThemeIcons(isDarkMode);
        });
    </script>
</body>
</html>
