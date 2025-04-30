// Main application logic
document.addEventListener('DOMContentLoaded', () => {
    // Initialize all components
    initializeMenu();
    initializeCart();
    initializeCheckout();
    
    // Show menu section by default
    showSection('menu-section');
  });
  
  // Show a specific section and hide others
  function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
      section.classList.remove('active-section');
    });
    
    // Show the requested section
    const sectionToShow = document.getElementById(sectionId);
    if (sectionToShow) {
      sectionToShow.classList.add('active-section');
    }
  }