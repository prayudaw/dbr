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

                       <div class="card-body">

                           <div class="table-responsive">
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


   <!-- MODAL EDIT -->
   <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
       <div class="modal-dialog modal-dialog modal-dialog-centered">
           <div class="modal-content">
               <div class="modal-header">
                   <h3 class="modal-title" id="myModalLabel">EDIT</h3>
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

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
                                   type="text" placeholder="Username">
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="control-label col-xs-3">Role</label>
                           <div class="col-xs-9">
                               <select class="form-control" id="kondisi" name="kondisi">
                                   <option value="-">-- Pilih role --</option>
                               </select>
                               <!-- <input name="kobar_edit" id="kode_barang2" class="form-control" type="text" placeholder="Kode Barang" style="width:335px;" readonly> -->
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
   <!--END MODAL EDIT-->


   <style>
       .redClass {
           background-color: red;
           color: white;
       }
   </style>

   <script type="text/javascript">
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
                   $('#id_user').val(data.id);
               }
           });
           return false;
       });

       //Update User 
       $('#btn_update').on('click', function() {
           var id = $('#id_user').val();
           var username = $('#username_edit').val();
           var password = $('#password_edit').val();

           $.ajax({
               type: "POST",
               url: "<?php echo base_url() ?>dashboard/user/update",
               dataType: "JSON",
               data: {
                   id: id,
                   username: username,
                   password: password,
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

       // Call the dataTables jQuery plugin
       $(document).ready(function() {
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