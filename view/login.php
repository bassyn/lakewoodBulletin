<?php
require '../model/carrierModel.php';
if(!isset($message)){
	include 'navListing.php';
}
?>

<link href="../css/login.css" rel="stylesheet"/>

<div class="login-page">
    <div class="form">
        <form name="register" class="register-form" method="post" action="../model/registerModel.php">
            <input type="text" placeholder="username" name="username" maxlength="20"/>
            <input type="password" placeholder="password" name="password1"/>
            <input type="password" placeholder="confirm password" name="password2"/><br/>
            <input type="text" placeholder="email address" name="email" id="email"/>
            <p class="message">To receive your messages through text; enter your cell phone number and select your carrier</p>
            <input type="text" placeholder="cell phone number" name="cell" id="cell"/>
            <!--label class="message">Carrier: </label-->
            <select name="carrier_id">
                <option>Select a Carrier</option>
                <?php foreach($carriers as $carrier){ ?>
                    <option value="<?= $carrier['id']?>"><?= $carrier['name']?> </option>
                <?php } ?>
            </select>
            <input type="submit" value="create">
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>

        <form class="login-form" action="../model/loginModel.php" method="post" name="form1">
            <input type="text" placeholder="username" name="username" id="username"/>
            <input type="password" placeholder="password" name="password" id="password"/>
            <input type="submit" name="button" id="button" value="login"/>
            <p class="message">Not registered? <a href="#">Create an account</a></p>
        </form>
    </div>
</div>

<?php
	include 'footerListing.html';
?>
<script src="../controller/javaScript.js"></script>