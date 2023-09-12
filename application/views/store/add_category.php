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
    <link rel="stylesheet" href="<?= base_url('assets/frontend/timepicker') ?>/css/bootstrap-material-datetimepicker.css" />
    <?php $this->load->view('store/include/base_css'); ?>
  </head>
  <body id="page-top">
    <!-- navbar -->
    <?php $this->load->view('store/include/base_nav'); ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
      <!-- Page Heading -->
      <!-- Log on to codeastro.com for more projects -->
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">เพิ่มหมวดหมู่สินค้า</h6>
        </div>
        <div class="card-body">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <form action="<?= base_url()?>store/category/add" enctype="multipart/form-data" method="post">
								<div class="form-group">
                    <label  class="">ชื่อหมวดหมู่สินค้า</label>
                    <input type="text" class="form-control" name="category_name" required="" placeholder="ชื่อหมวดหมู่สินค้า">
                    <?= form_error('name'),'<small class="text-danger pl-3">','</small>'; ?>
                  </div>
									<div class="form-group">
                    <label  class="">รายละเอียดหมวดหมู่สินค้า</label>
                    <textarea type="text" class="form-control" name="category_description" required="" placeholder="รายละเอียด"></textarea>
                    <?= form_error('name'),'<small class="text-danger pl-3">','</small>'; ?>             
									
                  </div>
                </div>
              </div>
              <hr>
              <input  type="submit" class="btn btn-success pull-rigth" value="เพิ่ม" name="submit">
              <a class="btn btn-danger" href="javascript:history.back()"> ยกเลิก</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Main Content -->
    <!-- The Modal -->
    <!-- Log on to codeastro.com for more projects -->
    <!-- Footer -->
    <?php $this->load->view('store/include/base_footer'); ?>
    <!-- End of Footer -->
    <!-- js -->
        <?php $this->load->view('store/include/base_js'); ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
        <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
        <script type="text/javascript" src="<?= base_url('assets/frontend/timepicker') ?>/js/bootstrap-material-datetimepicker.js"></script>
        <script type="text/javascript">
          $(".chosen-select").chosen({
            no_results_text: "ไม่พบหมวดหมู่สินค้า"
          })
          
          $(document).ready(function()
          {
            $('#time').bootstrapMaterialDatePicker
            ({
              date: false,
              shortTime: false,
              format: 'HH:mm'
            });
          })
        </script>
        <script type="text/javascript">
          $(document).ready(function()
          {
            $('#time2').bootstrapMaterialDatePicker
            ({
              date: false,
              shortTime: false,
              format: 'HH:mm'
            });
          })
        </script>

      </body>
    </html>

<script>
	document.addEventListener('DOMContentLoaded', function() {
    const inputs = Array.from(
      document.querySelectorAll('input[name=telephone], input[name=mobile]')
    );

    const inputListener = e => {
      inputs
        .filter(i => i !== e.target)
        .forEach(i => (i.required = !e.target.value.length));
    };

    inputs.forEach(i => i.addEventListener('input', inputListener));
  });
</script>

<?php $this->load->view('store/include/notification'); ?>