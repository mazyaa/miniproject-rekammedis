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
