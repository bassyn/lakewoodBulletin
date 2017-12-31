<?php
$sendMessage=false;
if(!isset($id))
{
    $id = $_GET['listing'];
}else{
    $sendMessage=true;
}
    include '../model/listingDetailsModel.php';
    include 'navListing.php';
?>
	<link href="../css/contact.css" rel="stylesheet"/>
    <div class="row">
        <div class="col-md-12 col-lg-8 listingDetails">
        <?php
            foreach($listings as $listing){
        ?>
            <h1><?= $listing->getTitle(); ?> </br></h1>
            <figure>
                <img class="listingDetailImage" src="<?= $listing->getPhoto(); ?>" onerror="this.src='../images/paper.jpg';"/>
            </figure>
                <table class="listingDetailTable">
                    <tr>
                        <td>
                            <?php
                            if($listing->getCategory()=='Jobs'){
                                echo 'Pay:';
                            }else{
                                echo 'Price:';
                            }?></h4>
                        </td>
                        <td>
                            <p>
                            <?php  $output=$listing->getPrice(); 
                                        /*preg_match_all("/([0-9]+)/i",$output ,$matches);
                                        for($i=0;$i<sizeof($matches[0]);$i++){
                                        $output=preg_replace(('/'.$matches[0][$i].'/'),(number_format ($matches[0][$i])), $output);
                                        }*/
                                        echo($output);  ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td><h4>Description: </h4></td>
                        <td><p><?= $listing->getDescription(); ?></p></td>
                    </tr>
                    <?php if(!empty($listing->getContact())) {?>
                    <tr>
                        <td><h4>Contact: </h4></td>
                        <td><p><?=$listing->getContact(); ?></p></td>
                    </tr>
                    <?php } ?>
                </table>
        <?php 
            } 

            if(isset($images)){
                foreach($images as $image){?>
                    <img class="additionalImages" src="<?= $image['image_path']; ?>"/>
                <?php
                }?>
                <img class="additionalImages" src="<?= $listing->getPhoto();?>"/>
        <?php  }?>
        </div>

    <div class="col-md-12 col-lg-3 container">
    
        <?php
        if($sendMessage==true){
            echo "Your Message Has Been sent.";
        }
        ?>
        <form action="../model/sendMessageModel.php" method="post">
        <label for="subject">Contact Form</label><br>
            <textarea id="message" name="message" style="height:125px"></textarea><br>
        <input type="hidden" name="id" value="<?= $listing->getId()?>">
            <input type="submit" value="Send">

        </form>
    </div>

</div>



<?php
    include 'footerListing.html';

?>

<script src="../controller/javaScript.js"></script>