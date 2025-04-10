/**
 * Theme Switcher - Gère le basculement entre les thèmes clair et sombre
 */

// Fonction pour appliquer le thème avec les bons contrastes
function applyTheme(theme) {
    console.log("Applying theme:", theme)
    const html = document.documentElement
    const body = document.body
  
    // Supprimer les classes de thème existantes
    html.classList.remove("light-theme", "dark-theme")
    body.classList.remove("light-theme", "dark-theme")
  
    // Ajouter la nouvelle classe de thème
    html.classList.add(theme + "-theme")
    body.classList.add(theme + "-theme")
  
    // Mettre à jour l'icône du bouton de thème
    const themeIcon = document.getElementById("theme-icon")
    if (themeIcon) {
      if (theme === "dark") {
        themeIcon.innerHTML = `
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707-.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
              `
      } else {
        themeIcon.innerHTML = `
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                  </svg>
              `
      }
    }
  
    // Enregistrer la préférence dans localStorage
    localStorage.setItem("theme", theme)
  }
  
  // Vérifier le thème enregistré ou utiliser la préférence du système
  document.addEventListener("DOMContentLoaded", () => {
    const savedTheme = localStorage.getItem("theme")
    const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches
    const initialTheme = savedTheme || (prefersDarkMode ? "dark" : "light")
  
    applyTheme(initialTheme)
  
    // Ajouter un écouteur d'événement pour le bouton de changement de thème
    const themeToggle = document.getElementById("theme-toggle")
    if (themeToggle) {
      themeToggle.addEventListener("click", () => {
        const currentTheme = document.documentElement.classList.contains("dark-theme") ? "dark" : "light"
        const newTheme = currentTheme === "dark" ? "light" : "dark"
        applyTheme(newTheme)
  
        // Mettre à jour les calendriers pour qu'ils s'adaptent au thème
        updateCalendars()
      })
    }
  })
  
  // Fonction pour mettre à jour les calendriers
  function updateCalendars() {
    // Cette fonction sera appelée après un changement de thème
    // pour redimensionner tous les calendriers FullCalendar
    const calendarIds = ["L1", "L2", "L3", "M1", "M2"]
    calendarIds.forEach((id) => {
      const calendarVar = window["calendar" + id]
      if (typeof calendarVar !== "undefined") {
        calendarVar.updateSize()
      }
    })
  }
  