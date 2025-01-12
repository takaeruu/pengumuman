<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Kelas</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_kelas') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                <div class="col-md-7 mb-3">
                                        <label for="nama_kelas">Nama Kelas:</label>
                                        <input type="text" class="form-control" name="nama_kelas" value="<?= $oke->nama_kelas ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                    <label for="email-id-vertical">Nama jurusan:</label>
                            <select class="form-control" name="nama_jurusan" required>
                                <?php foreach ($yoga as $item): ?>
                                    <option value="<?= $item->id_jurusan ?>" 
                                        <?= $oke->id_jurusan == $item->id_jurusan ? 'selected' : ''; ?>>
                                        <?= $item->nama_jurusan ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                    <label for="email-id-vertical">Nama Wali Kelas:</label>
                            <select class="form-control" name="username" required>
                                <?php foreach ($yoga1 as $item): ?>
                                    <option value="<?= $item->id_user ?>" 
                                        <?= $oke->id_user == $item->id_user ? 'selected' : ''; ?>>
                                        <?= $item->username ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                            <input type="hidden" name="id_kelas" value="<?= $oke->id_kelas ?>">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
