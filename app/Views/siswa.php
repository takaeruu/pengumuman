<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">SISWA</h4>
                </div>

                <!-- Button to trigger "Tambah Jurusan" form -->
                <button class="btn btn-primary" id="btnTambahSiswa" onclick="loadTambahSiswaForm()">
                    <i class="fe fe-plus"></i> ADD SISWA
                </button>

                <!-- Content area -->
                <div id="content">
                    <!-- Initial content (table of jurusan) -->
                    <div class="card-content">
                        <div class="card-body">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Nama Kelas</th>
                                        <th>Nama Siswa</th>
                                        <th>Email Siswa</th>
                                        <th>No Hp Siswa</th>
                                        <th>Email Ortu</th>
                                        <th>No Hp Ortu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                        $no = 1;
                                        foreach ($oke as $okei) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= ($okei->nama_kelas) ?></td>
                                            <td><?= ($okei->nama_siswa) ?></td>
                                            <td><?= ($okei->email_siswa) ?></td>
                                            <td><?= ($okei->no_siswa) ?></td>
                                            <td><?= ($okei->email_ortu) ?></td>
                                            <td><?= ($okei->no_ortu) ?></td>

                                            <td>
                                                <!-- Edit button -->
                                                <button class="btn btn-info" onclick="loadEditSiswaForm(<?= $okei->id_siswa ?>)">
                                                    <i class="fe fe-edit"></i> Edit
                                                </button>
                                                <button class="btn btn-secondary btn-delete" data-id="<?= $okei->id_siswa ?>">Delete</button>
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

<div id="dynamicContent"></div>

<script>
    // Function to load "Tambah Jurusan" form dynamically
    function loadTambahSiswaForm() {
        // Fetch and load the form for adding a new jurusan
        fetch('<?= base_url('home/t_siswa') ?>') // Endpoint for adding siswa form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToSiswaList()">
                        <i class="fe fe-arrow-left"></i> Back to Siswa List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah siswa.');
            });
    }

    // Function to load "Edit Jurusan" form dynamically
    function loadEditSiswaForm(id_siswa) {
        // Fetch and load the edit form for the siswa
        fetch('<?= base_url('home/e_siswa') ?>/' + id_siswa) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToSiswaList()">
                        <i class="fe fe-arrow-left"></i> Back to Siswa List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form edit jurusan.');
            });
    }

    // Function to return to the jurusan list
    function backToSiswaList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }
</script>
