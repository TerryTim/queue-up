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
		<!-- Log on to codeastro.com for more projects -->
		<!-- Site Title -->
		<title>My Profile</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<!--CSS-->
		<style type="text/css">
		.text-block {
		position: absolute;
		bottom: 20px;
		right: 20px;
		background-color: black;
		color: white;
		padding-left: 20px;
		padding-right: 20px;
		}
		</style>
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>
		<section class="generic-banner relative">
			<div class="container">
				<div class="section-top-border">
					<h3 class="mb-30" align="center">บัญชีของฉัน</h3>
					<div class="row d-flex justify-content-center">
						<div class="col-lg-6">
							<!-- Default Card Example -->
							<div class="card" align="left">
								<div class="card-header">
									<i class="fas fa-user"></i> ข้อมูลบัญชี
								</div>
								<div class="card-body" align="left">
									<div class="row">
										<div class="col-sm-4"><!-- change from col-sm-8 to col-sm-4 -->
											<h5 class="card-title">ชื่อผู้ใช้</h5>
											<p class="card-text"><?php echo $profile['username_customer'] ?></p>
											<h5 class="card-title">ชื่อ</h5>
											<p class="card-text"><?php echo $profile['name_customer'] ?></p>
											<h5 class="card-title">อีเมล</h5>
											<p class="card-text"><?php echo $profile['email_customer']?></p>
											<h5 class="card-title">หมายเลขโทรศัพท์</h5>
											<p class="card-text"><?php echo $profile['phone_customer'] ?></p>
										</div>
										<div class="col-sm-8"><!-- change from col-sm-8 to col-sm-8 -->
											<h5 class="card-title">ที่อยู่</h5>
											<p class="card-text"><?php echo $profile['address_customer']?></p>
											<h5 class="card-title">รูปภาพ</h5>
											<p><img class="img-profile rounded-circle" height="150" width="150" src="<?= base_url('assets/images/profiles/customers/' . $profile['img_customer']) ?>" alt="Profile Image"></p>
											<!-- <p><a href="<?php echo base_url('profile/changepassword/'.$profile['id_customer']) ?>" class="btn btn-primary">เปลี่ยนรหัสผ่าน</a></p> -->
											<p><button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">แก้ไขข้อมูล</button></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
				<!-- Log on to codeastro.com for more projects -->
				<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="<?php echo base_url('profile/editprofile') ?>" method="post" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-14">
												<!-- <div class="row form-group">
													<label for="name" class="control-label">ชื่อผู้ใช้</label>
													<input type="text" class="form-control" name="username_customer" value="<?php echo $profile['username_customer']?>" >
												</div> -->
												<div class="row form-group">
													<label for="name" class="control-label">ชื่อ-นามสกุล</label>
													<input type="hidden" name="id_customer" value="<?= $profile['id_customer']; ?>">
													<input type="text" class="form-control" name="name" value="<?php echo $profile['name_customer']?>" >
												</div>
												<div class="row form-group">
													<label for="name" class="control-label">อีเมล</label>
													<input type="email" class="form-control" name="email" value="<?php echo $profile['email_customer']?>" >
												</div>
												<div class="row form-group">
													<label for="name" class="control-label">หมายเลขโทรศัพท์</label>
													<input type="text" class="form-control" name="phone_number" value="<?php echo $profile['phone_customer']?>" >
												</div>
												<div class="row form-group">
													<label for="name" class="control-label">รายละเอียดที่อยู่</label>
													<textarea type="text" class="form-control" name="address" rows="4"><?= $profile['address_customer']?></textarea>
												</div>
												<div class="row form-group">
													<label for="" class="control-label">รูปภาพ</label>
													<!-- <img src="<?php echo base_url($profile['img_customer'])?>" alt="<?php echo $this->session->userdata('img_customer') ?>" style="width:150px;height:150px"><input type="file" class="form-control" value="<?php echo base_url($this->session->userdata('name_lengkap')) ?>" name="img"  > -->
													<img class="img-profile rounded-circle" style="width:150px;height:150px" src="<?= base_url('assets/images/profiles/customers/' . $profile['img_customer']) ?>" alt="Profile Image">
													<input type="file" class="form-control" value="<?php echo base_url($this->session->userdata('img_customer')) ?>" name="fileToUpload" id="fileToUpload"  >
												</div>
											</div>
										</div>
									</div>
								</div>
									<!-- <button class="btn btn-danger" data-dismiss="modal">ปิด</button> -->
									<button type="submit" name="submit" class="btn btn-primary" >บันทึก</button>
							</form>
						</div>
					</div>
				</div>
				<!-- Log on to codeastro.com for more projects -->
				<!-- <?php $this->load->view('frontend/include/base_footer'); ?> -->
				<!-- js -->
				<?php $this->load->view('frontend/include/base_js'); ?>
			</body>
		</html>

		<?php $this->load->view('store/include/notification'); ?>