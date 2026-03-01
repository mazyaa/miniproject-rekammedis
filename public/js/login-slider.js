/**
 * Login Page Text Slider
 * Handles the automatic text carousel animation
 */
document.addEventListener('DOMContentLoaded', function() {
    const textGroup = document.getElementById('textGroup');
    const subGroup = document.getElementById('subGroup');
    const bullets = document.querySelectorAll('#bullets span');

    if (!textGroup || !subGroup || !bullets.length) return;

    let current = 0;
    const total = bullets.length;

    function goTo(index) {
        bullets[current].classList.remove('active');
        current = index;
        bullets[current].classList.add('active');
        textGroup.style.transform = `translateY(-${current * 34}px)`;
        subGroup.style.transform = `translateY(-${current * 22}px)`;
    }

    // Click handler for bullets
    bullets.forEach((bullet, index) => {
        bullet.addEventListener('click', () => goTo(index));
    });

    // Auto-rotate every 3.5 seconds
    setInterval(() => goTo((current + 1) % total), 3500);
});
