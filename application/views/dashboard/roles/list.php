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
                           <i class="fa fa-plus"></i> Tambah Role User
                       </button>
                       <div class="table-responsive">
                           <div class="card-body">
                               <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>No</th>
                                           <th>Role Name</th>
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
                   <h5 class="modal-title" id="addModalLabel">Tambah Role User</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="addForm">
                       <div class="mb-3">
                           <label for="role" class="form-label">Role Name</label>
                           <input type="text" class="form-control" id="role_name" name="role_name">
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
                           <label class="control-label col-xs-3">Role User</label>
                           <div class="col-xs-9">
                               <input type="text" name="role_name_edit" id="role_name_edit" class="form-control"
                                   type="text" placeholder="Role Name ">
                           </div>
                       </div>
                       <input type="hidden" name="role_id" id="role_id">
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
                   "url": "<?php echo base_url() ?>dashboard/roles_user/ajax_list",
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
                   url: '<?php echo base_url() ?>dashboard/roles_user/add', // Replace with your backend endpoint
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
                       $('#addUserForm')[0].reset();
                       $('#addUserModal').modal('hide');
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
                   url: "<?php echo base_url() ?>dashboard/roles_user/get_role_by_id/" + id,
                   dataType: "JSON",
                   data: {
                       id: id
                   },
                   success: function(data) {
                       console.log(data);
                       $('#ModalaEdit').modal('show');
                       $('#role_name_edit').val(data.role_name);
                       $('#role_id').val(data.id);
                   }
               });
               return false;
           });

           //Proses Update role user 
           $('#btn_update').on('click', function() {
               var id = $('#role_id').val();
               var role_name = $('#role_name_edit').val();

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url() ?>dashboard/roles_user/update",
                   dataType: "JSON",
                   data: {
                       id: id,
                       role_name: role_name
                   },
                   success: function(data) {
                       console.log(data);
                       if (data.status == 1) {
                           Swal.fire({
                               icon: 'success',
                               title: 'Sukses',
                               text: data.message
                           });
                           $('#ModalaEdit').modal('hide');
                           $('#id_user').val('');
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
                       url: '<?php echo base_url('dashboard/roles_user/delete'); ?>',
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