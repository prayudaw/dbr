   <!-- header -->
   <?php $this->load->view('templates/header') ?>
   <!-- end header -->

   <!-- Sidebar -->
   <?php $this->load->view('templates/sidebar') ?>
   <!-- End of Sidebar -->

   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">

       <!-- Main Content -->
       <div id="content">

           <!-- Topbar -->
           <?php $this->load->view('templates/topbar') ?>
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
                   <div class="col-xl-2 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <a href="<?php echo base_url('dashboard/buku') ?>">
                               <div class="card-body">
                                   <div class="row no-gutters align-items-center">
                                       <div class="col mr-2">
                                           
                                       </div>
                                       <div class="col-auto">
                                           <i class="fas fa-book fa-2x text-gray-300"></i>
                                       </div>
                                   </div>
                               </div>
                           </a>

                       </div>
                   </div>


               </div>



               <div class="row">
                   <div class="col-lg-6 mb-4">
                       <!-- about us -->
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-primary">About Sicarik</h6>
                           </div>
                           <div class="card-body">
                               <div class="text-center">
                                   <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/') ?>img/undraw_posting_photo.svg" alt="...">
                               </div>
                               <p>Sicarik adalah Sistem Informasi Catatan Riwayat Pemustaka pengecekan tanggungan koleksi buku, skripsi ,prosedur pengembalian buku dan kunci locker</p>

                           </div>
                       </div>
                   </div>
                   <div class="col-lg-6 mb-4">
                       <!-- about us -->
                       <div class="card shadow mb-4">
                           <div class="card-header py-3">
                               <h6 class="m-0 font-weight-bold text-primary">Jam Layanan Perpustakaan</h6>
                           </div>
                           <div class="card-body">
                               <div class="text-center">
                                   <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?php echo base_url('assets/') ?>img/undraw_posting_photo.svg" alt="...">
                               </div>
                               <p>Jam layanan perpustakaan UIN Sunan Kalijaga sebagai berikut :<br />
                               <ul>
                                   <li>Hari Senin sampai Kamis buka pukul 08.00 samapi 16.00 WIB</li>
                                   <li> Hari Jumat buka pukul 08.00 - 16.30 WIB, istirahat shalat jumat 11.30 - 13.00 WIB</li>
                                   <li>Hari Sabtu Libur</li>
                                   <li>Hari Libur Nasional perpustakaan UIN Sunan Kalijaga tidak membuka layanan</li>
                               </ul>
                               </p>

                           </div>
                       </div>
                   </div>
               </div>

               <!-- Content Row -->
               <div class="row">
               </div>

           </div>
           <!-- /.container-fluid -->

       </div>
       <!-- End of Main Content -->

       <!-- Footer copyright -->
       <?php $this->load->view('templates/footer_copyright') ?>
       <!-- End of Footer copyright -->

   </div>
   <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Sidebar -->
   <?php $this->load->view('templates/footer') ?>
   <!-- End of Sidebar -->