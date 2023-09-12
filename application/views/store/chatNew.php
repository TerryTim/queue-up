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
    <?php //$this->load->view('store/include/base_css'); ?>
  </head>
  <body id="page-top">
    <!-- navbar -->
    <?php //$this->load->view('store/include/base_nav'); ?>

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
        </div>
        <!-- added closing container div here -->
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
}
?>


</body>
</html>

<script>
    window.addEventListener("load", function() {
        // get the chat container element
        var chatContainer = document.getElementById("chat-container");
        // scroll the chat container to the bottom
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });

    // $('#chat .card-body').scrollTop($('#chat .card-body')[0].scrollHeight);
</script>
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

<?php $this->load->view('store/include/notification'); ?>