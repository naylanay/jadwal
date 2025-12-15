<div class="container">
    <h3>Kirim Pengingat Jadwal Besok</h3>

    <a href="<?= base_url('Reminder/kirim_jadwal_besok') ?>" class="btn btn-primary">
        KIRIM SEKARANG
    </a>

    <p class="mt-3 text-muted">
        *Tekan tombol ini untuk mengirim pengingat WhatsApp ke seluruh siswa berdasarkan jadwal besok.
    </p>

    <!-- FLASH MESSAGE -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            <?= $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
    <!-- ANIMASI 2 ANAK DI TAMAN (FULL ANIMASI + BUNGA MEKAR + PELANGI) -->
<div class="text-center mt-5 mb-5">
    <div class="school-park-anim">
        <svg width="420" height="350" viewBox="0 0 420 350" xmlns="http://www.w3.org/2000/svg">

            <!-- PELANGI -->
            <!-- PELANGI SETENGAH -->
            <g class="rainbow">
                <path d="M50 260 A160 160 0 0 1 370 260" stroke="red" stroke-width="12" fill="none"/>
                <path d="M65 260 A145 145 0 0 1 355 260" stroke="orange" stroke-width="12" fill="none"/>
                <path d="M80 260 A130 130 0 0 1 340 260" stroke="yellow" stroke-width="12" fill="none"/>
                <path d="M95 260 A115 115 0 0 1 325 260" stroke="green" stroke-width="12" fill="none"/>
                <path d="M110 260 A100 100 0 0 1 310 260" stroke="blue" stroke-width="12" fill="none"/>
                <path d="M125 260 A85 85 0 0 1 295 260" stroke="indigo" stroke-width="12" fill="none"/>
                <path d="M140 260 A70 70 0 0 1 280 260" stroke="violet" stroke-width="12" fill="none"/>
            </g>

            <!-- RUMPUT -->
            <ellipse class="grass" cx="210" cy="290" rx="190" ry="40" fill="#8FE88A" />

            <!-- AWAN BERGERAK -->
            <g class="cloud cloud1">
                <circle cx="70" cy="40" r="20" fill="#fff" />
                <circle cx="90" cy="40" r="25" fill="#fff" />
                <circle cx="110" cy="40" r="20" fill="#fff" />
            </g>

            <g class="cloud cloud2">
                <circle cx="290" cy="70" r="20" fill="#fff" />
                <circle cx="310" cy="70" r="25" fill="#fff" />
                <circle cx="330" cy="70" r="20" fill="#fff" />
            </g>

            <!-- BURUNG -->
            <path id="birdPath" d="M120 140 C 260 20, 330 220, 180 270 C 60 220, 60 90, 120 140" fill="none" stroke="none"/>
            <g class="bird">
                <path d="M0 0 L6 3 L0 6 Z" fill="black"/>
            </g>

            <!-- SEKOLAH -->
            <rect x="130" y="90" width="170" height="90" fill="#FFCE73" stroke="#C48A3B" stroke-width="3"/>
            <rect x="165" y="115" width="90" height="60" fill="#FFFFFF" stroke="#C48A3B" stroke-width="3"/>
            <polygon points="130,90 215,40 300,90" fill="#E08A7B"/>
            <text x="215" y="83" font-size="15" text-anchor="middle" fill="#fff" font-weight="bold">SCHOOL</text>

            <!-- POHON KANAN -->
            <rect x="330" y="180" width="18" height="70" fill="#7B4A1F" />
            <circle class="treeleaf" cx="339" cy="165" r="40" fill="#62C95C" />

            <!-- POHON KIRI -->
            <rect x="60" y="180" width="18" height="70" fill="#7B4A1F" />
            <circle class="treeleaf" cx="69" cy="165" r="40" fill="#62C95C" />

            <!-- BUNGA-BUNGA MEKAR -->
            <g class="flower-group">
                <g class="flower f1">
                    <circle cx="120" cy="270" r="0" fill="pink"/>
                    <circle cx="120" cy="270" r="0" fill="yellow" />
                </g>
                <g class="flower f2">
                    <circle cx="200" cy="280" r="0" fill="#ff69b4"/>
                    <circle cx="200" cy="280" r="0" fill="yellow" />
                </g>
                <g class="flower f3">
                    <circle cx="280" cy="270" r="0" fill="#ffa6d1"/>
                    <circle cx="280" cy="270" r="0" fill="yellow" />
                </g>
            </g>

            <!-- ANAK 1 -->
            <g class="kid1">
                <circle cx="150" cy="210" r="28" fill="#FFD39F" />
                <circle class="eye1a" cx="140" cy="205" r="3" fill="#000"/>
                <circle class="eye1b" cx="160" cy="205" r="3" fill="#000"/>
                <path d="M140 220 Q150 230 160 220" stroke="#000" fill="none" stroke-width="2"/>
                <path d="M130 190 Q150 175 170 190" fill="#3A2A1A"/>
                <rect x="132" y="235" width="45" height="65" rx="14" fill="#4F8CFF"/>
            </g>

            <!-- Buku -->
            <rect class="book-glow" x="128" y="220" width="55" height="32" fill="#fff" stroke="#ccc"/>
            <line x1="155" y1="220" x2="155" y2="252" stroke="#ccc"/>

            <!-- ANAK 2 -->
            <g class="kid2">
                <circle cx="270" cy="210" r="28" fill="#FFD39F" />
                <circle class="eye2a" cx="260" cy="205" r="3" fill="#000"/>
                <circle class="eye2b" cx="280" cy="205" r="3" fill="#000"/>
                <path d="M260 220 Q270 230 280 220" stroke="#000" fill="none" stroke-width="2"/>
                <path d="M250 190 Q270 175 290 190" fill="#3A2A1A"/>
                <rect x="247" y="235" width="45" height="65" rx="14" fill="#FF8BA0"/>
            </g>

            <!-- Buku -->
            <rect class="book-glow" x="243" y="220" width="55" height="32" fill="#fff" stroke="#ccc"/>
            <line x1="270" y1="220" x2="270" y2="252" stroke="#ccc"/>

        </svg>
    </div>

    <p class="text-muted mt-3">Sistem siap mengingatkan jadwal besok 📚✨</p>
