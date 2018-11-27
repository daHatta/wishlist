<?php 

require_once 'includes/header.php';

for ($i=0; $i < 3; $i++) { 
	$wish[$i] = "";
	$wish_err[$i] = false;
	$wish_err_msg[$i] = "";
	$wish_corr[$i] = false;
}

$prename = $surname = $street = $city = $zip = $phone = $email = "";

$step = "";

//Regular Expressions
$allowed_chars = "/[^A-Za-z0-9- ]/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$wish[0] = $_POST["wish01"];
	$wish[1] = $_POST["wish02"];
	$wish[2] = $_POST["wish03"];
	
	$step = $_POST["step01"];
	
	if (isset($_POST["step01"]) && $step == "step01") {
		
		if (!empty($wish[0])) {
			
			if (preg_match($allowed_chars, $wish[0])) {
				$wish_err[0] = true;
				$wish_err_msg[0] = "Special characters used.";
				echo $wish_err_msg[0];
			} else {
				echo $wish[0];
				$wish_corr[0] = true;
			}
		} else {
			$wish_err[0] = true;
			$wish_err_msg[0] = "No entry.";
			echo $wish_err_msg[0];
		}
		
		if (!empty($wish[1])) {
			
			if (preg_match($allowed_chars, $wish[1])) {
				$wish_err[1] = true;
				$wish_err_msg[1] = "Special characters used.";
				echo $wish_err_msg[1];
			} else {
				echo $wish[1];
				$wish_corr[1] = true;
			}
		} else {
			$wish_err[1] = true;
			$wish_err_msg[1] = "No entry.";
			echo $wish_err_msg[1];
		}
		
		if (!empty($wish[2])) {
			
			if (preg_match($allowed_chars, $wish[2])) {
				$wish_err[2] = true;
				$wish_err_msg[2] = "Special characters used.";
				echo $wish_err_msg[2];
			} else {
				echo $wish[2];
				$wish_corr[2] = true;
			}
		} else {
			$wish_err[2] = true;
			$wish_err_msg[2] = "No entry.";
			echo $wish_err_msg[2];
		}
	}

	if ($wish_corr[0]==true || $wish_corr[1]==true || $wish_corr[2]==true) {
		
		echo "<form method=\"post\" action=\" \">";
		echo "<div class=\"form-group\">";
		echo "<label for=\"wish01\">Wish No. 1:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish01\" value=\"{$wish[0]}\" class=\"form-control\" readonly />";
		echo "<label for=\"wish02\">Wish No. 2:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish02\" value=\"{$wish[1]}\" class=\"form-control\" readonly />";
		echo "<label for=\"wish03\">Wish No. 3:</label>";
		echo "<input type=\"text\" id=\"wish03\" name=\"wish03\" value=\"{$wish[2]}\" class=\"form-control\" readonly />";
		echo "</form>";
		
	}

}

?>



			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group">
					<label for="wish01">Wish No. 1:</label>
					<input type="text" id="wish01" name="wish01" class="form-control" />
					<label for="wish02">Wish No. 2:</label>
					<input type="text" id="wish02" name="wish02" class="form-control" />
					<label for="wish03">Wish No. 3:</label>
					<input type="text" id="wish03" name="wish03" class="form-control" />
					<input type="hidden" name="step01" value="step01" />
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<!--
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
			-->
<?php require_once 'includes/footer.php'; ?>