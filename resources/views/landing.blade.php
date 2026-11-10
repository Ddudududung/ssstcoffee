<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSST Coffee — Coffee Companion / Lifestyle Compliment</title>
    <meta name="description" content="Titik singgah buat ngopi. Menemani momen di sela aktivitas harian di Bandung.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="SSST Coffee">
    <meta property="og:description" content="Coffee Companion / Lifestyle Compliment">

    <!-- Web Font Fallbacks & Polish -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Kalam:wght@700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body x-data="{
    navScrolled: false,
    mobileMenuOpen: false,
    init() {
        window.addEventListener('scroll', () => {
            this.navScrolled = window.scrollY > 40;
            const nav = document.getElementById('site-nav');
            if (nav) nav.classList.toggle('scrolled', window.scrollY > 40);
        });
        // Spotlight mengikuti kursor di atas ilustrasi hero
        const stage = document.getElementById('illo-stage');
        if (stage) {
            stage.addEventListener('mousemove', (e) => {
                const r = stage.getBoundingClientRect();
                stage.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
                stage.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
            });
        }
        // Tutup mobile menu saat resize ke desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 900 && this.mobileMenuOpen) {
                this.closeMobileMenu();
            }
        });
    },
    toggleMobileMenu() {
        this.mobileMenuOpen = !this.mobileMenuOpen;
        document.body.classList.toggle('nav-open', this.mobileMenuOpen);
    },
    closeMobileMenu() {
        this.mobileMenuOpen = false;
        document.body.classList.remove('nav-open');
    },
    scrollTo(selector) {
        const el = document.querySelector(selector);
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    }
}">

{{-- ═══════════════════════════════════════════════
     NAVIGATION — FIXED FLOATING
═══════════════════════════════════════════════ --}}
<nav id="site-nav" class="glass">
    <div class="nav-inner">

        {{-- Logo — ganti file di public/images/logo.png --}}
        <a href="#" class="nav-logo" aria-label="SSST Coffee — ke atas">
            <img src="{{ asset('images/logo.png') }}" alt="SSST Coffee" style="height: 38px; width: auto; display: block;">
        </a>

        {{-- Links (desktop) --}}
        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#merch">Merch</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="#cerita">Cerita</a></li>
            <li><a href="#outlet">Lokasi</a></li>
            <li><a href="#about">About</a></li>
        </ul>

        {{-- Tagline pill (desktop only) --}}
        <span class="nav-tagline">#AlwaySSST</span>

        {{-- Burger button (mobile only) --}}
        <button
            id="nav-burger"
            class="nav-burger"
            aria-label="Buka menu navigasi"
            :aria-expanded="mobileMenuOpen"
            :class="mobileMenuOpen ? 'open' : ''"
            @click="toggleMobileMenu()"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>

    {{-- Mobile Menu Drawer --}}
    <div
        id="nav-mobile-menu"
        class="nav-mobile-menu"
        role="dialog"
        aria-label="Menu navigasi"
        x-cloak
        x-show="mobileMenuOpen"
        x-transition:enter="menu-slide-enter-active"
        x-transition:enter-start="menu-slide-enter-start"
        x-transition:enter-end="menu-slide-enter-end"
        x-transition:leave="menu-slide-leave-active"
        x-transition:leave-start="menu-slide-leave-start"
        x-transition:leave-end="menu-slide-leave-end"
        @keydown.escape.window="closeMobileMenu()"
    >
        <a href="#hero"    @click="closeMobileMenu()">Home</a>
        <a href="#menu"    @click="closeMobileMenu()">Menu</a>
        <a href="#merch"   @click="closeMobileMenu()">Merch</a>
        <a href="#gallery" @click="closeMobileMenu()">Galeri</a>
        <a href="#cerita"  @click="closeMobileMenu()">Cerita</a>
        <a href="#outlet"  @click="closeMobileMenu()">Lokasi</a>
        <a href="#about"   @click="closeMobileMenu()">About</a>
        <p class="nav-mobile-tagline">#AlwaySSST</p>
    </div>
</nav>


