<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Daftar User</h3>
                    <a href="<?= site_url('user/create') ?>" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah User
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($users as $u): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($u->username) ?></td>
                                        <td>
                                            <a href="<?= site_url('user/edit/' . $u->id) ?>"
                                                class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="<?= site_url('user/delete/' . $u->id) ?>" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus user ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>