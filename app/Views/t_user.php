<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah User</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_t_user') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">

                                    <div class="col-md-7 mb-3">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" name="email" placeholder="Masukkan Email" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="no_hp">Nomor Telepon:</label>
                                        <input type="text" class="form-control" name="no_hp" placeholder="Masukkan Nomor Telepon" required>
                                    </div>
                                    
                                    <div class="col-md-7 mb-3">
                                        <label for="level">Level:</label>
                                        <select class="form-control" name="level" id="level" required>
                                            <option value="" disabled selected>Pilih Level</option>
                                            <option value="admin">Admin</option>
                                            <option value="kepsek">Kepala Sekolah</option>
                                            <option value="wakepsek">Wakil Kepala Sekolah</option>
                                            <option value="guru">Guru</option>
                                        </select>
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
