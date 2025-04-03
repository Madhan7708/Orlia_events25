// Add smooth scrolling for all anchor links and buttons
document.querySelectorAll('a[href^="#"], .hero-btn').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get the target element
        const targetId = this.getAttribute('href')?.substring(1) || 
                        this.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu if exists
            const mobileMenu = document.querySelector('.mobile-menu');
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
            }
        }
    });
});

// Handle navigation for mobile
document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav-links a");

  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      // Close mobile menu if it exists
      const mobileMenu = document.querySelector(".mobile-menu");
      if (mobileMenu && mobileMenu.classList.contains("active")) {
        mobileMenu.classList.remove("active");
      }
    });
  });
});

function updateCountdown() {
    try {
        const targetDate = new Date('April 3, 2025 00:00:00').getTime();
        
        // Update every second
        const timer = setInterval(() => {
            try {
                const now = new Date().getTime();
                const distance = targetDate - now;

                // Calculate time units
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update DOM elements with leading zeros
                document.getElementById('days').innerText = days.toString().padStart(2, '0');
                document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
                document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');

                // Check if countdown is over
                if (distance < 0) {
                    clearInterval(timer);
                    document.getElementById('days').innerText = '00';
                    document.getElementById('hours').innerText = '00';
                    document.getElementById('minutes').innerText = '00';
                    document.getElementById('seconds').innerText = '00';
                }
            } catch (error) {
                console.error('Error updating countdown:', error);
            }
        }, 1000);

        // Initial update
        updateCountdownDisplay();
    } catch (error) {
        console.error('Error initializing countdown:', error);
        // Fallback display
        setFallbackCountdown();
    }
}

function updateCountdownDisplay() {
    const now = new Date().getTime();
    const targetDate = new Date('April 3, 2025 00:00:00').getTime();
    const distance = targetDate - now;

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById('days').innerText = days.toString().padStart(2, '0');
    document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
    document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
}

function setFallbackCountdown() {
    const elements = ['days', 'hours', 'minutes', 'seconds'];
    elements.forEach(id => {
        const element = document.getElementById(id);
        if (element) element.innerText = '00';
    });
}

// Initialize countdown when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    updateCountdown();
    
    // Backup check for mobile Chrome
    setTimeout(() => {
        const daysElement = document.getElementById('days');
        if (daysElement && daysElement.innerText === '00') {
            updateCountdown();
        }
    }, 1000);
});

// Add visibility change handler for mobile browsers
document.addEventListener('visibilitychange', () => {
    if (!document.hidden) {
        updateCountdownDisplay();
    }
});
