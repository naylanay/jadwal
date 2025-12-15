<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tombol trigger modal -->
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMapelModal">
        <i class="fas fa-plus"></i> Tambah Mapel
    </a> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#filterMapelModal">Filter Mapel</button>

    

    <div class="col-md-10">
        <table id="mapelTable" class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Kelas</th>
                    <th>Nama Mapel</th>
                    <th>Kode Mapel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($mapel as $m): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $m['name']; ?></td>
                        <td><?= $m['name_mapel']; ?></td>
                        <td><?= $m['code_mapel']; ?></td>
                        <td>
                            <a href="<?= base_url('mapel/detail/' . $m['id']); ?>" class="btn btn-sm btn-info">Detail</a>
                            <!-- Tombol Edit -->
                            <a href="<?= base_url('mapel/edit/' . $m['id']); ?>" class="btn btn-sm btn-warning">Edit</a>

                            <!-- Tombol Delete -->
                            <a href="<?= base_url('mapel/delete/' . $m['id']); ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus data ini?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
                </div>

<!-- Modal Add New Mapel -->
<div class="modal fade" id="newMapelModal" tabindex="-1" aria-labelledby="newMapelModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url('mapel/add'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="newMapelModalLabel">Tambah Mata Pelajaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Dropdown Kelas -->
          <div class="form-group mb-3">
            <label for="id_kelas">Kelas</label>
            <select class="form-control" id="id_kelas" name="id_kelas" required>
              <option value="">-- Pilih Kelas --</option>
              <?php foreach ($kelas as $k): ?>
                <option value="<?= $k['id']; ?>"><?= $k['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Nama Mapel -->
          <div class="form-group mb-3">
            <label for="name_mapel">Nama Mapel</label>
            <input type="text" class="form-control" id="name_mapel" name="name_mapel" placeholder="Masukkan nama mapel" required>
          </div>

          <!-- Kode Mapel -->
          <div class="form-group mb-3">
            <label for="code_mapel">Kode Mapel</label>
            <input type="text" class="form-control" id="code_mapel" name="code_mapel" placeholder="Masukkan kode mapel" required>
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

<!-- Modal Filter Mapel -->
<div class="modal fade" id="filterMapelModal" tabindex="-1" aria-labelledby="filterMapelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterMapelModalLabel">Filter Mapel Berdasarkan Kelas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="modalKelasFilter" class="form-select">
          <option value="">-- Semua Kelas --</option>
          <?php foreach ($kelas as $k): ?>
            <option value="<?= $k['id']; ?>"><?= htmlspecialchars($k['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" id="applyMapelFilter" class="btn btn-primary">Filter</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#applyMapelFilter').click(function() {
    var id_kelas = $('#modalKelasFilter').val();
    console.log("Filter kelas dipilih:", id_kelas);

    $.ajax({
      url: '<?= base_url('mapel/ajax_filter_mapel'); ?>',
      type: 'POST',
      data: { id_kelas: id_kelas },
      success: function(response) {
        console.log("Response dari server:", response);
        $('#mapelTable tbody').html(response);
        $('#filterMapelModal').modal('hide'); // tutup modal
      },
      error: function(xhr, status, error) {
        console.error("Error Ajax:", xhr.responseText);
      }
    });
  });
});
</script>
