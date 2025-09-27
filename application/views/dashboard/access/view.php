      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



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
                          <h6 class="m-0 font-weight-bold text-primary">Role User :
                              <?php echo $role_data['role_name'] ?></h6>
                          <hr />
                          <form id="accessForm">
                              <ul id="tree">
                                  <?php
                                    // Fungsi rekursif untuk membangun treeview
                                    function build_tree($menus, $parent_id = 0, $current_access)
                                    {
                                        foreach ($menus as $menu) {
                                            if ($menu['parent_id'] == $parent_id) {
                                                $is_checked = in_array($menu['id'], array_column($current_access, 'menu_id')) ? 'checked' : '';
                                                echo '<li>';
                                                echo '<input type="checkbox" name="menu_ids[]" value="' . $menu['id'] . '" ' . $is_checked . '> ' . $menu['menu_name'];
                                                // Cari anak-anaknya (recursive)
                                                $children = array_filter($menus, function ($item) use ($menu) {
                                                    return $item['parent_id'] == $menu['id'];
                                                });

                                                if (!empty($children)) {
                                                    echo '<ul>';
                                                    build_tree($menus, $menu['id'], $current_access);
                                                    echo '</ul>';
                                                }

                                                echo '</li>';
                                            }
                                        }
                                    }
                                    build_tree($menus, 0, $current_access);
                                    ?>
                              </ul>
                              <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
                              <button type="submit" class="btn btn-success">Simpan </button>
                              <a href="<?php echo base_url('dashboard/roles_user') ?>" class="btn btn-danger">Kembali
                              </a>
                          </form>
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

      <script src="https://cdn.jsdelivr.net/npm/jquery-treeview@1.4.2/jquery.treeview.min.js"></script>

      <script type="text/javascript">
          // Call the dataTables jQuery plugin
          $(document).ready(function() {
              // Aktifkan JQuery Treeview
              $("#tree").treeview();

              // Handle form submission dengan AJAX
              $('#accessForm').submit(function(e) {
                  e.preventDefault();
                  //   alert('tes');
                  //   return false;
                  $.ajax({
                      url: "<?php echo base_url('dashboard/access/update'); ?>",
                      type: "POST",
                      data: $(this).serialize(),
                      dataType: "json",
                      success: function(response) {
                          alert(response.message);
                      }
                  });
              });
          });
      </script>