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
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                   <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
               </div>

               <!-- Content Row -->
               <div class="row">

                   <!-- Earnings (Monthly) Card Example -->
                   <div class="col-xl-6 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Total Barang Milik Perpus</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           <?php echo $total_barang_bmn ?></div>
                                   </div>
                                   <div class="col-auto">
                                       <i class="fas fa-list fa-2x text-gray-300"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <!-- Earnings (Monthly) Card Example -->
                   <div class="col-xl-6 col-md-6 mb-4">
                       <div class="card border-left-success shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                           Total Barang Yang Belum Disensus</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">
                                           <?php echo $total_barang_bmn_yg_blm_disensus ?></div>
                                   </div>
                                   <div class="col-auto">
                                       <i class="fas fa-list fa-2x text-gray-300"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>


           </div>
           <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->

       <!-- Footer copyright -->
       <?php $this->load->view('dashboard/templates/footer_copyright') ?>
       <!-- End of Footer copyright -->

   </div>
   <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Sidebar -->
   <?php $this->load->view('dashboard/templates/footer') ?>
   <!-- End of Sidebar -->