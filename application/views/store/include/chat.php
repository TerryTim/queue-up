<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <!-- Site Title -->
        <title>QUEUEUP</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <link href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
        <?php $this->load->view('frontend/include/base_css'); ?>
    </head>
    <body>


<button class="open-button" onclick="openForm()" target="_blank">ติดต่อร้านค้า</button>

<div class="chat-popup" id="chat" style="display:none;">

<form action="<?= base_url('chat/add/')?>" enctype="multipart/form-data" method="post" class="form-container" id="chat_form" onsubmit="event.preventDefault()">
<button type="button" class="close" onclick="closeForm()">&times;</button>
        <input type="hidden" name="entrepreneur_id" value="<?= $product[0]['entrepreneur_id']; ?>">
        <h4><i class="fa fa-store"></i>  <?=$product[0]['store_name']?></h4>
        <div class="card-body p-4" style="height: 400px; width: auto; overflow-y: scroll; scroll-behavior: smooth; scroll-padding-bottom: 0.5em;">
       
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
    if ($row['sender'] == $product[0]['entrepreneur_id']) {
        // display messages for sender 1
        ?>
        <div id="chat-container"> <!-- added container div here -->
            <div class="d-flex align-items-baseline mb-4">
                <div class="position-relative avatar">
                    <img class="img-profile rounded-circle"
                        src="<?= base_url('assets/images/profiles/entrepreneurs/' . $row['store_image']) ?>" 
                        alt="Profile Image">
                </div>
                <div class="pe-2">
                    <div>
                        <?php if (!empty($row['chat_image'])) { ?>
                            <div>
                                <img src="<?= base_url('assets/images/chats/' . $row['chat_image']) ?>" 
                                    alt="Chat Image" style="height: 100px; width: auto;">
                            </div>
                        <?php } ?>
                        <div class="card card-text d-inline-block p-2 px-3 m-1"><?= $row['text'] ?></div>
                    </div>
                    <div>
                        <div class="small"><?= date('H:i', strtotime($row['time'])) ?></div>
                    </div>
                </div>
            </div>
        </div> <!-- added closing container div here -->
        <?php
    } elseif ($row['sender'] == $this->session->userdata('id_customer')) {
        // display messages for sender 2
        ?>
        <div id="chat-container"> <!-- added container div here -->
            <div class="d-flex align-items-baseline text-right justify-content-end mb-4">
                <div class="pe-2">
                    <?php if (!empty($row['text'])) { ?>
                        <div>
                            <div class="card card-text d-inline-block p-2 px-2 m-1" style="background-color: #e44830; color: white; border: 1px solid #e44830;"><?= $row['text'] ?></div>
                        </div>
                    <?php } ?>
                    <div>
                        <?php if (!empty($row['chat_image'])) { ?>
                            <div>
                                <img src="<?= base_url('assets/images/chats/' . $row['chat_image']) ?>" 
                                    alt="Chat Image" style="width: 150px;">
                            </div>
                        <?php } ?>
                        <div class="small"><?= date('H:i', strtotime($row['time'])) ?></div>
                    </div>
                </div>
                
                <div class="position-relative avatar">
                    <img class="img-profile rounded-circle"
                    src="<?= base_url('assets/images/profiles/customers/' . $this->session->userdata('img_customer')) ?>" 
                    alt="Profile Image">
                </div>
            </div>
        </div>
        <?php
    }
}
?>
</div>
        <div class="card-footer">
            <div class="row">
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" style="display: none;">
                <label for="fileToUpload"><i class="fas fa-image"></i></label>
                <div class="col">
                    <input type="text" class="form-control" name="text" id="text" placeholder="เขียนข้อความ...">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary pull-rigth" id="send-button">ส่ง</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function openForm() {
  document.getElementById("chat").style.display = "block";
}

function closeForm() {
  document.getElementById("chat").style.display = "none";
}

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
  $('#chat .card-body').append(data);

  // scroll to the bottom of the chat container
  $('#chat .card-body').scrollTop($('#chat .card-body')[0].scrollHeight);
},
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr.responseText);
        $('#text').val('');
      }
    });
  });
  setInterval(function() {
      $.ajax({
        url: "<?= base_url('chat/check_new_messages') ?>",
        success: function(result) {
          $("#chat .card-body").html(result); // update the chat box with the new messages
        }
      });
    }, 1000); // check every second
});
</script>


</body>
</html>
<style>

.chat-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

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
</style>