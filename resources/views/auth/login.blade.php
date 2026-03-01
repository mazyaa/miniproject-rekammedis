<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap');

    *, *::before, *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0f4f8;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        width: 100%;
        padding: 24px;
        background: linear-gradient(135deg, #e8f4fd 0%, #f0faf5 50%, #eef2ff 100%);
        position: relative;
        overflow: hidden;
    }

    .login-wrapper::before {
        content: '';
        position: fixed;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(99,179,237,0.15) 0%, transparent 70%);
        top: -100px; left: -100px;
        border-radius: 50%;
        pointer-events: none;
    }

    .login-wrapper::after {
        content: '';
        position: fixed;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(72,187,120,0.12) 0%, transparent 70%);
        bottom: -80px; right: -80px;
        border-radius: 50%;
        pointer-events: none;
    }

    .box {
        width: 100%;
        max-width: 920px;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 24px 80px rgba(30,64,175,0.1), 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .inner-box {
        display: flex;
        min-height: 560px;
    }

    /* ===== FORM SIDE ===== */
    .forms-wrap {
        flex: 1.1;
        padding: 48px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .logo-area {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 36px;
    }

    .logo-icon {
        width: 44px; height: 44px;
        background: linear-gradient(135deg, #0ea5e9, #0284c7);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(14,165,233,0.35);
        flex-shrink: 0;
    }

    .logo-icon svg {
        width: 22px; height: 22px;
        fill: none;
        stroke: #fff;
        stroke-width: 2.2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .logo-text strong {
        display: block;
        font-size: 15px;
        font-weight: 800;
        color: #0c1a3a;
        letter-spacing: -0.3px;
        line-height: 1.2;
    }

    .logo-text span {
        font-size: 10.5px;
        font-weight: 400;
        color: #94a3b8;
        letter-spacing: 0.6px;
        text-transform: uppercase;
    }

    .heading { margin-bottom: 30px; }

    .heading h2 {
        font-size: 28px;
        font-weight: 800;
        color: #0c1a3a;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .heading h2 em {
        font-family: 'Instrument Serif', serif;
        font-style: italic;
        color: #0ea5e9;
    }

    .heading p {
        font-size: 13.5px;
        color: #94a3b8;
    }

    .input-wrap { margin-bottom: 18px; }

    .input-wrap label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 7px;
    }

    .input-inner {
        position: relative;
    }

    .input-inner svg.input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px; height: 16px;
        stroke: #cbd5e1;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        pointer-events: none;
        transition: stroke 0.3s;
    }

    .input-inner:focus-within svg.input-icon {
        stroke: #0ea5e9;
    }

    .input-field {
        width: 100%;
        padding: 13px 16px 13px 42px;
        border: 1.8px solid #e2e8f0;
        border-radius: 14px;
        font-size: 14px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #1e293b;
        background: #f8fafc;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-field::placeholder { color: #cbd5e1; font-size: 13px; }

    .input-field:focus {
        border-color: #0ea5e9;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(14,165,233,0.1);
    }

    .field-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 6px;
    }

    .sign-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: #fff;
        border: none;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 700;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
        box-shadow: 0 6px 20px rgba(14,165,233,0.35);
        position: relative;
        overflow: hidden;
        letter-spacing: 0.2px;
    }

    .sign-btn::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
        transition: left 0.5s ease;
    }

    .sign-btn:hover::before { left: 100%; }
    .sign-btn:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(14,165,233,0.4);
    }
    .sign-btn:active { transform: translateY(0); }

    .bottom-note {
        font-size: 11.5px;
        color: #b0bec5;
        text-align: center;
        margin-top: 20px;
        line-height: 1.7;
    }

    .session-status {
        background: #f0fdf4;
        border: 1px solid #86efac;
        color: #16a34a;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 13px;
        margin-bottom: 16px;
    }

    /* ===== CAROUSEL SIDE ===== */
    .carousel {
        flex: 0.9;
        background: linear-gradient(160deg, #0c4a7a 0%, #0369a1 45%, #0891b2 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        padding: 40px 32px;
        position: relative;
        overflow: hidden;
    }

    .carousel::before {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        border: 1.5px solid rgba(255,255,255,0.07);
        border-radius: 50%;
        top: -70px; right: -70px;
    }

    .carousel::after {
        content: '';
        position: absolute;
        width: 200px; height: 200px;
        border: 1.5px solid rgba(255,255,255,0.07);
        border-radius: 50%;
        bottom: -50px; left: -50px;
    }

    /* Floating decorative icons */
    .deco-icons { position: absolute; inset: 0; pointer-events: none; }

    .deco-icon {
        position: absolute;
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.14);
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: floatIcon 4s ease-in-out infinite;
    }

    .deco-icon svg {
        width: 18px; height: 18px;
        stroke: rgba(255,255,255,0.65);
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .deco-icon:nth-child(1) { top: 13%; left: 7%;  animation-delay: 0s;    }
    .deco-icon:nth-child(2) { top: 17%; right: 9%;  animation-delay: 1s;    }
    .deco-icon:nth-child(3) { bottom: 27%; left: 5%;  animation-delay: 0.5s; }
    .deco-icon:nth-child(4) { bottom: 13%; right: 7%;  animation-delay: 1.5s; }

    @keyframes floatIcon {
        0%, 100% { transform: translateY(0); }
        50%       { transform: translateY(-9px); }
    }

    /* Illustration */
    .carousel-illustration {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        z-index: 2;
    }

    .illus-circle {
        width: 195px; height: 195px;
        background: rgba(255,255,255,0.09);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulseRing 3s ease-in-out infinite;
    }

    @keyframes pulseRing {
        0%, 100% { box-shadow: 0 0 0 18px rgba(255,255,255,0.04), 0 0 0 36px rgba(255,255,255,0.02); }
        50%       { box-shadow: 0 0 0 24px rgba(255,255,255,0.055), 0 0 0 46px rgba(255,255,255,0.025); }
    }

    .illus-circle svg { width: 115px; height: 115px; }

    /* Text slider */
    .text-slider { text-align: center; z-index: 2; width: 100%; }

    .slide-tag {
        display: inline-block;
        background: rgba(255,255,255,0.14);
        color: rgba(255,255,255,0.85);
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 12px;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .text-wrap {
        overflow: hidden;
        height: 34px;
        margin-bottom: 6px;
    }

    .text-group {
        transition: transform 0.55s cubic-bezier(0.4,0,0.2,1);
    }

    .text-group h2 {
        font-size: 17px;
        font-weight: 700;
        color: #fff;
        line-height: 34px;
        white-space: nowrap;
    }

    .text-sub-wrap {
        overflow: hidden;
        height: 22px;
        margin-bottom: 18px;
    }

    .text-sub-group {
        transition: transform 0.55s cubic-bezier(0.4,0,0.2,1);
    }

    .text-sub-group p {
        font-size: 12px;
        color: rgba(255,255,255,0.58);
        line-height: 22px;
        white-space: nowrap;
    }

    .bullets { display: flex; gap: 8px; justify-content: center; }

    .bullets span {
        width: 8px; height: 8px;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.35s ease;
    }

    .bullets span.active {
        background: #fff;
        width: 26px;
        border-radius: 4px;
    }

    /* Stats */
    .stats-bar {
        display: flex;
        gap: 22px;
        justify-content: center;
        z-index: 2;
        padding-top: 16px;
        border-top: 1px solid rgba(255,255,255,0.12);
        width: 100%;
    }

    .stat-item { text-align: center; }
    .stat-num { font-size: 17px; font-weight: 800; color: #fff; }
    .stat-label { font-size: 10px; color: rgba(255,255,255,0.5); font-weight: 500; letter-spacing: 0.3px; }

    /* Responsive */
    @media (max-width: 680px) {
        .carousel { display: none; }
        .forms-wrap { padding: 40px 28px; }
        .inner-box { min-height: unset; }
    }
</style>

<div class="login-wrapper">
    <div class="box">
        <div class="inner-box">

            <!-- FORM SIDE -->
            <div class="forms-wrap">

                <div class="logo-area">
                    <div class="logo-icon">
                        <!-- ECG / heartbeat icon -->
                        <svg viewBox="0 0 24 24"><polyline points="2,12 6,12 8,5 11,19 13,9 15,14 17,12 22,12"/></svg>
                    </div>
                    <div class="logo-text">
                        <strong>MediCare Admin</strong>
                        <span>Sistem Manajemen Medis</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if (session('status'))
                        <div class="session-status">{{ session('status') }}</div>
                    @endif

                    <div class="heading">
                        <h2>Selamat Datang, <em>Dokter</em></h2>
                        <p>Masukkan kredensial Anda untuk mengakses dashboard</p>
                    </div>

                    <!-- Email -->
                    <div class="input-wrap">
                        <label for="email">Alamat Email</label>
                        <div class="input-inner">
                            <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="input-field"
                                placeholder="admin@medicare.com"
                                value="{{ old('email') }}"
                                required autofocus autocomplete="username"
                            />
                        </div>
                        @foreach($errors->get('email') as $msg)
                            <div class="field-error">⚠ {{ $msg }}</div>
                        @endforeach
                    </div>

                    <!-- Password -->
                    <div class="input-wrap">
                        <label for="password">Password</label>
                        <div class="input-inner">
                            <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="input-field"
                                placeholder="••••••••"
                                required autocomplete="current-password"
                            />
                        </div>
                        @foreach($errors->get('password') as $msg)
                            <div class="field-error">⚠ {{ $msg }}</div>
                        @endforeach
                    </div>

                    <input type="submit" value="Masuk ke Dashboard →" class="sign-btn" />

                    <p class="bottom-note">
                        Akses hanya untuk tenaga medis &amp; administrator terdaftar.<br>
                        Diproteksi dengan enkripsi end-to-end.
                    </p>
                </form>
            </div>

            <!-- CAROUSEL SIDE -->
            <div class="carousel">

                <div class="deco-icons">
                    <!-- Stethoscope -->
                    <div class="deco-icon">
                        <svg viewBox="0 0 24 24"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1"/><path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/><circle cx="20" cy="10" r="2"/></svg>
                    </div>
                    <!-- Heart -->
                    <div class="deco-icon">
                        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </div>
                    <!-- Pill / capsule -->
                    <div class="deco-icon">
                        <svg viewBox="0 0 24 24"><path d="M10.5 20H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v7"/><path d="m16 12 4 4m0-4-4 4"/><path d="M9 8h6M9 12h3"/></svg>
                    </div>
                    <!-- Plus medical -->
                    <div class="deco-icon">
                        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </div>
                </div>

                <!-- Main Medical SVG Illustration -->
                <div class="carousel-illustration">
                    <div class="illus-circle">
                        <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Outer ring -->
                            <circle cx="60" cy="60" r="55" stroke="rgba(255,255,255,0.12)" stroke-width="1.5" stroke-dasharray="6 4"/>

                            <!-- Medical cross shape -->
                            <rect x="46" y="22" width="28" height="76" rx="10" fill="rgba(255,255,255,0.1)"/>
                            <rect x="22" y="46" width="76" height="28" rx="10" fill="rgba(255,255,255,0.1)"/>
                            <rect x="47" y="23" width="26" height="74" rx="9" fill="rgba(255,255,255,0.06)"/>
                            <rect x="23" y="47" width="74" height="26" rx="9" fill="rgba(255,255,255,0.06)"/>

                            <!-- ECG / heartbeat line animated -->
                            <polyline
                                points="8,60 22,60 26,46 32,74 38,52 45,64 50,60 70,60 75,42 81,78 87,60 100,60 112,60"
                                stroke="white"
                                stroke-width="2.4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                fill="none"
                                opacity="0.9">
                                <animate attributeName="stroke-dasharray" values="0,400;400,0" dur="2.8s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.9;0.5;0.9" dur="2.8s" repeatCount="indefinite"/>
                            </polyline>

                            <!-- Center dot pulse -->
                            <circle cx="60" cy="60" r="6" fill="rgba(255,255,255,0.25)">
                                <animate attributeName="r" values="5;8;5" dur="2s" repeatCount="indefinite"/>
                                <animate attributeName="opacity" values="0.25;0.1;0.25" dur="2s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="60" cy="60" r="3.5" fill="rgba(255,255,255,0.85)"/>
                        </svg>
                    </div>
                </div>

                <!-- Slider text -->
                <div class="text-slider">
                    <div class="slide-tag">Sistem Kesehatan Digital</div>

                    <div class="text-wrap">
                        <div class="text-group" id="textGroup">
                            <h2>Kelola Data Pasien</h2>
                            <h2>Monitor Rekam Medis</h2>
                            <h2>Laporan Real-Time</h2>
                        </div>
                    </div>

                    <div class="text-sub-wrap">
                        <div class="text-sub-group" id="subGroup">
                            <p>Akses data pasien dengan aman &amp; cepat</p>
                            <p>Histori lengkap tersimpan &amp; terstruktur</p>
                            <p>Dashboard analitik terintegrasi</p>
                        </div>
                    </div>

                    <div class="bullets" id="bullets">
                        <span class="active" data-value="0"></span>
                        <span data-value="1"></span>
                        <span data-value="2"></span>
                    </div>
                </div>

                <!-- Stats -->
                <div class="stats-bar">
                    <div class="stat-item">
                        <div class="stat-num">2.4K+</div>
                        <div class="stat-label">Pasien</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">98%</div>
                        <div class="stat-label">Uptime</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-num">128</div>
                        <div class="stat-label">Dokter</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    const textGroup = document.getElementById('textGroup');
    const subGroup  = document.getElementById('subGroup');
    const bullets   = document.querySelectorAll('#bullets span');
    let current = 0;
    const total = 3;

    function goTo(i) {
        bullets[current].classList.remove('active');
        current = i;
        bullets[current].classList.add('active');
        textGroup.style.transform = `translateY(-${current * 34}px)`;
        subGroup.style.transform  = `translateY(-${current * 22}px)`;
    }

    bullets.forEach((b, i) => b.addEventListener('click', () => goTo(i)));
    setInterval(() => goTo((current + 1) % total), 3500);
</script>
