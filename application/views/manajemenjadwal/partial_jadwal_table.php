<?php if(empty($jadwal)): ?>
    <div class="alert alert-warning">Jadwal tidak ditemukan untuk filter yang dipilih.</div>
<?php else: ?>
<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Jam</th>
            <?php foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari): ?>
                <th><?= $hari ?></th>
            <?php endforeach; ?>
             <th>Aksi</th> <!-- 🔹 Tambahkan header kolom aksi -->
        </tr>
    </thead>
    <tbody>
        <?php foreach($jam_pelajaran as $jam): ?>
            <tr>
                <td><strong><?= $jam ?></strong></td>
                <?php foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $hari): ?>
                    <td>
                        <?= isset($jadwal[$jam][$hari]) ? htmlspecialchars($jadwal[$jam][$hari]['mapel']) : '-' ?>
                    </td>
                <?php endforeach; ?>

                <!-- 🔹 Kolom aksi di ujung kanan -->
                <td>
                    <?php 
                    // Ambil ID jadwal dari salah satu hari (jika ada)
                    $id_jadwal = null;
                    foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'] as $h) {
                        if (isset($jadwal[$jam][$h]['id'])) {
                            $id_jadwal = $jadwal[$jam][$h]['id'];
                            break;
                        }
                    }
                    ?>

                    <?php if ($id_jadwal): ?>
                        <a href="<?= base_url('manajemenjadwal/edit/'.$id_jadwal); ?>" 
                           class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('manajemenjadwal/delete/'.$id_jadwal); ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
