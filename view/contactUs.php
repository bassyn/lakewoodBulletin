<?php
    
    include 'navListing.php';
    if(isset($message)){
        $sendMessage = true;
    }else{
        $sendMessage=false;
    }
    
?>
<link href="../css/contact.css" rel="stylesheet"/>
<div class="row">
    <div class="col-md-12 col-lg-8">
        <div class="aboutUs">
                <br/>
                <h3>Thank you for using the Lakewood Bulletin.</h3> <br>
                <p style="font-size: 20px;">The Lakewood Bulletin is a free online classified for the Lakewood community. <br>Posting a listing is free.  
                    <br>Please adhere to our standards. Only postings and images that are appropriate for a a shul Bulletin Board may be posted. 
                    If you are unsure please contact us before posting your listing.</p><br/>
                <h4>We reserve the right to remove a listing at any time for any reason.<br><br></h4>
                <h3>Questions or comments can be emailed to info@lakewoodbulletin.com</h3><br/>
            </div>
    </div>

    <div class="col-md-12 col-lg-3 container">
    
        <?php
        if($sendMessage==true){
            echo "Your Message Has Been sent.";
        }
        ?>
        <form action="../model/contactUsModel.php" method="post">
            <label for ="email">Email Address</label>
            <input type="email" name = "email" placeholder="Enter Your Email Address" required><br>
            <label for ="message">Message</label>
            <textarea id="message" name="message" style="height:125px"></textarea><br>
            <input type="submit" value="Send">

        </form>
    </div>
</div>

<?php
    include 'footerListing.html';
?>