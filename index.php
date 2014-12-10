<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="assets/css/template/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- <link href="assets/css/template/fonts.css" rel="stylesheet" type="text/css" media="all" /> -->

</head>
<body>

<?php
	if(!isSet($_SESSION["user"])){
		session_start();
	}
	include("admin/functions/locations.php"); 
	$locations = get_all_locations();
	
	// echo "<pre>";
	// print_r($locations);
	// echo "</pre>";

?>


<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">ToolsForEver</a></h1>
			</div>
		<div id="menu">
			<!-- <ul>
				<li class="current_page_item"><a href="#" accesskey="1" title="">Homepage</a></li>
				<li><a href="#" accesskey="2" title="">Our Clients</a></li>
				<li><a href="#" accesskey="3" title="">About Us</a></li>
				<li><a href="#" accesskey="4" title="">Careers</a></li>
				<li><a href="#" accesskey="5" title="">Contact Us</a></li>
			</ul> -->
		</div>
	</div>
</div>


<div id="wrapper3" class="pure-g">
	<div id="portfolio" class="container pure-u-1">
		<div class="title">
			<h2>Onze filialen</h2>
			<!-- <span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>  -->
		</div>
		<?php foreach($locations as $location): ?>
			<div class="column1 pure-u-1-4" style="color: rgba(0,0,0,0.5); text-align: center; height: 175px;">
					<!-- <img src="assets/img/locaties/locatie_1.png" alt="" class="image image-full" /> -->
				<div class="pure-u-1" style="text-align: center;">
					<i class="fa fa-home fa-4x" ></i>
				</div>
				<h3 style="text-align: center;"><?= $location["location"]; ?></h3>
				<div style="width: 250px;">
					<?= $location["description"]; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div id="wrapper1">
	<div id="welcome" class="container">
		<div class="title">
			<h2>Contactinformatie</h2>
			<span class="byline">Voor vragen kunt u contact opnemen!</span> 
		</div>
		<div class="content pure-g">
			<p>	
				Tel: 0413 - 634895<br />
				Tax: 073 - 343434<br />
				Email : info@toolsforever.nl<br />
				Hoge heuvel 12<br />
				5443 DF Errup<br />
			</p>
		</div>
	</div>
</div>