<?php
    require_once '../model/listingsModel.php';
    include 'navListing.php';
    $category = $_GET['category'];

?>
    <div class="pageName">
        <h1><?= $category ?>
        <?php   
            if (!empty($_GET['subcategory'])){
                $subcategory = $_GET['subcategory'];
                echo ' - ' . $subcategory;
            }?></h1>
        <hr/>
    </div>
    <div class="container-fluid">
    <!--div class="row">
        <div class="col-sm-3 offset-8">
        <form>  </form>
        </div>
    </div-->
    <div class="row" id="listingsRow">
    <?php
       foreach($listings as $listing) :
       ?>
                <div class="col-sm-12 col-md-6 col-lg-4 listing">
                    <h3><?= $listing->getTitle(); ?> </br></h3>
                    <figure>
                        <a href="../view/listingDetails.php?listing=<?=$listing->getId();?>"><img class="images" src="<?= $listing->getPhoto(); ?>" onerror="this.src='../images/paper.jpg';"/></a>
                        <figcaption>
                        <h4>
                        <?php
                        if($category=='Jobs'){
                            echo 'Pay:';
                        }else{
                            echo 'Price:';
                        }?>
                        <?php $output=$listing->getPrice(); 
                        /*preg_match_all("/([0-9]+)/i",$output ,$matches);
                        for($i=0;$i<sizeof($matches[0]);$i++){
                        $output=preg_replace(('/'.$matches[0][$i].'/'),((number_format ($matches[0][$i]))), $output);
                        }*/
                        echo($output);   ?>
                        </figcaption>
                    </figure>

                </div>
        <?php


            //echo '<div class="clearfix visible-xs"></div>';
            endforeach; 
            echo '</div>';
    include 'footerListing.html';

?>