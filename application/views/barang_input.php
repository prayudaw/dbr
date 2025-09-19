<?php $this->load->view('templates/header') ?>

<div class="container">
    <h2>Input Daftar Barang Ruangan</h2><br /><br />
    <?php if ($this->session->flashdata('success_message')): ?>
    <div class="alert alert-success" role="alert">
        <?= $this->session->flashdata('success_message'); ?>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error_message')): ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->session->flashdata('error_message'); ?>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="ruangan">Pilih Barang (Milik Perpus):</label>
        <select class="form-control" id="barang">
            <option value="">ketik kode barang </option>
            <?php foreach ($barang_options as $barang): ?>
            <option value="<?= $barang['id']; ?>">
                <?= $barang['kode_barang']; ?><?= $barang['NUP']; ?> - <?= $barang['nama_barang']; ?>- -
                <?= $barang['merk']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?= form_open(INDEX_URL . 'barang/input'); ?>
    <div class="form-group">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
            value="<?= set_value('nama_barang'); ?>">
        <?= form_error('nama_barang', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="kode_barang">Kode Barang:</label>
        <input type="number" class="form-control" id="kode_barang" name="kode_barang"
            value="<?= set_value('kode_barang'); ?>">
        <?= form_error('kode_barang', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="nup">NUP:</label>
        <input type="number" class="form-control" id="nup" name="nup" value="<?= set_value('nup'); ?>">
        <?= form_error('nup', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="merk_type">Merk / type:</label>
        <input type="text" class="form-control" id="merk_type" name="merk_type" value="<?= set_value('merk_type'); ?>">
        <?= form_error('merk_type', '<div class="text-danger">', '</div>'); ?>
    </div>
    <div class="form-group">
        <label for="kondisi">kondisi:</label>
        <select class="form-control" id="kondisi" name="kondisi">
            <option value="">--Pilih kondisi-- </option>
            <option value="Baik">Baik</option>
            <option value="Rusak">Rusak</option>
        </select>
        <?= form_error('kondisi', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="jumlah">Jumlah:</label>
        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang"
            value="<?= set_value('jumlah_barang'); ?>">
        <?= form_error('jumlah_barang', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="jumlah">Tahun:</label>
        <input type="number" class="form-control" id="tahun" name="tahun" value="<?= set_value('tahun'); ?>">
        <?= form_error('tahun', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="penguasaan">Penguasaan:</label>
        <textarea class="form-control" id="penguasaan" name="penguasaan"><?= set_value('penguasaan'); ?></textarea>
        <?= form_error('penguasaan', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="Keterangan">Keterangan:</label>
        <textarea class="form-control" id="keterangan" name="keterangan"><?= set_value('keterangan'); ?></textarea>
        <?= form_error('keterangan', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="ruangan">Ruangan:</label>
        <select class="form-control" id="ruangan" name="ruangan">
            <option value="">Pilih atau ketik nama ruangan</option>
            <?php foreach ($ruangan_options as $ruangan): ?>
            <option value="<?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>"
                <?= set_select('ruangan', $ruangan['nama_ruangan']); ?>>
                <?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <?= form_error('ruangan', '<div class="text-danger">', '</div>'); ?>
    </div>

    <div class="form-group">
        <label for="tanggal_masuk">Tanggal Masuk:</label>
        <input type="date" class="form-control" id="tanggal_input" name="tanggal_input"
            value="<?= set_value('tanggal_input', $tanggal_default); ?>">
        <?= form_error('tanggal_masuk', '<div class="text-danger">', '</div>'); ?>
    </div>
    <!-- <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_checked" value="1" <?php echo set_checkbox('is_checked', '1'); ?>> Barang Sudah Dicek (Optional)
                <input type="checkbox" name="is_label" value="1" <?php echo set_checkbox('is_label', '1'); ?>> Barang Sudah Dilabel (Optional)
            </label>
        </div>
    </div> -->
    <br>
    <div class="row btn-group-responsive">
        <div class="col-xs-12 col-sm-6 mb-2">
            <button type="submit" class="btn btn-primary btn-block">Simpan Barang</button>
        </div>
        <div class="col-xs-12 col-sm-6">
            <a href="<?php echo base_url() ?>" class="btn btn-danger btn-block">Kembali</a>
        </div>
    </div>
    <?= form_close(); ?>
</div>

<?php $this->load->view('templates/footer') ?>

<script>
$(document).ready(function() {
    $('#ruangan').select2({
        theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik nama ruangan',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
    });

    $('#barang').select2({
        theme: 'bootstrap4', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik Barang',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
    });

    $('#barang').on('change', function() {
        var selectedBarang = $(this).val(); // Dapatkan nilai ruangan yang dipilih
        // Lakukan permintaan AJAX
        $.ajax({
            url: "<?= site_url(INDEX_URL . 'barang/get_barang_by_id') ?>", // URL endpoint AJAX
            type: "POST",
            dataType: "json",
            data: {
                id: selectedBarang
            }, // Kirim data ruangan yang dipilih
            success: function(data) {
                // Kosongkan opsi lama pada Select2 barang
                $('#nama_barang').val(data.nama_barang);
                $('#kode_barang').val(data.kode_barang);
                $('#nup').val(data.nup);
                $('#merk_type').val(data.merk);
                $('#jumlah_barang').val(1);
                $('#tahun').val(data.tahun);
                $('#kondisi').val(data.kondisi);
                $('#penguasaan').val('Barang Milik Perpustakaan');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: " + textStatus, errorThrown);
                alert("Gagal mengambil data barang. Silakan coba lagi.");
            }
        });
    });
});
</script>

<style>
/* Styling dasar agar lebih rapi, bisa diintegrasikan ke CSS global */
.container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    /* Agar padding tidak menambah lebar */
}

.text-danger {
    color: red;
    font-size: 0.9em;
    margin-top: 5px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

/* Sesuaikan lebar Select2 agar sama dengan form-control lainnya */
.select2-container {
    width: 100% !important;
}
</style>