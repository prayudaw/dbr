   <!-- header -->
   <?php $this->load->view('dashboard/templates/header') ?>
   <!-- end header -->

   <!-- Sidebar -->
   <?php $this->load->view('dashboard/templates/sidebar') ?>
   <!-- End of Sidebar -->

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

           <!-- Topbar -->
           <?php $this->load->view('dashboard/templates/topbar') ?>
           <!-- End of Topbar -->

           <!-- Begin Page Content -->
           <!-- Begin Page Content -->
           <div class="container-fluid">

               <!-- Page Heading -->
               <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title ?></h1>
               <div class="card shadow mb-4">
                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary"></h6>
                   </div>
                   <div class="card-body">
                       <div class="panel panel-default">
                           <div class="panel-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <div class="card card-primary">
                                           <div class="card-header">
                                               <h3 class="card-title"></h3>
                                           </div>
                                           <div class="card-body">
                                               <form id="form_tambah">
                                                   <div class="row">
                                                       <div class="col-md-6">
                                                           <div class="form-group">
                                                               <label for="ruangan">Pilih Barang (Milik Perpus):</label>
                                                               <select class="form-control" id="barang">
                                                                   <option value="">ketik kode barang </option>
                                                                   <?php foreach ($barang_options as $barang): ?>
                                                                   <option value="<?= $barang['id']; ?>">
                                                                       <?= $barang['kode_barang']; ?><?= $barang['NUP']; ?>
                                                                       - <?= $barang['nama_barang']; ?>- -
                                                                       <?= $barang['merk']; ?>
                                                                   </option>
                                                                   <?php endforeach; ?>
                                                               </select>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="nama_barang">Nama Barang:</label>
                                                               <input type="text" class="form-control" id="nama_barang"
                                                                   name="nama_barang">
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="kode_barang">Kode Barang:</label>
                                                               <input type="number" class="form-control"
                                                                   id="kode_barang" name="kode_barang">
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="nup">NUP:</label>
                                                               <input type="number" class="form-control" id="nup"
                                                                   name="nup">
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="merk_type">Merk / type:</label>
                                                               <input type="text" class="form-control" id="merk_type"
                                                                   name="merk_type">
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="kondisi">kondisi:</label>
                                                               <select class="form-control" id="kondisi" name="kondisi">
                                                                   <option value="">--Pilih kondisi-- </option>
                                                                   <option value="Baik">Baik</option>
                                                                   <option value="Rusak">Rusak</option>
                                                               </select>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="jumlah">Jumlah:</label>
                                                               <input type="number" class="form-control"
                                                                   id="jumlah_barang" name="jumlah_barang">
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="jumlah">Tahun:</label>
                                                               <input type="number" class="form-control" id="tahun">
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="penguasaan">Penguasaan:</label>
                                                               <textarea class="form-control" id="penguasaan"
                                                                   name="penguasaan"></textarea>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="Keterangan">Keterangan:</label>
                                                               <textarea class="form-control" id="keterangan"
                                                                   name="keterangan"></textarea>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="ruangan">Ruangan:</label>
                                                               <select class="form-control" id="ruangan" name="ruangan">
                                                                   <option value="">Pilih atau ketik nama ruangan
                                                                   </option>
                                                                   <?php foreach ($ruangan_options as $ruangan): ?>
                                                                   <option
                                                                       value="<?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>"
                                                                       <?= set_select('ruangan', $ruangan['nama_ruangan']); ?>>
                                                                       <?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>
                                                                   </option>
                                                                   <?php endforeach; ?>
                                                               </select>
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="tanggal_masuk">Tanggal Masuk:</label>
                                                               <input type="date" class="form-control"
                                                                   id="tanggal_input" name="tanggal_input"
                                                                   value="<?php echo $tanggal_default ?>">
                                                           </div>
                                                       </div>

                                                   </div>
                                           </div>

                                           <div class="card-footer">
                                               <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                   Simpan</button>
                                               <button type="button" id="btn-reset"
                                                   class="btn btn-default">Reset</button>
                                           </div>
                                           </form>

                                       </div>
                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- /.container-fluid -->

       <!-- End of Main Content -->
       <!-- Footer -->
       <?php $this->load->view('dashboard/templates/footer_copyright') ?>
       <!-- End of Footer -->

   </div>
   <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Footer -->
   <?php $this->load->view('dashboard/templates/footer') ?>
   <!-- End of Footer -->

   <script>
$(document).ready(function() {

    $('#ruangan').select2({
        theme: 'bootstrap5', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik nama ruangan',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag 
    });

    $('#barang').select2({
        theme: 'bootstrap5', // Menggunakan tema Bootstrap 4 jika Anda memuatnya
        placeholder: 'Pilih atau ketik Barang',
        allowClear: true, // Memungkinkan penghapusan pilihan
        tags: true // Mengizinkan pengguna untuk menambahkan tag
    });

    $('#barang').on('change', function() {
        var selectedBarang = $(this).val(); // Dapatkan nilai barang yang dipilih
        // Lakukan permintaan AJAX
        $.ajax({
            url: "<?= site_url('dashboard/barang/ajax_get_barang_by_id') ?>", // URL endpoint AJAX
            type: "POST",
            dataType: "json",
            data: {
                id: selectedBarang
            }, // Kirim data barang yang dipilih
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

    $('#form_tambah').submit(function(e) {
        e.preventDefault(); // Mencegah form untuk submit secara normal
        var formData = $(this).serialize(); // Mengambil semua data dari form
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('dashboard/dbr/add'); ?>', // URL ke controller dan method Anda
            data: formData,
            dataType: 'json', // Tipe data yang diharapkan dari server (JSON)
            success: function(response) {
                console.log(response); // untuk check data
                //Berhasil
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                    $('#form_tambah')[0].reset(); // mengosongkan form

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oppss',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                // Gagal
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<p style="color:red;">Terjadi kesalahan saat mengirim data.</p>'
                });

            }
        });
    });

});
   </script>