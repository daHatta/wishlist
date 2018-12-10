<?php

require_once 'view/Templates.php';
require_once 'model/Wish.php';
require_once 'model/Customer.php';

// load header needed only once
require_once 'includes/header.php';

// generate variables for step 1
// wishes : items, errors, messages, correct
for ($i=0; $i < 3; $i++) { 
	$wish[$i] = "";
	$wish_err[$i] = false;
	$wish_err_msg[$i] = "";
	$wish_corr[$i] = false;
}

// variables for step 2 including errors, messages, correct
$prename = $surname = $street = $city = $zip = $phone = $email = "";
$prename_err = $surname_err = $street_err = $city_err = $zip_err = $phone_err = $email_err = false;
$prename_err_msg = $surname_err_msg = $street_err_msg = $city_err_msg = $zip_err_msg = $phone_err_msg = $email_err_msg = false;
$prename_corr = $surname_corr = $street_corr = $city_corr = $zip_corr = $phone_corr = $email_corr = false;

// variable for status of progress
// none -> step 1 -> step 2 -> finish
$step = "";

//Regular Expressions
// only letters, numbers, minus and dot allowed for wishes
$allowed_chars = "/[^a-zA-ZäöüÄÖÜ0-9 \-\.]/";
// only letters, minus and dot allowed for prename, surname and city
$prename_chars = $surname_chars = $city_chars = "/[^a-zA-ZäöüÄÖÜ \-\.]/";
// street formatted as street and no
$street_chars = "/[a-zA-ZäöüÄÖÜ \.]+ [0-9]+[a-zA-Z]?/";
// zip code uses max. 5 numbers and no nonesense codes like 00000 
$zip_chars = "/^([0]{1}[1-9]{1}|[1-9]{1}[0-9]{1})[0-9]{3}$/";
// phone number uses only numbers, plus, "()" and space to get 6 different formats like
//  +49 40 80817-9000 and 0049 (40) 80817-9000
$phone_chars = "/^((((\+|[0]{2})\d{1,4} )(\(?([1-9]{1})([\d]{1,4}\)?)))|(\([1-9]{1}[\d]{1,4}\))|([0]{1}[\d]{1,5}))( [2-9]{1}[\d-?]{2,10})$/";
// check format of email address
$email_chars = "=^([a-zA-Z0-9][\w.-]*)@((?:[a-zA-ZüöäÜÖÄ0-9][\wüöäÜÖÄ.-]*\.)*[a-zA-ZüöäÜÖÄ0-9][\wüöäÜÖÄ._-]*\.[a-zA-Z]{2,}|((\d{1,2}|1\d{2}|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d{2}|2[0-4]\d|25[0-5]))$=";


$form = new view\Templates();


