<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Jurusan</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_e_jurusan') ?>" id="modalForm" enctype="multipart/form-data">
    <div id="form-container">
        <!-- Form Tambah Modal 1 (Form Pertama) -->
        <div class="modal-form">
            <div class="row">
                <div class="col-md-7 mb-3">
                    <label for="nomor_surat">Nama Jurusan:</label>
                    <input type="text" class="form-control" name="nama_jurusan" placeholder="Masukkan Jurusan" value="<?= $oke->nama_jurusan ?>" required>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
        <input type="hidden" name="id_jurusan" value="<?= $oke->id_jurusan ?>">
            <button type="submit" class="btn btn-info">Save</button>
        </div>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</section>
