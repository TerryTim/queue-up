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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <!-- <link href="//use.fontawesome.com/releases/v5.0.7/css/all.css"> -->
		
		<?php $this->load->view('frontend/include/base_css'); ?>
	</head>
	<body>
		<!-- navbar -->
		<?php $this->load->view('frontend/include/base_nav'); ?>
    <!-- chat -->
    <?php $this->load->view('frontend/include/chat'); ?>
		<!-- start banner Area -->
    <br><br><br>
		<button class="open-button" onclick="openForm()" target="_blank">ติดต่อร้านค้า</button>
    <!-- <a href="<?= base_url('chat/view/'.$product[0]['entrepreneur_id']) ?>" target="_blank"><i class="fas fa-ticket-alt"></i> ติดต่อร้านค้า</a> -->
    <?php if($product == null){ ?>
      <br><br>
      <h2 style="text-align: center"><i class="fa fa-search"></i> ไม่พบผลการค้นหา</h2>
    <?php } ?>
    <?php foreach ($product as $row) { ?>
<form action="<?= base_url()?>booking" method="post">
  <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="../../assets/images/products/<?= $row['product_image'];  ?>" /></div>
						  <!-- <div class="tab-pane" id="pic-2"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/447918/sub/goods_447918_sub20.jpg?width=750" /></div>
						  <div class="tab-pane" id="pic-3"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/447918/sub/goods_447918_sub18.jpg?width=750" /></div>
						  <div class="tab-pane" id="pic-4"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/435044/item/goods_30_435044.jpg?width=1557&impolicy=quality_75" /></div>
						  <div class="tab-pane" id="pic-5"><img src="https://cf.shopee.com.my/file/cebab0ae0205198e4f9f7e8f61fd6472" /></div> -->
						  </div>
						  <ul class="preview-thumbnail nav nav-tabs">
						  <!-- <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/447918/item/goods_30_447918.jpg?width=750" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/447918/sub/goods_447918_sub20.jpg?width=750" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/447918/sub/goods_447918_sub18.jpg?width=750" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="https://image.uniqlo.com/UQ/ST3/AsianCommon/imagesgoods/435044/item/goods_30_435044.jpg?width=1557&impolicy=quality_75" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="https://cf.shopee.com.my/file/cebab0ae0205198e4f9f7e8f61fd6472" /></a></li> -->
						  </ul>
					  </div>
					<div class="details col-md-6">
          <p class="product-description">
          <img class="rounded-circle" height="50" width="50" src="<?= base_url('assets/images/profiles/entrepreneurs/' . $row['store_image']) ?>" alt="Profile Image">
             <i class="fa fa-store"></i> 
            <?=$row['store_name']?><br> 
            <label for="store_rating"><?=$store_rating[0]['COALESCE(CAST(AVG(ratings.store_rating) AS DECIMAL(10,1)), 0)']?></label>
                  <?php for ($x = 0; $x < round($store_rating[0]['COALESCE(CAST(AVG(ratings.store_rating) AS DECIMAL(10,1)), 0)']); $x++) {
                    echo '<label for="stars-rating-5"><i class="fa fa-star text-warning"></i></label>';
                    }
                    for ($y = 0; $y < 5-round($store_rating[0]['COALESCE(CAST(AVG(ratings.store_rating) AS DECIMAL(10,1)), 0)']); $y++) {
                      echo '<label for="stars-rating-5"><i class="fa fa-star"></i></label>';
                    }
                  ?></p>
            <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
						<h3 class="product-title"><?=$row['product_name']?></h3>
						<div class="rating">
							<div class="stars">
                <label for="order_rating"><?=$row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']?></label>
                  <?php for ($x = 0; $x < round($row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']); $x++) {
                    echo '<label for="stars-rating-5"><i class="fa fa-star text-warning"></i></label>';
                    }
                    for ($y = 0; $y < 5-round($row['COALESCE(CAST(AVG(ratings.order_rating) AS DECIMAL(10,1)), 0)']); $y++) {
                      echo '<label for="stars-rating-5"><i class="fa fa-star"></i></label>';
                    }
                  ?>
							</div>
              <span class="review-no">สั่งไปแล้ว <?=$row['COUNT(orders.product_id)']?> ชิ้น</span><br>
              <span class="display-5">ให้คะแนนแล้ว <?=$row['COUNT(ratings.order_id)']?></span>
						</div>
            <!-- <?php echo nl2br(htmlspecialchars(html_entity_decode(str_replace("\\r\\n","\r\n",$row['product_description'])))) ?><br><br> -->
						<h4 class="price"><span>฿ <?=$row['product_price']?></span></h4>
						<!-- <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p> -->
						<!-- <h5 class="sizes">ตัวเลือก:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
						</h5>
						<h5 class="colors">colors:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
						</h5> -->
						<!-- <div class="action">
              <h5 class="sizes">จำนวน:</h5>
							<select id="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
              </select>
						</div><br> -->
            <div class="action">
              <h5 class="sizes">รูปแบบการรับสินค้า:</h5>
              <?php if($row['pickup_id'] == "PU002"){ ?>
													<i class="fas fa-truck"></i>
												<?php } else{ ?>
													<i class="fas fa-store"></i>
													<?php } ?>
                <?=$row['pickup_option']?><br><br>
                <!-- <button class="btn btn-default" type="button">รับที่ร้านค้า</button>
                <button class="btn btn-default" type="button">จัดส่งถึงที่</button> -->
						</div>
            <?php if($row['pickup_id'] == "PU001"){ ?>
            <div>
              <h5 class="product-title">รายละเอียดที่อยู่ของร้านค้า </h4>
              <?=$row['store_address']?>
            </div>
            <?php } ?>
            <div class="action">
              <div><br></div>
              <div class="dropdown-divider"></div>
                <a class="add-to-cart btn btn-primary" href="#" data-toggle="modal" data-target="#confirmModal">
                  <i class="text-gray-400"></i>
                  สั่งจองสินค้า
                </a>
              </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
            <!-- <div class="image-cropper">
              <img src="../../assets/images/profiles/<?= $row['image']; ?>" width="100px" height="auto" class="rounded"/>
            </div> -->
            <h4 class="product-title">รายละเอียดสินค้า </h4>
            <?php echo nl2br(htmlspecialchars(str_replace("\\r\\n","\r\n",$row['product_description']))) ?><br><br>
            
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="container">
	<div class="card">
		<div class="container-fliud">
			<div class="wrapper row">
				<div class="preview col-md-6">
            <h4 class="product-title">คะแนนของสินค้า </h4>
              <?php foreach ($rating as $rate) { ?>
                <div>
                  <?= $rate['create_at']; ?><br>
                  <lable><b>
                  <img class="img-profile rounded-circle " height="50" width="50" src="<?= base_url('assets/images/profiles/customers/' . $rate['img_customer']) ?>" alt="Profile Image">
                  <?= $rate['username_customer']; ?></b></lable>
                      <div class="stars">
                        <?php for ($x = 0; $x < $rate['order_rating']; $x++) {
                          echo '<label for="stars-rating-5"><i class="fa fa-star text-warning"></i></label>';
                          }
                        ?>
                      </div>
                      
                      <?= $rate['comment']; ?>
                </div><br>
              <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="card" style="background: white">
</div>


<!-- Confirm Modal-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ต้องการสั่งจองสินค้านี้ใช่หรือไม่?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-footer">
				<a class="btn btn-primary" type="button" href="<?= base_url('booking/checkout/'.$row['product_id']) ?>">สั่งจองสินค้า</a>
				<button class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>


		<!-- End service Area -->
		<!-- End feature Area -->
		<!-- Log on to codeastro.com for more projects -->
		<!-- End Generic Start -->
		<!-- start footer Area -->
		<?php //$this->load->view('frontend/include/base_footer'); ?>
		<!-- js -->
		<?php $this->load->view('frontend/include/base_js'); ?>
	</body>
</html>

<script>
  /* Open the chat */
function openForm() {
  document.getElementById("chat").style.display = "block";
}

/* Close the chat */
function closeForm() {
  document.getElementById("chat").style.display = "none";
}


</script>
<style>
   a.nav-link {
        color: gray;
        font-size: 18px;
        padding: 0;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        /* border: 2px solid #e84118; */
        padding: 2px;
        flex: none;
    }

    /* input:focus {
        outline: 0px !important;
        box-shadow: none !important;
    } */

    .card-text {
        border: 2px solid #ddd;
        border-radius: 8px;
    }

  /* Style the button */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 150px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 1px solid #ccc;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 500px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the button is hovered, make it more transparent */
.open-button:hover {
  opacity: 1;
}



.btn-primary,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:visited,
.btn-primary:focus {
    background-color: #e44830;
    border-color: #e44830;
}

  .image-cropper {
  width: 100px;
  height: 100px;
  position: relative;
  overflow: hidden;
  border-radius: 50%;
}

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #e44830; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #e44830;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    /* background: #b36800; */
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */
</style>

<?php $this->load->view('store/include/notification'); ?>