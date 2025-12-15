<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <h5>Mata Pelajaran: <strong><?= $mapel['name_mapel']; ?></strong></h5>
    <h6>Kode Mapel: <?= $mapel['code_mapel']; ?></h6>

    <hr>

    <!-- Tombol tambah deskripsi -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addDeskripsiModal">
        <i class="fas fa-plus"></i> Tambah Deskripsi
    </button>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($deskripsi_list as $d): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $d['deskripsi']; ?></td>
                <td>
                    <!-- Tombol Edit, akan membuka modal edit -->
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editDeskripsiModal<?= $d['id'] ?>">
                    Edit
                </button>
                    <a href="<?= base_url('mapel/hapus_deskripsi/' . $d['id'] . '/' . $mapel['id']); ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin hapus deskripsi ini?')">Hapus</a>
                </td>
            </tr>
            <!-- Modal Edit Deskripsi -->
            <div class="modal fade" id="editDeskripsiModal<?= $d['id'] ?>" tabindex="-1" aria-labelledby="editDeskripsiModalLabel<?= $d['id'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url('mapel/edit_deskripsi/' . $d['id'] . '/' . $mapel['id']); ?>" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDeskripsiModalLabel<?= $d['id'] ?>">Edit Deskripsi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <textarea class="form-control" name="deskripsi" rows="4" required><?= htmlspecialchars($d['deskripsi']); ?></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>

<!-- Modal Tambah Deskripsi -->
<div class="modal fade" id="addDeskripsiModal" tabindex="-1" aria-labelledby="addDeskripsiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('mapel/tambah_deskripsi/' . $mapel['id']); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addDeskripsiModalLabel">Tambah Deskripsi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="deskripsi" rows="4" placeholder="Tulis deskripsi di sini..." required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
