<?php 
require_once("private/db-settings.php"); //Require DB connection 
require_once("private/funcs.php"); //Require DB connection 
$products = getProducts($_GET['id']);
$dir = "images/catalog/";
?>
<div class="cattext">CATÁLOGO DE PRODUCTOS</div>
<?php if (count($products) == 0) {
    //echo "<h1>NO EXISTEN PRODUCTOS PARA ESTA CATEGORIA</h1>";
    //exit();		header("Location: catalog.php");
}
?>
	<div id="wrapper">
	<div id="slider_wrapper">
        <div class="slider-wrapper theme-default">
        <div class="category-box">
            <div class="category-img">
                <?php echo "<img src='images/catalog/" . $products[0]['category_img'] . "'/>"; ?>
            </div>
            <div class="category-text">
                <h3><?php echo $products[0]['category'] ?></h3>
                <p> <?php echo $products[0]['category_desc']?> </p>
            </div>
        </div>
            <div id="slider" class="nivoSlider">
            <?php 
                foreach ($products as $prod) {
                    echo "<a><img width='530' height='398' src='". $dir . $prod['folder'] . "/" . $prod['filename'] . "' title='" . $prod['code'] . "' />";
                }
            ?>
            </div>
        </div>
    </div>

    </div>
    <div class="button-catalog" align="center">
      <a href="catalog.php">
        <img src="images/catalog-button2.png" width="188" height="35" />
      </a>
    </div>


    <script type="text/javascript" src="js/nivo-slider/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/nivo-slider/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        /*$('#slider').nivoSlider();*/
        $('#slider').nivoSlider({effect:'random'})
    });
    </script>


      

