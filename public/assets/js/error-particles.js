/**
 * Three.js Particle Background
 * Used on error pages (404, 500, etc.)
 */
(function () {
    'use strict';

    const canvas = document.getElementById('bg-canvas');
    if (!canvas) return;

    /* ---------- Renderer ---------- */
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    /* ---------- Scene & Camera ---------- */
    const scene  = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 30;

    /* ---------- Config ---------- */
    const PARTICLE_COUNT = 800;
    const MAX_LINES      = 300;
    const LINE_THRESHOLD = 8;
    const BOUNDS_XY      = 40;
    const BOUNDS_Z       = 20;

    const COLOR_PALETTE = [
        new THREE.Color(0x0d6efd),
        new THREE.Color(0x6610f2),
        new THREE.Color(0xe040fb),
        new THREE.Color(0x4d9fff),
        new THREE.Color(0xa855f7),
    ];

    /* ---------- Particle Geometry ---------- */
    const geometry   = new THREE.BufferGeometry();
    const positions  = new Float32Array(PARTICLE_COUNT * 3);
    const velocities = new Float32Array(PARTICLE_COUNT * 3);
    const colors     = new Float32Array(PARTICLE_COUNT * 3);

    for (let i = 0; i < PARTICLE_COUNT; i++) {
        const i3    = i * 3;
        const color = COLOR_PALETTE[Math.floor(Math.random() * COLOR_PALETTE.length)];

        positions[i3]     = (Math.random() - 0.5) * 80;
        positions[i3 + 1] = (Math.random() - 0.5) * 80;
        positions[i3 + 2] = (Math.random() - 0.5) * 40;

        velocities[i3]     = (Math.random() - 0.5) * 0.02;
        velocities[i3 + 1] = (Math.random() - 0.5) * 0.02;
        velocities[i3 + 2] = (Math.random() - 0.5) * 0.01;

        colors[i3]     = color.r;
        colors[i3 + 1] = color.g;
        colors[i3 + 2] = color.b;
    }

    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color',    new THREE.BufferAttribute(colors, 3));

    const material = new THREE.PointsMaterial({
        size: 1.5,
        vertexColors: true,
        transparent: true,
        opacity: 0.6,
        blending: THREE.AdditiveBlending,
        sizeAttenuation: true,
    });

    const particles = new THREE.Points(geometry, material);
    scene.add(particles);

    /* ---------- Connection Lines ---------- */
    const lineGeometry  = new THREE.BufferGeometry();
    const linePositions = new Float32Array(MAX_LINES * 6);
    const lineColors    = new Float32Array(MAX_LINES * 6);

    lineGeometry.setAttribute('position', new THREE.BufferAttribute(linePositions, 3));
    lineGeometry.setAttribute('color',    new THREE.BufferAttribute(lineColors, 3));

    const lineMaterial = new THREE.LineBasicMaterial({
        vertexColors: true,
        transparent: true,
        opacity: 0.15,
        blending: THREE.AdditiveBlending,
    });

    const lines = new THREE.LineSegments(lineGeometry, lineMaterial);
    scene.add(lines);

    /* ---------- Mouse Interaction ---------- */
    let mouseX = 0;
    let mouseY = 0;

    document.addEventListener('mousemove', function (e) {
        mouseX = (e.clientX / window.innerWidth  - 0.5) * 2;
        mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
    });

    /* ---------- Animation Loop ---------- */
    function animate() {
        requestAnimationFrame(animate);

        const posArr = particles.geometry.attributes.position.array;

        // Move particles & wrap boundaries
        for (let i = 0; i < PARTICLE_COUNT; i++) {
            const i3 = i * 3;
            posArr[i3]     += velocities[i3];
            posArr[i3 + 1] += velocities[i3 + 1];
            posArr[i3 + 2] += velocities[i3 + 2];

            if (posArr[i3]     >  BOUNDS_XY) posArr[i3]     = -BOUNDS_XY;
            if (posArr[i3]     < -BOUNDS_XY) posArr[i3]     =  BOUNDS_XY;
            if (posArr[i3 + 1] >  BOUNDS_XY) posArr[i3 + 1] = -BOUNDS_XY;
            if (posArr[i3 + 1] < -BOUNDS_XY) posArr[i3 + 1] =  BOUNDS_XY;
            if (posArr[i3 + 2] >  BOUNDS_Z)  posArr[i3 + 2] = -BOUNDS_Z;
            if (posArr[i3 + 2] < -BOUNDS_Z)  posArr[i3 + 2] =  BOUNDS_Z;
        }

        particles.geometry.attributes.position.needsUpdate = true;

        // Update connection lines
        const lp = lines.geometry.attributes.position.array;
        const lc = lines.geometry.attributes.color.array;
        let lineIdx = 0;

        for (let i = 0; i < PARTICLE_COUNT && lineIdx < MAX_LINES; i++) {
            for (let j = i + 1; j < PARTICLE_COUNT && lineIdx < MAX_LINES; j++) {
                const i3 = i * 3;
                const j3 = j * 3;
                const dx = posArr[i3]     - posArr[j3];
                const dy = posArr[i3 + 1] - posArr[j3 + 1];
                const dz = posArr[i3 + 2] - posArr[j3 + 2];
                const dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                if (dist < LINE_THRESHOLD) {
                    const idx   = lineIdx * 6;
                    const alpha = 1 - dist / LINE_THRESHOLD;

                    lp[idx]     = posArr[i3];
                    lp[idx + 1] = posArr[i3 + 1];
                    lp[idx + 2] = posArr[i3 + 2];
                    lp[idx + 3] = posArr[j3];
                    lp[idx + 4] = posArr[j3 + 1];
                    lp[idx + 5] = posArr[j3 + 2];

                    lc[idx]     = 0.05 * alpha;
                    lc[idx + 1] = 0.43 * alpha;
                    lc[idx + 2] = 0.99 * alpha;
                    lc[idx + 3] = 0.40 * alpha;
                    lc[idx + 4] = 0.06 * alpha;
                    lc[idx + 5] = 0.95 * alpha;

                    lineIdx++;
                }
            }
        }

        // Clear unused lines
        for (let i = lineIdx * 6; i < MAX_LINES * 6; i++) {
            lp[i] = 0;
            lc[i] = 0;
        }

        lines.geometry.attributes.position.needsUpdate = true;
        lines.geometry.attributes.color.needsUpdate    = true;
        lines.geometry.setDrawRange(0, lineIdx * 2);

        // Camera follows mouse
        camera.position.x += (mouseX * 3 - camera.position.x) * 0.02;
        camera.position.y += (-mouseY * 3 - camera.position.y) * 0.02;
        camera.lookAt(scene.position);

        // Slow auto-rotation
        particles.rotation.y += 0.0003;
        particles.rotation.x += 0.0001;

        renderer.render(scene, camera);
    }

    animate();

    /* ---------- Resize Handler ---------- */
    window.addEventListener('resize', function () {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
})();
