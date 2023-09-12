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
		<title>รายละเอียดคำสั่ง</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		
		<!--CSS-->
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
	<!-- navbar -->
	<?php $this->load->view('frontend/include/base_nav'); ?>
	<!-- chat -->
    <?php $this->load->view('frontend/include/chat'); ?>

	<section class="service-area section-gap relative">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-12">
					<!-- Default Card Example -->
					<div class="card">
						<?php foreach ($order as $row) { ?>
						<div class="card-header">รหัสคำสั่ง <?=$row['order_id']?></div>
							<div class="card-body" align="center">
								<div class="card-body">
									<table class="table">
										<tbody>
											<tr>
											<th><label for="name" class="control-label"><i class="fa fa-store"></i> <?=$row['store_name']?></label></th>
											<th>สินค้า</th>
											<th>รูปแบบการรับสินค้า</th>
											<th>จำนวน</th>
											<th>ที่อยู่ในการจัดส่ง</th>
											</tr>
											<td><img style="height:125px; width:125px; object-fit: cover;" 
											src="../../assets/images/products/<?= $row['product_image']; ?>"
											style="cursor: pointer;" onclick="window.location='<?= base_url('search/detail/'.$row['product_id']) ?>'"></img></td>
											<td><?= $row['product_name']; ?></td>
											<td><?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
													<i class="fas fa-truck"></i>
												<?php } else{ ?>
													<i class="fas fa-store"></i>
													<?php } ?>
													<?= $row['pickup_option']; ?></td>
											<td><?= $row['quantity']; ?></td>
											<td><?= $row['shipping_address']; ?></td>
											<tr>
												<?php if($row['pickup_id'] == 'PU002'){ ?>
													<th>ข้อมูลพัสดุ</th>
												<?php }else{ ?>
													<th></th>
													<?php } ?>
												<th>สถานะคำสั่ง</th>
												<th></th>
												<th>ราคาสินค้า</th>
												<th>฿ <?= $row['product_price']; ?></th>
											</tr>
											<tr>
												<th><?= $row['company_name']; ?></th>
												<th><?= $row['order_status_name']; ?></th>
												<th></th>
												<th>ค่าจัดส่ง</th>
												<th>฿ <?= $row['shipping_cost']; ?></th>
											</tr>
											<tr>
												<th><?= $row['shipping_tracking']; ?></th>
												<th></th>
												<th></th>
												<th>ยอดรวมทั้งสิ้น</th>
												<th><h4 style="color:#e44830">฿ <?= $row['product_price']*$row['quantity']+$row['shipping_cost']; ?></h4></th>
											</tr>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tbody>
									</table>
									<?php if($row['pickup_id'] == 'PU002'){ ?>
										<div class="btn-group">
											<form method="post" action="<?php echo base_url('tracking') ?>" target="_blank">
												<input type="hidden" name="company_id" value="<?= $row['parcel_delivery_company_id'] ?>">
												<input type="hidden" name="shipping_tracking" value="<?= $row['shipping_tracking'] ?>">
												<button class="btn btn-success" type="submit"><i class="fas fa-dolly-flatbed"></i> ติดตามสินค้า</button>    
											</form>
										</div>
									<?php }?>
										 
										<?php if(empty($rating) or empty($rating[0]['customer_id'])){ ?>
												<a><button data-toggle="modal" data-target="#reviewModal" class="btn btn-primary" style="margin-left: 5px;">
												<i class="fas fa-edit"></i> ให้คะแนน</button></a>
											<?php }elseif($rating[0]['customer_id'] == $this->session->userdata('id_customer')){ ?>
												<a><button class="btn btn-primary" disabled style="margin-left: 5px;"><i class="fas fa-edit"></i> ให้คะแนนแล้ว</button></a>
											<?php } ?>
									<a><button class="open-button" onclick="openForm()" target="_blank" style="margin-left: 5px;">
										<i class="fas fa-comments"></i> ติดต่อร้านค้า</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
		<?php } ?>
				<!-- <div class="col-lg-8">
					<div class="card">
						<div class="card-header">รหัสคำสั่ง <?=$row['order_id']?></div>
							<div class="card-body" align="center">
								<div class="card-body">
									<table class="table">
										<tbody>
											<tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</selection>
		<!-- Log on to codeastro.com for more projects -->
				<div class="modal fade bd-example-modal-lg" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">ให้คะแนนสินค้า</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="<?php echo base_url('rating/rating/'.$row['order_id']) ?>" method="post" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-sm-14">
												<label for="name" class="control-label"><i class="fa fa-store"></i> <?=$row['store_name']?></label>
												<div class="row form-group">
													<img style="height:150px; width:150px; object-fit: cover;"  src="../../assets/images/products/<?= $row['product_image'];  ?>" class="mr-3" alt="Responsive image" >
													<label for="name" class="control-label"><?= $row['product_name']; ?><br>
													<label for="name" class="control-label">
														<?php if($row['pickup_option'] == "จัดส่งถึงที่"){ ?>
															<i class="fas fa-truck"></i>
														<?php } else{ ?>
															<i class="fas fa-store"></i>
														<?php } ?>
															<?= $row['pickup_option']; ?></label>
												</div>
												<div class="row form-group">
													<label for="name" class="control-label">คุณภาพสินค้า</label>
													<fieldset class="rating" require>
														<input type="radio" id="field1_star5" name="order_rating" value="5" /><label class = "full" for="field1_star5"></label>
														
														<input type="radio" id="field1_star4" name="order_rating" value="4" /><label class = "full" for="field1_star4"></label>
														
														<input type="radio" id="field1_star3" name="order_rating" value="3" /><label class = "full" for="field1_star3"></label>
														
														<input type="radio" id="field1_star2" name="order_rating" value="2" /><label class = "full" for="field1_star2"></label>
														
														<input type="radio" id="field1_star1" name="order_rating" value="1" /><label class = "full" for="field1_star1"></label>
														
													</fieldset>

												</div>
												<div class="row form-group">
													<label for="name" class="control-label">บริการจากร้านค้า</label>													
													<fieldset class="rating" require>
														<input type="radio" id="field2_star5" name="store_rating" value="5" require/><label class = "full" for="field2_star5"></label>
														
														<input type="radio" id="field2_star4" name="store_rating" value="4" /><label class = "full" for="field2_star4"></label>
														
														<input type="radio" id="field2_star3" name="store_rating" value="3" /><label class = "full" for="field2_star3"></label>
														
														<input type="radio" id="field2_star2" name="store_rating" value="2" /><label class = "full" for="field2_star2"></label>
														
														<input type="radio" id="field2_star1" name="store_rating" value="1" /><label class = "full" for="field2_star1"></label>
														
													</fieldset>
												</div>
												<textarea class="form-control" name="comment" rows="3" cols="50" placeholder="อธิบายเพิ่มเติม"></textarea>
											</div>
										</div>
									</div>
									<div align="center">
									<button type="submit" class="btn btn-primary" >บันทึก</button>
									</div>
								</div>
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
<style>
	table {
		table-layout: fixed;
		width: 100%;
	}

	table td {
		word-wrap: break-word;         /* All browsers since IE 5.5+ */
		overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
	}

	.modal-content {
  margin-right: 20px;
}

