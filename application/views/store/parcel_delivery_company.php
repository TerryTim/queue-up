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
    <!-- Begin Page Content -->
    <!-- Log on to codeastro.com for more projects -->
    <div class="container-fluid">
    <h1 class="h5 text-gray-800"><i class="fas fa-truck"></i> จัดการบริษัทขนส่ง</h1>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header py-3">
          <a href="<?= base_url('store/parcel_delivery_company/addForm') ?>" class="btn btn-success pull-right" >
          <i class="fa fa-plus"> เพิ่มบริษัทขนส่ง</i>
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                  <!-- <th>#</th> -->
                  <!-- <th>Ticket Code</th>
                  <th>Name </th>
                  <th>Seat </th>
                  <th>Origin Buy</th>
                  <th>Action</th> -->
                  <th>รหัสบริษัทขนส่ง</th>
                  <th>บริษัทขนส่ง</th>
                  <th>คำอธิบาย</th>
                  <th>ดำเนินการ</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($parcel_delivery_company as $row) { ?>
                  <tr>
                    <td><?= $row['company_id']; ?></td>
                    <td><?= $row['company_name']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td><a href="<?= base_url('store/parcel_delivery_company/editForm/'.$row['company_id']) ?>" class="btn btn btn-info">แก้ไข</a>
                    <a class="btn btn btn-danger" href="<?= base_url('store/parcel_delivery_company/delete/'.$row['company_id']) ?>"
                      data-toggle="modal" data-target="#deleteProductModal" data-company-id="<?= $row['company_id'] ?>"
                      data-company-name="<?= $row['company_name'] ?>">ลบ</a></td>
                  </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- Footer -->
<?php $this->load->view('store/include/base_footer'); ?>
<!-- End of Footer -->
</div><!-- Log on to codeastro.com for more projects -->
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- js -->
<?php $this->load->view('store/include/base_js'); ?>

<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ต้องการลบบริษัทขนส่งนี้ใช่หรือไม่</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="card-body">
          <div>
            <table class="table table-bordered table-hover">
              <tbody>
                  <td><span id="company-id"></span></td>
                  <td><span id="company-name"></span></td>
                </tbody>
            </table>
          </div>
        </div>
      </div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
				<a class="btn btn-danger" href="<?= base_url('store/parcel_delivery_company/delete/'.$row['company_id']) ?>">ลบบริษัทขนส่ง</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>


<script>
    $('#deleteProductModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var company_id = button.data('company-id') // Extract info from data-* attributes
        var company_name = button.data('company-name')
        var modal = $(this)
        modal.find('#company-id').text(company_id)
        modal.find('#company-name').text(company_name)
        modal.find('.modal-footer a').attr('href', '<?= base_url('store/parcel_delivery_company/delete/') ?>' + company_id)
    })
</script>

<?php $this->load->view('store/include/notification'); ?>