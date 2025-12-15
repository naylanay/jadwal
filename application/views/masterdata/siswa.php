
<div class="container-fluid ">
    <h1 class="h3 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Tombol Tambah Siswa -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
        Tambah Siswa
    </button>
    <button id="btnFilter" class=" btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#filterSiswaModal">Filter Siswa</button>


    

    <!-- Tabel Data Siswa -->
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Email</th>
                <th>Password</th>
                <th>No WA</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($siswa)): ?>
                <?php $no = 1; foreach ($siswa as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row->nama_siswa) ?></td>
                        <td><?= htmlspecialchars($row->tanggal_lahir) ?></td>
                        <td><?= htmlspecialchars($row->nama_kelas) ?></td>
                        <td><?= htmlspecialchars($row->nama_jurusan) ?></td>
                        <td><?= htmlspecialchars($row->email) ?></td>
                        <td><?= str_repeat('*', 4) ?></td>
                        <td><?= htmlspecialchars($row->no_wa); ?></td>

                        <td>
                            <button class="btn btn-sm btn-warning btn-edit"
                                data-id="<?= $row->id ?>"
                                data-id_user="<?= $row->id_user ?>"
                                data-id_kelas="<?= $row->id_kelas ?>"
                                data-tanggal_lahir="<?= $row->tanggal_lahir ?>"
                                data-no_wa="<?= htmlspecialchars($row->no_wa) ?>"

                                data-bs-toggle="modal" data-bs-target="#modalEditSiswa">
                                Edit
                            </button>
                            <a href="<?= site_url('siswa/hapus/'.$row->id) ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin hapus data ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" class="text-center">Belum ada data siswa</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ===========================
     MODAL TAMBAH SISWA
