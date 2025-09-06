// Main JavaScript for HirMatic Website

document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu functionality
    window.toggleMobileMenu = function() {
        const menu = document.getElementById('mobileMenu');
        if (menu) {
            menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
        }
    };
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('mobileMenu');
        const toggle = document.querySelector('.mobile-menu-toggle');
        
        if (menu && toggle && !menu.contains(event.target) && !toggle.contains(event.target)) {
            menu.style.display = 'none';
        }
    });
    
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#f44336';
                    isValid = false;
                } else {
                    field.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                }
            });
            
            // Email validation
            const emailFields = form.querySelectorAll('input[type="email"]');
            emailFields.forEach(field => {
                if (field.value && !isValidEmail(field.value)) {
                    field.style.borderColor = '#f44336';
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showNotification('Please fill in all required fields correctly.', 'error');
            }
        });
    });
    
    // File upload validation
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    this.value = '';
                    showNotification('File size must be less than 5MB.', 'error');
                    return;
                }
                showNotification('File uploaded successfully!', 'success');
            }
        });
    });
    
    // Stats counter animation
    const statsNumbers = document.querySelectorAll('.stat-number');
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                animateNumber(entry.target);
                entry.target.classList.add('animated');
            }
        });
    });
    
    statsNumbers.forEach(stat => {
        if (stat.textContent.match(/^\d+/)) {
            statsObserver.observe(stat);
        }
    });
});

// Helper functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function showNotification(message, type = 'info') {
    const existing = document.querySelectorAll('.notification');
    existing.forEach(n => n.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
        color: white;
        border-radius: 8px;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        max-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

function animateNumber(element) {
    const text = element.textContent;
    const number = parseInt(text.match(/\d+/)?.[0] || '0');
    const suffix = text.replace(/^\d+/, '');
    
    if (number > 0) {
        let current = 0;
        const increment = Math.ceil(number / 50);
        const timer = setInterval(() => {
            current += increment;
            if (current >= number) {
                current = number;
                clearInterval(timer);
            }
            element.textContent = current + suffix;
        }, 30);
    }
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
`;
document.head.appendChild(style);
