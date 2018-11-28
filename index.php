<?php 

require_once 'includes/header.php';

for ($i=0; $i < 3; $i++) { 
	$wish[$i] = "";
	$wish_err[$i] = false;
	$wish_err_msg[$i] = "";
	$wish_corr[$i] = false;
}

$prename = $surname = $street = $city = $zip = $phone = $email = "";
$prename_err = $surname_err = $street_err = $city_err = $zip_err = $phone_err = $email_err = false;
$prename_err_msg = $surname_err_msg = $street_err_msg = $city_err_msg = $zip_err_msg = $phone_err_msg = $email_err_msg = false;
$prename_corr = $surname_corr = $street_corr = $city_corr = $zip_corr = $phone_corr = $email_corr = false;

$step = "";

//Regular Expressions
$allowed_chars = "/[^a-zA-Z0-9- ]/";
$prename_chars = $surname_chars = $city_chars = "/^[a-zA-ZäöüÄÖÜ \-]*$/";
$street_chars = "/[a-zA-ZäöüÄÖÜ \.]+ [0-9]+[a-zA-Z]?/";
$plz_chars = "/^[0-9]{5}$/";
$phone_chars = "/^[0-9 \(\)\/\-\+]*$/";
$email_chars = "/\A[^@]+@[^@]+\z/";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	
	var_dump($_POST);
	
	if (isset($_POST["step01"])) {
		
		$wish[0] = $_POST["wish01"];
		$wish[1] = $_POST["wish02"];
		$wish[2] = $_POST["wish03"];
		
		$step = $_POST["step01"];
		
		if ($step == "step01") {
			
			if (!empty($wish[0])) {
			
				if (preg_match($allowed_chars, $wish[0])) {
					$wish_err[0] = true;
					$wish_err_msg[0] = "Special characters used.";
				} else {
					$wish_corr[0] = true;
				}
			} else {
				$wish_err[0] = true;
				$wish_err_msg[0] = "No entry.";
			}
			
			if (!empty($wish[1])) {
				
				if (preg_match($allowed_chars, $wish[1])) {
					$wish_err[1] = true;
					$wish_err_msg[1] = "Special characters used.";
				} else {
					$wish_corr[1] = true;
				}
			} else {
				$wish_err[1] = true;
				$wish_err_msg[1] = "No entry.";
			}
			
			if (!empty($wish[2])) {
				
				if (preg_match($allowed_chars, $wish[2])) {
					$wish_err[2] = true;
					$wish_err_msg[2] = "Special characters used.";
				} else {
					$wish_corr[2] = true;
				}
			} else {
				$wish_err[2] = true;
				$wish_err_msg[2] = "No entry.";
			}
		}
	}

	
	if (isset($_POST["step02"])) {
		
		$prename = $_POST["prename"];
		$name = $_POST["name"];
		$street = $_POST["street"];
		$city = $_POST["city"];
		$zip = $_POST["zip"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		
		$step = $_POST["step02"];
		
		if ($step == "step02") {
			
			if (!empty($prename)) {
			
				if (preg_match($prename_chars, $prename)) {
					$prename_err = true;
					$prename_err_msg = "Unusual characters used.";
				} else {
					$prename_corr = true;
				}
			} else {
				$prename_err = true;
				$prename_err_msg = "Prename required.";
			}
			
			if (!empty($surname)) {
			
				if (preg_match($surname_chars, $surname)) {
					$surname_err = true;
					$surname_err_msg = "Unusual characters used.";
				} else {
					$surname_corr = true;
				}
			} else {
				$surname_err = true;
				$surname_err_msg = "Surname required.";
			}
			
			if (!empty($street)) {
			
				if (preg_match($street_chars, $street)) {
					$street_err = true;
					$street_err_msg = "Unusual characters used.";
				} else {
					$street_corr = true;
				}
			} else {
				$street_err = true;
				$street_err_msg = "Street required.";
			}
			
			var_dump($_POST);
		}
	}
	
	if ($wish_corr[0] == false && $wish_corr[1] == false && $wish_corr[2] == false) {
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		echo "<label for=\"wish01\">Wish No. 1:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish01\" value=\"{$wish[0]}\" class=\"form-control\" />";
		echo "<div class=\"error\">{$wish_err_msg[0]}</div>";
		echo "<label for=\"wish02\">Wish No. 2:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish02\" value=\"{$wish[1]}\" class=\"form-control\" />";
		echo "<div class=\"error\">{$wish_err_msg[1]}</div>";
		echo "<label for=\"wish03\">Wish No. 3:</label>";
		echo "<input type=\"text\" id=\"wish03\" name=\"wish03\" value=\"{$wish[2]}\" class=\"form-control\" />";
		echo "<div class=\"error\">{$wish_err_msg[2]}</div>";
		echo "<input type=\"hidden\" name=\"step01\" value=\"step01\" />";
		echo "</div>";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
		echo "</form>";
		
	} 
	
	if ($wish_corr[0] == true || $wish_corr[1] == true || $wish_corr[2] == true) {
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		echo "<label for=\"wish01\">Wish No. 1:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish01\" value=\"{$wish[0]}\" class=\"form-control\" readonly />";
		echo "<div class=\"error\">{$wish_err_msg[0]}</div>";
		echo "<label for=\"wish02\">Wish No. 2:</label>";
		echo "<input type=\"text\" id=\"wish01\" name=\"wish02\" value=\"{$wish[1]}\" class=\"form-control\" readonly />";
		echo "<div class=\"error\">{$wish_err_msg[1]}</div>";
		echo "<label for=\"wish03\">Wish No. 3:</label>";
		echo "<input type=\"text\" id=\"wish03\" name=\"wish03\" value=\"{$wish[2]}\" class=\"form-control\" readonly />";
		echo "<div class=\"error\">{$wish_err_msg[2]}</div>";
		echo "</div>";
		echo "<div class=\"form-group\">";
		echo "<label for=\"prename\">Prename:</label>";
		echo "<input type=\"text\" id=\"prename\" name=\"prename\" class=\"form-control\" />";
		echo "<label for=\"name\">Name:</label>";
		echo "<input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" />";
		echo "<label for=\"street\">Street:</label>";
		echo "<input type=\"text\" id=\"street\" name=\"street\" class=\"form-control\" />";
		echo "<label for=\"city\">City:</label>";
		echo "<input type=\"text\" id=\"city\" name=\"city\" class=\"form-control\" />";
		echo "<label for=\"zip\">Zip:</label>";
		echo "<input type=\"text\" id=\"zip\" name=\"zip\" class=\"form-control\" />";
		echo "<label for=\"phone\">Phone:</label>";
		echo "<input type=\"text\" id=\"phone\" name=\"phone\" class=\"form-control\" />";
		echo "<label for=\"email\">Email:</label>";
		echo "<input type=\"text\" id=\"email\" name=\"email\" class=\"form-control\" />";
		echo "<input type=\"hidden\" name=\"step02\" value=\"step02\" />";
		echo "</div>";
		echo "<button type=\"submit\" class=\"btn btn-primary\">Contact Us</button>";
		echo "</form>";
		
	}
	
} else {
	
	echo "<form method=\"post\" action=\"index.php\">";
	echo "<div class=\"form-group\">";
	echo "<label for=\"wish01\">Wish No. 1:</label>";
	echo "<input type=\"text\" id=\"wish01\" name=\"wish01\" value=\"{$wish[0]}\" class=\"form-control\" />";
	echo "<div class=\"error\">{$wish_err_msg[0]}</div>";
	echo "<label for=\"wish02\">Wish No. 2:</label>";
	echo "<input type=\"text\" id=\"wish01\" name=\"wish02\" value=\"{$wish[1]}\" class=\"form-control\" />";
	echo "<div class=\"error\">{$wish_err_msg[1]}</div>";
	echo "<label for=\"wish03\">Wish No. 3:</label>";
	echo "<input type=\"text\" id=\"wish03\" name=\"wish03\" value=\"{$wish[2]}\" class=\"form-control\" />";
	echo "<div class=\"error\">{$wish_err_msg[2]}</div>";
	echo "<input type=\"hidden\" name=\"step01\" value=\"step01\" />";
	echo "</div>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
	echo "</form>";
	
}

require_once 'includes/footer.php';
?>