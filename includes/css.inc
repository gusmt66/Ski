<link href="css/format.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />

<?php 
if (curPageName() == 'index.php' || curPageName() == '') {
	echo '<link href="css/index.css" rel="stylesheet" type="text/css" />';	
}
?>

<?php 
if (curPageName() == 'catalog.php' || curPageName() == 'catalog-detail.php') {
	echo '<link href="css/catalog.css" rel="stylesheet" type="text/css" />';	
}
?>

<?php 
if (curPageName() == 'who-we-are.php') {
	echo '<link href="css/who.css" rel="stylesheet" type="text/css" />';	
}
?>

<?php 
if (curPageName() == 'contact.php') {
	echo '<link href="css/contact.css" rel="stylesheet" type="text/css" />';	
}
?>

<?php 
if (curPageName() == 'clients.php') {
	echo '<link href="css/clients.css" rel="stylesheet" type="text/css" />';	
}
?>


<link rel="stylesheet" href="css/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider/style.css" type="text/css" media="screen" />
