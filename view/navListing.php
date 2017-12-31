<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Lakewood Bulletin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="../css/style.css" rel="stylesheet"/>
	<link rel="shortcut icon" href="../favicon.ico" />
</head>
<body>
   <div class="navbar navbar-wrapper">
        <div class="container-fluid">
            <nav class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu" aria-expand="false">
                        <span class="sr-only">Toggle navigation</span> Menu
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar">
                                <!--span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span-->
                            </span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../view/listings.php?category=Cars">Cars</a></li>
                        <li><a href="../view/listings.php?category=Jobs">Jobs</a></li>
                        <li><a href="../view/listings.php?category=Misc. For Sale">Misc. For Sale</a></li>
                        <li><a href="../view/listings.php?category=Real Estate">Real Estate</a></li>
                        <li><a href="../view/listings.php?category=Rentals">Rentals</a>
                            <!--ul id="rentals">
                                <li><a href="../model/listingsModel.php?category=Rentals&subcategory=House Rentals">Houses</a></li>
                                <li><a href="../model/listingsModel.php?category=Rentals&subcategory=Apartment Rentals">Apartments</a></li>
                                <li><a href="../model/listingsModel.php?category=Rentals&subcategory=Office Rentals">Office Space</a></li>
                            </ul-->
                        </li>
                        <li><a href="../view/listings.php?category=Services">Services</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                            if(!isset($_SESSION)) { 
                                session_start(); 
                            }
                            if($_SESSION['login']==='Logout'){
                                echo '<li><a href="../view/messages.php">Message Center</a></li>';
                                echo '<li><a href="../model/logoutModel.php">Logout</a></li>';
                            }else{
                                echo '<li><a href="../view/login.php">Login</a><li>';
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>