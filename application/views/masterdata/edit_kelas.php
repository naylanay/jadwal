<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4 col-lg-8">
        <div class="card-body">
            <form action="<?= base_url('kelas/edit/' . $kelas['id']); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="name">Nama Kelas</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?= $kelas['name']; ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label for="id_jurusan">Jurusan</label>
                    <select name="id_jurusan" id="id_jurusan" class="form-control" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <?php foreach($jurusan as $j): ?>
                            <option value="<?= $j['id']; ?>" 
                                <?= ($j['id'] == $kelas['id_jurusan']) ? 'selected' : ''; ?>>
                                <?= $j['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="code_kelas">Kode Kelas</label>
                    <input type="text" class="form-control" id="code_kelas" name="code_kelas" 
                           value="<?= $kelas['code_kelas']; ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('kelas'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</div>
                        </div>
                        
                        