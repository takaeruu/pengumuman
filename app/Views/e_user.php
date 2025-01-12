<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_user') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                    <div class="col-md-7 mb-3">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" value="<?= $oke->username ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" name="email" value="<?= $oke->email ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="no_hp">Nomor Telepon:</label>
                                        <input type="text" class="form-control" name="no_hp" value="<?= $oke->no_hp ?>" required>
                                    </div>
                                    

                                    <div class="col-md-7 mb-3">
    <label for="level">Level:</label>
    <select class="form-control" name="level" id="level" required>
        <option value="admin" <?= (isset($currentLevel) && $currentLevel === 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="kepsek" <?= (isset($currentLevel) && $currentLevel === 'kepsek') ? 'selected' : ''; ?>>Kepala Sekolah</option>
        <option value="wakepsek" <?= (isset($currentLevel) && $currentLevel === 'wakepsek') ? 'selected' : ''; ?>>Wakil Kepala Sekolah</option>
        <option value="guru" <?= (isset($currentLevel) && $currentLevel === 'guru') ? 'selected' : ''; ?>>Guru</option>
    </select>
</div>




                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id_user" value="<?= $oke->id_user ?>">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
