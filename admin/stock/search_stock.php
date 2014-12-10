<?php
	include("../base/header.php");
	require("../functions/search.php");

	$products = get_all_products();
	$locations = get_all_locations();
?>

	<div class="pure-form pure-g">
		<div class="pure-u-1 ">
			<div class="pure-u-1-4">
				<h3>Selecteer een product</h3>
				<select name="product_id">
					<option></option>	
					<?php foreach($products as $product_id => $product): ?>
						<option value="<?= $product_id; ?>"><?= $product["id"] . " - " . $product["product"]?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="pure-u-1-4">
				<h3>Selecteer een locatie</h3>
				<select name="location_id">
					<option></option>
					<?php foreach($locations as $location_id => $location): ?>
						<option value="<?= $location_id; ?>"><?= $location["location"]; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="pure-u-1">
			<div class="pure-button pure-button-primary send_search">Zoeken</div>
		</div><br /><br />	
	</div>
	
<?php
	include("../base/footer.php");
?>

<script>
	$(document).ready(function(){
		$("select[name='product_id']").select2({width: '200px', placeholder: "Selecteer een product", allowClear: true,});
		$("select[name='location_id']").select2({width: '200px',  placeholder: "Selecteer een locatie", allowClear: true});

		$(".send_search").on("click",function(){
			send_search();
		});
	});

	function send_search(){
		product_id = $("select[name='product_id'] option:selected").val();
		location_id = $("select[name='location_id'] option:selected").val();

		$.post("../functions/search.php",{
			action: "search",
			product_id: product_id,
			location_id: location_id
		},function(data){

		})
	}
</script>