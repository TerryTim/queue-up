<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/store/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/store/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/store/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/store/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/store/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/store/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/store/js/demo/datatables-demo.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url() ?>assets/datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<?= "<script>".$this->session->flashdata('message')."</script>"?>
<script type="text/javascript">
	$(document).ready(function () {
		$(".preloader").fadeOut();
	});
  
	$(":submit").click(function (e) {
		window.addEventListener("beforeunload", function (event) {
			$(".preloader").show();
		});
	});

</script>
<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">About Project</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				[ ] with ❤ in Jakarta/Cengkareng <br>
				By Bahyu Sanciko
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> -->

<?php 
  // Retrieve customer data from the database
  $entrepreneur_id = $this->session->userdata('entrepreneur_id'); // Replace with actual customer ID
  $query = $this->db->get_where('entrepreneurs', array('entrepreneur_id' => $entrepreneur_id));
  $profile = $query->row_array();
?>

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
                    <form action="<?= base_url()?>store/profile/editprofile" method="post" enctype="multipart/form-data">
                      <div class="card-body">
                          <div class="row">
                            <div class="col-sm-14">
								<div class="row form-group">
									<label for="name" class="control-label">ชื่อ-นามสกุล</label>
									<input type="hidden" name="entrepreneur_id" value="<?= $profile['entrepreneur_id']; ?>">
									<div class="col-sm-4">
										<input type="text" class="form-control" name="firstname" value="<?php echo $profile['firstname']?>" >
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="lastname" value="<?php echo $profile['lastname']?>" >
									</div>
								</div>
								<div class="row form-group">
                                  <label for="name" class="control-label">ชื่อร้านค้า</label>
                                  <input type="text" class="form-control" name="store_name" value="<?php echo $profile['store_name']?>" >
                                </div>
                                <div class="row form-group">
                                  <label for="name" class="control-label">อีเมล</label>
                                  <input type="email" class="form-control" name="email" value="<?php echo $profile['email']?>" >
                                </div>
                                <div class="row form-group">
                                  <label for="name" class="control-label">หมายเลขโทรศัพท์</label>
                                  <input type="number" class="form-control" name="phone_number" value="<?php echo $profile['phone_number']?>" >
                                </div>
                                <div class="row form-group">
                                  <label for="name" class="control-label">รายละเอียดที่อยู่ของร้านค้า</label>
                                  <textarea type="text" class="form-control" name="store_address" rows="4"><?= $profile['store_address']?></textarea>
                                </div>
                                <div class="row form-group">
                                  <label for="" class="control-label">รูปภาพ</label>
                                  <img class="img-profile rounded-circle" style="width:150px;height:150px" src="<?= base_url('assets/images/profiles/entrepreneurs/' . $profile['store_image']) ?>" alt="Profile Image">
                                  <input type="file" class="form-control" value="<?php echo base_url($this->session->userdata('store_image')) ?>" name="fileToUpload" id="fileToUpload"  >
                                </div>
								                <div class="row form-group">
                                  <label for="name" class="control-label">บัญชีธนาคาร</label>
                                  <input type="text" class="form-control" name="bank_account" value="<?= $profile['bank_account']?>">
                                </div>
                                <div class="row form-group">
                                  <label for="bank_account_name" class="control-label">ชื่อบัญชีธนาคาร</label>
                                  <input type="text" class="form-control" name="bank_account_name" value="<?= $profile['bank_account_name']?>">
                                </div>
								                <div class="row form-group">
                                  <label for="name" class="control-label">หมายเลขบัญชีธนาคาร</label>
                                  <input type="text" class="form-control" name="number_bank_account"  value="<?= $profile['number_bank_account']?>">
                                </div>
                                  <button type="submit" name="submit" class="btn btn-primary" >บันทึก</button>
                            </div>
                          </div>
                      </div>
                    </form>
                </div>
              </div>
          </div>
        </div>
