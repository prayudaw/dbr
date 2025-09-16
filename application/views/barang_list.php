<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar'); ?>

<style>
    /* Styling dari sebelumnya, tambahkan atau modifikasi sesuai kebutuhan */
    .container {
        width: 95%;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-header {
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .card-body {
        padding: 1.25rem;
    }

    .form-inline .form-group {
        margin-bottom: 0;
    }

    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .btn {
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-sm {
        /* Untuk tombol Edit */
        padding: .25rem .5rem;
        font-size: .875rem;
        line-height: 1.5;
        border-radius: .2rem;
    }

    table.dataTable thead th,
    table.dataTable tbody td {
        white-space: nowrap;
    }

    .modal-body .form-group {
        display: flex;
        /* Menggunakan flexbox untuk layout */
        align-items: center;
        /* Pusatkan secara vertikal */
        margin-bottom: 1rem;
    }

    .modal-body .control-label {
        flex: 0 0 120px;
        /* Lebar label tetap */
        max-width: 120px;
        text-align: right;
        padding-right: 15px;
    }

    .modal-body .col-md-9 {
        flex-grow: 1;
        /* Input mengisi sisa ruang */
    }

    .help-block {
        font-size: 0.85em;
    }
</style>
<div class="container mt-auto">
    <h2>Daftar Barang Ruangan</h2>
    <a href="<?php echo site_url(INDEX_URL . 'barang/input'); ?>" class="btn btn-success mb-3"><i class="fa fa-plus"></i> Tambah Barang Baru</a>
    <hr>
    <div class="card mb-4">
        <div class="card-header">
            Filter Data
        </div>
        <div class="card-body">
            <form id="form-filter">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-6"> <label for="filter_nama_barang" class="sr-only">Nama Barang:</label>
                        <input type="text" class="form-control" id="filter_nama_barang" name="filter_nama_barang" placeholder="Nama Barang">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6"> <label for="filter_kode_barang" class="sr-only">Kode Barang:</label>
                        <input type="text" class="form-control" id="filter_kode_barang" name="filter_kode_barang" placeholder="Kode Barang">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6"> <label for="filter_nup" class="sr-only">NUP:</label>
                        <input type="text" class="form-control" id="filter_nup" name="filter_nup" placeholder="NUP">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6"> <label for="filter_penguasaan" class="sr-only">Penguasaan:</label>
                        <input type="text" class="form-control" id="filter_penguasaan" name="filter_penguasaan" placeholder="Penguasaan">
                    </div>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label for="filter_kondisi" class="sr-only">Kondisi:</label>
                        <select class="form-control" id="filter_kondisi" name="filter_kondisi">
                            <option value="">-Pilih Kondisi-</option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak-Ringan">Rusak-Ringan</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-6">
                        <label for="filter_ruangan" class="sr-only">Ruangan:</label>
                        <select class="form-control" id="filter_ruangan" name="filter_ruangan">
                            <option value="">Semua Ruangan</option>
                            <?php foreach ($ruangan_options as $ruangan): ?>
                                <option value="<?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>" <?= set_select('ruangan', $ruangan['nama_ruangan']); ?>>
                                    <?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3 col-sm-3 mb-2">
                        <button type="button" id="btn-filter" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filter</button>
                    </div>
                    <div class="col-xs-3 col-sm-3 mb-2">
                        <button type="button" id="btn-reset" class="btn btn-default btn-block"><i class="fa fa-refresh"></i> Reset</button>
                    </div>
                    <div class="col-xs-3 col-sm-3 mb-2">
                        <button type="button" id="btn-export-excel" class="btn btn-info btn-block"><i class="fa fa-file-excel-o"></i> Export Excel Filtered</button>
                    </div>
                    <div class="col-xs-3 col-sm-3 mb-2">
                        <button id="exportPdfBtn" class="btn btn-danger btn-block"><i class="fa fa-file-pdf-o"></i> Export PDF </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class=" table-responsive">
        <table id="table-barang" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kode Barang</th>
                    <th>NUP</th>
                    <th>Merk</th>
                    <th>Ruangan</th>
                    <th>Jumlah</th>
                    <th>Penguasaan</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>



<?php $this->load->view('templates/footer') ?>


<div class="modal fade" id="detailBarangModal" tabindex="-1" role="dialog" aria-labelledby="detailBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="detailBarangModalLabel">Detail Barang</h4>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="detail_id"></span></p>
                <p><strong>Nama Barang:</strong> <span id="detail_nama_barang"></span></p>
                <p><strong>Ruangan:</strong> <span id="detail_ruangan"></span></p>
                <p><strong>Jumlah:</strong> <span id="detail_jumlah"></span></p>
                <p><strong>Kondisi:</strong> <span id="detail_kondisi"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_form_label">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Ruangan</label>
                            <div class="col-md-9">
                                <select class="form-control" id="ruangan_edit" name="ruangan_edit">
                                    <option id="ruangan_selected"></option>
                                    <?php foreach ($ruangan_options as $ruangan1): ?>
                                        <option value="<?= $ruangan1['lantai']; ?>-<?= $ruangan1['nama_ruangan']; ?>" <?= set_select('ruangan', $ruangan1['nama_ruangan']); ?>>
                                            <?= $ruangan1['lantai']; ?>-<?= $ruangan1['nama_ruangan']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kondisi</label>
                            <div class="col-md-9">
                                <select class="form-control" id="kondisi_edit" name="kondisi_edit">
                                    <option value="">--Pilih Kondisi--</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Penguasaan</label>
                            <div class="col-md-9">
                                <input name="penguasaan_edit" id="penguasaan_edit" placeholder="penguasaan_edit" class="form-control" type="text">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah</label>
                            <div class="col-md-9">
                                <input name="jumlah_barang_edit" id="jumlah_barang_edit" placeholder="Jumlah" class="form-control" type="number">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan Perubahan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#exportPdfBtn').on('click', function(e) {
        e.preventDefault();
        var ruangan = $('#filter_ruangan').val();

        // --- Validasi di sini ---
        if (ruangan === "" || ruangan === null) {
            alert("Mohon pilih Ruangan untuk melakukan export.");
            return false; // Hentikan proses export
        }
        // --- Akhir Validasi ---

        // Bangun URL dengan parameter query string
        var export_url = "<?php echo site_url(INDEX_URL . 'barang/export_pdf'); ?>?";
        export_url += "&ruangan=" + encodeURIComponent(ruangan);

        // Arahkan browser ke URL export PDF
        window.open(export_url, '_blank'); // Membuka di tab baru
    });
    $('#btn-export-excel').click(function(e) {
        e.preventDefault();
        var ruangan = $('#filter_ruangan').val();

        // --- Validasi di sini ---
        if (ruangan === "" || ruangan === null) {
            alert("Mohon pilih Ruangan untuk melakukan export.");
            return false; // Hentikan proses export
        }
        // --- Akhir Validasi ---

        // Bangun URL dengan parameter query string
        var export_url = "<?php echo site_url(INDEX_URL . 'barang/export_excel'); ?>?";
        export_url += "&ruangan=" + encodeURIComponent(ruangan);

        // Arahkan browser ke URL ekspor
        window.location.href = export_url;
    });

    function save() {
        $('#btnSave').text('Menyimpan...'); // Mengubah teks tombol
        $('#btnSave').attr('disabled', true); // Menonaktifkan tombol

        var url = "<?= site_url(INDEX_URL . 'barang/update_dbr') ?>";

        // Melakukan submit form via AJAX
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(), // Mengambil semua data dari form
            dataType: "JSON",
            success: function(data) {
                if (data.status == 'success') {
                    $('#modal_form').modal('hide'); // Menyembunyikan modal
                    table.ajax.reload(null, false); // Reload DataTables
                    alert(data.message); // Tampilkan pesan sukses
                } else if (data.status == 'error') {
                    // Tampilkan pesan error validasi
                    alert('Validasi gagal! Periksa kembali input Anda.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error updating data');
            },
            complete: function() {
                $('#btnSave').text('Simpan Perubahan'); // Kembalikan teks tombol
                $('#btnSave').attr('disabled', false); // Aktifkan kembali tombol
            }
        });
    }

    // Fungsi JavaScript untuk konfirmasi delete
    function delete_barang(id) {
        if (confirm('Anda yakin ingin menghapus data ini?')) {
            // AJAX call untuk menghapus data
            $.ajax({
                url: "<?php echo site_url(INDEX_URL . 'barang/hapus/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status) { // Jika penghapusan berhasil
                        alert('Data berhasil dihapus!');
                        table.ajax.reload(null, false); // Reload tabel Datatables
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    // Fungsi untuk menampilkan modal edit dan mengisi data
    function edit_barang(id) {
        // Reset pesan error
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        // Mengambil data barang via AJAX
        $.ajax({
            url: "<?= site_url(INDEX_URL . 'barang/get_dbr_by_id/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data.ruangan);
                // Mengisi form di modal dengan data yang diterima
                $('#modal_form').modal('show'); // Menampilkan modal
                $('.modal-title').text('Edit Data Barang'); // Mengubah judul modal
                $('[name="id"]').val(data.id);
                $('#ruangan_selected').val(data.ruangan);
                $('#kondisi_edit').val(data.kondisi);
                $('#penguasaan_edit').val(data.penguasaan);
                $('#jumlah_barang_edit').val(data.jumlah_barang);


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error mengambil data dari ajax');
            }
        });
    }



    // Fungsi untuk menampilkan detail barang di modal
    function show_detail(id) {

        $.ajax({
            url: "<?php echo site_url(INDEX_URL . 'barang/get_detail/') ?>" + id, // URL untuk mengambil detail
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data) {
                    $('#detail_id').text(data.id);
                    $('#detail_nama_barang').text(data.nama_barang);
                    $('#detail_ruangan').text(data.ruangan);
                    $('#detail_jumlah').text(data.jumlah_barang);
                    $('#detail_kondisi').text(data.kondisi);
                    $('#detailBarangModal').modal('show'); // Tampilkan modal
                } else {
                    alert('Detail barang tidak ditemukan.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error mengambil detail barang: ' + textStatus);
            }
        });
    }


    $('#ruangan_edit').select2({
        theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik nama ruangan',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
    });
    $('#filter_ruangan').select2({
        theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik nama ruangan',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
    });


    $('#ruangan').select2({
        theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik nama ruangan',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
    });


    var table; // Deklarasi variabel global untuk DataTables

    $(document).ready(function() {
        // Inisialisasi DataTables
        table = $('#table-barang').DataTable({
            "processing": true, // Tampilkan loading indicator
            "serverSide": true, // Aktifkan server-side processing
            "searching": false,
            "order": [], // Nonaktifkan pengurutan default
            "ajax": {
                "url": "<?= site_url(INDEX_URL . 'barang/ajax_list') ?>",
                "type": "POST",
                "data": function(d) {
                    // Tambahkan data filter dari form ke permintaan DataTables
                    d.filter_nama_barang = $('#filter_nama_barang').val();
                    d.filter_ruangan = $('#filter_ruangan').val();
                    d.filter_penguasaan = $('#filter_penguasaan').val();
                    d.filter_kode_barang = $('#filter_kode_barang').val();
                    d.filter_nup = $('#filter_nup').val();
                    d.filter_kondisi = $('#filter_kondisi').val();
                }
            },
            "columnDefs": [{
                    "targets": [0], // Kolom pertama (No) tidak boleh diurutkan
                    "orderable": false,
                },
                // Atur kolom lain yang tidak boleh diurutkan
            ],
            // Opsional: Konfigurasi bahasa
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json"
            }
        });

        // Event listener untuk tombol filter
        $('#btn-filter').click(function() {
            table.ajax.reload(null, false); // Reload DataTables, tanpa mereset posisi halaman
        });

        // Event listener untuk tombol reset
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset(); // Reset form filter
            table.ajax.reload(null, false); // Reload DataTables
        });


    });
</script>