=========================== -->
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('siswa/tambah') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahSiswaLabel">Tambah Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="id_user" class="form-label">Nama Siswa</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id ?>"><?= htmlspecialchars($user->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="id_kelas" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?= $k->id ?>">
                            <?= htmlspecialchars($k->nama_kelas) ?> - <?= htmlspecialchars($k->nama_jurusan) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>

            <!-- <div class="mb-3">
                <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                <input type="text" name="no_wa" id="no_wa" class="form-control" required>
            </div> -->

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- ===========================
     MODAL EDIT SISWA
=========================== -->
<div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" id="formEditSiswa">
      <input type="hidden" name="id" id="edit_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditSiswaLabel">Edit Siswa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit_id_user" class="form-label">Nama Siswa</label>
                <select name="id_user" id="edit_id_user" class="form-select" required>
                    <option value="">-- Pilih Siswa --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id ?>"><?= htmlspecialchars($user->name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="edit_id_kelas" class="form-label">Kelas</label>
                <select name="id_kelas" id="edit_id_kelas" class="form-select" required>
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?= $k->id ?>">
                            <?= htmlspecialchars($k->nama_kelas) ?> - <?= htmlspecialchars($k->nama_jurusan) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir" class="form-control" required>
            </div>

            <!-- <div class="mb-3">
                <label for="no_wa" class="form-label">No WhatsApp</label>
                <input type="text" class="form-control" id="no_wa" name="no_wa" required>
            </div> -->

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
                    </div>
                    
                    <!-- Script untuk isi modal edit -->
                    <!-- <script>
                        document.querySelectorAll('.btn-edit').forEach(button => {
                            button.addEventListener('click', function() {
                                const id = this.dataset.id;
                                const id_user = this.dataset.id_user;
                                const id_kelas = this.dataset.id_kelas;
                                const tanggal_lahir = this.dataset.tanggal_lahir;
                                
                                document.getElementById('edit_id').value = id;
                                document.getElementById('edit_id_user').value = id_user;
                                document.getElementById('edit_id_kelas').value = id_kelas;
                                document.getElementById('edit_tanggal_lahir').value = tanggal_lahir;
                                
                                // Ubah action form edit agar sesuai ID
                                document.getElementById('formEditSiswa').action = '<?= base_url('siswa/edit/') ?>' + id;
                            });
                        });
                        </script> -->
<!-- ==========================
MODAL FILTER SISWA (AJAX)
========================== -->
<div class="modal fade" id="filterSiswaModal" tabindex="-1" aria-labelledby="filterSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSiswaModalLabel">Filter Siswa Berdasarkan Kelas dan Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="mb-3">
                    <label for="filter_kelas" class="form-label">Kelas</label>
                    <select id="filter_kelas" class="form-select">
                        <option value="">-- Semua Kelas --</option>
                        <?php foreach ($kelas as $k): ?>
                            <option value="<?= $k->id ?>"><?= htmlspecialchars($k->nama_kelas) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="filter_jurusan" class="form-label">Jurusan</label>
                        <select id="filter_jurusan" class="form-select">
                            <option value="">-- Semua Jurusan --</option>
                            <?php
                $jurusanUnik = [];
                foreach ($kelas as $k) {
                    if (!in_array($k->nama_jurusan, $jurusanUnik)) {
                        $jurusanUnik[] = $k->nama_jurusan;
                        echo '<option value="'.htmlspecialchars($k->nama_jurusan).'">'.htmlspecialchars($k->nama_jurusan).'</option>';
                    }
                }
                ?>
            </select>
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" id="applyFilterSiswa" class="btn btn-primary">Filter</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script>
    $(document).ready(function() {
        
        // Delegasi Event untuk Tombol Edit (Sudah Benar)
        $('table tbody').on('click', '.btn-edit', function() {
            const id = $(this).data('id');
            const id_user = $(this).data('id_user');
            const id_kelas = $(this).data('id_kelas');
            const tanggal_lahir = $(this).data('tanggal_lahir');
            //const no_wa = $(this).data('no_wa');
            
            $('#edit_id').val(id);
            $('#edit_id_user').val(id_user);
            $('#edit_id_kelas').val(id_kelas);
            $('#edit_tanggal_lahir').val(tanggal_lahir);
            //$('#no_wa').val($(this).data('no_wa'));
            
            // Ubah action form edit agar sesuai ID
            $('#formEditSiswa').attr('action', '<?= base_url('siswa/edit/') ?>' + id);
        });

        // ✅ PERBAIKAN: Listener Eksplisit agar Tombol Filter selalu berfungsi (Sudah Benar)
        $('#btnFilter').on('click', function(e) {
            e.preventDefault(); 
            // Pastikan Anda memuat Bootstrap 5 JS, ini menggunakan API Bootstrap 5
            var filterModal = new bootstrap.Modal(document.getElementById('filterSiswaModal'));
            filterModal.show();
        });

        // ✅ KODE BARU: Memastikan modal tertutup dan halaman bersih
$('#applyFilterSiswa').click(function() {
    var id_kelas = $('#filter_kelas').val();
    var jurusan = $('#filter_jurusan').val();
    
    // Tampilkan Indikator Loading (Opsional)
    // $('#loadingIndicator').show(); 

    $.ajax({
        url: '<?= base_url('siswa/ajax_filter_siswa'); ?>',
        type: 'POST',
        data: { id_kelas: id_kelas, jurusan: jurusan },
        success: function(response) {
            $('table tbody').html(response);
            
            // PENTING: Tutup modal HANYA SETELAH AJAX SUKSES
            $('#filterSiswaModal').modal('hide'); 
            
            // $('#loadingIndicator').hide(); // Sembunyikan Loading
        },
        error: function(xhr, status, error) {
             alert('Gagal memuat data siswa.');
             $('#filterSiswaModal').modal('hide'); 
        }
    });
});

// ✅ KODE KRUSIAL: Listener Event Bootstrap untuk pembersihan (hanya berjalan saat modal benar-benar tersembunyi)
$('#filterSiswaModal').on('hidden.bs.modal', function () {
    // Ini adalah tempat terbaik untuk pembersihan paksa jika masih redup atau tidak bisa scroll
    // Ini dijalankan setelah Bootstrap yakin modal sudah tidak terlihat
    $('body').removeClass('modal-open');
    $('body').removeAttr('style');
    $('html').removeClass('modal-open'); 
    $('html').removeAttr('style'); 
    $('.modal-backdrop').remove();
});
        
    });
</script>