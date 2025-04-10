/**
 * Dashboard.js - Script principal pour le tableau de bord étudiant
 * Ce script gère les fonctionnalités interactives du tableau de bord
 */

// Exécuter le code une fois que le DOM est complètement chargé
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM chargé - Initialisation du dashboard")
  
    // Gestion du thème sombre/clair
    initThemeToggle()
  
    // Gestion de la sidebar mobile
    initMobileSidebar()
  
    // Gestion de la sidebar desktop
    initDesktopSidebar()
  
    // Gestion des onglets
    initTabs()
  
    // Gestion de la navigation
    initNavigation()
  
    // Initialisation des notifications
    initNotifications()
  })
  
  /**
   * Initialise le basculement du thème clair/sombre
   */
  function initThemeToggle() {
    console.log("Initialisation du toggle de thème")
  
    const themeToggle = document.getElementById("theme-toggle")
    const themeToggleMobile = document.getElementById("theme-toggle-mobile")
    const themeToggleSettings = document.getElementById("theme-toggle-settings")
    const html = document.documentElement
    const body = document.body
  
    // Fonction pour changer le thème
    function toggleTheme() {
      console.log("Toggle du thème")
  
      // Déterminer le nouveau thème (inverse du thème actuel)
      const currentTheme = html.classList.contains("dark-theme") ? "dark" : "light"
      const newTheme = currentTheme === "dark" ? "light" : "dark"
  
      // Supprimer les classes de thème existantes
      html.classList.remove("light-theme", "dark-theme")
      body.classList.remove("light-theme", "dark-theme")
  
      // Ajouter les nouvelles classes de thème
      html.classList.add(newTheme + "-theme")
      body.classList.add(newTheme + "-theme")
  
      // Mettre à jour les icônes
      updateThemeIcons(newTheme === "dark")
  
      // Enregistrer la préférence de thème
      localStorage.setItem("theme", newTheme)
      document.cookie = `theme=${newTheme}; path=/; max-age=31536000` // 1 an
  
      console.log("Thème changé pour:", newTheme)
    }
  
    // Mettre à jour les icônes du thème
    function updateThemeIcons(isDark) {
      const themeIcon = document.getElementById("theme-icon")
      const themeIconMobile = document.getElementById("theme-icon-mobile")
  
      const sunIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
      `
  
      const moonIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
      `
  
      if (themeIcon) {
        themeIcon.innerHTML = isDark ? sunIcon : moonIcon
      }
  
      if (themeIconMobile) {
        themeIconMobile.innerHTML = isDark ? sunIcon : moonIcon
      }
  
      if (themeToggleSettings) {
        themeToggleSettings.checked = isDark
      }
    }
  
    // Ajouter des écouteurs d'événements pour les boutons de changement de thème
    if (themeToggle) {
      themeToggle.addEventListener("click", toggleTheme)
      console.log("Écouteur d'événement ajouté au bouton de thème desktop")
    } else {
      console.warn("Bouton de thème desktop non trouvé")
    }
  
    if (themeToggleMobile) {
      themeToggleMobile.addEventListener("click", toggleTheme)
      console.log("Écouteur d'événement ajouté au bouton de thème mobile")
    } else {
      console.warn("Bouton de thème mobile non trouvé")
    }
  
    if (themeToggleSettings) {
      themeToggleSettings.addEventListener("change", toggleTheme)
      console.log("Écouteur d'événement ajouté au toggle de thème dans les paramètres")
    }
  
    // Initialiser les icônes en fonction du thème actuel
    const isDarkMode = html.classList.contains("dark-theme")
    updateThemeIcons(isDarkMode)
  }
  
  /**
   * Initialise la sidebar mobile
   */
  function initMobileSidebar() {
    console.log("Initialisation de la sidebar mobile")
  
    const sidebar = document.getElementById("sidebar")
    const mobileMenuBtn = document.getElementById("mobile-menu-button")
    const closeSidebarBtn = document.getElementById("close-sidebar")
  
    // Fonction pour ouvrir/fermer la sidebar sur mobile
    function toggleMobileSidebar() {
      console.log("Toggle de la sidebar mobile")
      if (sidebar) {
        sidebar.classList.toggle("sidebar-open")
        console.log("Sidebar mobile toggled:", sidebar.classList.contains("sidebar-open"))
      }
    }
  
    // Ajouter des écouteurs d'événements
    if (mobileMenuBtn) {
      mobileMenuBtn.addEventListener("click", toggleMobileSidebar)
      console.log("Écouteur d'événement ajouté au bouton de menu mobile")
    } else {
      console.warn("Bouton de menu mobile non trouvé")
    }
  
    if (closeSidebarBtn) {
      closeSidebarBtn.addEventListener("click", toggleMobileSidebar)
      console.log("Écouteur d'événement ajouté au bouton de fermeture de la sidebar")
    } else {
      console.warn("Bouton de fermeture de la sidebar non trouvé")
    }
  }
  
  /**
   * Initialise la sidebar desktop
   */
  function initDesktopSidebar() {
    console.log("Initialisation de la sidebar desktop")
  
    const sidebar = document.getElementById("sidebar")
    const mainContent = document.getElementById("main-content")
    const toggleSidebarBtn = document.getElementById("toggle-sidebar")
  
    // Fonction pour basculer la sidebar sur desktop
    function toggleSidebar() {
      console.log("Toggle de la sidebar desktop")
      if (sidebar && mainContent) {
        sidebar.classList.toggle("sidebar-collapsed")
        mainContent.classList.toggle("main-content-expanded")
        console.log("Sidebar desktop toggled:", sidebar.classList.contains("sidebar-collapsed"))
      }
    }
  
    // Ajouter l'écouteur d'événement
    if (toggleSidebarBtn) {
      toggleSidebarBtn.addEventListener("click", toggleSidebar)
      console.log("Écouteur d'événement ajouté au bouton de toggle de la sidebar desktop")
    } else {
      console.warn("Bouton de toggle de la sidebar desktop non trouvé")
    }
  }
  
  /**
   * Initialise les onglets dans les différentes sections
   */
  function initTabs() {
    console.log("Initialisation des onglets")
  
    const tabButtons = document.querySelectorAll(".tab-button")
    const tabContents = document.querySelectorAll(".tab-content")
  
    if (tabButtons.length === 0) {
      console.warn("Aucun bouton d'onglet trouvé")
      return
    }
  
    tabButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const tabId = button.getAttribute("data-tab")
        console.log("Onglet cliqué:", tabId)
  
        // Retirer la classe active de tous les boutons et contenus
        tabButtons.forEach((btn) => btn.classList.remove("active"))
        tabContents.forEach((content) => content.classList.remove("active"))
  
        // Ajouter la classe active au bouton et contenu correspondant
        button.classList.add("active")
        const tabContent = document.getElementById(tabId)
        if (tabContent) {
          tabContent.classList.add("active")
        } else {
          console.warn("Contenu d'onglet non trouvé:", tabId)
        }
      })
    })
  
    console.log("Écouteurs d'événements ajoutés à", tabButtons.length, "boutons d'onglets")
  }
  
  /**
   * Initialise la navigation entre les différentes sections
   */
  function initNavigation() {
    console.log("Initialisation de la navigation")
  
    const navLinks = document.querySelectorAll(".nav-link")
    const contentSections = document.querySelectorAll(".content-section")
    const pageTitle = document.querySelector("h1")
    const sidebar = document.getElementById("sidebar")
  
    if (navLinks.length === 0) {
      console.warn("Aucun lien de navigation trouvé")
      return
    }
  
    navLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault()
  
        const targetId = link.getAttribute("data-target")
        console.log("Navigation vers:", targetId)
  
        // Retirer la classe active de tous les liens et sections
        navLinks.forEach((navLink) => navLink.classList.remove("active"))
        contentSections.forEach((section) => section.classList.add("hidden"))
  
        // Ajouter la classe active au lien et section correspondant
        link.classList.add("active")
        const targetSection = document.getElementById(targetId)
        if (targetSection) {
          targetSection.classList.remove("hidden")
        } else {
          console.warn("Section cible non trouvée:", targetId)
        }
  
        // Mettre à jour le titre de la page
        if (pageTitle) {
          const linkText = link.querySelector(".sidebar-text")?.textContent || link.textContent
          pageTitle.textContent = linkText.trim()
        }
  
        // Fermer la sidebar sur mobile après la navigation
        if (window.innerWidth < 1024 && sidebar) {
          sidebar.classList.remove("sidebar-open")
        }
      })
    })
  
    // Initialiser la page avec la première section active
    if (navLinks.length > 0 && contentSections.length > 0) {
      navLinks[0].classList.add("active")
      contentSections[0].classList.remove("hidden")
      console.log("Section initiale activée")
    }
  
    console.log("Écouteurs d'événements ajoutés à", navLinks.length, "liens de navigation")
  }
  
  /**
   * Initialise les fonctionnalités liées aux notifications
   */
  function initNotifications() {
    console.log("Initialisation des notifications")
  
    const notificationButtons = document.querySelectorAll(".mt-3.text-sm.text-ge-orange")
  
    if (notificationButtons.length === 0) {
      console.log("Aucun bouton de notification trouvé")
      return
    }
  
    notificationButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const notificationItem = this.closest(".p-5")
        console.log("Notification marquée comme lue")
  
        // Changer l'apparence de la notification
        notificationItem.classList.remove(
          "bg-ge-orange",
          "bg-opacity-10",
          "dark:bg-ge-orange",
          "dark:bg-opacity-20",
          "border-l-4",
          "border-ge-orange",
        )
        notificationItem.classList.add("bg-tertiary")
  
        // Supprimer l'indicateur de non-lu
        const indicator = notificationItem.querySelector(".w-2.h-2.bg-ge-orange")
        if (indicator) indicator.remove()
  
        // Masquer le bouton
        this.style.display = "none"
  
        // Mettre à jour le compteur de notifications
        updateNotificationCount()
      })
    })
  
    console.log("Écouteurs d'événements ajoutés à", notificationButtons.length, "boutons de notification")
  
    function updateNotificationCount() {
      // Compter les notifications non lues
      const unreadCount = document.querySelectorAll(".border-l-4.border-ge-orange").length
      console.log("Nombre de notifications non lues:", unreadCount)
  
      // Mettre à jour les badges
      const badges = document.querySelectorAll(".notification-badge")
      badges.forEach((badge) => {
        if (unreadCount > 0) {
          badge.textContent = unreadCount
          badge.style.display = "flex"
        } else {
          badge.style.display = "none"
        }
      })
  
      // Mettre à jour le badge dans la sidebar
      const sidebarBadge = document.querySelector(
        ".ml-auto.bg-ge-orange.text-white.text-xs.font-bold.px-2.py-1.rounded-full",
      )
      if (sidebarBadge) {
        if (unreadCount > 0) {
          sidebarBadge.textContent = unreadCount
          sidebarBadge.style.display = "block"
        } else {
          sidebarBadge.style.display = "none"
        }
      }
    }
  }
  