<div id="notification-container">
  <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert-success">
          <?php echo $this->session->flashdata('success'); ?>
      </div>
      <?php $this->session->unset_userdata('success'); ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('message')): ?>
      <div class="alert alert-warning">
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php $this->session->unset_userdata('message'); ?>
  <?php endif; ?>
</div>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
</div>


<script>
    $(document).ready(function() {
        // show the notification message and fade it out after 3 seconds
        $('#notification-container').fadeIn('slow', function() {
            $(this).delay(3000).fadeOut('slow');
        });
    });
</script>

<style>
#notification-container {
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
}

#notification-container .alert {
    display: inline-block;
    margin: 10px;
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
}
</style>