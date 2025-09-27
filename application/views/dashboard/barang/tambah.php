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
                                                               <input type="number" class="form-control" id="NUP"
                                                                   name="nup">
                                                           </div>

                                                           <div class="form-group">
                                                               <label for="merk_type">Merk:</label>
                                                               <input type="text" class="form-control" id="merk"
                                                                   name="merk">
                                                           </div>


                                                           <div class="form-group">
                                                               <label for="nilai_perolehan">Nilai Perolehan:</label>
                                                               <input type="number" class="form-control"
                                                                   id="nilai_perolehan" name="nilai_perolehan">
                                                           </div>


                                                           <div class="form-group">
                                                               <label for="tanggal_masuk">Tgl perolehan:</label>
                                                               <input type="date" class="form-control"
                                                                   id="tgl_perolehan" name="tgl_perolehan">
                                                           </div>

                                                           <div class=" form-group">
                                                               <label for="kondisi">kondisi:</label>
                                                               <select class="form-control" id="kondisi" name="kondisi">
                                                                   <option value="">--Pilih kondisi-- </option>
                                                                   <option value="Baik">Baik</option>
                                                                   <option value="Rusak-Ringan">Rusak Ringan</option>
                                                                   <option value="Rusak">Rusak</option>
                                                               </select>
                                                           </div>
                                                           <div class=" form-group">
                                                               <label for="kondisi">Kategori:</label>
                                                               <select class="form-control" id="kategori"
                                                                   name="kategori">
                                                                   <option value="">--Pilih Kategori-- </option>
                                                                   <option value="TIK">TIK</option>
                                                                   <option value="NONTIK">NONTIK</option>
                                                                   <option value="Aset-tak-berwujud">Aset-tak-berwujud
                                                                   </option>
                                                               </select>
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
           $('#form_tambah').submit(function(e) {
               e.preventDefault(); // Mencegah form untuk submit secara normal
               var formData = $(this).serialize(); // Mengambil semua data dari form
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url('dashboard/barang/add'); ?>', // URL ke controller dan method Anda
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
                           text: 'Terjadi Kesalahan pada server'
                       });

                   }
               });
           });

       });
   </script>