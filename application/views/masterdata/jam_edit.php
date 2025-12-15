<div class="container">
    <h3>Edit Jam Pelajaran</h3>
    
    <!-- Menampilkan flash message jika ada -->
   <?php if($this->session->flashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('jam/edit/' . $jam->id); ?>" method="POST">
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" 
                   value="<?= set_value('jam_mulai', $jam->jam_mulai); ?>" required>
            <?= form_error('jam_mulai', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" 
                   value="<?= set_value('jam_selesai', $jam->jam_selesai); ?>" required>
            <?= form_error('jam_selesai', '<small class="text-danger">', '</small>'); ?>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="<?= base_url('masterdata/jam'); ?>" class="btn btn-secondary mt-2">Kembali</a>
    </form>
</div>
</div>
