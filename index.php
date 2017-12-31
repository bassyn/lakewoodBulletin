<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }
	if(!isset($_SESSION['login'])){
    	$_SESSION['login'] = 'Login';
	}
	include 'view/nav.php';

?>
<div id="image">
    <img id="bulletinBoard" src="images/bulletinBoard2.jpg" alt="">
</div>
<?php
	include 'view/footer.html';

?>
