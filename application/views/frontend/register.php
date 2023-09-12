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
		<title>Register</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/frontend/datepicker/dcalendar.picker.css">
		<?php $this->load->view('frontend/include/base_css'); ?>
		
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>
		<section class="service-area section-gap relative">
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="col-lg-8">
						<!-- Default Card Example -->
						<div class="card ">
							<div class="card-header">
								<i class="fas fa-user"></i> สมัครสมาชิก
							</div>
							<div class="card-body">
								<form action="<?php echo base_url() ?>login/register" method="post">
									<div class="form-group">
										<div class="form-group">
											<div class="form-label-group">
												<label for="name">ชื่อ-นามสกุล</label>
												<input type="text" name="name" class="form-control" required=""  value="<?php echo set_value('name') ?>">
												<?php echo form_error('name'),'<small class="text-danger pl-3">','</small>'; ?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-row">
											<div class="col-md-6">
												<div class="form-label-group">
													<label for="username">อีเมล</label>
													<input type="text" name="email" class="form-control" required=""  value="<?php echo set_value('email') ?>">
													<?php echo form_error('email'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-label-group">
													<label for="username">หมายเลขโทรศัพท์</label>
													<input type="number" id="nomor" name="nomor" class="form-control" required="" value="<?php echo set_value('nomor') ?>">
													<?php echo form_error('nomor'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="username">รายละเอียดที่อยู่</label>
										<div class="form-label-group">
											<textarea class="form-control" name="address"><?php echo set_value('address') ?></textarea>
											<?php echo form_error('address'),'<p class="text-danger pl-3">','</p>'; ?>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<label for="username">ชื่อผู้ใช้ (ผู้ใช้อื่นจะเห็นชื่อนี้)</label>
											<input type="text" id="username" name="username" class="form-control" required="">
											<?php echo form_error('username'),'<small class="text-danger pl-3">','</small>'; ?>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-6 mb-3 mb-sm-0">
											<label for="username">รหัสผ่าน</label>
											<input type="password" class="form-control form-control-user" name="password1" value="<?php echo set_value('password1') ?>">
										</div>
										<div class="col-sm-6">
											<label for="username">ยืนยันรหัสผ่าน</label>
											<input type="password" class="form-control form-control-user" name="password2"  value="<?php echo set_value('password2') ?>">
										</div>
									</div>
									<?php echo form_error('password1'),'<small class="text-danger pl-3">','</small>'; ?>
									<button class="btn btn-info btn-block">สมัคร</button>
								</form>
								<hr>
								<div class="text-center">
									<p>หากมีบัญชีผู้ใช้แล้ว? <a class="" href="<?php echo base_url() ?>login">
									<i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a></p>
									<p> <a class="" href="<?php echo base_url() ?>login/registerEntrepreneur">
									<i class="fas fa-store"></i> สมัครสมาชิกร้านค้า</a></p>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- End banner Area -->
				<!-- Log on to codeastro.com for more projects -->
				<!-- start footer Area -->
				<!-- <?php $this->load->view('frontend/include/base_footer'); ?> -->
				<!-- js -->
				<?php $this->load->view('frontend/include/base_js'); ?>
			</body>
		</html>

		<?php $this->load->view('store/include/notification'); ?>

