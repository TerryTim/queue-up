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
		<title>QUEUEUP</title>
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
		<!--
		CSS
		============================================= -->
		<style type="text/css">
		.combined {
		-webkit-text-stroke: 1px black;
		color: white;
		text-shadow:
		2px  2px 0 #000,
		-1px -1px 0 #000,
		1px -1px 0 #000,
		-1px  1px 0 #000,
		1px  1px 0 #000;
		}
		.border-black{
		  color: blue;
		  /*border white with light shadow*/
		  text-shadow: 
		     2px   0  0   #000, 
		    -2px   0  0   #000, 
		     0    2px 0   #000, 
		     0   -2px 0   #000, 
		     1px  1px 0   #000, 
		    -1px -1px 0   #000, 
		     1px -1px 0   #000, 
		    -1px  1px 0   #000,
		     1px  1px 5px #000;
		}
		</style>
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>
		<!-- start banner Area -->
		<section class="banner-area relative section-gap relative" id="home">
			<div class="container">
				<div class="row fullscreen d-flex align-items-center justify-content-end">
					<div class="banner-content col-lg-12 col-md-10">
						
					<?php if ($this->session->userdata('username')) { ?>
				      	
				      <?php }else{ ?>  
				  	  <div class="container">
				<div class="row height align-items-center justify-content-center">
					<div class="col-lg-5">
						<div class="card card-login mx-auto mt-10">
							<div class="card-header">ลงชื่อเข้าใช้</div>
							<div class="card-body" align="left">
								<?php echo $this->session->flashdata('pesan'); ?>
								<form action="<?php echo base_url() ?>login/checker" method="post">
									<div class="form-group">
										<div class="form-label-group">
										<div>อีเมล</div>
											<input type="text" id="email" name="email" class="form-control" 
                                            placeholder="Email" required="required" value="<?= isset($username) ?>">
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
										<div>รหัสผ่าน</div>
											<input type="password" name="password" class="form-control" placeholder="Password" required="required">
										</div>
									</div>
									<!-- <div class="form-group">
										<div class="checkbox">
											<label>
												<input type="checkbox" value="remember-me">
												จำรหัสผ่าน
											</label>
										</div>
									</div> -->
									<button class="btn btn-success btn-block">เข้าสู่ระบบ</button>
								</form>
								<div class="text-center">
									<p><a class="d-block mt-3" href="<?php echo base_url() ?>login/register">สมัครสมาชิก</a>
									<hr>
									<!-- <b><a class="d-block mt-3" style="font-size:15px;" href="<?php echo base_url() ?>store/login">ลงชื่อเข้าใช้ร้านค้า</a></b> -->
									<!-- <a class="d-block small" href="<?php echo base_url() ?>login/forgetpassword">Forgot Password</a> -->
								</p>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				  	  <?php } ?>
					</div>
				</div>
			</div>
		</section>
		
