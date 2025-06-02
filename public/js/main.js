// Add this to your main JS file
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.querySelector('.navbar__toggle');
    const menu = document.querySelector('.navbar__menu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('navbar__menu--open');
            toggle.classList.toggle('navbar__toggle--open');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.remove('navbar__menu--open');
                toggle.classList.remove('navbar__toggle--open');
            }
        });
    }
});