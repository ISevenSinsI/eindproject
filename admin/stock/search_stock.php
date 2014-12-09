<?php
	include("../base/header.php");
	require("../functions/search.php");
	require("../functions/locations.php");

?>

	<div class="pure-form pure-g">
		<div class="pure-u-1-4">
			<!-- filling -->
		</div>

		<div class="pure-u-1-4">
			<h3>Selecteer een product</h3>
			<select name="product_id">
				<option value="0">Selecteer een product.</option>
			</select>
		</div>

		<div class="pure-u-1-4">
			<h3>Selecteer een locatie</h3>
			<select name="location_id">
				<option value="0">Selecteer een locatie.</option>
			</select>
		</div>

		<div class="pure-u-1-4">
			<!-- filling -->
		</div>	
	</div>
	
<?php
	include("../base/footer.php");
?>

<script>
	$(document).ready(function(){
		$("select[name='product_id']").select2({width: '200px'});
		$("select[name='location_id']").select2({width: '200px'});
	});
</script>