{{-- ═══════════════════════════════════════════════
     01 · HERO — INTERACTIVE HOTSPOT ILLUSTRATION
═══════════════════════════════════════════════ --}}
<section id="hero" style="padding-top: 68px; background: var(--black); border-bottom: 1px solid var(--border);">
    <div class="section-wrap" style="padding-top: 4rem; padding-bottom: 4rem;">

        {{-- Eyebrow --}}
        <p class="t-label c-mid" style="margin-bottom: 1.25rem;">Coffee Companion / Lifestyle Compliment</p>

        {{-- Hero headline — judul Creato, "SSST." sebagai kata kunci pakai Baligo (brand book) --}}
        <h1 class="t-hero c-white" style="margin-bottom: 1.5rem; max-width: 14ch;">
            Start<br>with <span class="f-display">SSST.</span>
        </h1>

        <p class="t-body c-light" style="max-width: 52ch; margin-bottom: 3rem;">
            Titik singgah buat ngopi. Setelah makan, setelah lari, atau sebelum pulang.<br>
            Gambar di bawah ini adalah isi web-nya — arahkan kursor, bagian yang menyala bisa diklik:
            <span class="c-white" style="font-weight:600;">Menu · Merch · Galeri · Cerita · Lokasi · About</span>
        </p>

        {{-- ── ILLUSTRATION STAGE — full-bleed, tiap zona = satu section web ── --}}
        <div style="margin-bottom: 3rem; margin-left: calc(-1 * min(1.5rem, max(0px, (100vw - 1320px) / -2))); margin-right: calc(-1 * min(1.5rem, max(0px, (100vw - 1320px) / -2)));">
            {{-- Scrollable on mobile --}}
            <div style="overflow-x: auto;" class="no-scrollbar">
                <div id="illo-stage" style="position: relative; min-width: 1100px; aspect-ratio: 1400 / 480;">

                    {{-- ── ILLUSTRATION (SVG vector scene — kiri→kanan: Lokasi, Galeri, Cerita, Menu, Merch, About) ── --}}
                    <svg style="width:100%; height:100%; display:block;" viewBox="0 0 1400 480" preserveAspectRatio="xMidYMax meet" fill="none" xmlns="http://www.w3.org/2000/svg">

                        {{-- Ground --}}
                        <line x1="30" y1="430" x2="1370" y2="430" stroke="#2e2e2c" stroke-width="2"/>

                        {{-- ░░ ZONA 1 · LOKASI — kedai + pin peta → section #outlet ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Lokasi kedai SSST"
                           @click="scrollTo('#outlet')" @keydown.enter="scrollTo('#outlet')">
                            {{-- Map pin melayang --}}
                            <g class="bob">
                                <circle cx="180" cy="96" r="15" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                                <polygon points="171,103 189,103 180,124" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                                <circle cx="180" cy="96" r="5" fill="#f4f4f0"/>
                            </g>
                            <line x1="180" y1="124" x2="180" y2="140" stroke="#2e2e2c" stroke-width="2" stroke-dasharray="4 4"/>
                            {{-- Signboard --}}
                            <rect x="95" y="140" width="170" height="34" rx="5" fill="#1a1a18" stroke="#f4f4f0" stroke-width="2"/>
                            <text x="180" y="163" fill="#f4f4f0" font-family="'Creato Display',sans-serif" font-weight="800" font-size="15" text-anchor="middle" letter-spacing="1">ssst coffee</text>
                            {{-- Awning --}}
                            <polygon points="60,208 300,208 282,174 78,174" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                            <line x1="108" y1="174" x2="94" y2="208" stroke="#f4f4f0" stroke-width="1.5"/>
                            <line x1="146" y1="174" x2="132" y2="208" stroke="#f4f4f0" stroke-width="1.5"/>
                            <line x1="180" y1="174" x2="180" y2="208" stroke="#f4f4f0" stroke-width="1.5"/>
                            <line x1="214" y1="174" x2="200" y2="208" stroke="#f4f4f0" stroke-width="1.5"/>
                            <line x1="252" y1="174" x2="238" y2="208" stroke="#f4f4f0" stroke-width="1.5"/>
                            {{-- Building --}}
                            <rect x="75" y="208" width="210" height="222" fill="#1a1a18" stroke="#f4f4f0" stroke-width="2.5"/>
                            {{-- Window --}}
                            <rect x="92" y="232" width="82" height="72" fill="#212120" stroke="#f4f4f0" stroke-width="2"/>
                            <line x1="133" y1="232" x2="133" y2="304" stroke="#f4f4f0" stroke-width="1.5"/>
                            <line x1="92" y1="268" x2="174" y2="268" stroke="#f4f4f0" stroke-width="1.5"/>
                            {{-- Door --}}
                            <rect x="200" y="236" width="62" height="194" fill="#212120" stroke="#f4f4f0" stroke-width="2"/>
                            <circle cx="212" cy="330" r="3.5" fill="#f4f4f0"/>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="95" y="30" width="170" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="180" y="52" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">Lokasi →</text>
                            </g>
                        </g>

                        {{-- ░░ ZONA 2 · GALERI — polaroid di tali → section #gallery ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Galeri foto"
                           @click="scrollTo('#gallery')" @keydown.enter="scrollTo('#gallery')">
                            {{-- Tali --}}
                            <path d="M330,130 Q450,170 570,130" stroke="#737370" stroke-width="2" fill="none"/>
                            {{-- Polaroid 1 --}}
                            <g class="swing">
                                <line x1="372" y1="146" x2="372" y2="168" stroke="#737370" stroke-width="2"/>
                                <rect x="337" y="168" width="70" height="86" rx="3" fill="#f4f4f0"/>
                                <rect x="344" y="176" width="56" height="46" fill="#212120"/>
                                <polyline points="348,214 360,198 370,210 378,202 396,218" stroke="#737370" stroke-width="2" fill="none"/>
                                <circle cx="354" cy="188" r="3" fill="#737370"/>
                                <line x1="348" y1="234" x2="392" y2="234" stroke="#737370" stroke-width="2.5" stroke-linecap="round"/>
                            </g>
                            {{-- Polaroid 2 (miring) --}}
                            <g class="swing d2" transform="rotate(-5 450 150)">
                                <line x1="450" y1="158" x2="450" y2="180" stroke="#737370" stroke-width="2"/>
                                <rect x="415" y="180" width="70" height="86" rx="3" fill="#f4f4f0"/>
                                <rect x="422" y="188" width="56" height="46" fill="#212120"/>
                                <circle cx="440" cy="205" r="9" fill="none" stroke="#737370" stroke-width="2"/>
                                <circle cx="460" cy="212" r="6" fill="none" stroke="#737370" stroke-width="2"/>
                                <line x1="426" y1="246" x2="470" y2="246" stroke="#737370" stroke-width="2.5" stroke-linecap="round"/>
                            </g>
                            {{-- Polaroid 3 (miring kanan) --}}
                            <g class="swing d3" transform="rotate(4 528 146)">
                                <line x1="528" y1="144" x2="528" y2="166" stroke="#737370" stroke-width="2"/>
                                <rect x="493" y="166" width="70" height="86" rx="3" fill="#f4f4f0"/>
                                <rect x="500" y="174" width="56" height="46" fill="#212120"/>
                                <path d="M506,210 Q520,192 534,210" stroke="#737370" stroke-width="2" fill="none"/>
                                <line x1="506" y1="232" x2="550" y2="232" stroke="#737370" stroke-width="2.5" stroke-linecap="round"/>
                            </g>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="365" y="60" width="170" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="450" y="82" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">Galeri →</text>
                            </g>
                        </g>

                        {{-- ░░ ZONA 3 · CERITA — orang baca jurnal → section #cerita ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Cerita SSST"
                           @click="scrollTo('#cerita')" @keydown.enter="scrollTo('#cerita')">
                            {{-- Speech bubble */}
                            <g class="bob d2">
                                <rect x="600" y="120" width="76" height="40" rx="12" fill="#212120" stroke="#f4f4f0" stroke-width="2"/>
                                <circle cx="622" cy="140" r="2.5" fill="#f4f4f0"/>
                                <circle cx="638" cy="140" r="2.5" fill="#f4f4f0"/>
                                <circle cx="654" cy="140" r="2.5" fill="#f4f4f0"/>
                                <polygon points="622,160 636,160 624,174" fill="#212120" stroke="#f4f4f0" stroke-width="2"/>
                            </g>
                            {{-- Orang duduk bersila --}}
                            <circle cx="648" cy="212" r="14" fill="#1a1a18" stroke="#f4f4f0" stroke-width="2.5"/>
                            <line x1="638" y1="208" x2="658" y2="208" stroke="#f4f4f0" stroke-width="2"/>
                            <circle cx="644" cy="213" r="1.5" fill="#f4f4f0"/>
                            <circle cx="652" cy="213" r="1.5" fill="#f4f4f0"/>
                            <path d="M648,226 C630,226 626,250 630,272" stroke="#f4f4f0" stroke-width="3.5" stroke-linecap="round" fill="none"/>
                            {{-- Kaki bersila --}}
                            <path d="M634,320 C640,306 656,306 662,320" stroke="#f4f4f0" stroke-width="3" stroke-linecap="round" fill="none"/>
                            <path d="M628,326 C638,314 658,314 668,326" stroke="#f4f4f0" stroke-width="3" stroke-linecap="round" fill="none"/>
                            {{-- Buku terbuka di pangkuan --}}
                            <polygon points="608,290 644,278 644,312 608,322" fill="#f4f4f0" stroke="#111110" stroke-width="1.5"/>
                            <polygon points="680,290 644,278 644,312 680,322" fill="#f4f4f0" stroke="#111110" stroke-width="1.5"/>
                            <line x1="644" y1="278" x2="644" y2="312" stroke="#111110" stroke-width="1.5"/>
                            <line x1="620" y1="292" x2="636" y2="288" stroke="#737370" stroke-width="1.5"/>
                            <line x1="620" y1="300" x2="636" y2="296" stroke="#737370" stroke-width="1.5"/>
                            <line x1="652" y1="288" x2="668" y2="292" stroke="#737370" stroke-width="1.5"/>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="580" y="52" width="160" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="660" y="74" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">Cerita →</text>
                            </g>
                        </g>

                        {{-- ░░ ZONA 4 · MENU — cup SSST besar (pusat) → section #menu ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Menu kopi SSST"
                           @click="scrollTo('#menu')" @keydown.enter="scrollTo('#menu')">
                            {{-- Steam (animated) --}}
                            <g class="steam" fill="none" stroke="#737370" stroke-width="2.5" stroke-linecap="round">
                                <path d="M818,148 Q823,136 818,124"/>
                                <path d="M848,144 Q853,132 848,120"/>
                                <path d="M878,148 Q883,136 878,124"/>
                            </g>
                            {{-- Lid --}}
                            <rect x="800" y="162" width="96" height="15" rx="5" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                            {{-- Body --}}
                            <path d="M812,177 L884,177 L872,415 L824,415 Z" fill="#2a2a28" stroke="#f4f4f0" stroke-width="2.5"/>
                            <text x="848" y="310" fill="#f4f4f0" font-family="'Creato Display',sans-serif" font-weight="900" font-size="24" text-anchor="middle" letter-spacing="-0.5">ssst</text>
                            {{-- Biji kopi kecil di kaki cup --}}
                            <ellipse cx="786" cy="408" rx="7" ry="11" transform="rotate(25 786 408)" stroke="#737370" stroke-width="1.5"/>
                            <ellipse cx="912" cy="412" rx="7" ry="11" transform="rotate(-20 912 412)" stroke="#737370" stroke-width="1.5"/>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="770" y="52" width="160" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="850" y="74" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">Menu →</text>
                            </g>
                        </g>

                        {{-- ░░ ZONA 5 · MERCH — rak gantung: kaos, totebag, tumbler → section #merch ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Merchandise SSST"
                           @click="scrollTo('#merch')" @keydown.enter="scrollTo('#merch')">
                            {{-- Rak --}}
                            <line x1="975" y1="256" x2="975" y2="430" stroke="#f4f4f0" stroke-width="3.5"/>
                            <line x1="1145" y1="256" x2="1145" y2="430" stroke="#f4f4f0" stroke-width="3.5"/>
                            <line x1="968" y1="256" x2="1152" y2="256" stroke="#f4f4f0" stroke-width="3.5" stroke-linecap="round"/>
                            {{-- Hanger + kaos --}}
                            <g class="swing">
                                <line x1="1030" y1="256" x2="1030" y2="278" stroke="#f4f4f0" stroke-width="2"/>
                                <path d="M1030,282 C1018,286 1012,296 1012,308 L1048,308 C1048,296 1042,286 1030,282 Z" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                                <text x="1030" y="304" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="900" font-size="11" fill="#f4f4f0">ssst</text>
                            </g>
                            {{-- Totebag digantung --}}
                            <g class="swing d2">
                                <path d="M1105,256 C1105,272 1105,268 1105,278" stroke="#f4f4f0" stroke-width="2"/>
                                <path d="M1092,280 C1092,268 1118,268 1118,280" stroke="#f4f4f0" stroke-width="2.5" fill="none"/>
                                <path d="M1084,280 L1126,280 L1122,352 L1088,352 Z" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                                <circle cx="1097" cy="308" r="2" fill="#f4f4f0"/>
                                <circle cx="1113" cy="308" r="2" fill="#f4f4f0"/>
                                <path d="M1099,318 Q1105,323 1111,318" stroke="#f4f4f0" stroke-width="1.5" fill="none"/>
                            </g>
                            {{-- Tumbler di tanah --}}
                            <rect x="1158" y="376" width="18" height="46" rx="6" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                            <rect x="1161" y="368" width="12" height="10" rx="3" fill="#f4f4f0"/>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="980" y="52" width="160" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="1060" y="74" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">Merch →</text>
                            </g>
                        </g>

                        {{-- ░░ ZONA 6 · ABOUT — orang selfie (sosmed) → footer #about ░░ --}}
                        <g class="illo" tabindex="0" role="button" aria-label="Tentang SSST & sosial media"
                           @click="scrollTo('#about')" @keydown.enter="scrollTo('#about')">
                            {{-- Orang berdiri membelakangi (selfie) --}}
                            <circle cx="1235" cy="196" r="14" fill="#1a1a18" stroke="#f4f4f0" stroke-width="2.5"/>
                            <path d="M1224,192 C1227,183 1243,183 1246,192" fill="#f4f4f0"/>
                            <line x1="1235" y1="210" x2="1235" y2="290" stroke="#f4f4f0" stroke-width="3.5" stroke-linecap="round"/>
                            {{-- Lengan pegang HP --}}
                            <polyline points="1235,228 1272,222 1296,206" stroke="#f4f4f0" stroke-width="3" stroke-linecap="round" fill="none"/>
                            <rect x="1288" y="188" width="26" height="42" rx="5" fill="#212120" stroke="#f4f4f0" stroke-width="2.5"/>
                            <circle cx="1301" cy="196" r="2.5" fill="#f4f4f0"/>
                            {{-- Kaki --}}
                            <line x1="1235" y1="290" x2="1222" y2="352" stroke="#f4f4f0" stroke-width="3" stroke-linecap="round"/>
                            <line x1="1235" y1="290" x2="1250" y2="352" stroke="#f4f4f0" stroke-width="3" stroke-linecap="round"/>
                            <rect x="1212" y="350" width="20" height="8" rx="3" fill="#f4f4f0"/>
                            <rect x="1244" y="350" width="20" height="8" rx="3" fill="#f4f4f0"/>
                            {{-- Love / like melayang (animated) --}}
                            <g class="heart" fill="#f4f4f0">
                                <path d="M1326,150 C1326,142 1318,142 1318,150 C1318,142 1310,142 1310,150 C1310,158 1318,164 1318,164 C1318,164 1326,158 1326,150 Z" transform="scale(1.15) translate(-46,-22)"/>
                            </g>
                            <g class="heart d2" fill="none" stroke="#f4f4f0" stroke-width="2">
                                <path d="M1356,112 C1356,106 1350,106 1350,112 C1350,106 1344,106 1344,112 C1344,118 1350,122 1350,122 C1350,122 1356,118 1356,112 Z"/>
                            </g>
                            {{-- Sparkle --}}
                            <path d="M1330,80 L1330,92 M1324,86 L1336,86" stroke="#737370" stroke-width="2" stroke-linecap="round"/>
                            {{-- Chip label --}}
                            <g class="illo-label">
                                <rect x="1215" y="52" width="160" height="32" rx="16" fill="#f4f4f0"/>
                                <text x="1295" y="74" text-anchor="middle" font-family="'Creato Display',sans-serif" font-weight="700" font-size="14" fill="#111110">About →</text>
                            </g>
                        </g>

                        {{-- ░░ Ambient: beans floating + burung + semak kecil ░░ --}}
                        <g class="beans" opacity="0.18" stroke="#f4f4f0" stroke-width="1.5" fill="none">
                            <ellipse cx="360" cy="330" rx="7" ry="11" transform="rotate(25 360 330)"/>
                            <path d="M360 320 Q356 330 360 340"/>
                            <ellipse cx="760" cy="90" rx="7" ry="11" transform="rotate(-30 760 90)"/>
                            <path d="M760 80 Q764 90 760 100"/>
                            <ellipse cx="1180" cy="140" rx="6" ry="10" transform="rotate(40 1180 140)"/>
                        </g>
                        <path d="M960,70 Q966,62 972,70 Q978,62 984,70" stroke="#737370" stroke-width="2" fill="none"/>
                        <path d="M300,420 Q306,412 312,420 Q318,412 324,420" stroke="#737370" stroke-width="2" fill="none"/>
                        <g stroke="#737370" stroke-width="2" stroke-linecap="round">
                            <line x1="705" y1="430" x2="705" y2="418"/>
                            <line x1="711" y1="430" x2="714" y2="420"/>
                            <line x1="699" y1="430" x2="696" y2="420"/>
                        </g>

                    </svg>

                    {{-- ── Cursor spotlight — glow mengikuti kursor ── --}}
                    <div class="spotlight" aria-hidden="true"></div>
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     02 · MENU
═══════════════════════════════════════════════ --}}
<section id="menu" class="theme-light"
    x-data="{
        activeTab: '{{ $categories->first()->slug ?? 'coffee' }}',
        sel: 0,
        imgOk: true,
        items: {{ Js::from($allItems) }},
        get visible() { return this.items.filter(i => i.cat === this.activeTab); },
        get cur() { return this.items[this.sel]; }
    }"
    style="padding: 6rem 0; background: var(--black); border-bottom: 1px solid var(--border);">
    <div class="section-wrap">
        <div class="menu-split">

            {{-- KIRI — foto item yang dipilih (klik item di kanan untuk ganti) --}}
            <div class="menu-photo">
                {{-- Foto otomatis dari public/images/menu/{nama-item}.jpg/png/webp --}}
                <img x-show="cur && cur.img && imgOk" :src="cur && cur.img" :alt="cur ? cur.name : 'SSST Coffee'"
                     style="width:100%; height:100%; object-fit:cover; display:block;"
                     x-on:error="imgOk = false" x-on:load="imgOk = true">
                <div class="img-placeholder" x-show="!cur || !cur.img || !imgOk" style="height:100%;">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9l4-4 4 4 4-4 4 4"/><circle cx="8" cy="15" r="2"/></svg>
                    <span x-text="cur ? 'Foto: ' + cur.name : 'Foto lini produk SSST'"></span>
                </div>
                <p class="menu-photo-label f-accent" x-text="cur ? cur.name + '.' : 'Lini produk SSST.'"></p>
            </div>

            {{-- KANAN — katalog menu --}}
            <div class="menu-catalog">

                {{-- Header --}}
                <div style="display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div>
                        <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Menu</p>
                        <h2 class="t-h1 c-white">Ringkas,<br>familiar.</h2>
                    </div>

                    {{-- Delivery Partners --}}
                    <div>
                        <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Pesan antar via</p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            {{-- TODO: ganti # dengan URL GrabFood outlet --}}
                            <a href="#" target="_blank" rel="noopener" class="partner-badge">
                                <span style="width:8px; height:8px; border-radius:50%; background:#00b14f; flex-shrink:0;"></span>
                                GrabFood
                            </a>
                            {{-- TODO: ganti # dengan URL GoFood outlet --}}
                            <a href="#" target="_blank" rel="noopener" class="partner-badge">
                                <span style="width:8px; height:8px; border-radius:50%; background:#e62129; flex-shrink:0;"></span>
                                GoFood
                            </a>
                            {{-- TODO: ganti # dengan URL ShopeeFood outlet --}}
                            <a href="#" target="_blank" rel="noopener" class="partner-badge">
                                <span style="width:8px; height:8px; border-radius:50%; background:#f05123; flex-shrink:0;"></span>
                                ShopeeFood
                            </a>
                        </div>
                    </div>
                </div>

        {{-- Category Tabs --}}
        <div style="display: flex; gap: 0.5rem; overflow-x: auto; padding-bottom: 1.5rem; margin-bottom: 0.5rem;" class="no-scrollbar">
            @foreach($categories as $cat)
                <button
                    type="button"
                    class="tab-btn"
                    :class="activeTab === '{{ $cat->slug }}' ? 'active' : ''"
                    @click="activeTab = '{{ $cat->slug }}'; sel = items.findIndex(i => i.cat === '{{ $cat->slug }}'); imgOk = true"
                >{{ $cat->name }}</button>
            @endforeach
        </div>

        {{-- Daftar item — klik untuk lihat foto & keterangan di panel kiri --}}
        <div style="display: flex; flex-direction: column; gap: 0.35rem;">
            <template x-for="(it, idx) in visible" :key="it.name + idx">
                <button type="button" class="menu-item-btn"
                        :class="sel === items.indexOf(it) ? 'active' : ''"
                        @click="sel = items.indexOf(it); imgOk = true">
                    <span class="mi-name" x-text="it.name"></span>
                    <span class="mi-desc" x-text="it.description"></span>
                </button>
            </template>
            <p class="c-mid" x-show="visible.length === 0" style="padding: 1.5rem 1rem; font-size: 0.9rem;">Belum ada item.</p>
        </div>

            </div>{{-- /menu-catalog --}}
        </div>{{-- /menu-split --}}
    </div>
</section>


{{-- ═══════════════════════════════════════════════
     03 · MERCH — Tokopedia Integration
═══════════════════════════════════════════════ --}}
<section id="merch" style="padding: 6rem 0; background: var(--dark); border-bottom: 1px solid var(--border);">
    <div class="section-wrap">

        <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Merchandise</p>
        <div style="display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 3.5rem;">
            <h2 class="f-display t-h1 c-white">Bawa pulang<br>yang lain.</h2>
            <p class="t-body c-light" style="max-width: 40ch;">Hanya tersedia melalui official store Tokopedia. Tidak ada transaksi di sini.</p>
        </div>

        {{-- Merch Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
            @foreach($products as $prod)
            <div style="background: var(--card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; transition: border-color 0.2s, transform 0.2s;" onmouseover="this.style.borderColor='var(--mid)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='translateY(0)'">

                {{-- Product image --}}
                <div style="aspect-ratio: 1; background: var(--black); padding: 1.25rem; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--border);">
                    @if($prod->image_url && !str_starts_with($prod->image_url, '/images/merch'))
                        <img src="{{ asset($prod->image_url) }}" alt="{{ $prod->name }}" style="width:100%; height:100%; object-fit:contain;">
                    @else
                        {{--
                            TODO: Ganti dengan:
                            <img src="/images/merch/{{ Str::slug($prod->name) }}.jpg" alt="{{ $prod->name }}"
                                 style="width:100%; height:100%; object-fit:contain;">
                        --}}
                        <div style="width:100%; height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:0.5rem;">
                            <svg width="32" height="32" fill="none" stroke="var(--border)" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9l4-4 4 4 4-4 4 4"/><circle cx="8" cy="15" r="2"/></svg>
                            <span class="t-label" style="color:var(--border);">Foto menyusul</span>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="padding: 1.1rem 1.25rem 1.25rem;">
                    <p class="c-white" style="font-weight:700; font-size:0.88rem; margin-bottom:0.25rem;">{{ $prod->name }}</p>
                    <p class="c-mid" style="font-size:0.72rem; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $prod->description }}</p>
                    <div style="display:flex; align-items:center; justify-content:space-between; margin-top:1rem; padding-top:0.75rem; border-top: 1px solid var(--border);">
                        <span class="c-white" style="font-weight:800; font-size:0.9rem;">{{ $prod->formatted_price }}</span>
                        {{-- TODO: ganti href dengan URL Tokopedia produk ini --}}
                        <a href="{{ $prod->tokopedia_url ?: '#' }}" target="_blank" rel="noopener" style="font-size:0.7rem; font-weight:700; letter-spacing:0.08em; color:#03ac0e; text-decoration:none; text-transform:uppercase; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                            Tokopedia ↗
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- Sync badge --}}
        <div style="margin-top: 2rem; display: flex; align-items: center; justify-content: flex-end; gap: 0.5rem;">
            <span style="width:6px; height:6px; border-radius:50%; background:#03ac0e;"></span>
            <span class="t-label c-mid">Tokopedia API Ready</span>
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     04 · GALLERY
═══════════════════════════════════════════════ --}}
<section id="gallery" class="theme-light" style="padding: 6rem 0; background: var(--dark); border-bottom: 1px solid var(--border);">
    <div style="max-width: 1320px; margin: 0 auto;">

        {{-- Header (full width) --}}
        <div style="padding: 0 1.5rem; margin-bottom: 3rem;">
            <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Galeri</p>
            <h2 class="f-display t-h1 c-white">Momen-momen<br>di SSST.</h2>
        </div>

        {{-- Horizontal scroll gallery --}}
        <div class="gallery-track" style="padding: 0 1.5rem 1.5rem;">

            {{-- TODO: Ganti setiap div.gallery-item dengan foto nyata --}}
            {{-- FORMAT:
                <div class="gallery-item">
                    <img src="/images/gallery/nama-file.jpg" alt="Deskripsi"
                         style="width:100%; height:100%; object-fit:cover;">
                    <div style="position:absolute; bottom:0; left:0; right:0; padding:1.25rem; background:linear-gradient(transparent, rgba(17,17,16,0.9));">
                        <p class="t-label c-mid">Label Event</p>
                        <p class="c-white" style="font-weight:600; font-size:0.9rem;">Keterangan foto</p>
                    </div>
                </div>
            --}}

            @for($g = 1; $g <= 8; $g++)
            <div class="gallery-item">
                <div class="img-placeholder" style="border-radius:16px;">
                    <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9l4-4 4 4 4-4 4 4"/><circle cx="8" cy="15" r="2"/></svg>
                    <span>Foto {{ $g }}</span>
                </div>
                <div style="position:absolute; bottom:0; left:0; right:0; padding:1.25rem; background:linear-gradient(transparent, rgba(17,17,16,0.88)); border-bottom-left-radius:16px; border-bottom-right-radius:16px;">
                    <p class="t-label" style="color:var(--mid); margin-bottom:0.25rem;">Event / Keseharian</p>
                    <p class="c-light" style="font-weight:600; font-size:0.88rem;">Isi keterangan foto di sini</p>
                </div>
            </div>
            @endfor

        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     05 · CERITA SSST COFFEE
═══════════════════════════════════════════════ --}}
<section id="cerita" class="theme-light" style="padding: 6rem 0; background: var(--black); border-bottom: 1px solid var(--border);">
    <div class="section-wrap">

        <div class="grid-2">

            {{-- Left: Story --}}
            <div>
                <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Cerita</p>
                <h2 class="f-display t-h1 c-white" style="margin-bottom: 2rem;">
                    Titik singgah,<br>bukan destinasi.
                </h2>
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <p class="t-body c-light">
                        SSST hidup di antara momen-momen kecil dalam keseharian. Setelah makan, sebelum pulang, setelah berolahraga, atau saat berpindah dari satu tempat ke tempat lain.
                    </p>
                    <p class="t-body c-light">
                        Kopi bukan lagi tujuan utama, melainkan pelengkap yang menyatu dalam ritme aktivitas. Servisnya cepat, rasanya mudah diterima, dan menunya familiar.
                    </p>
                    <p class="t-body c-light">
                        Pilihan yang aman buat dipesan tanpa mikir panjang.
                    </p>
                </div>
            </div>

            {{-- Right: 4 Pillars + 3 Moments --}}
            <div>
                {{-- 4S Pillars --}}
                <div style="border-top: 1px solid var(--border); margin-bottom: 3rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0;">
                        @foreach([['Source','Starts from the right source'],['Strategy','Developed with a strategy'],['Service','Delivered with great service'],['Team','Crafted by our passionate team']] as $pillar)
                        <div class="pillar-item">
                            <h4 class="f-heading c-white" style="font-size:1.3rem; margin-bottom:0.35rem;">{{ $pillar[0] }}</h4>
                            <p class="c-mid" style="font-size:0.78rem; line-height:1.5;">{{ $pillar[1] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- 3 Moments --}}
                <p class="t-label c-mid" style="margin-bottom: 1rem;">Momen Singgah</p>
                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                    @foreach([
                        ['SETELAH MAKAN', '"Abis makan, ngopi dulu yuk."'],
                        ['SETELAH OLAHRAGA', '"Habis lari, enaknya yang seger."'],
                        ['DI JALAN', '"Sekalian beli buat di jalan."']
                    ] as $m)
                    <div style="background: var(--card); border: 1px solid var(--border); border-radius: 14px; padding: 1.25rem 1.5rem;">
                        <p class="t-label c-mid" style="margin-bottom:0.5rem;">{{ $m[0] }}</p>
                        <p class="f-accent c-white" style="font-size:1.35rem;">{{ $m[1] }}</p>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     06 · OUTLET / LOKASI
═══════════════════════════════════════════════ --}}
<section id="outlet" style="padding: 6rem 0; background: var(--black); border-bottom: 1px solid var(--border);">
    <div class="section-wrap">

        {{-- Header --}}
        <div style="display: flex; align-items: flex-end; justify-content: space-between; flex-wrap: wrap; gap: 2rem; margin-bottom: 4rem;">
            <div>
                <p class="t-label c-mid" style="margin-bottom: 0.75rem;">Lokasi</p>
                <h2 class="f-display t-h1 c-white">
                    07.00<br>21.00
                </h2>
            </div>
            <div>
                <p class="t-body c-light" style="max-width:38ch; margin-bottom:1.5rem;">
                    Buka dari pagi sampai malam. Mampir sebelum jalan, sesudah makan, atau pas pulang.
                </p>
                <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                    <a href="https://instagram.com/ssstcoffee" target="_blank" rel="noopener" class="partner-badge">@ssstcoffee</a>
                    <a href="https://wa.me/6287156178190" target="_blank" rel="noopener" class="partner-badge">(62) 8715 6178 190</a>
                </div>
            </div>
        </div>

        {{-- Outlet Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(360px, 100%), 1fr)); gap: 1rem;">
            @foreach($outlets as $outlet)
            <div class="outlet-card" style="border-radius: 20px; overflow: hidden; min-height: 380px;">

                {{-- Ambience photo --}}
                <div style="width:100%; height:100%; position:absolute; inset:0;">
                    {{--
                        TODO: Ganti div placeholder ini dengan:
                        <img src="/images/outlets/{{ Str::slug($outlet->name) }}.jpg"
                             alt="{{ $outlet->name }}"
                             style="width:100%; height:100%; object-fit:cover;">
                    --}}
                    <div class="img-placeholder" style="height:100%; border-radius:20px;">
                        <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9l4-4 4 4 4-4 4 4"/><circle cx="8" cy="15" r="2"/></svg>
                        <span>Foto Ambience {{ $outlet->name }}</span>
                    </div>
                </div>

                {{-- Overlay gradient + info --}}
                <div class="outlet-overlay" style="position:absolute; bottom:0; left:0; right:0;">
                    {{-- Always visible --}}
                    <p class="t-label c-mid" style="margin-bottom:0.4rem;">{{ strtoupper($outlet->city) }}</p>
                    <h3 class="f-heading c-white" style="font-size:1.6rem; letter-spacing:-0.02em;">{{ $outlet->name }}</h3>

                    {{-- Hover reveals (detail) --}}
                    <div class="outlet-detail">
                        <p class="t-body c-light" style="margin: 0.75rem 0 1rem; font-size:0.85rem;">{{ $outlet->address }}</p>

                        {{-- Hours + Maps CTA --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:1rem;">
                            <div style="display:flex; align-items:center; gap:0.5rem;">
                                <span style="width:7px; height:7px; border-radius:50%; background:#4ade80;"></span>
                                <span class="t-label" style="color:var(--light);">{{ $outlet->opening_hours }} — Setiap Hari</span>
                            </div>

                            {{-- TODO: ganti maps_url dengan URL Google Maps outlet ini --}}
                            @if($outlet->maps_url)
                            <a href="{{ $outlet->maps_url }}" target="_blank" rel="noopener"
                               style="display:inline-flex; align-items:center; gap:0.4rem; padding:0.5rem 1rem; background:var(--white); color:var(--black); border-radius:100px; font-size:0.72rem; font-weight:700; letter-spacing:0.06em; text-decoration:none; text-transform:uppercase; transition:background 0.2s; flex-shrink:0;"
                               onmouseover="this.style.background='var(--cream)'" onmouseout="this.style.background='var(--white)'">
                                Buka Maps ↗
                            </a>
                            @endif
                        </div>

                        {{-- Delivery links per outlet --}}
                        <div style="margin-top:1rem; display:flex; flex-wrap:wrap; gap:0.5rem;">
                            {{-- TODO: ganti # dengan URL GrabFood/GoFood/ShopeeFood outlet {{ $outlet->name }} --}}
                            <a href="#" target="_blank" rel="noopener" class="partner-badge" style="padding:0.35rem 0.75rem; font-size:0.65rem;">
                                <span style="width:6px;height:6px;border-radius:50%;background:#00b14f;flex-shrink:0;"></span>GrabFood
                            </a>
                            <a href="#" target="_blank" rel="noopener" class="partner-badge" style="padding:0.35rem 0.75rem; font-size:0.65rem;">
                                <span style="width:6px;height:6px;border-radius:50%;background:#e62129;flex-shrink:0;"></span>GoFood
                            </a>
                            <a href="#" target="_blank" rel="noopener" class="partner-badge" style="padding:0.35rem 0.75rem; font-size:0.65rem;">
                                <span style="width:6px;height:6px;border-radius:50%;background:#f05123;flex-shrink:0;"></span>ShopeeFood
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- ═══════════════════════════════════════════════
     07 · FOOTER
═══════════════════════════════════════════════ --}}
<footer id="about" style="background: var(--dark); border-top: 1px solid var(--border); padding: 5rem 0 3rem; scroll-margin-top: 80px;">
    <div class="section-wrap">

        {{-- Top row: Brand + Social + Nav --}}
        <div class="footer-grid">

            {{-- Brand --}}
            <div>
                <a href="#" class="nav-logo" style="display:block; margin-bottom:1rem;" aria-label="SSST Coffee">
                    <img src="{{ asset('images/logo.png') }}" alt="SSST Coffee" style="height: 48px; width: auto; display: block;">
                </a>
                <p class="t-body c-mid" style="max-width:38ch; margin-bottom:1.75rem;">
                    Coffee Companion / Lifestyle Compliment.<br>
                    Titik singgah buat ngopi di sela aktivitas harian.
                </p>
                {{-- Social --}}
                <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                    {{-- TODO: isi href dengan URL Instagram / TikTok / dll --}}
                    <a href="https://instagram.com/ssstcoffee" target="_blank" rel="noopener" class="partner-badge">Instagram</a>
                    <a href="https://www.tokopedia.com" target="_blank" rel="noopener" class="partner-badge">Tokopedia</a>
                    <a href="https://wa.me/6287156178190" target="_blank" rel="noopener" class="partner-badge">WhatsApp</a>
                    {{-- TODO: tambah TikTok / YouTube jika ada --}}
                </div>
            </div>

            {{-- Navigasi --}}
            <div>
                <p class="t-label c-mid" style="margin-bottom:1.25rem;">Navigasi</p>
                <ul style="list-style:none; display:flex; flex-direction:column; gap:0.85rem;">
                    @foreach(['Menu' => '#menu', 'Merch' => '#merch', 'Galeri' => '#gallery', 'Cerita' => '#cerita', 'Lokasi' => '#outlet'] as $label => $href)
                    <li>
                        <a href="{{ $href }}" style="font-family:var(--font-body); font-size:0.88rem; font-weight:500; color:var(--light); text-decoration:none; transition:color 0.2s;" onmouseover="this.style.color='var(--white)'" onmouseout="this.style.color='var(--light)'">{{ $label }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Info --}}
            <div>
                <p class="t-label c-mid" style="margin-bottom:1.25rem;">Info</p>
                <div style="display:flex; flex-direction:column; gap:1rem;">
                    <div>
                        <p class="t-label c-mid" style="margin-bottom:0.3rem;">Jam Buka</p>
                        <p class="f-heading c-white" style="font-size:1.1rem;">07.00 — 21.00</p>
                        <p class="c-mid" style="font-size:0.78rem;">Setiap Hari</p>
                    </div>
                    <div>
                        <p class="t-label c-mid" style="margin-bottom:0.3rem;">Kota</p>
                        <p class="c-light" style="font-size:0.88rem; font-weight:500;">Bandung, Jawa Barat</p>
                    </div>
                    <div>
                        <p class="t-label c-mid" style="margin-bottom:0.3rem;">Kontak</p>
                        <a href="https://wa.me/6287156178190" style="font-size:0.85rem; color:var(--light); text-decoration:none; font-weight:500;">(62) 8715 6178 190</a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom row --}}
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:1rem; padding-top:2rem;">
            <p class="c-mid" style="font-size:0.78rem;">&copy; {{ date('Y') }} SSST Coffee. All rights reserved.</p>
            <p class="f-display c-mid" style="font-size:1rem; letter-spacing:-0.01em;">#AlwaySSST</p>
        </div>

    </div>
</footer>


</body>
</html>