</div>

<style>
/* Floating keseluruhan */
.school-park-anim {
    animation: floaty 3s infinite ease-in-out;
}
@keyframes floaty {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
    100% { transform: translateY(0px); }
}

/* Pelangi bergerak lembut */
.rainbow {
    opacity: 0.75;
    animation: rainbowFloat 6s infinite ease-in-out;
}
@keyframes rainbowFloat {
    0% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
    100% { transform: translateY(0); }
}

/* Rumput */
.grass {
    animation: grassWave 4s infinite ease-in-out;
}
@keyframes grassWave {
    0% { transform: skewX(0deg); }
    50% { transform: skewX(3deg); }
    100% { transform: skewX(0deg); }
}

/* Awan */
.cloud {
    animation: cloudMove 14s infinite linear;
}
@keyframes cloudMove {
    0% { transform: translateX(-30px); }
    100% { transform: translateX(40px); }
}

/* Daun pohon */
.treeleaf {
    animation: leafWave 2.5s infinite ease-in-out alternate;
}
@keyframes leafWave {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(5deg); }
}

/* Burung */
.bird {
    offset-path: path("M120 140 C 260 20, 330 200, 180 270 C 60 220, 60 90, 120 140");
    animation: fly 8s infinite linear;
}
@keyframes fly {
    to { offset-distance: 100%; }
}

/* Kedipan mata */
.eye1a, .eye1b, .eye2a, .eye2b {
    animation: blink 3s infinite;
}
@keyframes blink {
    0%, 90%, 100% { transform: scaleY(1); }
    95% { transform: scaleY(0.1); }
}

/* Glow buku */
.book-glow {
    animation: bookGlow 2s infinite ease-in-out;
}
@keyframes bookGlow {
    0% { filter: drop-shadow(0px 0px 2px #fff); }
    50% { filter: drop-shadow(0px 0px 8px #fff); }
    100% { filter: drop-shadow(0px 0px 2px #fff); }
}

/* Bunga Mekar */
.flower circle {
    animation: flowerBloom 3s infinite ease-in-out;
    transform-origin: center;
}
.f1 circle { animation-delay: 0s; }
.f2 circle { animation-delay: 0.7s; }
.f3 circle { animation-delay: 1.4s; }

@keyframes flowerBloom {
    0% { r: 0; opacity: 0; }
    40% { r: 8; opacity: 1; }
    70% { r: 10; opacity: 1; }
    100% { r: 0; opacity: 0; }
}
</style>

    
</div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
