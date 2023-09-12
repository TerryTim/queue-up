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
		<title>สมัครสมาชิกร้านค้า</title>
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
								<i class="fas fa-store"></i> สมัครสมาชิกร้านค้า 
							</div>
							<div class="card-body">
								<form action="<?php echo base_url() ?>login/registerEntrepreneur" method="post">
									<div class="form-group">
											<div class="form-row">
												<div class="col-md-6">
													<div class="form-label-group">
														<label for="username">ชื่อ</label>
														<input type="text" name="firstname" class="form-control" required=""  value="<?php echo set_value('firstname') ?>">
														<?php echo form_error('firstname'),'<small class="text-danger pl-3">','</small>'; ?>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-label-group">
														<label for="username">นามสกุล</label>
														<input type="text" name="lastname" class="form-control" required=""  value="<?php echo set_value('lastname') ?>">
														<?php echo form_error('lastname'),'<small class="text-danger pl-3">','</small>'; ?>
													</div>
												</div>
											</div>
										</div>
									<div class="form-group">
										<div class="form-row">
											<div class="col-md-6">
												<div class="form-label-group">
													<label for="username">ชื่อร้านค้า</label>
													<input type="text" name="store_name" class="form-control" required=""  value="<?php echo set_value('store_name') ?>">
													<?php echo form_error('store_name'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-label-group">
													<label for="username">หมายเลขโทรศัพท์</label>
													<input type="number" name="phone_number" class="form-control" required=""  value="<?php echo set_value('phone_number') ?>">
													<?php echo form_error('phone_number'),'<small class="text-danger">','</small>'; ?>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<label for="username">รายละเอียดที่อยู่ของร้านค้า</label>
											<textarea class="form-control" name="store_address" required="" ><?php echo set_value('store_address') ?></textarea>
											<?php echo form_error('store_address'),'<p class="text-danger pl-3">','</p>'; ?>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<label for="username">อีเมล</label>
											<input type="email" name="email" class="form-control" required=""  value="<?php echo set_value('email') ?>">
											<?php echo form_error('email'),'<small class="text-danger pl-3">','</small>'; ?>
										</div>
									</div>
									<div class="form-group">
									<div class="form-row">
										<div class="col-md-6">
											<label for="username">รหัสผ่าน</label>
											<input type="password" class="form-control form-control-user" name="password1"  value="<?php echo set_value('password1') ?>">
										</div>
										<div class="col-md-6">
											<label for="username">ยืนยันรหัสผ่าน</label>
											<input type="password" class="form-control form-control-user" name="password2"  value="<?php echo set_value('password2') ?>">
										</div>
									</div>
									</div>
									<?php echo form_error('password1'),'<small class="text-danger pl-3">','</small>'; ?>
									<div class="form-group">
										<div class="form-row">
											<div class="col-md-6">
												<div class="form-label-group">
													<label for="username">บัญชีธนาคาร</label>
													<input type="bank_account" name="bank_account" class="form-control" required="" placeholder="กรุงไทย"  value="<?php echo set_value('bank_account') ?>">
													<?php echo form_error('bank_account'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-label-group">
												<label for="bank_account_name">ชื่อบัญชีธนาคาร</label>
													<input type="text" name="bank_account_name" class="form-control" required="" placeholder="" value="<?php echo set_value('bank_account_name') ?>">
													<?php echo form_error('bank_account_name'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-label-group">
												<label for="username">หมายเลขบัญชีธนาคาร</label>
													<input type="number" name="number_bank_account" class="form-control" required="" value="<?php echo set_value('number_bank_account') ?>">
													<?php echo form_error('number_bank_account'),'<small class="text-danger pl-3">','</small>'; ?>
												</div>
											</div>
										</div>
									</div>
									<button class="btn btn-info btn-block">สมัคร</button>
								</form>
								<hr>
								<div class="text-center">
									<p>หากมีบัญชีผู้ใช้แล้ว? <a class="" href="<?php echo base_url() ?>login">
									<i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a></p>
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