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
           <div class="container-fluid">

               <!-- Page Heading -->
               <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title ?></h1>

               <!-- DataTales Example -->
               <div class="card shadow mb-4">

                   <div class="card-header py-3">
                       <h6 class="m-0 font-weight-bold text-primary"></h6>
                       <button type="button" class="btn btn-primary" id="btn-modal-add">
                           <i class="fa fa-plus"></i> Tambah Menu
                       </button>
                       <div class="table-responsive">
                           <div class="card-body">
                               <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>No</th>
                                           <th>Menu ID</th>
                                           <th>menu_name</th>
                                           <th>url</th>
                                           <th>icon</th>
                                           <th>parent_id</th>
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

           </div>
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


   <!-- modal tambah -->
   <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="addModalLabel">Tambah Menu</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="addForm">
                       <div class="mb-3">
                           <label for="role" class="form-label">Menu Name</label>
                           <input type="text" class="form-control" id="menu_name" name="menu_name">
                       </div>
                       <div class="mb-3">
                           <label for="role" class="form-label">url</label>
                           <input type="text" class="form-control" id="url" name="url">
                       </div>
                       <div class="mb-3">
                           <label for="role" class="form-label">icon</label>
                           <input type="text" class="form-control" id="icon" name="icon">
                       </div>
                       <div class="mb-3">
                           <label for="role" class="form-label">parent_id</label>
                           <input type="text" class="form-control" id="parent_id" name="parent_id">
                       </div>
                       <button type="submit" class="btn btn-primary">Simpan</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <!-- end modal tambah-->


   <!-- modal edit -->
   <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
       <div class="modal-dialog modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h3 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i>Edit</h3>
               </div>
               <form class="form-horizontal">
                   <div class="modal-body">
                       <div class="form-group">
                           <label class="control-label col-xs-3">Menu Name</label>
                           <div class="col-xs-3">
                               <input type="text" name="menu_name_edit" id="menu_name_edit" class="form-control"
                                   type="text" placeholder="Menu Name">
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-xs-9">
                               <input type="text" name="url_edit" id="url_edit" class="form-control" type="text"
                                   placeholder="Url">
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-xs-9">
                               <input type="text" name="icon_edit" id="icon_edit" class="form-control" type="text"
                                   placeholder="Icon">
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-xs-9">
                               <input type="text" name="parent_id_edit" id="parent_id_edit" class="form-control"
                                   type="text" placeholder="Parent id">
                           </div>
                       </div>
                       <input type="hidden" name="menu_id" id="menu_id">
                       <div class="modal-footer">
                           <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                           <button class="btn btn-info" id="btn_update">Update</button>
                       </div>
               </form>
           </div>
       </div>
   </div>
   <!-- end modal edit -->


   <script type="text/javascript">
       // Call the dataTables jQuery plugin
       $(document).ready(function() {

           var table;
           table = $('#table').DataTable({
               "processing": true, //Feature control the processing indicator.
               "serverSide": true, //Feature control DataTables' server-side processing mode.
               "order": [], //Initial no order.
               "ajax": {
                   "url": "<?php echo base_url() ?>dashboard/menu/ajax_list",
                   'data': function(data) {},
                   "type": "POST"
               },
               "createdRow": function(row, data, dataIndex) {}
           });


           //onclick button tambah 
           $('body').on('click', '#btn-modal-add', function() {
               $('#addModal').modal('show');
           });


           //proses add 
           $('#addForm').on('submit', function(e) {
               e.preventDefault(); // Prevent the default form submission
               var formData = $(this).serialize(); // Serialize form data into a URL-encoded string

               $.ajax({
                   url: '<?php echo base_url() ?>dashboard/menu/add', // Replace with your backend endpoint
                   type: 'POST',
                   data: formData,
                   success: function(data) {
                       if (data.status == 1) {
                           Swal.fire({
                               icon: 'success',
                               title: 'Sukses',
                               text: data.message
                           });
                           $('#addModal').modal('hide'); //sembunyikan popup add 
                           table.ajax.reload(); //just reload table
                           // Optional: reload a data table or refresh a list

                       } else {
                           Swal.fire({
                               icon: 'error',
                               title: 'Oops...',
                               text: data.message
                           });
                       }
                       $('#addForm')[0].reset();
                       $('#addModal').modal('hide');
                       // Handle success response from the server
                       // alert('User added successfully!');

                       // You might want to clear the form and close the modal

                   },
                   error: function(xhr, status, error) {
                       // Handle error response
                       alert('An error occurred: ' + error);
                   }
               });
           });

           //onclick button edit
           $('body').on('click', '#btn-edit-post', function() {
               var id = $(this).data('id');
               $.ajax({
                   type: "GET",
                   url: "<?php echo base_url() ?>dashboard/menu/get_menu_by_id/" + id,
                   dataType: "JSON",
                   data: {
                       id: id
                   },
                   success: function(data) {
                       $('#ModalaEdit').modal('show');
                       $('#menu_name_edit').val(data.menu_name);
                       $('#url_edit').val(data.url);
                       $('#icon_edit').val(data.icon);
                       $('#parent_id_edit').val(data.parent_id);
                       $('#menu_id').val(data.id);

                   }
               });
               return false;
           });

           //Proses Update role user 
           $('#btn_update').on('click', function() {
               var id = $('#menu_id').val();
               var menu_name = $('#menu_name_edit').val();
               var url = $('#url_edit').val();
               var icon = $('#icon_edit').val();
               var parent_id = $('#parent_id_edit').val();

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url() ?>dashboard/menu/update",
                   dataType: "JSON",
                   data: {
                       id: id,
                       menu_name: menu_name,
                       url: url,
                       icon: icon,
                       parent_id: parent_id,
                   },
                   success: function(data) {
                       if (data.status == 1) {
                           Swal.fire({
                               icon: 'success',
                               title: 'Sukses',
                               text: data.message
                           });
                           $('#ModalaEdit').modal('hide');
                           $('#menu_id').val('');
                           table.ajax.reload(); //just reload table
                       } else {
                           Swal.fire({
                               icon: 'error',
                               title: 'Oops...',
                               text: data.message
                           });
                           return false;
                       }
                   }
               });
               return false;
           });

           //proses hapus
           $('body').on('click', '.delete-btn', function() {
               var id = $(this).data('id');
               if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                   // Mengirim permintaan AJAX ke server
                   $.ajax({
                       url: '<?php echo base_url('dashboard/menu/delete'); ?>',
                       type: 'POST',
                       data: {
                           id: id
                       },
                       dataType: 'json',
                       success: function(response) {
                           if (response.status === 1) {
                               Swal.fire({
                                   icon: 'success',
                                   title: 'Sukses',
                                   text: response.message
                               });
                               table.ajax.reload(); //just reload table
                           } else {
                               Swal.fire({
                                   icon: 'error',
                                   title: 'Oops...',
                                   text: response.message
                               });
                           }
                       },
                       error: function(xhr, status, error) {
                           alert("Terjadi kesalahan saat menghubungi server: " +
                               error);
                       }
                   });
               }
           });





       });
   </script>