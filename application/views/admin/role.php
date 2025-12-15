<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    
    <div class="col-lg-6"><!-- 🔹 Ubah angka ini kalau mau lebih lebar/sempit -->

    <!-- Flash Message -->
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?= form_error('role', '<div class="alert alert-danger">', '</div>'); ?>

    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newRoleModal">Add New Role</a>

    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($role as $r): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $r['role']; ?></td>
                    <td>
                        <a href="<?= base_url('role/roleAccess/') . $r['id']; ?>" class="badge bg-warning text-white">access</a>
                        <a href="<?= base_url('role/edit/') . $r['id']; ?>" class="badge bg-success text-white">edit</a>
                        <a href="<?= base_url('role/delete/') . $r['id']; ?>" class="badge bg-danger text-white" onclick="return confirm('Yakin mau menghapus role <?= $r['role']; ?>?');">delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal: Add New Role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="<?= base_url('role/add'); ?>" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="role">Role Name</label>
            <input type="text" class="form-control" id="role" name="role" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>

            </div>
            </div>