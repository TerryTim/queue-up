  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('store/home') ?>">
        <!-- <div class="sidebar-brand-icon rotate-n-15"> -->
          <!-- <i class="fas fa-bus"></i> -->
        <!-- </div> -->
        <div class="sidebar-brand-text mx-3">QUEUEUP</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <!-- <a class="nav-link" href="<?= base_url() ?>store/home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard </span></a>
          <a class="nav-link" href="<?= base_url() ?>store/bus">
            <i class="fas fa fa-bus"></i>
            <span>Manage Bus</span></a>
            <a class="nav-link" href="<?= base_url() ?>store/rute">
              <i class="fas fa fa-compass"></i>
              <span>Manage Terminal</span></a> -->
        <!-- <a class="nav-link" href="<?= base_url() ?>store/order">
          <i class="fas fa-bookmark"></i>
          <span>List Bookings</span></a>
        <a class="nav-link" href="<?= base_url() ?>store/ticket">
          <i class="fas fa-ticket-alt"></i>
          <span>Tickets</span></a> -->
          <a class="nav-link" href="<?= base_url() ?>store/order">
          <i class="fas fa-bookmark"></i>
          <span>คำสั่งการจอง</span></a>
        <a class="nav-link" href="<?= base_url() ?>store/product">
          <i class="fas fa-box"></i>
          <span>จัดการสินค้า</span></a>
        <a class="nav-link" href="<?= base_url() ?>store/chat">
          <i class="fas fa-comment-alt"></i>
          <span>ข้อความ</span></a>

        <a class="nav-link" href="<?= base_url() ?>store/category">
          <i class="fas fa-layer-group"></i>
          <span>จัดการหมวดหมู่สินค้า</span></a>
        <a class="nav-link" href="<?= base_url() ?>store/parcel_delivery_company">
          <i class="fas fa-truck"></i>
          <span>จัดการบริษัทขนส่ง</span></a>
        <?php if ($this->session->userdata('level') == '1') { ?>
           <a class="nav-link" href="<?= base_url() ?>store/bank">
          <i class="fas fa fa-piggy-bank"></i>
          <span>Bank List</span></a>
        <a class="nav-link" href="<?= base_url() ?>store/laporan">
          <i class="fa fa fa-file"></i>
          <span>Report</span></a>
             <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-users"></i>
              <span>User Management</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('store/customer') ?>">Customer List</a>
                <a class="collapse-item" href="<?= base_url() ?>store/admin">Administrator</a>
              </div>
            </div>
          </li>
        <?php }else{ } ?>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <!-- <div class="text-center d-none d-md-inline">
        
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div> -->

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="<?= base_url('store/order/vieworder') ?>" method="GET">
            <div class="input-group">
              <input type="text" name="order" class="form-control bg-light border-0 small" placeholder="ค้นหาคำสั่งการจอง" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-info" >
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            
            <div class="topbar-divider d-none d-sm-block"></div>

            <?php 
              // Retrieve customer data from the database
              $entrepreneur_id = $this->session->userdata('entrepreneur_id'); // Replace with actual customer ID
              $query = $this->db->get_where('entrepreneurs', array('entrepreneur_id' => $entrepreneur_id));
              $profile = $query->row_array();
            ?>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $profile['store_name']; ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('assets/images/profiles/entrepreneurs/' . $profile['store_image']) ?>" alt="Profile Image">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">
                  <i class="fas fa-info-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                  บัญชีของฉัน
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  ออกจากระบบ
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


        