</style>

<script>
	$("label").click(function(){
		// $(this).parent().find("label").css({"background-color": "#D8D8D8"});
		$(this).parent().find("label").css({"font-family": "FontAwesome",
			"content": "\f005",
			"color": "#D8D8D8"});
		// $(this).css({"background-color": "#c59b08"});
		$(this).css({"font-family": "FontAwesome",
			"content": "\f005",
			"color": "#f9c110"});
		// $(this).nextAll().css({"background-color": "#c59b08"});
		$(this).nextAll().css({"font-family": "FontAwesome",
			"content": "\f005",
			"color": "#f9c110"});
	});
</script>

<style>
	@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
	.rating { 
	border: none;
	float: left;
	margin:0px 0px 0px 28px;
	}

	.rating > input { display: none; } 
	.rating > label:before { 
	margin-top: 2px;
	padding:0px 5px 0px 5px;
	font-size: 1.25em;
	font-family: FontAwesome;
	/* display: inline-block; */
	content: "\f005";
	}

	.rating > .half:before { 
	content: "\f089";
	position: absolute;
	}

	.rating > label { 
		color: #D8D8D8; 
		float: right;
		margin:4px 1px 0px 0px;
		background-color:none;
		/* border-radius:15px;
		height:25px; */
	}

	/***** CSS Magic to Highlight Stars on Hover *****/

	.rating:not(:checked) > label:hover, /* hover current star */
	.rating:not(:checked) > label:hover ~ label { 
		font-family: FontAwesome;
		content: "\f005";
		color:#f9c110 !important;
	cursor:pointer;
	} /* hover previous stars in list */

	.rating > input:checked + label:hover, /* hover current star when changing rating */
	.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
	.rating > input:checked ~ label:hover ~ label { 
		font-family: FontAwesome;
		content: "\f005";
		color:#f9c110 !important;
		cursor:pointer;
	}
</style>

<?php $this->load->view('store/include/notification'); ?>