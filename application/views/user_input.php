<div class="container mt-4">
    <h3><?= isset($user) ? 'Edit User' : 'Tambah User' ?></h3>

    <form action="<?= isset($user) ? site_url('user/update/'.$user->id) : site_url('user/store') ?>" method="post">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                   value="<?= isset($user) ? $user->name : '' ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= isset($user) ? $user->email : '' ?>" required>
        </div>

        <!-- Tidak ada input password karena akan otomatis di-set default di controller -->

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= site_url('user') ?>" class="btn btn-secondary">Kembali</a>
    </form>

    <?php if (!isset($user)): ?>
        <div class="alert alert-info mt-3">
            Password default untuk user baru adalah: <strong>123456</strong>
        </div>
    <?php endif; ?>
</div>