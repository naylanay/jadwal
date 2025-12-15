<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <!-- Form Edit Role -->
            <form action="<?= base_url('role/edit/' . $role['id']); ?>" method="post">
                <!-- Hidden input untuk ID -->
                <input type="hidden" name="id" value="<?= $role['id']; ?>">

                <div class="form-group">
                    <label for="role">Role Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="role" 
                        name="role" 
                        value="<?= set_value('role', $role['role']); ?>"
                    >
                    <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url('role'); ?>" class="btn btn-secondary">Cancel</a>
            </form>

        </div>
    </div>
</div>
</div>