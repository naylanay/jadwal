<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <form action="<?= base_url('jurusan/edit/' . $jurusan['id']); ?>" method="post">

        <div class="form-group">
            <label for="name">Nama Jurusan</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $jurusan['name']; ?>">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"><?= $jurusan['deskripsi']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="code_jurusan">Kode Jurusan</label>
            <input type="text" class="form-control" id="code_jurusan" name="code_jurusan" value="<?= $jurusan['code_jurusan']; ?>">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>
</div> 