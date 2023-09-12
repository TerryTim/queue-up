<?php $this->load->view('frontend/include/base_css'); ?>

<?php 
	// Retrieve customer data from the database
	$customer_id = $this->session->userdata('id_customer');
	$this->db->select('username_customer, img_customer');
	$query = $this->db->get_where('customer', array('id_customer' => $customer_id));
	$profile = $query->row_array();
?>

<header id="header" id="home">
	<div class="container">
		<div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				<a href="<?php echo base_url() ?>"><h3> <i class="fas fa-ticket-alt"></i> <b>QUEUE<b style="color:#e44830">UP</b></b></h3></a>
			</div>
			<?php if ($this->session->userdata('username')) { ?>
			<div class="topnav">
				<div class="input-group rounded">
					<form action="<?= base_url('search') ?>">
					<input type="text" placeholder="ค้นหาสินค้า..." name="search" size="50" value="<?php echo isset($check) ?>">
					<button class='rounded' type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
			<?php } ?>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
					<!-- <li class="menu"><a href="<?php echo base_url() ?>">Home</a></li> -->
					<!-- <li class="menu"><a href="<?php echo base_url() ?>search">Check Tickets</a></li> -->
					<?php if ($this->session->userdata('username')) { ?>
						<!-- <li><a href="<?php echo base_url() ?>search"><i class="fas fa-search"></i> ค้นหา</a></li> -->
						<!-- <li><img src="<?php echo $this->session->userdata('img_customer')?>" height="25" width="auto" ></li> -->
						<li><img class="img-profile rounded-circle" style="height:25px; width:25px;" src="<?= base_url('assets/images/profiles/customers/'.$profile['img_customer']) ?>" alt="Profile Image"></li>
						<li class="menu-has-children"><a href="#"><?php echo $profile['username_customer']; ?></a>
						<ul>
							<li><a href="<?php echo base_url() ?>profile/profilesaya/<?php echo $this->session->userdata('id_customer') ?>"><i class="fas fa-id-card"></i> บัญชีของฉัน</a></li>
							<!-- <li><a href="<?php echo base_url() ?>profile/<?php echo $this->session->userdata('id_customer') ?>"><i class="fas fa-id-card"></i> บัญชีของฉัน</a></li> -->
							<li><a href="<?php echo base_url() ?>profile/history"><i class="fas fa-ticket-alt"></i> ประวัติการซื้อ</a></li>
							<li><a href="<?php echo base_url() ?>login/logout"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a></li>
						</ul>
						</li>
					<?php }else{ ?>  
					<!-- <a href="<?php echo base_url() ?>login/register">Register</a>
					<li><a href="<?php echo base_url() ?>login">Login</a></li> -->
					<?php } ?>
					</ul>
				</nav><!-- #nav-menu-container -->		    		
				</div>
			</div>
			
		</header><!-- #header -->	


<style>
	.topnav .search-container {
	width: 100%;
	text-align:center;
}

</style>