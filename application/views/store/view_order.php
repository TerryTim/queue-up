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
          <h6 class="m-0 font-weight-bold text-primary">รหัสคำสั่ง [<?= $order[0]['order_id']; ?>]  </h6>
        </div>
        <div class="card-body">
            <div class="card-body">
              <div class="row">
                <?php foreach ($order as $row ) { ?>
                <input type="hidden" class="form-control" name="id_customer" value="<?= $row['id_customer'] ?>" readonly>
                <input type="hidden" class="form-control" name="order_id" value="<?= $row['order_id'] ?>" readonly>
                <input type="hidden" class="form-control" name="origin_beli" value="<?= $row['order_status_name'] ?>" readonly>
                <input type="hidden" class="form-control" name="id_ticket[]" value="<?= $row['quantity'] ?>" readonly>

                <div class="col-sm-2">
                  <div class="row form-group">
                  <img style="height:200px; width:200px; object-fit: cover;" src="../../../assets/images/products/<?= $row['product_image'];  ?>"></img>
                  </div>
                </div>
                
                <div class="col-sm-5">
                  <p>ผู้สั่ง <b><?= $row['username_customer']; ?></b></p>
                  <b><?= $row['name_customer']; ?></b>
                  <hr>
                  <div class="row form-group">
                    <label for="name" class="col-sm-4 control-label">สินค้า</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="product_name" value="<?= $row['product_name'] ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="name" class="col-sm-4 control-label">ราคา</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="product_price" value="<?= $row['product_price'] ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="name" class="col-sm-4 control-label">จำนวน</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="quantity" value="<?= $row['quantity'] ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">ค่าส่ง</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="shipping_cost" value="<?= $row['shipping_cost'] ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">รูปแบบการรับสินค้า</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="pickup_option>" value="<?= $row['pickup_option'] ?>" readonly>
                    </div>
                  </div>
                  <?php if($row['pickup_id'] == 'PU001'){ ?>
                    <div class="row form-group">
                      <label for="" class="col-sm-4 control-label">วันที่ต้องการรับสินค้า</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="pickup_date" value="<?= $row['pickup_date'] ?>" readonly>
                      </div>
                    </div>
                  <?php } ?>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">สถานะคำสั่ง</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="order_status_name" value="<?php  echo $row['order_status_name']; ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">สถานะการชำระเงิน</label>
                    <div class="col-sm-6">
                      <?php if($row['payment_status'] == "ชำระเงินแล้ว"){ ?>
                        <input type="text" class="form-control" style="color: green" name="payment_status" value="<?php  echo $row['payment_status']; ?>" readonly>
                        <?php } else{ ?>
                        <input type="text" class="form-control" style="color: red" name="payment_status" value="<?php  echo $row['payment_status']; ?>" readonly>
                      <?php } ?>
                    </div>
                  </div>
                  <?php if($row['payment_status'] == "ชำระเงินแล้ว"){ ?>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">หลักฐานการชำระเงิน</label>
                    <div class="col-sm-6">
                      <p class="mb-0"> <a href="<?= base_url('assets/images/payment_proof/'.$order[0]['payment_proof']) ?>" class="btn btn-info">ดูหลักฐาน</a></p>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">เวลาที่ทำรายการ</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="date_beli" value="<?= hari_indo(date('N',strtotime($row['create_at']))).', '.tanggal_indo(date('Y-m-d',strtotime(''.$row['create_at'].''))).', '.date('H:i',strtotime($row['create_at']));  ?>" readonly>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label">ยอดรวมทั้งสิ้น</label>
                    <div class="col-sm-6">
                      <h4><b>฿ <?php $total =  count($order) * $order[0]['product_price']*$row['quantity']+$row['shipping_cost']; echo number_format($total)?></b></h4>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="" class="col-sm-4 control-label"></label>
                      <?php if($row['order_status_id'] == "ORD_S001"){ ?>
                        <a class="btn" href="<?= base_url('store/order/accept/'.$row['order_id']) ?>">
                        <b class="btn btn-success"><i class="fas fa-check"></i> ยอมรับคำสั่ง</b></a>
                        <a class="btn" href="<?= base_url('store/order/deny/'.$row['order_id']) ?>">
                        <b class="btn btn-danger"><i class="fas fa-times"></i> ปฏิเสธ</b></a>
                      <?php } elseif($row['order_status_id'] == "ORD_S002" && $row['pickup_id'] == "PU001"){ ?>
                        <a class="btn" href="<?= base_url('store/order/prepare/'.$row['order_id']) ?>">
                        <b class="btn btn-info"><i class="fas fa-box"></i> กำลังเตรียมสินค้า</b></a>
                      <?php } elseif($row['order_status_id'] == "ORD_S003" && $row['pickup_id'] == "PU001"){ ?>
                        <a class="btn" href="<?= base_url('store/order/done/'.$row['order_id']) ?>">
                        <b class="btn btn-success"><i class="fas fa-check"></i> เตรียมสินค้าเส็จแล้ว</b></a>
                      <?php } elseif($row['order_status_id'] == "ORD_S007" && $row['pickup_id'] == "PU001"){ ?>
                        <a class="btn" href="<?= base_url('store/order/customer_has_received/'.$row['order_id']) ?>">
                        <b class="btn btn-success"><i class="fas fa-check"></i> ลูกค้าได้รับสินค้าแล้ว</b></a>
                      <?php } ?>
                    </div>
                </div>
                <?php if($row['pickup_id'] == "PU002"){ ?>
                <div class="col-sm-5">
                  <p><b>ที่อยู่ในการจัดส่ง </b></p>
                  <hr>
                  <div class="row form-group">
                    <label for="name" class="col-sm-8 control-label">
                    <?= $order[0]['shipping_address']; ?></label>
                    <div></div>
                  </div>
                  <hr>
                  <?php } ?>                  

                <?php if($row['order_status_id'] != "ORD_S001" && $row['pickup_id'] == "PU002"){ ?>
                <div class="col-sm-8">
                  <p><b>ข้อมูลพัสดุสำหรับสินค้าจัดส่งถึงที่ </b></p>
                  <hr>
                  <form action="<?= base_url()?>store/order/addTracking" method="post">
                  <input type="hidden" name="order_id" value="<?= $order[0]['order_id']; ?>">
                  <div class="row form-group">
                    <label for="name" class="col-sm-4 control-label">บริษัทขนส่ง</label>
                    <div class="col-sm-6">
                      <select class="form-control chosen-select" name="company_id"  required="">
                        <?php if($row['company_id'] != "PDC000"){ ?>
                          <option value="<?= $row['company_id'] ?>" selected disable=''><?= $row['company_name']; ?></option>
                          <?php foreach ($parcel_company as $row ) {?>
                          <option value="<?= $row['company_id'] ?>" ><?= $row['company_name']; ?></option>
                          <?php } ?>
                        <?php }else{ ?>
                          <option value="" selected disabled="">เลือกบริษัทขนส่ง</option>
                          <?php foreach ($parcel_company as $row ) {?>
                          <option value="<?= $row['company_id'] ?>" ><?= $row['company_name']; ?></option>
                          <?php } ?>
                        <?php } ?>
                    </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <label for="name" class="col-sm-4 control-label">หมายเลขพัสดุ</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="shipping_tracking" value="<?= $order[0]['shipping_tracking'] ?>">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-success pull-rigth" value="บันทึก" name="submit">
                </form>

                  <?php if(isset($order[0]['shipping_tracking'])){ ?>
                    <br>
                    <a class="btn btn-success" href="<?= 'https://th.kerryexpress.com/th/track/v2/?track='.$order[0]['shipping_tracking'] ?>">
                    <i class="fas fa-dolly-flatbed"></i> ติดตามพัสดุ</a>
                  <?php } ?>
                <?php } ?>
                <?php } ?>
              </div>
              </div>
              <hr><a class="btn btn-secondary float-left" href="<?= base_url().'store/order' ?>"><i class="fas fa-angle-left"></i> กลับ</a>
                <!-- <button type="submit" class="btn btn-success">Submit</button> -->
              <!-- <a class="btn btn-primary float-right" href="<?= base_url('assets/store/upload/eticket/'.$row['order_id'].'.pdf') ?>" target="_blank"> Print E-Ticket</a>  -->
              <!-- <a class="btn btn-primary float-right" href="<?= base_url('store/order/kirimemail/'.$row['order_id']) ?>"> Send E-Ticket</a> -->
            </div>
          </div>
      </div>
    </div>
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