<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- Tombol trigger modal -->
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newJurusanModal">Add New Jurusan</a>

    <div class="col-md-8">
        <table class="table table-hover  table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Deskripsi</th>
                    <th>code_jurusan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($jurusan as $j): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $j['name']; ?></td>
                        <td><?= $j['deskripsi']; ?></td>
                        <td><?= $j['code_jurusan']; ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <a href="<?= base_url('jurusan/edit/' . $j['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                            
                            <!-- Tombol Delete -->
                            <a href="<?= base_url('jurusan/delete/' . $j['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
                </div>
<!-- Modal Add New Jurusan -->
<div class="modal fade" id="newJurusanModal" tabindex="-1" aria-labelledby="newJurusanModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('jurusan/add'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="newJurusanModalLabel">Add New Jurusan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="name">Nama Jurusan</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama jurusan" required>
          </div>
          <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi jurusan" required></textarea>
          </div>
          <div class="form-group mb-3">
            <label for="code_jurusan">Kode Jurusan</label>
            <input type="text" class="form-control" id="code_jurusan" name="code_jurusan" placeholder="Kode jurusan" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