<?php if ($this->session->userdata('username')) { ?>
    <div class="container">
  <?php 
    $i = 0;
    foreach ($products as $row) { 
      if ($i % 2 == 0) {
        echo '<div class="row">';
      }
  ?>
  <div class="col-xs-12 col-md-6">
    <div class="prod-info-main prod-wrap clearfix">
      <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="product-image"> 
                <img style="height:200px; width:214px; object-fit: cover;" src="./assets/images/products/<?= $row['product_image'];  ?>" class="img-responsive">
            </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12">
          <div class="product-deatil">
            <p class="product-description"> <i class="fa fa-store"></i> <?=$row['store_name']?></p> 
            <h5 class="name">
              <a href="<?php echo base_url() ?>search/detail/<?php echo $row['product_id'] ?>">
                <?=$row['product_name']?>
              </a>
              <a><span><?=$row['category_name']?></span></a>                            
            </h5>
            <p class="price-container">
              <span>฿<?=$row['product_price']?></span>
            </p>
            <span class="tag1"></span> 
          </div>
          <div class="product-info smart-form">
            <div class="row">
              <div class="col-md-12">
                <div class="rating">
                  <label for="order_rating"><?=$row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']?></label>
                  <?php for ($x = 0; $x < round($row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']); $x++) {
                    echo '<label for="stars-rating-5"><i class="fa fa-star text-warning"></i></label>';
                    }
                    for ($y = 0; $y < 5-round($row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']); $y++) {
                      echo '<label for="stars-rating-5"><i class="fa fa-star"></i></label>';
                    }
                  ?>
                </div>
                <span>สั่งไปแล้ว <?=$row['COUNT(orders.product_id)']?> ชิ้น</span><br>
                <span>ให้คะแนนแล้ว: <?=$row['COUNT(ratings.order_id)']?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end product -->
  </div>
  <?php 
    if ($i % 2 == 1 || $i == count($products)-1) {
      echo '</div>';
    }
    $i++;
  ?>
  <?php } ?>
</div>

<?php } ?>
		<!-- End service Area -->
		<!-- End feature Area -->
		<!-- Log on to codeastro.com for more projects -->
		<!-- End Generic Start -->
		<!-- start footer Area -->
		<!-- <?php// $this->load->view('frontend/include/base_footer'); ?> -->
		<!-- js -->
		<?php $this->load->view('frontend/include/base_js'); ?>
	</body>
</html>

<style>
body{
    margin-top:20px;
    background:#eee;
}

.prod-info-main {
    border: 1px solid #CEEFFF;
    margin-bottom: 20px;
    margin-top: 10px;
    background: #fff;
    padding: 6px;
    -webkit-box-shadow: 0 1px 4px 0 rgba(21,180,255,0.5);
    box-shadow: 0 1px 1px 0 rgba(21,180,255,0.5);
}

.prod-info-main .product-image {
    background-color: #EBF8FE;
    display: block;
    min-height: 238px;
    overflow: hidden;
    position: relative;
    border: 1px solid #CEEFFF;
    padding-top: 40px;
}

.prod-info-main .product-deatil {
    border-bottom: 1px solid #dfe5e9;
    padding-bottom: 17px;
    padding-left: 16px;
    padding-top: 16px;
    position: relative;
    background: #fff
}

.product-content .product-deatil h5 a {
    color: #2f383d;
    font-size: 15px;
    line-height: 19px;
    text-decoration: none;
    padding-left: 0;
    margin-left: 0
}

.prod-info-main .product-deatil h5 a span {
    color: #9aa7af;
    display: block;
    font-size: 13px
}

.prod-info-main .product-deatil span.tag1 {
    border-radius: 50%;
    color: #fff;
    font-size: 15px;
    height: 50px;
    padding: 13px 0;
    position: absolute;
    right: 10px;
    text-align: center;
    top: 10px;
    width: 50px
}

.prod-info-main .product-deatil span.sale {
    background-color: #21c2f8
}

.prod-info-main .product-deatil span.discount {
    background-color: #71e134
}

.prod-info-main .product-deatil span.hot {
    background-color: #fa9442
}

.prod-info-main .description {
    font-size: 12.5px;
    line-height: 20px;
    padding: 10px 14px 16px 19px;
    background: #fff
}

.prod-info-main .product-info {
    padding: 11px 19px 10px 20px
}

.prod-info-main .product-info a.add-to-cart {
    color: #2f383d;
    font-size: 13px;
    padding-left: 16px
}

.prod-info-main name.a {
    padding: 5px 10px;
    margin-left: 16px
}

.product-info.smart-form .btn {
    padding: 6px 12px;
    margin-left: 12px;
    margin-top: -10px
}

.load-more-btn {
    background-color: #21c2f8;
    border-bottom: 2px solid #037ca5;
    border-radius: 2px;
    border-top: 2px solid #0cf;
    margin-top: 20px;
    padding: 9px 0;
    width: 100%
}

.product-block .product-deatil p.price-container span,
.prod-info-main .product-deatil p.price-container span,
.shipping table tbody tr td p.price-container span,
.shopping-items table tbody tr td p.price-container span {
    color: #21c2f8;
    font-family: Lato, sans-serif;
    font-size: 24px;
    line-height: 20px
}

.product-info.smart-form .rating label {
    margin-top:15px;
    
}

.prod-wrap .product-image span.tag2 {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    padding: 10px 0;
    color: #fff;
    font-size: 11px;
    text-align: center
}

.prod-wrap .product-image span.tag3 {
    position: absolute;
    top: 10px;
    right: 20px;
    width: 60px;
    height: 36px;
    border-radius: 50%;
    padding: 10px 0;
    color: #fff;
    font-size: 11px;
    text-align: center
}

.prod-wrap .product-image span.sale {
    background-color: #57889c;
}

.prod-wrap .product-image span.hot {
    background-color: #a90329;
}

.prod-wrap .product-image span.special {
    background-color: #3B6764;
}
.shop-btn {
    position: relative
}

.shop-btn>span {
    background: #a90329;
    display: inline-block;
    font-size: 10px;
    box-shadow: inset 1px 1px 0 rgba(0, 0, 0, .1), inset 0 -1px 0 rgba(0, 0, 0, .07);
    font-weight: 700;
    border-radius: 50%;
    padding: 2px 4px 3px!important;
    text-align: center;
    line-height: normal;
    width: 19px;
    top: -7px;
    left: -7px
}

.product-deatil hr {
    padding: 0 0 5px!important
}

.product-deatil .glyphicon {
    color: #3276b1
}

.product-deatil .product-image {
    border-right: 0px solid #fff !important
}

.product-deatil .name {
    margin-top: 0;
    margin-bottom: 0
}

.product-deatil .name small {
    display: block
}

.product-deatil .name a {
    margin-left: 0
}

.product-deatil .price-container {
    font-size: 24px;
    margin: 0;
    font-weight: 300;
    
}

.product-deatil .price-container small {
    font-size: 12px;
    
}

.product-deatil .fa-2x {
    font-size: 16px!important
}

.product-deatil .fa-2x>h5 {
    font-size: 12px;
    margin: 0
}

.product-deatil .fa-2x+a,
.product-deatil .fa-2x+a+a {
    font-size: 13px
}

.product-deatil .certified {
    margin-top: 10px
}

.product-deatil .certified ul {
    padding-left: 0
}

.product-deatil .certified ul li:not(first-child) {
    margin-left: -3px
}

.product-deatil .certified ul li {
    display: inline-block;
    background-color: #f9f9f9;
    padding: 13px 19px
}

.product-deatil .certified ul li:first-child {
    border-right: none
}

.product-deatil .certified ul li a {
    text-align: left;
    font-size: 12px;
    color: #6d7a83;
    line-height: 16px;
    text-decoration: none
}

.product-deatil .certified ul li a span {
    display: block;
    color: #21c2f8;
    font-size: 13px;
    font-weight: 700;
    text-align: center
}

.product-deatil .message-text {
    width: calc(100% - 70px)
}

@media only screen and (min-width:1024px) {
    .prod-info-main div[class*=col-md-4] {
        padding-right: 0
    }
    .prod-info-main div[class*=col-md-8] {
        padding: 0 13px 0 0
    }
    .prod-wrap div[class*=col-md-5] {
        padding-right: 0
    }
    .prod-wrap div[class*=col-md-7] {
        padding: 0 13px 0 0
    }
    .prod-info-main .product-image {
        border-right: 1px solid #dfe5e9
    }
    .prod-info-main .product-info {
        position: relative
    }
}
</style>

<?php $this->load->view('store/include/notification'); ?>