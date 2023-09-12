<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/elemefav.png">
		<meta name="author" content="colorlib">
		<!-- Meta Description -->		<!-- Author Meta -->

		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Log on to codeastro.com for more projects -->
		<!-- Site Title -->
		<title>Get Tickets</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js" crossorigin="anonymous"></script> -->

		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/datepicker/dcalendar.picker.css">
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>
		<section class="service-area section-gap relative">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-14">
						<!-- Default Card Example -->
						<div class="card">
					  <div class="card-header">
					   <i class="fas fa-info-circle"></i> ตรวจสอบและชำระเงิน
					  </div>
					  <div class="card-body" align="center">
					  <div class="card-body">
					  	<?php foreach ($product as $row) { ?>
						<table class="table">
						<tbody>
							<tr>
							<th><i text-align: right; class="fa fa-store"> <?=$row['store_name']?></th>
							<th>ราคา</th>
							<th>รูปแบบการรับสินค้า</th>
							<th>จำนวน</th>
							<th>ค่าส่ง</th>
							<?php if($row['pickup_id'] == 'PU001'){ ?>
								<th>วันที่ต้องการรับสินค้า</th>
							<?php }elseif($row['pickup_id'] == 'PU002'){ ?>
								<th>ที่อยู่ในการจัดส่ง</th>
							<?php } ?>
							
							</tr>
							<td><img style="height: 100px;" src="../../assets/images/products/<?= $row['product_image'];  ?>"></img>
							<?= $row['product_name']; ?></td>
							<!-- <td><?= $row['product_id']; ?></td> -->
							<!-- <td><?= $row['product_name']; ?></td> -->
							<td><?= $row['product_price']; ?></td>
							<td><?= $row['pickup_option']; ?></td>
							
							<form action="<?= base_url('booking/add/'.$row['product_id'])?>" enctype="multipart/form-data" method="post">
							<td><input type="number" name="quantity" id="quantity" min="1" max="<?=$row['quantity']?>" value="1" onchange="calculateTotalPrice()"></td>
							<td><?= $row['shipping_cost']; ?></td>
							<?php if($row['pickup_id'] == 'PU001'){ ?>
								<td><input type="date" id="pickup_date" name="pickup_date" min="<?= date('Y-m-d') ?>" required></td>
							<?php }elseif($row['pickup_id'] == 'PU002'){ ?>
								<td><textarea id="address" name="address" required rows="6" cols="22"><?= $this->session->userdata('address') ?></textarea></td>
							<?php } ?>
						</tbody>
						</table>
						<h4>ยอดรวมทั้งสิ้น <b id="total-price" style="color:#e44830">฿<?= $row['product_price']+$row['shipping_cost']; ?></b></h4>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-12">
						<div class="card">
							<div class="preview row-md-4">
							<table>
						<tbody>
							<tr>
								<th><h4>ร้านค้า: <?=$row['store_name']?></h4></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th style="text-align: right"><h4 style="text-align: right">กรุณาชำระเงินและแนบหลักฐาน</h4></th>
							</tr>
								<th><h4>ธนาคาร: <?=$row['bank_account']?></h4></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><input type="file" name="fileToUpload" id="fileToUpload" required=""><br></th>
							<tr>
								<th><h4>ชื่อบัญชี: <?=$row['bank_account_name']?></h4></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><td>&nbsp;&nbsp;&nbsp;</td></th>
								<th><input type="submit" class="btn btn-primary pull-rigth" value="ยืนยัน" name="submit">
								<button class="btn btn-secondary" onclick="history.back()"> ยกเลิก</button>
								</form></th>
							</tr>
							<tr>
								<th><h4>หมายเลขบัญชี: <?=$row['number_bank_account']?></h4></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tbody>
						</table>
							</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</section>
			<!-- End banner Area -->
			<!-- start footer Area -->
			<?php //$this->load->view('frontend/include/base_footer'); ?>
			<!-- js -->
			<?php $this->load->view('frontend/include/base_js'); ?>
		</body>
	</html>

	<script>
function calculateTotalPrice() {
  let quantity = document.getElementById("quantity").value;
  let unitPrice = <?= $row['product_price'] ?>;
  let shippingCost = <?= $row['shipping_cost'] ?>;
  let totalPrice = quantity * (unitPrice + shippingCost);

  // Add comma to totalPrice if it's 1,000 or more
  let formattedTotalPrice = totalPrice.toLocaleString();

  document.getElementById("total-price").textContent = "฿" + formattedTotalPrice;
}

$(function() {
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
    });
  });
</script>

	<style>
.card {
  margin-top: 50px;
  padding: 3em;
  line-height: 1.5em; }

.btn-primary,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:visited,
.btn-primary:focus {
    background-color: #e44830;
    border-color: #e44830;
}
</style>