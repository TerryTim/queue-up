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
    <!-- navbar -->
    <?php $this->load->view('store/include/base_nav'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      
      <!-- DataTales Example -->
      <!-- Log on to codeastro.com for more projects -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h1 class="h5 text-gray-800"><i class="fas fa-bookmark"></i> รายการคำสั่งจอง</h1>
        </div>
        <div class="card-body">
        
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                  <th>เวลา</th>
                  <th>รหัสคำสั่ง</th>
                  <th>สินค้า</th>
                  <th>จำนวน</th>
                  <th>รูปแบบการรับสินค้า</th>
                  <th>สถานะการชำระเงิน</th>
                  <th>สถานะคำสั่ง</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($order as $row) { ?>
                    <?php if($row['new'] == 1){ ?>
                      <tr style="cursor: pointer;" onclick="window.location='<?= base_url('store/order/vieworder/'.$row['order_id']) ?>'">
                        <td><b><?= $row['create_at']; ?></b></td>
                        <td><b><?= $row['order_id']; ?></b></td>
                        <td><b><?= $row['product_name']; ?></b>
                      <small><i class="fas fa-circle" style="color: red"></i></small></td>
                      <td><b><?= $row['quantity']; ?></b></td>
                    <td><?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
                      <b><i class="fas fa-truck"></i></b>
                        <?php } else{ ?>
                          <b><i class="fas fa-store"></i></b>
                        <?php } ?>
                        <b><?= $row['pickup_option']; ?></b>
                    </td>
                    <td>
                    <b><?= $row['payment_status']; ?></b>
                    </td>
                    <td>
                      <?php if($row['order_status_id'] == "ORD_S001"){ ?>
                        <div style="color: orange"><b><?= $row['order_status_name']; ?></b></div>
                          <?php } else if($row['order_status_id'] == "ORD_S002" or $row['order_status_id'] == "ORD_S004"){ ?>
                            <div style="color: green"><b><?= $row['order_status_name']; ?></b></div>
                          <?php } else if($row['order_status_id'] == "ORD_S006"){ ?>
                            <div style="color: red"><b><?= $row['order_status_name']; ?></b></div>
                          <?php } else if($row['order_status_id'] == "ORD_S003"){ ?>
                            <div style="color: #f9c110"><b><?= $row['order_status_name']; ?></b></div>
                          <?php } else{ ?>
                            <b><?= $row['order_status_name']; ?></b>
                          <?php } ?>
                    </td>
                    <?php }else{ ?>
                      <tr style="cursor: pointer;" onclick="window.location='<?= base_url('store/order/vieworder/'.$row['order_id']) ?>'">
                        <td><?= $row['create_at']; ?></td>
                        <td><?= $row['order_id']; ?></td>
                        <td><?= $row['product_name']; ?></td>
                        <td><?= $row['quantity']; ?></td>
                    <td><?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
                          <i class="fas fa-truck"></i>
                        <?php } else{ ?>
                          <i class="fas fa-store"></i>
                        <?php } ?>
                        <?= $row['pickup_option']; ?>
                    </td>
                    <td>
                    <?= $row['payment_status']; ?>
                    </td>
                    <td>
                      <?php if($row['order_status_id'] == "ORD_S001"){ ?>
                        <div style="color: orange"><?= $row['order_status_name']; ?></div>
                          <?php } else if($row['order_status_id'] == "ORD_S002" or $row['order_status_id'] == "ORD_S004"){ ?>
                            <div style="color: green"><?= $row['order_status_name']; ?></div>
                          <?php } else if($row['order_status_id'] == "ORD_S006"){ ?>
                            <div style="color: red"><?= $row['order_status_name']; ?></div>
                          <?php } else if($row['order_status_id'] == "ORD_S003"){ ?>
                            <div style="color: #f9c110"><?= $row['order_status_name']; ?></div>
                          <?php } else{ ?>
                            <?= $row['order_status_name']; ?>
                          <?php } ?>
                    </td>
                    <?php } ?>
                    
                  </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<?php $this->load->view('store/include/base_footer'); ?>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div><!-- Log on to codeastro.com for more projects -->
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- js -->
<?php $this->load->view('store/include/base_js'); ?>
</body>
</html>

<?php $this->load->view('store/include/notification'); ?>