<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>All-Activities</title>
</head>
<body>
	<h2>Vendo Machine</h2><hr>
	<?php 

	?>

	<form method="post">
		<fieldset style="width: 450px;">
			<legend>Products :</legend>

			<input type="checkbox" name="item1" id="iCoke" value="Coke">
			<label>Coke - ₱15</label><br>

			<input type="checkbox" name="item2" id="iSprite" value="Sprite">
			<label>Sprite - ₱20</label><br>

			<input type="checkbox" name="item3" id="iRoyal" value="Royal">
			<label>Royal - ₱20</label><br>

			<input type="checkbox" name="item4" id="iPepsi" value="Pepsi">
			<label>Pepsi - ₱15</label><br>

			<input type="checkbox" name="item5" id="iMountain" value="Mountain">
			<label>Mountain dew - ₱20</label><br>

		</fieldset>

		<fieldset style="width: 450px;">
			<legend>Options :</legend>

			<label>Size: </label>
			<select name="size">
				<option value="Regular" selected>Regular</option>
				<option value="Up">Up-Size (add ₱5)</option>
				<option value="Jumbo">Jumbo-Size (add ₱10)</option>
			</select>
			<label>Quantity: </label>
				<input type="number" name="quantity" id="quantity" min="1" max="10" style="width: 100px;">
				<input type="submit" value="Check out" name="checkout">
		</fieldset>



		<?php  
		$total = 0;
		$productPrices = [
            "Coke" => 15,
            "Sprite" => 20,
            "Royal" => 20,
            "Pepsi" => 15,
            "Mountain Dew" => 20
        ];
        $size = "Regular";
        $selectedProducts = [];
        $sizePriceAdjustment = 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;


        if (isset($_POST['size'])) {
			$size = $_POST['size'];
		}
		if ($size == 'Up') {
			$sizePriceAdjustment = 5;
		} elseif ($size == 'Jumbo') {
			$sizePriceAdjustment = 10;
		}
		if (isset($_POST['item1'])) {$selectedProducts[] = "Coke";}
		if (isset($_POST['item2'])) {$selectedProducts[] = "Sprite";}
		if (isset($_POST['item3'])) {$selectedProducts[] = "Royal";}
		if (isset($_POST['item4'])) {$selectedProducts[] = "Pepsi";}
		if (isset($_POST['item5'])) {$selectedProducts[] = "Mountain Dew";}
		$count = count($selectedProducts);




		if (isset($_REQUEST['checkout']) && !empty($selectedProducts) && !empty($quantity)) {
			echo "<hr><h2>Purchase Summary :</h2>";
			foreach ($selectedProducts as $product) {
        	$price = $productPrices[$product];
        	$priceEachProducthold = $price * $quantity;
        	$priceEachProduct = $priceEachProducthold + $sizePriceAdjustment;
        	$total += $priceEachProduct;

        	echo "<ul>
        			<li>
        				<b> $quantity piece of $size $product amounting to ₱ $priceEachProduct</b>
        			</li>
        		</ul>";

    		}
			echo "<b>Total Amount :  $total</b><br>";
    		echo "<b>Total Number Of Items :  $count</b>";

    		
		} 
		else if (isset($_REQUEST['checkout']) && !empty($selectedProducts) && empty($quantity)) {
				echo "<hr><b>Please add quantity.</b>";
		}
		else if (isset($_REQUEST['checkout'])) {
				echo "<hr><b>No product selected.</b>";
		}
		

		?>


	</form>
</body>
</html>