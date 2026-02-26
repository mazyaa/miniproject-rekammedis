/**
 * Error Page Animations & Interactions
 * GSAP entrance animations, typing effect, live clock, cursor particles
 */
(function () {
    'use strict';

    /* ==========================================
     * GSAP Entrance Timeline
     * ========================================== */
    window.addEventListener('load', function () {
        // Hide loader
        gsap.to('#loader', {
            opacity: 0,
            duration: 0.5,
            ease: 'power2.inOut',
            onComplete: function () {
                var loader = document.getElementById('loader');
                if (loader) loader.style.display = 'none';
            }
        });

        var tl = gsap.timeline({ delay: 0.4 });

        // Error code entrance
        tl.fromTo('#errorCode',
            { y: 40, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.8, ease: 'back.out(1.7)' }
        )

        // Separator
        .to('#separator', {
            opacity: 1,
            scaleX: 1,
            duration: 0.5,
            ease: 'power2.out',
        }, '-=0.3')

        // Subtitle (triggers typing)
        .to('#subtitle', {
            opacity: 1,
            duration: 0.3,
        }, '-=0.2')
        .add(typeText, '-=0.1')

        // Description
        .fromTo('#description',
            { y: 20, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out' },
            '-=0.5'
        )

        // Info cards (staggered)
        .to('#infoCards', { opacity: 1, duration: 0.5 }, '-=0.3')
        .fromTo('.info-card',
            { y: 30, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5, stagger: 0.12, ease: 'power2.out' },
            '<'
        )

        // Action buttons
        .fromTo('#btnGroup',
            { y: 20, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5, ease: 'power2.out' },
            '-=0.2'
        )

        // Diagnostic bar
        .to('#diagnostic', {
            opacity: 1,
            duration: 0.5,
            ease: 'power2.out',
        }, '-=0.2');
    });

    /* ==========================================
     * Typing Effect
     * ========================================== */
    function typeText() {
        var text  = 'Oops! Halaman Tidak Ditemukan';
        var el    = document.getElementById('typed-text');
        var index = 0;

        if (!el) return;

        function type() {
            if (index < text.length) {
                el.textContent += text.charAt(index);
                index++;
                setTimeout(type, 40 + Math.random() * 30);
            }
        }

        type();
    }

    /* ==========================================
     * Live Clock
     * ========================================== */
    function updateTime() {
        var now     = new Date();
        var timeStr = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false,
        });
        var el = document.getElementById('currentTime');
        if (el) el.textContent = timeStr;
    }

    updateTime();
    setInterval(updateTime, 1000);

    /* ==========================================
     * Cursor Particle Trail
     * ========================================== */
    var trailColors = ['#0d6efd', '#6610f2', '#e040fb', '#4d9fff', '#a855f7'];

    document.addEventListener('mousemove', function (e) {
        if (Math.random() > 0.7) return; // Throttle for performance

        var particle = document.createElement('div');
        particle.className = 'cursor-particle';

        var size  = Math.random() * 6 + 3;
        var color = trailColors[Math.floor(Math.random() * trailColors.length)];

        particle.style.width     = size + 'px';
        particle.style.height    = size + 'px';
        particle.style.left      = e.clientX + 'px';
        particle.style.top       = e.clientY + 'px';
        particle.style.background = color;
        particle.style.boxShadow = '0 0 ' + (size * 2) + 'px ' + color;

        document.body.appendChild(particle);

        gsap.fromTo(particle,
            { opacity: 0.8, scale: 1 },
            {
                opacity: 0,
                scale: 0,
                x: (Math.random() - 0.5) * 40,
                y: (Math.random() - 0.5) * 40 - 20,
                duration: 0.8 + Math.random() * 0.4,
                ease: 'power2.out',
                onComplete: function () { particle.remove(); },
            }
        );
    });
})();
