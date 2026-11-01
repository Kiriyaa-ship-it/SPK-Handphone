/**
 * Main JavaScript - SPK Handphone
 * Menangani interaktivitas dasar UI
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('SPK Handphone JS Loaded');

    // Handle Flash Message Close
    const closeButtons = document.querySelectorAll('.flash-close');
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const flashMessage = this.closest('.flash-message');
            if (flashMessage) {
                flashMessage.style.opacity = '0';
                flashMessage.style.transform = 'translateY(-20px)';
                flashMessage.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    flashMessage.remove();
                }, 300);
            }
        });
    });

    // Auto-hide Flash Messages after 5 seconds
    const flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(flash => {
        setTimeout(() => {
            if (document.body.contains(flash)) {
                flash.style.opacity = '0';
                flash.style.transform = 'translateY(-20px)';
                flash.style.transition = 'all 0.3s ease';
                
                setTimeout(() => {
                    flash.remove();
                }, 300);
            }
        }, 5000);
    });

    // Active Navigation Link Highlight
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath.endsWith(href) || (currentPath.endsWith('/') && href.endsWith('public/'))) {
            link.classList.add('active');
        }
    });
});
