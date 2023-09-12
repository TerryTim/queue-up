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
      <!-- Page Heading -->
      <!-- Log on to codeastro.com for more projects -->
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">รหัสสินค้า[<?= $product['product_id']; ?>]  </h6>
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
             
            <div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <p>ชื่อสินค้า    : <b><?= $product['product_name']; ?></b></p>
                  <p>รายละเอียดสินค้า : <b><?= $product['product_description']; ?></b></p>
                  <p>รูปภาพ : <br><img style="height: 150px;" src="../../../assets/images/products/<?= $product['product_image'];  ?>"></p>
                  <p>ราคา   : <b><?= $product['product_price'] ?></b></p>
                  <p>วิธีการรับสินค้า   : <b><?= $product['pickup_option'] ?></b></p>
                  <p>ค่าจัดส่งสินค้า   : <b><?= $product['shipping_cost'] ?></b></p>
                  <p>จำกัดจำนวนสินค้าต่อหนึ่งการจอง   : <b><?= $product['quantity'] ?></b></p>
                  <p>ประเภทสินค้า   : <b><?= $product['category_name'] ?></b></p>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
            <hr>
                        <a class="btn btn-secondary" href="javascript:history.back()"> กลับ</a>

          </div>
        </form>
      </div>
    </div>
  </div></div>
  <!-- End of Main Content -->
  <!-- Log on to codeastro.com for more projects -->
  <!-- Footer -->
  <?php $this->load->view('store/include/base_footer'); ?>
  <!-- End of Footer -->
<!-- js -->
<?php $this->load->view('store/include/base_js'); ?>
</body>
</html>

<?php $this->load->view('store/include/notification'); ?>