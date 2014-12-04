<html>
	<head>
		<title>ToolsForEver - <?= $page_title; ?></title>

		<!-- CSS -->
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/style.css">


		<!-- JavaScript -->
		<script rel="text/JavaScript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script>	
	</head>
	<body>
		<div class="pure-g wrapper">
			<div class="pure-u-1 menu">
				<div class="logo">
					<span class="fa-stack fa-lg" style="font-size: 36px; padding: 10px 0 5px 5px">
						<i class="fa fa-gears fa-stack-2x" style="color: #68686B; margin: 0 0 0 45%; z-index:1;"></i>
						<i class="fa fa-wrench fa-stack-2x" style="color: #cecece; margin: 0 0 0 90%;"></i>
						<i class="fa fa-gavel fa-stack-2x" style="color: #cecece;"></i>
					</span>
				</div>
			</div>
			<div class="pure-u-1 content">
				<?= $this->load->view($view_content); ?>
			</div>
		</div>
	</body>
</html>

<script>
	$(document).ready(function(){

	});
</script>