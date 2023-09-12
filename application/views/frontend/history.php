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
			<h2 class="" align="center">ประวัติการซื้อxx </h2>
			<div class="container ">
				<div class="row d-flex justify-content-center">
					<?php foreach ($customer as $row) {	 ?>
					<div class="col-sm-6 center">
						&nbsp;
						<div class="card justify-content-center" style="width: 18rem;">
							<img class="card-img-top" style="height:250px; width:auto; object-fit: cover;" src="../assets/images/products/<?= $row['product_image'];  ?>" alt="Card image cap" >
							<div class="card-body" align="left">
								<?php if ($row['order_status_id'] == 'ORD_S004'){ ?>
									<a href="#" class="card-link"><? $row['order_status_name'] ?></a>
								<?php } ?>
								<?php //}else {?>
								<a><i class="fa fa-store"></i> <?= $row['store_name']; ?></a>
								<a class="card-title" href="<?= base_url('profile/order/'.$row['order_id']) ?>"><?= $row['product_name']; ?></a>
								<p>จำนวน : <?= $row['quantity']; ?></br>
								รูปแบบการรับสินค้า : 
								<?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
									<i class="fas fa-truck"></i>
								<?php } else{ ?>
									<i class="fas fa-store"></i>
									<?php } ?>
									<?= $row['pickup_option']; ?>
								 <br>เวลาที่ทำรายการ : <?= $row['create_at']; ?></br>
								 สถานะคำสั่ง : <?php if ($row['order_status_id'] == 'ORD_S004') { ?>
									<i class='btn-danger'><?= $row['order_status_name'];  ?></i>
									<?php }elseif ($row['order_status_id'] == 'ORD_S002'){ ?>
										<i class='btn-success'><?= $row['order_status_name']; ?></i>
									<?php }elseif ($row['order_status_id'] == 'ORD_S001'){?>
										<i class='btn-warning'><?= $row['order_status_name']; ?></i>
									<?php }else{?>
										<i class='btn-success'><?= $row['order_status_name']; ?></i>
									<?php } ?>
									<!-- <hr> -->
									<!-- <?php if ($row['status_order'] == '1') { ?>
									<a href="<?php echo base_url('ticket/payment/'.$row['id_order']) ?>" class="btn btn-primary">Check Payment</a>
									<?php }else if ($row['status_order'] == '3'){ ?>
										<a href="<?php echo base_url('ticket/') ?>" class="btn btn-warning pull-right">Book Another</a>
									<?php }else {?>
									<a href="<?php echo base_url('store/home/refund') ?>" class="btn btn-danger" >Batal ticket</a>
									<a href="<?php echo base_url('assets/store/upload/eticket/'.$row['id_order'].'.pdf') ?>" class="btn btn-success pull-right" download>Print Ticket</a>
									<?php } ?> -->
								</div>
							</div>
						</div>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<?php } ?>
					</div>
				</div>
				<br><br>
				</div>
				<!-- Log on to codeastro.com for more projects -->

		<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url('profile/editprofile') ?>" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-14">
										<div class="row form-group">
											<input type="hidden" name="kode" value="<?php echo $profile['id_customer']?>">
										</div>
										<div class="row form-group">
											<label for="name" class="control-label">Name</label>
											<input type="text" class="form-control" name="name" value="<?php echo $profile['name_customer']?>" >
										</div>
										<div class="row form-group">
											<label for="name" class="control-label">Email</label>
											<input type="email" class="form-control" name="email" value="<?php echo $profile['email_customer']?>" >
										</div>
										<div class="row form-group">
											<label for="name" class="control-label">Mobilenumber</label>
											<input type="text" class="form-control" name="hp" value="<?php echo $profile['phone_customer']?>" >
										</div>
										<div class="row form-group">
											<label for="name" class="control-label">Address</label>
											<input type="text" class="form-control" name="address" value="<?php echo $profile['address_customer']?>" >
										</div>
										<div class="row form-group">
											<label for="" class="control-label">Photo Profile</label>
											<img src="<?php echo base_url($profile['img_customer'])?>" alt="<?php echo $this->session->userdata('id_card') ?>" style="width:150px;height:150px"><input type="file" class="form-control" value="<?php echo base_url($this->session->userdata('name_lengkap')) ?>" name="img"  >
										</div>
									</div>
								</div>
							</div>
						</div>
							<button class="btn btn-danger" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" >Save Changes</button>
					</form>
				</div>
			</div>
		</div>
				<!-- End banner Area -->
				<!-- End Generic Start -->
				<!-- start footer Area -->
				<?php //$this->load->view('frontend/include/base_footer'); ?>
				<!-- js -->
				<?php $this->load->view('frontend/include/base_js'); ?>
			</body>
		</html>