<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['username']) || ($_SESSION['username'])==null){
    $message = "You must log in first";
    include 'message.php';
    exit;
}
    include '../model/deleteListingModel.php';
	include 'navListing.php';
?>

<link href="../css/deleteListing.css" rel="stylesheet"/>
<?php

    if(count($listings) == 0){
        echo '<h2 style="text-align: center";>You have no current listings.</h2>';
    }else { ?>
        <div class="deleteListing">
            <table id="removeListingTable">
                <tr>
                    <th>Listing Title</th>
                    <th></th>
                </tr>
            <?php
                foreach($listings as $listing){?>
                <tr>
                    <td><?= $listing['title']?></td>
                    <td><button class="delete" id="<?= $listing['id'] ?>">Delete</button></td>
                </tr>
            <?php
                }
            ?>
            </table>
        </div>
<?php
    }
    include 'footerListing.html'; 
?>
<script src="../controller/javaScript.js"></script>