/**
 * Dashboard Modern - JavaScript
 * Animations and interactive features
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Chart with modern styling
    initModernChart();

    // Period buttons handler
    initPeriodButtons();

    // Add entrance animations observer
    initScrollAnimations();

    // Counter animation for stat numbers
    initCounterAnimation();
});

/**
 * Initialize Chart.js with modern styling
 */
function initModernChart() {
    const ctx = document.getElementById('lineChart');
    if (!ctx) return;

    // Get dynamic data from backend or use defaults
    const chartConfig = window.chartConfig || {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        data: [0, 0, 0, 0, 0, 0]
    };

    // Gradient fill
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(14, 165, 233, 0.25)');
    gradient.addColorStop(0.5, 'rgba(14, 165, 233, 0.08)');
    gradient.addColorStop(1, 'rgba(14, 165, 233, 0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartConfig.labels,
            datasets: [{
                label: 'Jumlah Pasien',
                data: chartConfig.data,
                borderColor: '#0ea5e9',
                backgroundColor: gradient,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#0ea5e9',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBackgroundColor: '#0ea5e9',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#0c1a3a',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    titleFont: {
                        family: "'Plus Jakarta Sans', sans-serif",
                        size: 13,
                        weight: '600'
                    },
                    bodyFont: {
                        family: "'Plus Jakarta Sans', sans-serif",
                        size: 14,
                        weight: '700'
                    },
                    padding: 14,
                    cornerRadius: 12,
                    displayColors: false,
                    callbacks: {
                        title: function(context) {
                            return 'Bulan ' + context[0].label;
                        },
                        label: function(context) {
                            return context.parsed.y + ' Pasien';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12,
                            weight: '500'
                        }
                    }
                },
                y: {
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)',
                        drawBorder: false
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            family: "'Plus Jakarta Sans', sans-serif",
                            size: 12,
                            weight: '500'
                        },
                        padding: 10
                    },
                    beginAtZero: true
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            }
        }
    });
}

/**
 * Period button toggle handler
 */
function initPeriodButtons() {
    const periodBtns = document.querySelectorAll('.period-btn');

    periodBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            periodBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Add ripple effect
            const ripple = document.createElement('span');
            ripple.style.cssText = `
                position: absolute;
                background: rgba(255,255,255,0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        });
    });
}

/**
 * Scroll-triggered animations
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animatable elements
    document.querySelectorAll('.stat-card, .chart-card, .activity-card, .welcome-banner').forEach(el => {
        observer.observe(el);
    });
}

/**
 * Counter animation for statistics
 */
function initCounterAnimation() {
    const counters = document.querySelectorAll('.stat-number');

    counters.forEach(counter => {
        const target = parseInt(counter.innerText.replace(/[^0-9]/g, ''));
        const suffix = counter.innerText.replace(/[0-9]/g, '');

        if (isNaN(target)) return;

        let current = 0;
        const increment = target / 50;
        const duration = 1500;
        const stepTime = duration / 50;

        counter.innerText = '0' + suffix;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.innerText = target + suffix;
                clearInterval(timer);
            } else {
                counter.innerText = Math.floor(current) + suffix;
            }
        }, stepTime);
    });
}

// Add ripple keyframes
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
