<style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Exo+2:ital,wght@0,100;0,300;1,100&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sun-glow: #ff6b00;
            --sun-core: #fff4a3;
            --mercury: #b5b5b5;
            --venus: #e8cda0;
            --earth: #4fa3d1;
            --mars: #c1440e;
            --jupiter: #c88b3a;
            --saturn: #e4d191;
            --uranus: #7de8e8;
            --neptune: #4b70dd;
            --orbit-color: rgba(255,255,255,0.08);
            --space-deep: #00000f;
        }

        html {
            width: 100%; height: 100%;
            overflow: hidden;
            background: var(--space-deep);
            font-family: 'Exo 2', sans-serif;
        }
        body {
            width: 100%; height: 100%;
            overflow-x: hidden;
            background: var(--space-deep);
            font-family: 'Exo 2', sans-serif;
        }
        #bg-wrapper {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }
        /* ───── STARFIELD ───── */
        #starfield {
            position: fixed; inset: 0; z-index: 0;
            background: radial-gradient(ellipse at 20% 30%, #0d0d2b 0%, #00000f 70%);
        }
        canvas#stars { position: absolute; inset: 0; width: 100%; height: 100%; }

        /* ───── NEBULA LAYERS ───── */
        .nebula {
            position: fixed; border-radius: 50%; filter: blur(80px);
            mix-blend-mode: screen; pointer-events: none; z-index: 1;
        }
        .nebula-1 {
            width: 60vw; height: 50vh;
            background: radial-gradient(ellipse, rgba(180,40,40,0.18) 0%, transparent 70%);
            top: 10%; left: 30%; animation: nebulaDrift1 40s ease-in-out infinite alternate;
        }
        .nebula-2 {
            width: 40vw; height: 60vh;
            background: radial-gradient(ellipse, rgba(20,80,160,0.15) 0%, transparent 70%);
            top: 20%; left: 5%; animation: nebulaDrift2 55s ease-in-out infinite alternate;
        }
        .nebula-3 {
            width: 35vw; height: 35vh;
            background: radial-gradient(ellipse, rgba(60,20,100,0.2) 0%, transparent 70%);
            bottom: 10%; right: 5%; animation: nebulaDrift3 48s ease-in-out infinite alternate;
        }
        @keyframes nebulaDrift1 { from { transform: translate(0,0) scale(1); } to { transform: translate(-3vw,2vh) scale(1.1); } }
        @keyframes nebulaDrift2 { from { transform: translate(0,0) scale(1); } to { transform: translate(2vw,-3vh) scale(0.95); } }
        @keyframes nebulaDrift3 { from { transform: translate(0,0) scale(1); } to { transform: translate(-2vw,3vh) scale(1.05); } }

        /* ───── SOLAR SYSTEM STAGE ───── */
        #solar-system {
            position: fixed; inset: 0; z-index: 2;
            display: flex; align-items: center; justify-content: center;
        }

        .system-container {
            position: relative;
            width: min(95vw, 95vh);
            height: min(95vw, 95vh);
        }

        /* ───── ORBIT RINGS ───── */
        .orbit {
            position: absolute; top: 50%; left: 50%;
            border: 1px solid var(--orbit-color);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: orbitPulse 8s ease-in-out infinite;
        }
        @keyframes orbitPulse {
            0%, 100% { border-color: rgba(255,255,255,0.06); }
            50%       { border-color: rgba(255,255,255,0.13); }
        }

        /* ───── SUN ───── */
        .sun {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: radial-gradient(circle at 38% 38%,
                var(--sun-core) 0%,
                #ffdd00 15%,
                #ff9900 35%,
                #ff5500 60%,
                #cc2200 80%,
                #880000 100%
            );
            box-shadow:
                0 0 40px 20px rgba(255,140,0,0.6),
                0 0 100px 50px rgba(255,80,0,0.35),
                0 0 200px 100px rgba(200,30,0,0.2),
                0 0 350px 150px rgba(150,20,0,0.1);
            animation: sunPulse 4s ease-in-out infinite;
            z-index: 10;
        }
        @keyframes sunPulse {
            0%, 100% { box-shadow: 0 0 40px 20px rgba(255,140,0,0.6), 0 0 100px 50px rgba(255,80,0,0.35), 0 0 200px 100px rgba(200,30,0,0.2); transform: translate(-50%,-50%) scale(1); }
            50%       { box-shadow: 0 0 55px 30px rgba(255,160,0,0.75), 0 0 130px 70px rgba(255,90,0,0.45), 0 0 260px 130px rgba(200,40,0,0.28); transform: translate(-50%,-50%) scale(1.04); }
        }

        /* Corona spikes */
        .sun::before {
            content: ''; position: absolute; inset: -15%;
            background: radial-gradient(circle, transparent 40%, rgba(255,120,0,0.08) 60%, transparent 75%),
                        repeating-conic-gradient(from 0deg, rgba(255,140,0,0.07) 0deg 6deg, transparent 6deg 12deg);
            border-radius: 50%;
            animation: coronaRotate 30s linear infinite;
        }
        @keyframes coronaRotate { to { transform: rotate(360deg); } }

        /* ───── PLANET ORBIT WRAPPER ───── */
        .planet-orbit {
            position: absolute; top: 50%; left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .planet-arm {
            position: absolute;
            top: 0; left: 50%;
            transform-origin: bottom center;
            display: flex; align-items: flex-start; justify-content: center;
        }

        .planet {
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease, filter 0.3s ease;
        }
        .planet:hover { transform: scale(1.4); filter: brightness(1.4); }

        /* Planet glow on hover */
        .planet::after {
            content: ''; position: absolute; inset: -30%;
            border-radius: 50%;
            background: radial-gradient(circle, var(--glow-color, rgba(255,255,255,0.2)) 0%, transparent 70%);
            opacity: 0; transition: opacity 0.3s;
        }
        .planet:hover::after { opacity: 1; }

        /* ───── INDIVIDUAL PLANETS ───── */

        /* Mercury */
        #mercury-orbit { animation: orbit 8s linear infinite; }
        #mercury {
            background: radial-gradient(circle at 35% 35%, #d8d8d8, #888 50%, #555);
            box-shadow: inset -4px -4px 8px rgba(0,0,0,0.5), 0 0 6px rgba(200,200,200,0.2);
            --glow-color: rgba(200,200,200,0.3);
        }

        /* Venus */
        #venus-orbit { animation: orbit 20s linear infinite; }
        #venus {
            background: radial-gradient(circle at 35% 35%, #f5e6c8, #c8a86e 50%, #a07040);
            box-shadow: inset -5px -5px 10px rgba(0,0,0,0.4), 0 0 8px rgba(220,180,100,0.3);
            --glow-color: rgba(220,180,100,0.4);
        }

        /* Earth */
        #earth-orbit { animation: orbit 32s linear infinite; }
        #earth {
            background:
                radial-gradient(circle at 30% 30%, rgba(100,200,100,0.9) 0%, transparent 40%),
                radial-gradient(circle at 70% 60%, rgba(60,160,200,0.8) 0%, transparent 50%),
                radial-gradient(circle at 35% 35%, #6ab4e8, #2a6ab0 40%, #1a4a80);
            box-shadow: inset -5px -5px 12px rgba(0,0,0,0.5), 0 0 10px rgba(70,140,220,0.4);
            --glow-color: rgba(70,140,220,0.4);
        }
        /* Moon */
        #earth::before {
            content: ''; position: absolute;
            border-radius: 50%;
            background: #c8c8c8;
            animation: moonOrbit 3s linear infinite;
        }

        /* Mars */
        #mars-orbit { animation: orbit 60s linear infinite; }
        #mars {
            background: radial-gradient(circle at 35% 35%, #e87050, #b03010 50%, #801000);
            box-shadow: inset -4px -4px 10px rgba(0,0,0,0.5), 0 0 8px rgba(200,60,20,0.3);
            --glow-color: rgba(200,60,20,0.4);
        }

        /* Jupiter */
        #jupiter-orbit { animation: orbit 190s linear infinite; }
        #jupiter {
            background:
                repeating-linear-gradient(
                    0deg,
                    #c88b3a 0px, #c88b3a 8%,
                    #e8b86a 8%, #e8b86a 14%,
                    #a06828 14%, #a06828 22%,
                    #d8a050 22%, #d8a050 30%,
                    #8a5020 30%, #8a5020 40%,
                    #c89050 40%, #c89050 50%,
                    #7a4010 50%, #7a4010 60%,
                    #d09848 60%, #d09848 70%,
                    #b07838 70%, #b07838 80%,
                    #e0b060 80%, #e0b060 90%,
                    #c08040 90%, #c08040 100%
                );
            box-shadow: inset -8px -8px 20px rgba(0,0,0,0.4), 0 0 15px rgba(200,140,60,0.3);
            --glow-color: rgba(200,140,60,0.4);
            overflow: hidden;
        }
        /* Great Red Spot */
        #jupiter::after {
            content: ''; position: absolute;
            width: 30%; height: 20%;
            top: 55%; left: 30%;
            background: radial-gradient(ellipse, rgba(180,40,0,0.8) 0%, rgba(140,20,0,0.5) 60%, transparent 100%);
            border-radius: 50%;
            animation: spotDrift 190s linear infinite reverse;
        }

        /* Saturn */
        #saturn-orbit { animation: orbit 470s linear infinite; }
        #saturn {
            background: radial-gradient(circle at 38% 38%, #f5e8a8, #c8b870 40%, #a09040);
            box-shadow: inset -6px -6px 15px rgba(0,0,0,0.4), 0 0 12px rgba(220,200,100,0.3);
            --glow-color: rgba(220,200,100,0.4);
            overflow: visible !important;
        }
        /* Saturn ring */
        #saturn::before {
            content: ''; position: absolute;
            border-radius: 50%;
            border: 3px solid rgba(220,200,120,0.6);
            box-shadow:
                0 0 0 2px rgba(200,180,100,0.3),
                0 0 0 5px rgba(180,160,80,0.15);
            transform: rotateX(70deg);
            pointer-events: none;
        }

        /* Uranus */
        #uranus-orbit { animation: orbit 1680s linear infinite; }
        #uranus {
            background: radial-gradient(circle at 38% 38%, #b0f0f0, #40c8c8 50%, #208080);
            box-shadow: inset -5px -5px 12px rgba(0,0,0,0.4), 0 0 10px rgba(60,200,200,0.35);
            --glow-color: rgba(60,200,200,0.4);
        }

        /* Neptune */
        #neptune-orbit { animation: orbit 3280s linear infinite; }
        #neptune {
            background: radial-gradient(circle at 35% 35%, #7090ff, #3050c0 45%, #102080);
            box-shadow: inset -5px -5px 12px rgba(0,0,0,0.5), 0 0 10px rgba(60,100,220,0.4);
            --glow-color: rgba(60,100,220,0.4);
        }

        @keyframes orbit { from { transform: translate(-50%,-50%) rotate(0deg); } to { transform: translate(-50%,-50%) rotate(360deg); } }
        @keyframes spotDrift { from { transform: none; } to { transform: translateX(100%); } }
        @keyframes moonOrbit {
            from { transform: rotate(0deg) translateX(140%) rotate(0deg); }
            to   { transform: rotate(360deg) translateX(140%) rotate(-360deg); }
        }

        /* ───── SHOOTING STARS ───── */
        .shooting-star {
            position: fixed; z-index: 3;
            width: 2px; height: 2px;
            background: white;
            border-radius: 50%;
            filter: blur(0.5px);
        }
        .shooting-star::after {
            content: ''; position: absolute;
            right: 0; top: 0;
            width: 0; height: 1px;
            background: linear-gradient(to left, white, transparent);
            transform-origin: right center;
        }

        /* ───── HUD OVERLAY ───── */
        #hud {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 5;
            display: flex; align-items: flex-start; justify-content: space-between;
            padding: 2rem 2.5rem;
            pointer-events: none;
        }
        .hud-title {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: clamp(1.1rem, 2.5vw, 2rem);
            color: rgba(255,255,255,0.9);
            letter-spacing: 0.25em;
            text-transform: uppercase;
            text-shadow: 0 0 20px rgba(100,180,255,0.5);
        }
        .hud-sub {
            font-family: 'Exo 2', sans-serif;
            font-weight: 100;
            font-style: italic;
            font-size: clamp(0.6rem, 1vw, 0.85rem);
            color: rgba(180,210,255,0.5);
            letter-spacing: 0.3em;
            margin-top: 0.3rem;
        }
        .hud-clock {
            font-family: 'Orbitron', monospace;
            font-size: clamp(0.7rem, 1.2vw, 1rem);
            color: rgba(160,200,255,0.6);
            letter-spacing: 0.15em;
            text-align: right;
        }
        .hud-date {
            font-family: 'Exo 2', sans-serif;
            font-weight: 100;
            font-size: clamp(0.55rem, 0.9vw, 0.75rem);
            color: rgba(120,170,255,0.4);
            letter-spacing: 0.2em;
            margin-top: 0.3rem;
        }

        /* Corner brackets */
        #hud::before, #hud::after {
            content: ''; position: fixed;
            width: 30px; height: 30px;
            opacity: 0.25;
        }
        #hud::before {
            top: 1rem; left: 1rem;
            border-top: 1px solid #7aadff;
            border-left: 1px solid #7aadff;
        }
        #hud::after {
            top: 1rem; right: 1rem;
            border-top: 1px solid #7aadff;
            border-right: 1px solid #7aadff;
        }
        .hud-bottom {
            position: fixed; bottom: 0; left: 0; right: 0;
            height: 60px; pointer-events: none; z-index: 20;
        }
        .hud-bottom::before, .hud-bottom::after {
            content: ''; position: absolute;
            width: 30px; height: 30px;
            opacity: 0.25;
        }
        .hud-bottom::before {
            bottom: 1rem; left: 1rem;
            border-bottom: 1px solid #7aadff;
            border-left: 1px solid #7aadff;
        }
        .hud-bottom::after {
            bottom: 1rem; right: 1rem;
            border-bottom: 1px solid #7aadff;
            border-right: 1px solid #7aadff;
        }

        /* Scanline effect */
        body::after {
            content: ''; position: fixed; inset: 0;
            background: repeating-linear-gradient(
                0deg,
                transparent, transparent 2px,
                rgba(0,0,20,0.03) 2px, rgba(0,0,20,0.03) 4px
            );
            pointer-events: none; z-index: 1;
        }

        /* ───── TOOLTIP ───── */
        .planet-label {
            position: absolute;
            font-family: 'Orbitron', monospace;
            font-size: 0.55rem;
            color: rgba(180,220,255,0.85);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            white-space: nowrap;
            top: 110%; left: 50%; transform: translateX(-50%);
            opacity: 0; transition: opacity 0.2s;
            text-shadow: 0 0 8px rgba(100,180,255,0.8);
            pointer-events: none;
        }
        .planet:hover .planet-label { opacity: 1; }
    </style>
    <div id="bg-wrapper">
            {{-- ───── STARFIELD CANVAS ───── --}}
    <div id="starfield">
        <canvas id="stars"></canvas>
    </div>

    {{-- ───── NEBULA ───── --}}
    <div class="nebula nebula-1"></div>
    <div class="nebula nebula-2"></div>
    <div class="nebula nebula-3"></div>

    {{-- ───── HUD ───── --}}


        <div id="hud">
            <div class="hud-clock" id="clock">--:--:--</div>
            <div class="hud-date" id="datestamp">-- --- ----</div>
        </div>

    <div class="hud-bottom"></div>

    {{-- ───── SOLAR SYSTEM ───── --}}
    <div id="solar-system">
        <div class="system-container" id="system">
            {{-- Sun --}}
            <div class="sun" id="sun" style="width:9%;height:9%;"></div>
        </div>
    </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const PLANETS = [
            { id:'mercury', label:'Mercury', size:1.4,  orbit:12,  dur:'8s',   color:'#b5b5b5', angle:20 },
            { id:'venus',   label:'Venus',   size:2.2,  orbit:18,  dur:'20s',  color:'#e8cda0', angle:80 },
            { id:'earth',   label:'Earth',   size:2.4,  orbit:25,  dur:'32s',  color:'#4fa3d1', angle:150, moon:true },
            { id:'mars',    label:'Mars',    size:1.8,  orbit:33,  dur:'60s',  color:'#c1440e', angle:240 },
            { id:'jupiter', label:'Jupiter', size:5.5,  orbit:50,  dur:'190s', color:'#c88b3a', angle:300 },
            { id:'saturn',  label:'Saturn',  size:4.5,  orbit:64,  dur:'470s', color:'#e4d191', angle:45,  rings:true },
            { id:'uranus',  label:'Uranus',  size:3.2,  orbit:76,  dur:'1680s',color:'#7de8e8', angle:200 },
            { id:'neptune', label:'Neptune', size:3.0,  orbit:88,  dur:'3280s',color:'#4b70dd', angle:120 },
            ];

            const container = document.getElementById('system');
            const W = container.offsetWidth;

    // Build orbits + planets
            PLANETS.forEach(p => {
                const orbitPx = (p.orbit / 100) * W;

                // Orbit ring
                const ring = document.createElement('div');
                ring.className = 'orbit';
                ring.style.cssText = `width:${orbitPx*2}px;height:${orbitPx*2}px;`;
                container.appendChild(ring);

        // Orbit wrapper (animates)
                const orbitEl = document.createElement('div');
                orbitEl.id = `${p.id}-orbit`;
                orbitEl.className = 'planet-orbit';
                orbitEl.style.cssText = `
                    width:${orbitPx*2}px; height:${orbitPx*2}px;
                    animation: orbit ${p.dur} linear infinite;
                    animation-delay: -${parseFloat(p.dur) * (p.angle/360)}s;
                    `;
                container.appendChild(orbitEl);

                 // Arm pointing up (planet sits at top of orbit)
                const arm = document.createElement('div');
                arm.className = 'planet-arm';
                arm.style.cssText = `width:${(p.size/100)*W}px; height:${orbitPx}px; margin-left:-${((p.size/100)*W)/2}px;`;
                orbitEl.appendChild(arm);

                // Planet
                const planet = document.createElement('div');
                planet.className = 'planet';
                planet.id = p.id;
                const sz = (p.size / 100) * W;
                planet.style.cssText = `width:${sz}px; height:${sz}px;`;

        // Saturn ring sizing
            if (p.rings) {
                planet.style.setProperty('--ring-w', `${sz * 2.2}px`);
                planet.style.setProperty('--ring-h', `${sz * 0.45}px`);
                planet.style.setProperty('--ring-top', `${sz * 0.28}px`);
                planet.style.setProperty('--ring-left', `${-sz * 0.6}px`);
                const ringStyle = document.createElement('style');
                ringStyle.textContent = `
                        #saturn::before {
                        width: ${sz*2.2}px !important; height: ${sz*0.45}px !important;
                        top: ${sz*0.28}px !important; left: ${-sz*0.6}px !important;
                        }
                    `;
                document.head.appendChild(ringStyle);
                }

        // Moon sizing
        if (p.moon) {
            const moonSz = sz * 0.28;
            const moonStyle = document.createElement('style');
            moonStyle.textContent = `
                #earth::before {
                    width: ${moonSz}px !important; height: ${moonSz}px !important;
                    top: ${sz/2 - moonSz/2}px; left: ${sz/2 - moonSz/2}px;
                }
            `;
            document.head.appendChild(moonStyle);
        }

        // Label
        const label = document.createElement('span');
        label.className = 'planet-label';
        label.textContent = p.label;
        planet.appendChild(label);

        arm.appendChild(planet);
    });

    // ── Star field
    const canvas = document.getElementById('stars');
    const ctx = canvas.getContext('2d');
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        drawStars();
    }
    function drawStars() {
        ctx.clearRect(0,0,canvas.width,canvas.height);
        const count = Math.floor((canvas.width * canvas.height) / 800);
        for (let i = 0; i < count; i++) {
            const x = Math.random() * canvas.width;
            const y = Math.random() * canvas.height;
            const r = Math.random() * 1.5;
            const alpha = 0.3 + Math.random() * 0.7;
            const hue = Math.random() < 0.1 ? `hsl(${200+Math.random()*60}, 60%, 90%)` :
                        Math.random() < 0.05 ? `hsl(${30+Math.random()*30}, 80%, 90%)` :
                        `rgba(255,255,255,${alpha})`;
            ctx.beginPath();
            ctx.arc(x, y, r, 0, Math.PI * 2);
            ctx.fillStyle = hue;
            ctx.fill();
        }
        // Distant galaxy smudge
        const grd = ctx.createRadialGradient(canvas.width*0.15, canvas.height*0.15, 0, canvas.width*0.15, canvas.height*0.15, canvas.width*0.08);
        grd.addColorStop(0, 'rgba(180,160,220,0.12)');
        grd.addColorStop(1, 'transparent');
        ctx.fillStyle = grd;
        ctx.beginPath();
        ctx.ellipse(canvas.width*0.15, canvas.height*0.15, canvas.width*0.08, canvas.height*0.04, -0.4, 0, Math.PI*2);
        ctx.fill();
    }

    // ── Twinkling
    const twinkleStars = [];
    function initTwinkle() {
        for (let i = 0; i < 80; i++) {
            twinkleStars.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: 0.5 + Math.random(),
                phase: Math.random() * Math.PI * 2,
                speed: 0.01 + Math.random() * 0.03
            });
        }
    }
    function animateTwinkle() {
        twinkleStars.forEach(s => {
            s.phase += s.speed;
            const alpha = 0.4 + 0.6 * Math.abs(Math.sin(s.phase));
            ctx.clearRect(s.x - s.r - 1, s.y - s.r - 1, s.r*2+2, s.r*2+2);
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.r, 0, Math.PI*2);
            ctx.fillStyle = `rgba(255,255,255,${alpha})`;
            ctx.fill();
        });
        requestAnimationFrame(animateTwinkle);
    }

    // ── Shooting stars
    function launchShootingStar() {
        const star = document.createElement('div');
        star.className = 'shooting-star';
        const startX = Math.random() * window.innerWidth;
        const startY = Math.random() * window.innerHeight * 0.5;
        const angle = 30 + Math.random() * 30;
        const length = 100 + Math.random() * 200;
        star.style.cssText = `
            left:${startX}px; top:${startY}px;
            width:${length}px; height:1px;
            background:linear-gradient(to right, transparent, rgba(255,255,255,0.9));
            transform:rotate(${angle}deg);
            opacity:1; transition:none;
        `;
        document.body.appendChild(star);
        requestAnimationFrame(() => {
            star.style.transition = `opacity 0.6s ease, transform 0.6s ease`;
            star.style.transform = `rotate(${angle}deg) translateX(${length*0.5}px)`;
            star.style.opacity = '0';
        });
        setTimeout(() => star.remove(), 700);
    }
    setInterval(launchShootingStar, 3000 + Math.random() * 4000);

    // ── Clock
    function updateClock() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2,'0');
        const m = String(now.getMinutes()).padStart(2,'0');
        const s = String(now.getSeconds()).padStart(2,'0');
        document.getElementById('clock').textContent = `${h}:${m}:${s}`;
        const months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
        document.getElementById('datestamp').textContent =
            `${String(now.getDate()).padStart(2,'0')} ${months[now.getMonth()]} ${now.getFullYear()}`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ── Init
    resizeCanvas();
    initTwinkle();
    animateTwinkle();
    window.addEventListener('resize', resizeCanvas);
});



    </script>
