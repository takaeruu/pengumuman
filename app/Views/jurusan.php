<section class="section">
    <div class="row" id="basic-table">
        <div class="col-12 col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" style="text-transform: uppercase; font-size: 30px;">JURUSAN</h4>
                </div>

                <!-- Button to trigger "Tambah Jurusan" form -->
                <button class="btn btn-primary" id="btnTambahJurusan" onclick="loadTambahJurusanForm()">
                    <i class="fe fe-plus"></i> ADD JURUSAN
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
                                        <th>Nama Jurusan</th>
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
                                            <td><?= ($okei->nama_jurusan) ?></td>
                                            <td>
                                                <!-- Edit button -->
                                                <button class="btn btn-info" onclick="loadEditJurusanForm(<?= $okei->id_jurusan ?>)">
                                                    <i class="fe fe-edit"></i> Edit
                                                </button>
                                                <a href="<?= base_url('home/hapusjurusan/'.$okei->id_jurusan) ?>">
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

<div id="dynamicContent"></div>

<script>
    // Function to load "Tambah Jurusan" form dynamically
    function loadTambahJurusanForm() {
        // Fetch and load the form for adding a new jurusan
        fetch('<?= base_url('home/t_jurusan') ?>') // Endpoint for adding jurusan form
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToJurusanList()">
                        <i class="fe fe-arrow-left"></i> Back to Jurusan List
                    </button>
                `;
                document.getElementById('dynamicContent').insertAdjacentHTML('beforeend', backButton);
            })
            .catch(error => {
                console.error('Error:', error); // Log any errors
                alert('Terjadi kesalahan saat memuat form tambah jurusan.');
            });
    }

    // Function to load "Edit Jurusan" form dynamically
    function loadEditJurusanForm(id_jurusan) {
        // Fetch and load the edit form for the jurusan
        fetch('<?= base_url('home/e_jurusan') ?>/' + id_jurusan) // Endpoint for editing jurusan
            .then(response => response.text()) // Convert response to HTML
            .then(data => {
                // Hide the entire section
                document.querySelector('.section').style.display = 'none';

                // Display the form inside the dynamicContent div
                document.getElementById('dynamicContent').innerHTML = data;

                // Add a back button
                let backButton = `
                    <button class="btn btn-secondary" onclick="backToJurusanList()">
                        <i class="fe fe-arrow-left"></i> Back to Jurusan List
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
    function backToJurusanList() {
        // Show the section again
        document.querySelector('.section').style.display = 'block';

        // Clear the dynamic content area (form area)
        document.getElementById('dynamicContent').innerHTML = '';
    }
</script>
