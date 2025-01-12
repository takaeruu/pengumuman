<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">PENGUMUMAN TERPILIH</h4>
                </div>

                <!-- Button to trigger "Tambah pengumuman" form -->
                <button class="btn btn-primary btn-lg" id="btnTambahpengumuman" onclick="loadTambahPengumumanForm()">
    <i class="fe fe-plus"></i> ADD PENGUMUMAN 
</button>

                <?php if (session()->getFlashdata('email_status')): ?>
    <div class="alert alert-info">
        <?= session()->getFlashdata('email_status'); ?>
    </div>
<?php endif; ?>



                <!-- Content area -->
                <div id="content">
                    <!-- Initial content (table of pengumuman) -->
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Isi</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                    $no = 1;
                                    foreach ($oke1 as $okei) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= ($okei->tanggal) ?></td>
                                            <td><?= ($okei->judul) ?></td>
                                            <td><?= ($okei->isi) ?></td>
                                            <td>
                                                <?php if ($okei->file): ?>
                                                    <?php
                                                    $fileExtension = pathinfo($okei->file, PATHINFO_EXTENSION);
                                                    $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']);
                                                    ?>
                                                    <?php if ($isImage): ?>
                                                        <button class="btn btn-secondary" onclick="viewImageModal('<?= base_url('uploads/' . $okei->file) ?>')">Lihat File</button>
                                                    <?php else: ?>
                                                        <a href="<?= base_url('uploads/' . $okei->file) ?>" target="_blank" class="btn btn-secondary">Lihat File</a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    Tidak Ada File
                                                <?php endif; ?>
                                            </td>
                                            <td>
    <!-- Edit button -->
    <button class="btn btn-primary" onclick="loadEditPengumumanForm(<?= $okei->id_pengumuman ?>)">
        <i class="fe fe-edit"></i> Edit
    </button>
    <a href="<?= base_url('home/hapus_pengumuman_terpilih/'.$okei->id_pengumuman) ?>">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="imageModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview" class="img-fluid" />
                <button id="fullscreenButton" class="btn btn-info mt-3">Fullscreen</button>
            </div>
        </div>
    </div>
</div>


<div id="dynamicContent"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    
function loadTambahPengumumanForm() {
    fetch('<?= base_url('home/t_pengumuman_terpilih') ?>')
        .then(response => response.text())
        .then(data => {
            document.querySelector('.section').style.display = 'none';
            document.getElementById('dynamicContent').innerHTML = data;
            // Wait for dynamic content to load before adding the back button
            let backButton = `
                <button class="btn btn-secondary" onclick="backToPengumumanList()">
                    <i class="fe fe-arrow-left"></i> Back to pengumuman List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat form tambah pengumuman.');
        });
}

// Function to load "Edit pengumuman" form dynamically
function loadEditPengumumanForm(id_pengumuman) {
    fetch('<?= base_url('home/e_pengumuman_terpilih') ?>/' + id_pengumuman)
        .then(response => response.text())
        .then(data => {
            document.querySelector('.section').style.display = 'none';
            document.getElementById('dynamicContent').innerHTML = data;
            // Wait for dynamic content to load before adding the back button
            let backButton = `
                <button class="btn btn-secondary" onclick="backToPengumumanList()">
                    <i class="fe fe-arrow-left"></i> Back to pengumuman List
                </button>
            `;
            document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memuat form edit pengumuman.');
        });
}

// Function to return to the pengumuman list
function backToPengumumanList() {
    document.querySelector('.section').style.display = 'block';
    document.getElementById('dynamicContent').innerHTML = '';
}


    // Function to display image in modal
    function viewImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

    // Function to display image in modal
function viewImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
    imageModal.show();
}

// Add event listener for fullscreen button
document.getElementById('fullscreenButton').addEventListener('click', function () {
    const modalImage = document.getElementById('modalImage');
    if (modalImage.requestFullscreen) {
        modalImage.requestFullscreen();
    } else if (modalImage.mozRequestFullScreen) { // Firefox
        modalImage.mozRequestFullScreen();
    } else if (modalImage.webkitRequestFullscreen) { // Chrome, Safari, Opera
        modalImage.webkitRequestFullscreen();
    } else if (modalImage.msRequestFullscreen) { // IE/Edge
        modalImage.msRequestFullscreen();
    }
});

</script>

<!-- Include Bootstrap CSS and JS if not already included -->
