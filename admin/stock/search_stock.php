<?php
	include("../base/header.php");
	require("../functions/search.php");

	$products = get_all_products();
	$locations = get_all_locations();
?>
	
	<div class="pure-form pure-g search_selection">
		<div class="pure-u-1 ">
			<div class="pure-u-1-4">
				<h3>Selecteer een product</h3>
				<select name="product_id" required>
					<option></option>	
					<?php foreach($products as $product_id => $product): ?>
						<option value="<?= $product_id; ?>"><?= $product["id"] . " - " . $product["product"] . " " . $product["type"]; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="pure-u-1-4">
				<h3>Selecteer een locatie</h3>
				<select name="location_id" required>
					<option></option>
					<?php foreach($locations as $location_id => $location): ?>
						<option value="<?= $location_id; ?>"><?= $location["location"]; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="pure-u-1">
			<br />
			<div class="pure-button pure-button-primary send_search">Zoeken</div>
		</div><br /><br />	
	</div>

	
	<div class="pure-form pure-g search_result">	
		<div class="pure-u-1-2">
			<h2 class="location_name">Locatie</h2>
			<table class="pure-table pure-table-bordered pure-table-striped dataTable no-footer" id="datatable">
				<thead>
					<tr style="color: white;">
						<th>Product</th>
						<th>Type</th>
						<th>Fabriek</th>
						<th>Verkoopprijs</th>
						<th style="width: 300px;">Aantal</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="product_name">

						</td>
						<td class="product_type">

						</td>
						<td class="factory">

						</td>
						<td class="product_sell_price">

						</td>
						<td>
							<input type="text" name="amount" style="width: 100px" />
							<input type="hidden" name="product_id" />
							<input type="hidden" name="location_id" />
							<i class="fa fa-save" style="float: right; margin-top: 5px; cursor:pointer"></i>
							<span class="save_message">
								<i class="fa fa-check-circle" style="color: green;"></i>
								Opgeslagen!
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
<?php
	include("../base/footer.php");
?>

<script>
	$(document).ready(function(){
		$("select[name='product_id']").select2({width: '300px', placeholder: "Selecteer een product", allowClear: true,});
		$("select[name='location_id']").select2({width: '300px',  placeholder: "Selecteer een locatie", allowClear: true});

		$(".send_search").on("click",function(){
			send_search();
		});

		$(".fa-save").on("click",function(){
			product_id = $("input[name='product_id']").val();
			location_id = $("input[name='location_id']").val();
			amount = $("input[name='amount']").val();

			$.post("../functions/search.php",{
				action: "change_stock",
				product_id: product_id,
				location_id: location_id,
				amount: amount
			},function(data){

			});

			show_save_message();
		});	
	});

	function send_search(){
		product_id = $("select[name='product_id'] option:selected").val();
		location_id = $("select[name='location_id'] option:selected").val();

		if(product_id == ""){
			alert("Selecteer een product");
			return false;
		}

		if(location_id == ""){
			alert("Selecteer een locatie");
			return false;
		}

		$.post("../functions/search.php",{
			action: "search",
			product_id: product_id,
			location_id: location_id
		},function(data){
			result = jQuery.parseJSON(data);

			$("input[name='product_id']").val(result["product"]["id"]);
			$("input[name='location_id']").val(result["location"]["id"]);
			$(".product_name").html(result["product"]["name"]);
			$(".product_type").html(result["product"]["type"]);
			$(".product_sell_price").html('&euro; ' + result["product"]["sell_price"]);

			$(".location_name").html(result["location"]["name"]);
			$("input[name='amount']").val(result["amount"]);

			$(".factory").html(result["factory"]);
		});
	}
</script>