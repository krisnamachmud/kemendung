// JavaScript untuk Website Desa Jatirejo

document.addEventListener('DOMContentLoaded', function() {
    // Smooth Scroll untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active Navigation Link
    const currentLocation = location.pathname;
    const menuItems = document.querySelectorAll('.nav-link');
    
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentLocation) {
            item.classList.add('active');
        }
    });

    // Tooltip Initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Form Validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Back to Top Button
    const backToTopBtn = document.createElement('button');
    backToTopBtn.id = 'backToTop';
    backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTopBtn.style.cssText = `
        display: none;
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%);
        color: white;
        border: none;
        cursor: pointer;
        font-size: 20px;
        z-index: 999;
        box-shadow: 0 4px 20px rgba(26, 95, 74, 0.4);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    `;
    document.body.appendChild(backToTopBtn);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopBtn.style.display = 'block';
            backToTopBtn.style.opacity = '1';
        } else {
            backToTopBtn.style.opacity = '0';
            setTimeout(() => {
                if (window.pageYOffset <= 300) {
                    backToTopBtn.style.display = 'none';
                }
            }, 300);
        }
    });

    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    backToTopBtn.addEventListener('mouseenter', function() {
        this.style.background = 'linear-gradient(135deg, #2d7d63 0%, #1a5f4a 100%)';
        this.style.transform = 'scale(1.15) rotate(360deg)';
        this.style.boxShadow = '0 8px 30px rgba(26, 95, 74, 0.6)';
    });

    backToTopBtn.addEventListener('mouseleave', function() {
        this.style.background = 'linear-gradient(135deg, #1a5f4a 0%, #2d7d63 100%)';
        this.style.transform = 'scale(1) rotate(0deg)';
        this.style.boxShadow = '0 4px 20px rgba(26, 95, 74, 0.4)';
    });

    // Typing Effect for Hero (if exists)
    const heroTitle = document.querySelector('.hero h1');
    if (heroTitle && heroTitle.getAttribute('data-typing')) {
        const text = heroTitle.textContent;
        heroTitle.textContent = '';
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                heroTitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            }
        };
        typeWriter();
    }

    // Card Tilt Effect
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 20;
            const rotateY = (centerX - x) / 20;
            
            this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
        });
    });

    // Ripple Effect on Buttons
    const buttons = document.querySelectorAll('.btn-primary-custom, .btn-primary');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                background: rgba(255,255,255,0.5);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
                left: ${x}px;
                top: ${y}px;
                width: 100px;
                height: 100px;
                margin-left: -50px;
                margin-top: -50px;
            `;

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Add ripple animation style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Counter Animation
    const counters = document.querySelectorAll('[data-count]');
    if (counters.length > 0) {
        const observerOptions = {
            threshold: 0.5
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const count = parseInt(target.getAttribute('data-count'));
                    const element = target.querySelector('.count-number');
                    
                    animateCounter(element, 0, count, 2000);
                    observer.unobserve(target);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);
        });
    }

    function animateCounter(element, start, end, duration) {
        let current = start;
        const increment = end / (duration / 16);
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= end) {
                element.textContent = formatNumber(end);
                clearInterval(timer);
            } else {
                element.textContent = formatNumber(Math.floor(current));
            }
        }, 16);
    }

    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    // Image Lazy Loading
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        images.forEach(img => imageObserver.observe(img));
    }

    // Modal Events
    const modals = document.querySelectorAll('[class*="modal"]');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function() {
            document.body.style.overflow = 'hidden';
        });
        modal.addEventListener('hidden.bs.modal', function() {
            document.body.style.overflow = 'auto';
        });
    });
});

// Copy to Clipboard Function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showNotification('Link disalin ke clipboard!', 'success');
    }).catch(() => {
        showNotification('Gagal menyalin link', 'error');
    });
}

// Notification Function
function showNotification(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = `
        top: 100px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
    `;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

// Share to Social Media
function shareToSocialMedia(platform, title, url) {
    let shareUrl = '';
    
    switch(platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`;
            break;
        case 'whatsapp':
            shareUrl = `https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`;
            break;
        default:
            return;
    }
    
    window.open(shareUrl, '_blank', 'width=600,height=400');
}

// Print Page
function printPage() {
    window.print();
}

// Export to PDF (memerlukan library tambahan)
function exportToPDF() {
    showNotification('Fitur PDF sedang dalam pengembangan', 'info');
}

// Search Function
function searchContent(query) {
    if (query.length < 3) {
        showNotification('Minimal 3 karakter untuk pencarian', 'warning');
        return;
    }
    
    // Implementasi pencarian dapat disesuaikan
    console.log('Searching for:', query);
}

// Chart Update Function (untuk statistik)
function updateChart(chartId, newData) {
    if (window.myChart && window.myChart[chartId]) {
        window.myChart[chartId].data = newData;
        window.myChart[chartId].update();
    }
}
