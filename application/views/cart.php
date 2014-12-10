<table>
	<thead>
		<th>Item</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
	</thead>
	<tbody>
<?php 	if(!empty($products)) {
		var_dump($products);
			foreach($products as $product) { ?>
		<tr>
			<td><?php echo $product['name'] ?></td>
			<td><?php echo $product['price'] ?></td>
			<td><?php echo $product['qty'] ?></td>
			<td><?php echo $product['subtotal'] ?></td>
		</tr>
<?php		}
		} ?>
	</tbody>
	<tfoot>
		<td></td>
	</tfoot>
	</table>
	<a href="store">Continue Shopping</a>

	<h1>Shipping Information</h1>
	<form>
		<table>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first_name"></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last_name"></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="text" name="address"></td>
		</tr>
		<tr>
			<td>Address 2</td>
			<td><input type="text" name="address2"></td>
		</tr>
		<tr>
			<td>City</td>
			<td><input type="text" name="city"></td>
		</tr>
		<tr>
			<td>State</td>
			<td><input type="text" name="state"></td>
		</tr>
		<tr>
			<td>Zipcode</td>
			<td><input type="text" name="zip_code"></td>
		</tr>
		</table>
	</form>

	<h1>Billing Information</h1>
	<form>
		<table>
		<tr>
			<td>First Name</td>
			<td><input type="text" name="first_name"></td>
		</tr>
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="last_name"></td>
		</tr>
		<tr>
			<td>Address</td>
			<td><input type="text" name="address"></td>
		</tr>
		<tr>
			<td>Address 2</td>
			<td><input type="text" name="address2"></td>
		</tr>
		<tr>
			<td>City</td>
			<td><input type="text" name="city"></td>
		</tr>
		<tr>
			<td>State</td>
			<td><input type="text" name="state"></td>
		</tr>
		<tr>
			<td>Zipcode</td>
			<td><input type="text" name="zip_code"></td>
		</tr>
		</table>
	</form>
</div><!-- close content div -->
</body>
</html>