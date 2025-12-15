<!DOCTYPE html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<div class="container mt-4">
    <h2 class="mb-4">Pilih Kelas, Semester, dan Tahun Ajaran</h2>
    <form id="filterForm" class="row g-3">
        <div class="col-md-4">
            <label for="kelas" class="form-label">Kelas</label>
            <select id="kelas" name="id_kelas" class="form-select" required>
                <option value="" selected>-- Pilih Kelas --</option>
                <?php foreach($kelas as $k): ?>
                    <option value="<?= $k->id?>">
                        <?= htmlspecialchars($k->nama_kelas) ?> (<?= htmlspecialchars($k->nama_jurusan) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="semester" class="form-label">Semester</label>
            <select id="semester" name="semester" class="form-select" required>
                <option value="" selected>-- Pilih Semester --</option>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <input type="text" id="tahun_ajaran" name="tahun_ajaran" class="form-control" placeholder="2025/2026" required pattern="\d{4}/\d{4}">
            <div class="form-text">Format: YYYY/YYYY</div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Tampilkan Jadwal</button>
        </div>
    </form>

    <hr />
    <div id="tabel-jadwal"></div>
</div>
<!-- ANIMASI 2 ANAK DI TAMAN (VERSI KECIL + PELANGI SETENGAH) -->
<div class="text-center mt-5 mb-5">
    <div class="school-park-anim">
        <svg width="330" height="280" viewBox="0 0 420 350" xmlns="http://www.w3.org/2000/svg">

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

            <!-- AWAN -->
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
            <!-- <path id="birdPath" d="M120 140 C 260 20, 330 220, 180 270 C 60 220, 60 90, 120 140" fill="none" stroke="none"/>
            <g class="bird">
                <path d="M0 0 L6 3 L0 6 Z" fill="black"/>
            </g> -->

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

            <!-- BUNGA MEKAR -->
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

    <p class="text-muted mt-3">HI INI JADWAL📚✨</p>
</div>

                </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#filterForm').submit(function(e){
    e.preventDefault();

    var data = $(this).serialize();

    $.ajax({
        url: '<?= base_url("jadwal/get_jadwal_filtered") ?>',
        method: 'POST',
        data: data,
        beforeSend: function(){
            $('#tabel-jadwal').html('<div class="text-center my-3"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>');
        },
        success: function(res){
            $('#tabel-jadwal').html(res);
        },
        error: function(){
            $('#tabel-jadwal').html('<div class="alert alert-danger">Gagal mengambil data jadwal.</div>');
        }
    });
});
</script>
</body>
</html>
