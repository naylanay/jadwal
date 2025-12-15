<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card col-md-8 shadow">
        <div class="card-body">
            <form action="<?= base_url('mapel/edit/' . $mapel['id']); ?>" method="post">

                <div class="form-group mb-3">
                    <label for="id_kelas">Kelas</label>
                    <select class="form-control" id="id_kelas" name="id_kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= $k['id']; ?>" 
                                <?= ($k['id'] == $mapel['id_kelas']) ? 'selected' : ''; ?>>
                                <?= $k['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_kelas', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label for="name_mapel">Nama Mapel</label>
                    <input type="text" class="form-control" id="name_mapel" name="name_mapel"
                        value="<?= set_value('name_mapel', $mapel['name_mapel']); ?>" required>
                    <?= form_error('name_mapel', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label for="code_mapel">Kode Mapel</label>
                    <input type="text" class="form-control" id="code_mapel" name="code_mapel"
                        value="<?= set_value('code_mapel', $mapel['code_mapel']); ?>" required>
                    <?= form_error('code_mapel', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('mapel'); ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>
                        </div>
