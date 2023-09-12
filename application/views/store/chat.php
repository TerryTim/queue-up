<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?= $title ?></title>
		<!-- css -->
		<?php $this->load->view('store/include/base_css'); ?>
	</head>
	<body id="page-top">
		<!-- navbar -->
		<?php $this->load->view('store/include/base_nav'); ?>
		<section style="background-color: #CDC4F9;">
			<div class="container py-5">
				<div class="row">
					<div class="col-md-12">
						<div class="card" id="chat3" style="border-radius: 15px;">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">
										<div class="p-3">
											<div class="input-group rounded mb-3">
												<!-- <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
													aria-describedby="search-addon" />
												<span class="input-group-text border-0" id="search-addon">
												<i class="fas fa-search"></i>
												</span> -->
											</div>
											<div data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px; overflow-y: scroll;">
												<ul class="list-unstyled mb-0">
													<?php foreach ($chatHeader as $row) { ?>
													<li class="p-2 border-bottom">
														<a class="d-flex justify-content-between" style="cursor: pointer;" onclick="window.location='<?= base_url('store/chat/view/'.$row['customer_id']) ?>'">
															<div class="d-flex flex-row" >
																<div>
																	<img src="<?= base_url('assets/images/profiles/customers/' . $row['img_customer']) ?>"
																		alt=""  width="50" style="margin-right: 10px; rounded-image; border-radius: 50%;">
																	<span class="badge bg-success badge-dot"></span>
																</div>
																<div class="pt-1">
																	<p class="fw-bold mb-0"><?= $row['username_customer']; ?></p>
																	<p class="small text-muted"><?= $row['text']; ?></p>
																</div>
															</div>
															<div class="pt-1">
																<p class="small text-muted mb-1"><?= $row['time']; ?></p>
																<!-- <span class="badge bg-danger rounded-pill float-end" style="color: white;">3</span> -->
															</div>
														</a>
													</li>
													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-7 col-xl-8">
										<form action="<?= base_url('store/chat/add/')?>" enctype="multipart/form-data" method="post" class="form-container" id="chat_form" onsubmit="event.preventDefault()">
											
                    						<?php if (empty($chat)) {
												echo "";
												}else{ ?>
											<div class="pt-3 pe-3" id="chat" style="position: relative; height: 500px; overflow-y: scroll;">
												<?php
													$thai_month = [
													  "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
													  "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
													];
													$prev_date = null;
													
													// loop through the rows of data
													foreach ($chat as $row) {
													  $date_parts = explode('-', $row['date']);
													  $thai_month_name = $thai_month[(int)$date_parts[1] - 1];
													  $date = $row['date'];
													  if ($prev_date !== $date) {
													      echo '<div class="text-center mb-2">' . $date_parts[2] . ' ' . $thai_month_name . ' ' . ($date_parts[0] + 543) . '</div>';
													      $prev_date = $date;
													  }
													  // check the sender of the message
													  if ($row['sender'] == $chat[0]['customer_id']) {
													      // display messages for sender 1
													      ?>
												<div id="chat-container"><!-- added container div here -->
													<div class="d-flex flex-row justify-content-start">
														<img src="<?= base_url('assets/images/profiles/customers/' . $row['img_customer']) ?>"
															alt="" style="width: 45px; height: 100%; margin-right: 10px; rounded-image; border-radius: 50%;">
														<div>
															<p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
																<?= $row['text']; ?>
															</p>
															<p class="small ms-3 mb-3 rounded-3 text-muted float-end"><?= date('H:i', strtotime($row['time'])) ?></p>
														</div>
													</div>
												</div><!-- added closing container div here -->
												<?php
													} elseif ($row['sender'] == $this->session->userdata('entrepreneur_id')) {
													    // display messages for sender 2
													    ?>
												<div id="chat-container"><!-- added container div here -->
													<div class="d-flex flex-row justify-content-end">
														<div>
															<p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
																<?= $row['text']; ?>
															</p>
															<p class="small me-3 mb-3 rounded-3 text-muted"><?= date('H:i', strtotime($row['time'])) ?></p>
														</div>
														<img src="<?= base_url('assets/images/profiles/entrepreneurs/' . $this->session->userdata('store_image')) ?>"
															alt="" style="width: 45px; height: 100%; margin-right: 10px; rounded-image; border-radius: 50%;">
													</div>
												</div><!-- added closing container div here -->
												<?php
													}
													}?>
													
											</div>
											<div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
												<img src="<?= base_url('assets/images/profiles/entrepreneurs/' . $this->session->userdata('store_image')) ?>"
													alt="" style="width: 40px; height: 100%; rounded-image;">
                        						<input type="hidden" id="customer_id" name="customer_id" value="<?= $row['customer_id']; ?>">
												<input type="text" class="form-control form-control-lg" id="text" name="text"
													placeholder="เขียนข้อความ">
												<input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" style="display: none;">
												<!-- <label for="fileToUpload"><i class="fas fa-image"></i></label> -->
												<button type="button" class="btn btn-primary pull-rigth" id="send-button"><i class="fas fa-paper-plane"></i></button>
											</div>
										<?php }?>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End of Page Wrapper -->
		<!-- Scroll to Top Button-->
		<!-- Footer -->
		<?php $this->load->view('store/include/base_footer'); ?>
		<!-- End of Footer -->
		<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
		</a>
		<!-- js -->
		<?php $this->load->view('store/include/base_js'); ?>
	</body>
</html>
<style>
	#chat3 .form-control {
	border-color: transparent;
	}
	#chat3 .form-control:focus {
	border-color: transparent;
	box-shadow: inset 0px 0px 0px 1px transparent;
	}
	.badge-dot {
	border-radius: 50%;
	height: 10px;
	width: 10px;
	margin-left: 2.9rem;
	margin-top: -.75rem;
	}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
	$('#send-button').on('click', function() {
	  $.ajax({
	    type: 'POST',
	    url: $('#chat_form').attr('action'),
	    data: new FormData($('#chat_form')[0]),
	    processData: false,
	    contentType: false,
	    success: function(data) {
	// clear the chat input field
	$('#text').val('');
	
	// append the new message to the chat container
	// $('#chat').append(data);
	
	// scroll to the bottom of the chat container
	$('#chat').scrollTop($('#chat')[0].scrollHeight);
	},
	    error: function(xhr, textStatus, errorThrown) {
	      console.log(xhr.responseText);
	      $('#text').val('');
	    }
	  });
	});
	setInterval(function() {
	    $.ajax({
	      url: "<?= base_url('store/chat/check_new_messages/') ?>",
		  data: { customer_id: $('#customer_id').val() },
	      success: function(result) {
	        $("#chat").html(result); // update the chat box with the new messages
	      }
	    });
	  }, 1000); // check every second
	});
	
</script>

<?php $this->load->view('store/include/notification'); ?>