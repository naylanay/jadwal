<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <form action="<?= base_url('manajemenjadwal/tambah_jadwal'); ?>" method="POST">
                
                <?= $this->session->flashdata('message'); ?>
                
                <h3>Formulir Tambah Jadwal Pelajaran</h3>
                
                <div class="">
            <label for="kelas" class="form-label">Kelas</label>
            <select id="kelas" name="id_kelas" class="form-select" required>
                <option value="" selected>-- Pilih Kelas --</option>
                <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k->id; ?>">
                        <?= $k->nama_kelas; ?> (<?= $k->nama_jurusan; ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
                <div class="form-group">
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
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tahun_ajaran">Tahun Ajaran:</label>
                        <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control" value="<?= set_value('tahun_ajaran', '2025/2026'); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="semester">Semester:</label>
                        <select name="semester" id="semester" class="form-control" required>
                            <option value="Ganjil" <?= set_select('semester', 'Ganjil'); ?>>Ganjil</option>
                            <option value="Genap" <?= set_select('semester', 'Genap'); ?>>Genap</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="hari">Hari:</label>
                        <select name="hari" id="hari" class="form-control" required>
                            <option value="">-- Pilih Hari --</option>
                            <option value="Senin" <?= set_select('hari', 'Senin'); ?>>Senin</option>
                            <option value="Selasa" <?= set_select('hari', 'Selasa'); ?>>Selasa</option>
                            <option value="Rabu" <?= set_select('hari', 'Rabu'); ?>>Rabu</option>
                            <option value="Kamis" <?= set_select('hari', 'Kamis'); ?>>Kamis</option>
                            <option value="Jumat" <?= set_select('hari', 'Jumat'); ?>>Jumat</option>
                        </select>
                        <?= form_error('hari', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
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

                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan Jadwal</button>
            </form>
            </div>
    </div>
</div>
                        </div>