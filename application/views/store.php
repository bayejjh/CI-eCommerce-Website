		<?php if(!isset($name)){ $name = ''; } ?>

	<div class="side_bar_div">
		<a href="/default_controller">
			Click Here to Return
			<br>ALL the POKéMONS!
		</a>
		<form action="/order_by" method="post">
			<h2>Search</h2>
			<h4>By Product Name</h4>
				<input type="text" placeholder="Product Name" name="word_search" value="<?= $name?>">
			<h4>By Category</h4>
				<?php if(!empty($this->session->userdata('categories')))
					  	{ ?>
				<?php 		foreach($this->session->userdata('categories') as $category)
							{	?>	
								<input type="radio" name="category" value="<?= $category['id'] ?>"><?= $category['name'] ?><br>
				<?php 		} ?>
				<?php 	} ?>
			<select name="selected_order">
				<option value="">(Order Selection)</option>
			    <option value="low_price">Lowest Price First</option>
			    <option value="high_price">Highest Price</option>
			    <option value="most_popular">Most Popular</option>
			</select>
			<input type="submit" class="submit_search">
		</form>
	</div>

	<div class="products_div"> 
		<?php if(!empty($products))
		{ 
			foreach($products as $product)
			{ ?>
				<div class="each_product" stuff="<?= $product['id']?>">
				<p>	
					<a class="product_name" href="/view_product/<?= $product['id'] ?>">
						<?= $product['name'] ?>
					</a>
				</p>
				<p>$<?= $product['price'] ?></p>
	 			<!-- <p> $product['main_image_id'] </p>    <-*image?*    -->
				<p><?= $product['description'] ?></p>
				<form action="/add_cart/<?= $product['id']?>" method="post">
					<input type="submit" value="Buy" class="submit">
				</form>
			</div>
			<? } ?>
		<? } ?>
	<div class="pagination_div"><?php echo $links ?></div>
<<<<<<< HEAD
		</form>

	<?php 	if(!empty($products))
			{ 
				foreach($products as $product)
				{ ?>
	  				<div class="each_product" stuff="<?= $product['id']?>">
						<p>	
							<a href="/view_product/<?= $product['id'] ?>">
								<?= $product['name'] ?>
							</a>
						</p>
						<p>
							$<?= $product['price'] ?>
						</p>
			 <!-- <p> $product['main_image_id'] </p>    <-*image?*    -->
			 <p>
			 	<?= $product['description'] ?>
			 </p>
			 <form action="/add_cart/<?= $product['id']?>" method="post">
				<input type="submit" value="Buy">
			 </form>
		</div>
	<?php		}
			} ?>
			<?php }}?>
=======
>>>>>>> 78455e6db09656fca81343c43384eeef4ab0925a
	</div>
</div> <!-- div for container -->
</body>
</html>