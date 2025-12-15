<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- Tombol trigger modal -->
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newKelasModal">Add New Kelas</a> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#filterModal">Filter Kelas</button>


    <div class="col-md-8">
        <table  id="kelasTable" class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Code Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($kelas as $k): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $k['name']; ?></td>
                        <td><?= $k['nama_jurusan']; ?></td>
                        <td><?= $k['code_kelas']; ?></td>
                        <td>
                            <a href="<?= base_url('kelas/edit/' . $k['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('kelas/delete/' . $k['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Modal Tambah Kelas -->
<div class="modal fade" id="newKelasModal" tabindex="-1" aria-labelledby="newKelasModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newKelasModalLabel">Tambah Kelas Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('kelas/tambah'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="name">Nama Kelas</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="form-group mb-3">
            <label for="id_jurusan">Jurusan</label>
            <select name="id_jurusan" id="id_jurusan" class="form-control" required>
              <option value="">-- Pilih Jurusan --</option>
              <?php foreach($jurusan as $j): ?>
                <option value="<?= $j['id']; ?>"><?= $j['name']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="code_kelas">Kode Kelas</label>
            <input type="text" class="form-control" id="code_kelas" name="code_kelas" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
              </div>
              
<!-- Modal Filter Kelas -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Kelas Berdasarkan Jurusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <select id="modalJurusanFilter" class="form-select">
          <option value="">-- Semua Jurusan --</option>
          <?php foreach ($jurusan as $j): ?>
            <option value="<?= $j['id']; ?>"><?= htmlspecialchars($j['name']); ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
         <!-- tombol filter -->
        <button type="button" id="applyFilter" class="btn btn-primary">Filter</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

  // Saat tombol "Filter" di modal diklik
  $('#applyFilter').click(function() {
    var id_jurusan = $('#modalJurusanFilter').val();
    console.log("Filter jurusan dipilih:", id_jurusan);

    $.ajax({
      url: '<?= base_url('kelas/ajax_filter_kelas'); ?>',
      type: 'POST',
      data: { id_jurusan: id_jurusan },
      success: function(response) {
        console.log("Response dari server:", response);
        $('#kelasTable tbody').html(response);
        var filterModalEl = document.getElementById('filterModal');
        var filterModal = bootstrap.Modal.getInstance(filterModalEl);
        if (filterModal) {
            filterModal.hide();
        }

      },
      error: function(xhr, status, error) {
        console.error("Error Ajax:", xhr.responseText);
      }
    });
  });

});
</script>

