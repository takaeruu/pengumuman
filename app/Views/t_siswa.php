<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Siswa</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_t_siswa') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                    <div class="col-md-7 mb-3">
                                        <label for="nama_kelas">Nama Kelas</label>
                                        <select class="form-control" name="nama_kelas">
                                            <option value="">Pilih</option>
                                            <?php foreach ($yoga as $item): ?>
                                                <option value="<?= $item->id_kelas ?>"><?= $item->nama_kelas ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                                
                                    <div class="col-md-7 mb-3">
                                        <label for="nama_siswa">Nama Siswa:</label>
                                        <input type="text" class="form-control" name="nama_siswa" placeholder="Masukkan Nama Siswa" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email_siswa">Email Siswa:</label>
                                        <input type="text" class="form-control" name="email_siswa" placeholder="Masukkan Email Siswa" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="no_siswa">No Hp Siswa:</label>
                                        <input type="text" class="form-control" name="no_siswa" placeholder="Masukkan Nomor Telepon Siswa" required>
                                    </div>
                                    
                                    <div class="col-md-7 mb-3">
                                        <label for="email_ortu">Email Ortu:</label>
                                        <input type="text" class="form-control" name="email_ortu" placeholder="Masukkan Email Orang tua" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="no_ortu">No Hp Ortu:</label>
                                        <input type="text" class="form-control" name="no_ortu" placeholder="Masukkan No Hp Orang tua" required>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
