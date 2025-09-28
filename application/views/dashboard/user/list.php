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
                           <i class="fa fa-plus"></i> Tambah user
                       </button>
                       <div class="table-responsive">
                           <div class="card-body">
                               <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>No</th>
                                           <th>Username</th>
                                           <th>Role</th>
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

   <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="addUserModalLabel">Tambah User baru</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <form id="addUserForm">
                       <div class="mb-3">
                           <label for="username" class="form-label">Username</label>
                           <input type="text" class="form-control" id="username" name="username" required>
                       </div>

                       <div class="mb-3">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" class="form-control" id="password" name="password" required>
                       </div>
                       <div class="mb-3">
                           <label for="role" class="form-label">Role</label>
                           <select class="form-control" aria-label="" id="role" name="role">
                               <option value="">--Pilih Role--</option>
                               <?php foreach ($role_user as $value) { ?>
                                   <option value="<?php echo $value['id'] ?>"><?php echo $value['role_name'] ?></option>
                               <?php } ?>
                           </select>
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
                           <label class="control-label col-xs-3">Username</label>
                           <div class="col-xs-9">
                               <input type="text" name="username_edit" id="username_edit" class="form-control"
                                   type="text" placeholder="Username">
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label col-xs-3">Password</label>
                           <div class="col-xs-9">
                               <input type="password" name="password_edit" id="password_edit" class="form-control"
                                   type="text" placeholder="Password">
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label col-xs-3">Role</label>
                           <div class="col-xs-9">
                               <select class="form-control" aria-label="" id="role_edit" name="role_edit">
                                   <option value="">--Pilih Role--</option>
                                   <?php foreach ($role_user as $value) { ?>
                                       <option value="<?php echo $value['id'] ?>"><?php echo $value['role_name'] ?></option>
                                   <?php } ?>
                               </select>
                           </div>
                           <input type="hidden" name="id_user" id="id_user">
                       </div>
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

           //onclick button tambah user
           $('body').on('click', '#btn-modal-add', function() {
               $('#addUserModal').modal('show');
           });

           //proses add 
           $('#addUserForm').on('submit', function(e) {
               e.preventDefault(); // Prevent the default form submission
               var formData = $(this).serialize(); // Serialize form data into a URL-encoded string

               $.ajax({
                   url: '<?php echo base_url() ?>dashboard/user/add_user', // Replace with your backend endpoint
                   type: 'POST',
                   data: formData,
                   success: function(data) {

                       if (data.status == 1) {
                           Swal.fire({
                               icon: 'success',
                               title: 'Sukses',
                               text: data.message
                           });
                           // Optional: reload a data table or refresh a list
                           window.location.reload();

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
                   url: "<?php echo base_url() ?>dashboard/user/get_user_by_id/" + id,
                   dataType: "JSON",
                   data: {
                       id: id
                   },
                   success: function(data) {
                       console.log(data);
                       $('#ModalaEdit').modal('show');
                       $('#username_edit').val(data.username);
                       $('#role_edit').val(data.role);
                       $('#id_user').val(data.id);
                   }
               });
               return false;
           });

           //Proses Update User 
           $('#btn_update').on('click', function() {
               var id = $('#id_user').val();
               var username = $('#username_edit').val();
               var password = $('#password_edit').val();
               var role = $('#role_edit').val();

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url() ?>dashboard/user/update",
                   dataType: "JSON",
                   data: {
                       id: id,
                       username: username,
                       password: password,
                       role: role,
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
           var table;
           table = $('#table').DataTable({
               "processing": true, //Feature control the processing indicator.
               "serverSide": true, //Feature control DataTables' server-side processing mode.
               "order": [], //Initial no order.
               "ajax": {
                   "url": "<?php echo base_url() ?>dashboard/user/ajax_list",
                   'data': function(data) {},
                   "type": "POST"
               },
               "createdRow": function(row, data, dataIndex) {}
           });

       });
   </script>