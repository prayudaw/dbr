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

               <!-- DataTales Example -->
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
                                               <h3 class="card-title">Pencarian</h3>
                                           </div>
                                           <div class="card-body">
                                               <form id="form-filter">
                                                   <div class="row">
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Kode Barang</label>
                                                               <input type="text" class="form-control"
                                                                   placeholder="Kode Barang" id="kode_barang">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Nama Barang</label>
                                                               <input type="text" class="form-control"
                                                                   placeholder="Nama Barang" id="nama_barang">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>NUP</label>
                                                               <input type="text" class="form-control" placeholder="NUP"
                                                                   id="NUP">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Merk</label>
                                                               <input type="text" class="form-control"
                                                                   placeholder="Merk" id="merk">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Kondisi</label>
                                                               <select class="form-control" name="kondisi" id="kondisi">
                                                                   <option value="">--Pilih Kondisi--</option>
                                                                   <option value="Baik">Baik</option>
                                                                   <option value="Rusak-Ringan">Rusak Ringan</option>
                                                                   <option value="Rusak">Rusak</option>
                                                               </select>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Ruangan</label>
                                                               <select class="form-control" id="ruangan" name="ruangan">
                                                                   <option value="">Semua Ruangan</option>
                                                                   <?php foreach ($ruangan_options as $ruangan): ?>
                                                                   <option
                                                                       value="<?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>"
                                                                       <?= set_select('ruangan', $ruangan['nama_ruangan']); ?>>
                                                                       <?= $ruangan['lantai']; ?>-<?= $ruangan['nama_ruangan']; ?>
                                                                   </option>
                                                                   <?php endforeach; ?>
                                                               </select>
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Penguasaan</label>
                                                               <input type="text" class="form-control"
                                                                   placeholder="Penguasaan" id="penguasaan">
                                                           </div>
                                                       </div>
                                                   </div>
                                           </div>
                                           </form>
                                           <div class="card-footer">
                                               <button type="button" id="btn-filter" class="btn btn-primary"><i
                                                       class="fas fa-search"></i>
                                                   Filter</button>
                                               <button type="button" id="btn-reset"
                                                   class="btn btn-default">Reset</button>

                                               <button type="button" id="btn-export-excel" class="btn btn-danger"><i
                                                       class="fa fa-file-pdf"></i> Export
                                                   PDF</button>
                                               <button type="button" id="exportPdfBtn" class="btn btn-success"><i
                                                       class="fa fa-file-excel"></i> Export
                                                   PDF</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="table" width="100%" cellspacing="0">
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
                                   <th>Action</th>
                           </thead>
                           <tbody>
                           </tbody>
                       </table>
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

   <script type="text/javascript">
//proses export excel jquery
$('#btn-export-excel').click(function(e) {
    e.preventDefault();
    var ruangan = $('#ruangan').val();

    // --- Validasi di sini ---
    if (ruangan === "" || ruangan === null) {
        alert("Mohon pilih Ruangan untuk melakukan export.");
        return false; // Hentikan proses export
    }
    // --- Akhir Validasi ---

    // Bangun URL dengan parameter query string
    var export_url = "<?php echo site_url('dashboard/dbr/export_excel'); ?>?";
    export_url += "&ruangan=" + encodeURIComponent(ruangan);

    // Arahkan browser ke URL ekspor
    window.location.href = export_url;
});

//proses export pdf jquery
$('#exportPdfBtn').on('click', function(e) {
    e.preventDefault();
    var ruangan = $('#ruangan').val();

    // --- Validasi di sini ---
    if (ruangan === "" || ruangan === null) {
        Swal.fire({
            icon: 'error',
            title: 'Oppss',
            text: 'Mohon pilih Ruangan untuk melakukan export.'
        });
        return false; // Hentikan proses export
    }
    // --- Akhir Validasi ---

    // Bangun URL dengan parameter query string
    var export_url = "<?php echo site_url('dashboard/dbr/export_pdf'); ?>?";
    export_url += "&ruangan=" + encodeURIComponent(ruangan);

    // Arahkan browser ke URL export PDF
    window.open(export_url, '_blank'); // Membuka di tab baru
});
$('#ruangan').select2({
    placeholder: 'Pilih atau ketik nama ruangan',
    allowClear: true, // Memungkinkan penghapusan pilihan
    tags: true // Mengizinkan pengguna untuk menambahkan tag (ruangan baru)
});
// Call the dataTables jQuery plugin
$(document).ready(function() {
    var table;
    table = $('#table').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "ajax": {
            "url": "<?php echo base_url() ?>/dashboard/dbr/ajax_list",
            'data': function(data) {
                data.searchKodeBarang = $('#kode_barang').val();
                data.searchNamaBarang = $('#nama_barang').val();
                data.searchKategori = $('#kategori').val();
                data.searchMerk = $('#merk').val();
                data.searchNUP = $('#NUP').val();
                data.searchKondisi = $('#kondisi').val();
                data.searchPenguasaan = $('#penguasaan').val();
                data.searchRuangan = $('#ruangan').val();
            },
            "type": "POST"
        },
        "createdRow": function(row, data, dataIndex) {
            //console.log(data);
            if (data[9] !== '') {
                $(row).addClass('greenClass');
            }
        }
    });
    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

    //button create post event
    $('body').on('click', '#btn-edit-post', function() {
        var id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: "<?php echo base_url() . INDEX_URL ?>/dashboard/barang/get_barang",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {
                $('#ModalaEdit').modal('show');
                $('#kode_barang_edit').val(data.kode_barang);
                $('#nama_barang_edit').val(data.nama_barang);
                $('#merk_edit').val(data.merk);
                $('#ruangan_edit').val(data.ruangan_edit);
                $('#NUP_edit').val(data.NUP);
                $('#id_barang').val(data.id);


            }
        });
        return false;
    });
});



//Date range picker
$('#tgl_perolehan').daterangepicker({
    autoUpdateInput: false,
    locale: {
        cancelLabel: 'Clear'
    }
});
   </script>