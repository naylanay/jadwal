<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

<?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahJamModal">
    Tambah Jam
</button>


    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jam)) : $no = 1; ?>
                <?php foreach ($jam as $j) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $j->jam_mulai; ?></td>
                        <td><?= $j->jam_selesai; ?></td>
                        <td>
                            <a href="<?= base_url('jam/edit/' . $j->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('jam/hapus/' . $j->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jam ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada jam pelajaran</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
            </div>
<!-- Modal Tambah Jam -->
<div class="modal fade" id="tambahJamModal" tabindex="-1" role="dialog" aria-labelledby="tambahJamLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('jam/tambah'); ?>" method="POST"> <!-- <- perbaikan di sini -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahJamLabel">Tambah Jam Pelajaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div> <!-- modal-content -->
    </form>
  </div> <!-- modal-dialog -->
</div> <!-- modal fade -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


