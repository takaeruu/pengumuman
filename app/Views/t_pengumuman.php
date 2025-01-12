<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Pengumuman</h4>
                </div>
                <div class="card-body">
                    <!-- Form Utama -->
                    <form method="POST" action="<?= base_url('home/aksi_t_pengumuman') ?>" id="modalForm" enctype="multipart/form-data">
                        <div id="form-container">
                            <!-- Form Tambah Modal 1 (Form Pertama) -->
                            <div class="modal-form">
                                <div class="row">
                                    <div class="col-md-7 mb-3">
                                        <label for="judul">Judul:</label>
                                        <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul Pengumuman" required>
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label for="isi">Isi:</label>
                                        <input type="text" class="form-control" name="isi" placeholder="Masukkan Isi Dari Pengumuman" required>
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <label for="file">File:</label>
                                        <input type="file" class="form-control" name="file" placeholder="Masukkan File" required>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                    <label for="nama_jurusan">Nama Jurusan</label>
                                        <select class="form-control" name="nama_jurusan" id="nama_jurusan">
    <option value="">Pilih</option>
    <?php foreach ($yoga as $item): ?>
        <option value="<?= $item->id_jurusan ?>"><?= $item->nama_jurusan ?></option>
    <?php endforeach; ?>
</select>

                                    </div>                                    <!-- Checkbox Share via Email -->
                                    <div class="col-md-7 mb-3">
                                        <label for="share_email">Share via Email:</label>
                                        <input type="checkbox" class="form-check-input" name="share_email" id="share_email" value="1">
                                        <label class="form-check-label" for="share_email">Kirim pengumuman melalui Email</label>
                                    </div>

                                    <div class="col-md-7 mb-3">
                                        <label for="share_whatsapp">Share via Whatsapp:</label>
                                        <input type="checkbox" class="form-check-input" name="share_whatsapp" id="share_whatsapp" value="1">
                                        <label class="form-check-label" for="share_whatsapp">Kirim pengumuman melalui Whatsapp</label>
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
