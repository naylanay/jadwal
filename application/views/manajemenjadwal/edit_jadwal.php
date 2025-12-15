<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Flash Message -->
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="<?= base_url('manajemenjadwal/edit/'.$jadwal['id']); ?>" method="POST">

                <!-- Kelas -->
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <input type="text" name="kelas" id="id_kelas" class="form-control"
                        value="<?= htmlspecialchars($jadwal['nama_kelas']); ?>" readonly>
                </div>

                <!-- Semester -->
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" name="semester" id="semester" class="form-control"
                        value="<?= htmlspecialchars($jadwal['semester']); ?>" readonly>
                </div>

                <!-- Tahun Ajaran -->
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control"
                        value="<?= htmlspecialchars($jadwal['tahun_ajaran']); ?>" readonly>
                </div>
                <!-- Hari -->
                <div class="form-group col-md-4">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="form-control" required>
                        <option value="">-- Pilih Hari --</option>
                        <?php 
                        $daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        foreach ($daftar_hari as $hari): ?>
                            <option value="<?= $hari; ?>" 
                                <?= ($hari == $jadwal['hari']) ? 'selected' : ''; ?>>
                                <?= $hari; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('hari', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>


                <!-- Jam Pelajaran -->
                <div class="form-group col-md-4">
                        <label for="id_jam">Jam Pelajaran:</label>
                        <select name="id_jam" id="id_jam" class="form-control" required>
                            <option value="">-- Pilih Jam --</option>
                            <?php foreach ($jam_pelajaran as $id => $jam) : ?>
                                <option value="<?= $id; ?>" <?= set_select('id_jam', $id); ?>>
                                    <?= $jam; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_jam', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- Mata Pelajaran -->
                <div class="form-group col-md-4">
                    <label for="id_mapel">Mata Pelajaran:</label>
                    <select name="id_mapel" id="id_mapel" class="form-control" required>
                        <option value="">-- Pilih Mapel --</option>
                        <?php foreach ($mapel as $m) : ?>
                        <option value="<?= $m['id']; ?>" <?= set_select('id_mapel', $m['id']); ?>>
                            <?= $m['name_mapel']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_mapel', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('manajemenjadwal'); ?>" class="btn btn-secondary">Kembali</a>
                </div>

            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
