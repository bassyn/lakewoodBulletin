
	<?php
	include 'navListing.php';
	 if(!empty($message)) : ?>
	 <div class="alert alert-info text-center">
		<h3><?= $message ?></h3>
	<?php endif; ?>
</div>

<?php 
	if(isset($loggedIn) || isset($addedListing)){
		include 'footerListing.html';
	}else {
		include 'login.php';
	}
	
?>