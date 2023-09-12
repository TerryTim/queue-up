<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <!-- css -->
  <?php $this->load->view('store/include/base_css'); ?>

</head>

<body id="page-top">

  <!-- navbar --><!-- Log on to codeastro.com for more projects -->
  <?php $this->load->view('store/include/base_nav'); ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
          <!-- Content Row -->
          <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-info text-uppercase mb-1"><a href="<?= base_url('store/order/select_today') ?>">คำสั่งการจองวันนี้</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $order_today[0]['count(order_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text font-weight-bold text-info text-uppercase mb-1"><a href="<?= base_url('store/order') ?>">คำสั่งการจองทั้งหมด</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $order[0]['count(order_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-s font-weight-bold text-success text-uppercase mb-1"><a href="<?= base_url('store/product') ?>">สินค้าทั้งหมด</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $product[0]['count(product_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <!-- <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a href="<?= base_url('store/confirmation') ?>">Payments List</a></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $confirmation[0]['count(id_confirmation)']; ?></div>
                        </div>
                        <div class="col">
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          </div>


          <div class="row">

            <!-- <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                      <div class="text-s font-weight-bold text-success text-uppercase mb-1"><a href="<?= base_url('store/product') ?>">สินค้าทั้งหมด</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $product[0]['count(product_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- Log on to codeastro.com for more projects -->

            <!-- <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="<?= base_url('store/timetable') ?>">Available Schedules</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="<?= base_url('store/bus') ?>">Available Bus</a></div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $bus[0]['count(id_bus)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-bus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->



          </div>

          <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-s font-weight-bold text-success text-uppercase mb-1"><a href="<?= base_url('store/category') ?>">จัดการหมวดหมู่สินค้า</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $category[0]['count(category_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-layer-group fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-s font-weight-bold text-success text-uppercase mb-1"><a href="<?= base_url('store/parcel_delivery_company') ?>">จัดการบริษัทขนส่ง</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $parcel_delivery_company[0]['count(company_id)']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-truck fa-2x text-gray-300"></i>
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

      <!-- Footer -->
      <?php $this->load->view('store/include/base_footer'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  <!-- Log on to codeastro.com for more projects -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- js -->
  <?php $this->load->view('store/include/base_js'); ?>

</body>

</html>

<?php $this->load->view('store/include/notification'); ?>