// do something if form-button was clicked
// Request-Method has to be POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//var_dump($_POST);
	
	// variables for step 1: the wishes
	$wish[0] = $_POST["wish01"];
	$wish[1] = $_POST["wish02"];
	$wish[2] = $_POST["wish03"];
	
	// do if POST variable step01 is set by hidden form field
	if (isset($_POST["step01"])) {
		
		// use variable step for status of progress
		$step = $_POST["step01"];
		
		// do if comparison is true
		if ($step == "step01") {
			
			// get size of wish-array
			$wish_len = count($wish);
			
			// use for loop to check wish-items
			for ($w = 0; $w < $wish_len; $w++) {
				
				// if wish 1 not empty
				if (!empty($wish[$w])) {
					// search for chars which are not allowed
					if (preg_match($allowed_chars, $wish[$w])) {
						// do if chars are found
						$wish_err[$w] = true;
						$wish_err_msg[$w] = "Special characters used.";
					} else {
						// everything is correct
						$wish_corr[$w] = true;
					}
				} else {
					/// set variables if wish 1 is empty
					$wish_err[$w] = true;
					$wish_err_msg[$w] = "No entry.";
				}
			}
			
			// deliver form of second step if at least one of the variables is true
			if ($wish_corr[0] == true || $wish_corr[1] == true || $wish_corr[2] == true) {
				
				// form of second step
				$form->customerView($wish);
								
			} else {
				
				// deliver form if all wish-items are empty or incorrect
				$form->wishesView($wish, $wish_err_msg);
			}
			
		}
	}
	
	// do if POST variable step02 is set by hidden form field
	if (isset($_POST["step02"])) {
		
		// variables for step 2: the address
		$prename = $_POST["prename"];
		$surname = $_POST["surname"];
		$street = $_POST["street"];
		$city = $_POST["city"];
		$zip = $_POST["zip"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		
		// use variable step for status of progress
		$step = $_POST["step02"];
		
		// do if comparison is true
		if ($step == "step02") {
			
			// true because field is not empty
			if (!empty($prename)) {
				// search for chars which are not allowed
				if (preg_match($prename_chars, $prename)) {
					// chars not allowed
					$prename_err = true;
					$prename_err_msg = "Unusual characters used.";
				} else {
					// chars and format are correct
					$prename_corr = true;
				}
			} else {
				// false because field is empty
				$prename_err = true;
				$prename_err_msg = "Prename is required.";
			}
			
			// true because field is not empty
			if (!empty($surname)) {
				// search for chars which are not allowed
				if (preg_match($surname_chars, $surname)) {
					// chars not allowed
					$surname_err = true;
					$surname_err_msg = "Unusual characters used.";
				} else {
					// chars and format are correct
					$surname_corr = true;
				}
			} else {
				// false because field is empty
				$surname_err = true;
				$surname_err_msg = "Surname is required.";
			}
			
			// true because field is not empty
			if (!empty($street)) {
				// check if chars and format are correct
				if (!preg_match($street_chars, $street)) {
					// chars and/or format are not correct
					$street_err = true;
					$street_err_msg = "Unusual characters or none requested format used.";
				} else {
					// chars and format are correct
					$street_corr = true;
				}
			} else {
				// false because field is empty
				$street_err = true;
				$street_err_msg = "Street is required.";
			}
			
			// true because field is not empty
			if (!empty($city)) {
				// search for chars which are not allowed
				if (preg_match($city_chars, $city)) {
					// chars not allowed
					$city_err = true;
					$city_err_msg = "Unusual characters used.";
				} else {
					// chars and format are correct
					$city_corr = true;
				}
			} else {
				// false because field is empty
				$city_err = true;
				$city_err_msg = "City is required.";
			}
			
			// true because field is not empty
			if (!empty($zip)) {
				// check if chars and format are correct
				if (!preg_match($zip_chars, $zip)) {
					// chars and/or format are not correct
					$zip_err = true;
					$zip_err_msg = "Unusual characters or none requested format used.";
				} else {
					// chars and format are correct
					$zip_corr = true;
				}
			} else {
				// false because field is empty
				$zip_err = true;
				$zip_err_msg = "Zip is required.";
			}
			
			// true because field is not empty
			if (!empty($phone)) {
				// check if chars and format are correct
				if (!preg_match($phone_chars, $phone)) {
					// chars and/or format are not correct
					$phone_err = true;
					$phone_err_msg = "Unusual characters or none requested format used.";
				} else {
					// chars and format are correct
					$phone_corr = true;
				}
			} else {
				// false because field is empty
				$phone_err = true;
				$phone_err_msg = "Phonenumber is required.";
			}
			
			// true because field is not empty
			if (!empty($email)) {
				// check if chars and format are correct
				if (!preg_match($email_chars, $email)) {
					// chars and/or format are not correct
					$email_err = true;
					$email_err_msg = "Unusual characters or none requested format used.";
				} else {
					// chars and format are correct
					$email_corr = true;
				}
			} else {
				// false because field is empty
				$email_err = true;
				$email_err_msg = "Email-address is required.";
			}
			
			// deliver answer (step 3) if all variables are true
			if ($prename_corr == true && $surname_corr == true && $street_corr == true && $city_corr == true && $zip_corr == true && $phone_corr == true && $email_corr == true) {
				
				// show pre- and surname and all wish-items
				echo "<p><strong>Hello {$prename} {$surname}, thanks for your request</strong></p>";
				echo "<p>Your wishes are: {$wish[0]}, {$wish[1]}, {$wish[2]}</p>";				
				echo "<p>We will contact you soon.</p>";
					
			} else {
				
				$customer = array($prename, $surname, $street, $city, $zip, $phone, $email);
				$error = array($prename_err_msg, $surname_err_msg, $street_err_msg, $city_err_msg, $zip_err_msg, $phone_err_msg, $email_err_msg);
				
				// deliver form of step 2 again if address-items are empty or incorrect
				$form->customerView($wish, $customer, $error);
				
			}
			
		}
	}
	
} else {
	
	// load starting formular, if form-button wasn't pressed
	$form->defaultView();
}

// load footer needed only once
require_once 'includes/footer.php';
?>