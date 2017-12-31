<?php
if(!isset($_SESSION)){
    session_start();
}

if(($_SESSION['username'])==null){
    $message = "You must log in first";
    include 'message.php';
    exit;
}
	include 'navListing.php';
    
?>

<link href="../css/addListing.css" rel="stylesheet"/>
<div class="addListing">
    <div class="form">
        <form name="register" class="addListing-form" method="post" action="../model/addListingModel.php" enctype="multipart/form-data">
            Category:
                <select name="category" id="category" required>
                    <option></option>
                    <option value="1">Cars</option>
                    <option value="2">Jobs</option>
                    <option value="3">Misc. For Sale</option>
                    <option value="4">Real Estate</option>
                    <option value="5">Rentals</option>
                    <option value="6">Services</option>
                </select>
            <br>
            Title: <input type="text" name="title" required/>
            Price/Pay: <input type="text" name="price" required/>
            Contact #/email: <br/><input type="text" name="contact"/>
            Description:<textarea name="description" required></textarea>
            Main Photo:<input type="file" name="mainPhoto"/><br/>
            Additional Photos:<input type="file" name="additionalPhotos1"/>
                              <input type="file" name="additionalPhotos2"/>
                              <input type="file" name="additionalPhotos3"/>
            <input type="submit" value="Add Listing"/>
        </form>
    </div>
</div>

<?php
	include 'footerListing.html';
?>
<script src="../controller/javaScript.js"></script>