<?php

echo "Hallo Welt!";


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Xmas Whishlist</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
	</head>
	<body>
		<header>
			<h1>Xmas Wishlist</h1>	
		</header>
		<main>
			<p>Place your wishes into the form.</p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group">
					<label for="wish01">Wish No. 1:</label>
					<input type="text" id="wish01" name="wish01" class="form-control" />
					<label for="wish02">Wish No. 2:</label>
					<input type="text" id="wish02" name="wish02" class="form-control" />
					<label for="wish03">Wish No. 3:</label>
					<input type="text" id="wish03" name="wish03" class="form-control" />
					<label for="wish04">Wish No. 4:</label>
					<input type="text" id="wish04" name="wish04" class="form-control" />
				</div>
				<div class="form-group">
					<label for="prename">Prename:</label>
					<input type="text" id="prename" name="prename" class="form-control" />
					<label for="name">Name:</label>
					<input type="text" id="name" name="name" class="form-control" />
					<label for="street">Street:</label>
					<input type="text" id="street" name="street" class="form-control" />
					<label for="city">City:</label>
					<input type="text" id="city" name="city" class="form-control" />
					<label for="zip">Zip-Code:</label>
					<input type="text" id="zip" name="zip" class="form-control" />
					<label for="phone">Phone:</label>
					<input type="text" id="phone" name="phone" class="form-control" />
					<label for="email">Email:</label>
					<input type="text" id="email" name="email" class="form-control" />
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</main>
		<footer>
			<p>&copy;2018 Heiko John, 833099</p>
		</footer>		
	</body>
</html>