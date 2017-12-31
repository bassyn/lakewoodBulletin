<link href="../css/messages.css" rel="stylesheet"/>
<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
    if($_SESSION['username'] == null){
        header('Location: ../index.php');
    }
    include '../model/messageCenterModel.php';
    include 'navListing.php';
   
   
    $me=$_SESSION['username'];
    $responceStyle="testimonial testimonial-default";
    $sentStyle=array("testimonial testimonial-primary","testimonial testimonial-info","testimonial testimonial-success","testimonial testimonial-warning","testimonial testimonial-danger");
    $currentStyle=$sentStyle[0];

    foreach ($rows as $row) {
        $newConversation=false;
        if(!isset($outsider)){
            if($row['sender']==$me){
                $outsider=$row['receiver'];
                $outsiderId=$row['receiverId'];
            }else{
                $outsider=$row['sender'];
                $outsiderId=$row['senderId'];
            }

        }
 
        if(!isset($listingId)){
            $listingId=$row['listingId'];
        }
        if($listingId!=$row['listingId']){
            $newConversation=true;
        } 
        if($outsider!=$row['sender'] && $outsider!=$row['receiver']){
            $newConversation=true;
        } 
       //  if(!isset($lastOutsider)){
         //    if($row['username']!=$_SESSION['username'])
           // $lastOutsider=$row['username'];
            //else  $lastOutsider=$row['toUser'];
        //}
//if(!isset($user)){
    
//if($row['username']!=$_SESSION['username']){
 //$user=$row['username'];
//}else{
  //  $user=$row['toUser'];
//}
//}
//if(!isset($lastUser)){
  //  $lastUser=$row['toUser'];
//}

 //if(!isset($from)){
   //         $from=$row['from_id'];
     //   }
  //      if($listingId!=$row['id']||($row['username']!=$lastOutsider && $row['username']!=$_SESSION['username'])){

    if($newConversation==true){
//if($user==$_SESSION['username'])$user=$lastUser;
?>

		<div class="col-sm-12">
            <div id="tb-testimonial" class="<?=$responceStyle?>">
                        <form method="post" action="../model/sendMessageModel.php">
                            <textarea class="responseMessage" name="message" placeholder="Respond to <?=$outsider?>"></textarea><br/>
                            <input name="id" type="hidden" value="<?=$listingId?>">
                            <input name="user" type="hidden" value="<?=$outsiderId?>">
                            <button type="submit" id="submitBtn">
                                 <span style="cursor: pointer"; class="glyphicon glyphicon-send"></span>  Send
                            </button>
                             <!--a style="float: right"; class="sendMessage" onclick="$('#submitBtn').click();"/>
                                <span style="cursor: pointer"; class="glyphicon glyphicon-send"></span> 
                            </a-->
                        </form>
            </div> 
            <hr style="border:solid white 3px;"/>  
		</div>
<?php

        $listingId=$row['listingId'];
        if($row['sender']==$me)
        {
            $outsider=$row['receiver'];
            $outsiderId=$row['receiverId'];
        }else{
            $outsider=$row['sender'];
            $outsiderId=$row['senderId'];
        }

    }
        if($row['sender']==$me){   
?>
    
            <div class="col-sm-12">
                <div id="tb-testimonial" class=" <?=$responceStyle?>">
                    <div class="testimonial-section">
                        <?=$row['message'] ?>
                    </div>
                    <div class="testimonial-desc">
                        <div class="testimonial-writer">
                            <div class="testimonial-writer-name"> <?=$me ?></div>
                        <div class="testimonial-writer-name">Re: <?=$row['title']?></div>
                        </div>
                    </div>
                </div>   
            </div>
<?php
        }else{
        //if(!isset($from)){
          //  $from=$row['from_id'];
        //}if($from!=$row['from_id']){
            if($newConversation==true){
                if(!isset($x)){
                    $x=0;
                }
                $x++;
                if($x==1)$x++;
                if(!($x<sizeof($sentStyle))){
                    $x=0;
                }
                $currentStyle=$sentStyle[$x];
            }
?>

		<div class="col-sm-12">
            <div id="tb-testimonial" class="<?=$currentStyle?>">
                <div class="testimonial-section"> <?=$row['message']?></div>
                <div class="testimonial-desc">
                <?php
                    if(!empty($row['photo'])){echo '<img src='.$row['photo']. ' />';}
                    else {echo '<img src="../images/paper.jpg"';}?>
                    <div class="testimonial-writer">
                    	<div class="testimonial-writer-name"><?=$row['sender']?></div>
                        <div class="testimonial-writer-name">Re: <?=$row['title']?></div>
                    </div>
                </div>
            </div>   
		</div>

<?php
  //      $from=$row['from_id'];
    }
       //if($row['username'] !== $_SESSION['username']){
           // $user=$row['username'];   
       //}
       
       //$lastUser=$user;
       //$user=$row['username'];
       //if($user!=$_SESSION['username'])$lastOutsider=$user;
        //$from=$row['from_id'];
        //$listingId=$row['id'];
    }
    //if(isset($from)&&$from!=$_SESSION['id']){
//if($user==$_SESSION['username'])$user=$lastUser;
if(isset($outsider)){
    ?>

		<div class="col-sm-12">
            <div id="tb-testimonial" class="<?=$responceStyle?>">
                <!--div class="testimonial-section"-->
                        <form method="post" action="../model/sendMessageModel.php">
                            <textarea class="responseMessage" name="message" placeholder="Respond to <?=$outsider?>"></textarea><br/>
                            <input name="id" type="hidden" value="<?=$listingId?>">
                            <input name="user" type="hidden" value="<?=$outsiderId?>">
                            <button type="submit" id="submitBtn2">
                                <span style="cursor: pointer"; class="glyphicon glyphicon-send"></span>  Send
                            </button>
                             <!--a style="float: right"; class="sendMessage" onclick="$('#submitBtn2').click();"/>
                                <span style="cursor: pointer"; class="glyphicon glyphicon-send"></span> 
                            </a-->
                        </form>
                <!--/div-->
            </div>   
		</div>
<?php
}
//}
 

include 'footerListing.html';

?>