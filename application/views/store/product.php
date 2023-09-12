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
    <h1 class="h5 text-gray-800"><i class="fas fa-box"></i> จัดการสินค้า</h1>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
      <div class="card-header py-3">
          <a href="<?= base_url('store/product/addForm') ?>" class="btn btn-success pull-right" >
          <i class="fa fa-plus"> เพิ่มสินค้า</i>
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
                  <th>รหัสสินค้า</th>
                  <th>สินค้า</th>
                  <!-- <th>รูปภาพ</th> -->
                  <th>ราคา</th>
                  <th>ดำเนินการ</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($product as $row) { ?>
                  <tr>
                    <td style="cursor: pointer;" onclick="window.location='<?= base_url('store/product/view/'.$row['product_id']) ?>'"><?= $row['product_id']; ?></td>
                    <td style="cursor: pointer;" onclick="window.location='<?= base_url('store/product/view/'.$row['product_id']) ?>'">
                    <img style="height: 90px;" src="../assets/images/products/<?= $row['product_image'];  ?>"></img> <?= $row['product_name']; ?></td>
                    <!-- <td style="cursor: pointer;" onclick="window.location='<?= base_url('store/product/view/'.$row['product_id']) ?>'"><img style="height: 50px;" src="../assets/images/products/<?= $row['product_image'];  ?>"></img></td> -->
                    <td style="cursor: pointer;" onclick="window.location='<?= base_url('store/product/view/'.$row['product_id']) ?>'"><?= $row['product_price']; ?></td>
                    <td><a href="<?= base_url('store/product/editForm/'.$row['product_id']) ?>" class="btn btn btn-info">แก้ไข</a>
                    <a class="btn btn btn-danger" href="<?= base_url('store/product/delete/'.$row['product_id']) ?>"
                      data-toggle="modal" data-target="#deleteProductModal" data-product-id="<?= $row['product_id'] ?>"
                      data-product-name="<?= $row['product_name'] ?>" data-product-image="<?= base_url('assets/images/products/' . $row['product_image']) ?>" >ลบ</a></td>
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
				<h5 class="modal-title" id="exampleModalLabel">ต้องการลบสินค้านี้ใช่หรือไม่</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
        <div class="card-body">
          <div>
            <table class="table table-bordered table-hover">
              <tbody>
                  <tr>
                    <td><span id="product-id"></span></td>
                    <td><span id="product-name"></span></td>
                    <td> <img id="product-image" style="max-height: 100px;"></td>
                  </tr>
                </tbody>
            </table>
          </div>
        </div>
      </div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
				<a class="btn btn-danger" href="<?= base_url('store/product/delete/'.$row['product_id']) ?>">ลบสินค้า</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<script>
    $('#deleteProductModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var product_id = button.data('product-id') // Extract info from data-* attributes
        var product_name = button.data('product-name')
        var product_image = button.data('product-image')
        var modal = $(this)
        modal.find('#product-id').text(product_id)
        modal.find('#product-name').text(product_name)
        modal.find('#product-image').attr('src', product_image)
        modal.find('.modal-footer a').attr('href', '<?= base_url('store/product/delete/') ?>' + product_id)
    })
</script>

<?php $this->load->view('store/include/notification'); ?>