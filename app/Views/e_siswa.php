<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Siswa</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_siswa') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">


                                <div class="col-md-7 mb-3">
                                    <label for="email-id-vertical">Nama Kelas:</label>
                            <select class="form-control" name="nama_jurusan" required>
                                <?php foreach ($yoga as $item): ?>
                                    <option value="<?= $item->id_kelas ?>" 
                                        <?= $oke->id_kelas == $item->id_kelas ? 'selected' : ''; ?>>
                                        <?= $item->nama_kelas ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                                    </div>


                                <div class="col-md-7 mb-3">
                                        <label for="nama_kelas">Nama Siswa:</label>
                                        <input type="text" class="form-control" name="nama_kelas" value="<?= $oke->nama_siswa ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email_siswa">Email Siswa:</label>
                                        <input type="text" class="form-control" name="email_siswa" value="<?= $oke->email_siswa ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="no_siswa">No Hp Siswa:</label>
                                        <input type="text" class="form-control" name="no_siswa" value="<?= $oke->no_siswa ?>" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email_ortu">Email Orang tua:</label>
                                        <input type="text" class="form-control" name="email_ortu" value="<?= $oke->email_ortu ?>" required>
                                    </div>


                                    <div class="col-md-7 mb-3">
                                        <label for="no_ortu">No Hp Ortu:</label>
                                        <input type="text" class="form-control" name="no_ortu" value="<?= $oke->no_ortu ?>" required>
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
