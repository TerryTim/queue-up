<!DOCTYPE html>
<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/elements/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<!-- Log on to codeastro.com for more projects -->
		<title>ประวัติการซื้อ</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<!--CSS-->
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>

		
		<div class="generic-banner">
			<br>
			<h2 class="justify-content-center" align="center">ประวัติการซื้อ </h2>
			<div class="container ">
				<div class="row d-flex justify-content-center">
					<?php foreach ($customer as $row) {	 ?>
					<div class="col-sm-6 align-items-center" >
						&nbsp;
						<div class="card justify-content-center" style="width: 32rem;">
							
							<div class="card-body " align="left" >
							<a><i class="fa fa-store"></i> <?= $row['store_name']; ?></a>
							<div class="media">
							<img style="height:150px; width:150px; object-fit: cover;"  src="../assets/images/products/<?= $row['product_image'];  ?>" class="mr-3" alt="Responsive image" >
							<div class="media-body" style="cursor: pointer;" onclick="window.location='<?= base_url('profile/order/'.$row['order_id']) ?>'">
							<a class="card-title" ><?= $row['product_name']; ?></a>
							<p>จำนวน : <?= $row['quantity']; ?></br>
								รูปแบบการรับสินค้า : 
								<?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
									<i class="fas fa-truck"></i>
								<?php } else{ ?>
									<i class="fas fa-store"></i>
									<?php } ?>
									<?= $row['pickup_option']; ?>
								 <br><?= $row['create_at']; ?></br>
								 <?php if ($row['order_status_id'] == 'ORD_S006') { ?>
									<i class='btn-danger'><?= $row['order_status_name'];  ?></i>
									<?php }elseif ($row['order_status_id'] == 'ORD_S002'){ ?>
										<i class='btn-success'><?= $row['order_status_name']; ?></i>
									<?php }elseif ($row['order_status_id'] == 'ORD_S001'){?>
										<i class='btn-warning'><?= $row['order_status_name']; ?></i>
									<?php }else{?>
										<i class='btn-success'><?= $row['order_status_name']; ?></i>
									<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
						&nbsp; 
						</a>
						<?php } ?>
					</div>
				</div>
				<br><br>
				</div>
				<!-- Log on to codeastro.com for more projects -->
				
				<!-- End banner Area -->
				<!-- End Generic Start -->
				<!-- start footer Area -->
				<?php //$this->load->view('frontend/include/base_footer'); ?>
				<!-- js -->
				<?php $this->load->view('frontend/include/base_js'); ?>
			</body>
		</html>

		<?php $this->load->view('store/include/notification'); ?>