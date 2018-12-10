<?php

namespace view;

use model\Wish;
use model\Customer;

/**
 * Class Templates
 */
class Templates
{
	
	private $label, $type, $class, $wish, $placeholder;
	
	public function __construct()
	{
		
	}
	
	public function addInputWithLabel($wish, $value="", $class, $label, $placeholder)
	{
		$label = ucfirst($label);
			
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" />";
	}
	
	public function addInputWithLabelAndError($wish, $value, $class, $label, $placeholder, $error_msg)
	{
		$label = ucfirst($label);
		
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" />";
		echo "<div class=\"error\">{$error_msg}</div>";
	}
	
	public function addInputWithLabelReadonly($wish, $value="", $class, $label, $placeholder)
	{
		$label = ucfirst($label);
			
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" readonly />";
	}
	
	public function addHidden($name, $value)
	{
		echo "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\" />";
	}
	
	public function addButton($type, $class, $label)
	{
		echo "<button type=\"{$type}\" class=\"{$class}\">{$label}</button>";	
	}
	
	
	public function defaultView()
	{
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		$this->addInputWithLabel("wish01", "", "form-control", "Wish #1", "Your wish #1");
		$this->addInputWithLabel("wish02", "", "form-control", "Wish #2", "Your wish #2");
		$this->addInputWithLabel("wish03", "", "form-control", "Wish #3", "Your wish #3");
		$this->addHidden("step01", "step01");
		
		echo "</div>";
		
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		echo "</form>";
	}
	
	public function wishesView($wishes, $error_msgs)
	{
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		$placeholder = "";
		
		for ($i=0; $i < count($wishes); $i++) {
			
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
			$j = $i+1;
			$label = "Wish #" . $j;
			$placeholder = "Your wish #" . $j;
			
			$this->addInputWithLabelAndError("wish0{$j}", $w[$i], "form-control", $label, $placeholder, $error_msgs[$i]);

		}
		
		$this->addHidden("step01", "step01");
		
		echo "</div>";
		
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		echo "</form>";
	}
	
	public function customerView($wishes, $customer = NULL, $error_msgs=NULL)
	{
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		for ($i=0; $i < count($wishes); $i++) {
			
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
			$j = $i+1;
			$label = "Wish #" . $j;
			$placeholder = "Your wish #" . $j;
			
			$this->addInputWithLabelReadonly("wish0{$j}", $w[$i], "form-control", $label, $placeholder);

		}
		
		echo "</div>";
		echo "<div class=\"form-group\">";
		
		if ($customer == NULL && $error_msgs == NULL) {
			
			$this->addInputWithLabel("prename", "", "form-control", "prename", "Your prename");
			$this->addInputWithLabel("surname", "", "form-control", "surname", "Your surname");
			$this->addInputWithLabel("street", "", "form-control", "street", "Your street and number");
			$this->addInputWithLabel("city", "", "form-control", "city", "Your city");
			$this->addInputWithLabel("zip", "", "form-control", "zip code", "Your zip code");
			$this->addInputWithLabel("phone", "", "form-control", "phone", "Your phone number");
			$this->addInputWithLabel("email", "", "form-control", "email", "Your email address");
			
		} else {
			
			$c_data = new Customer($customer);
			
			$this->addInputWithLabelAndError("prename", $c_data->prename, "form-control", "prename", "Your prename", $error_msgs[0]);
			$this->addInputWithLabelAndError("surname", $c_data->surname, "form-control", "surname", "Your surname", $error_msgs[1]);
			$this->addInputWithLabelAndError("street", $c_data->street, "form-control", "street", "Your street and number", $error_msgs[2]);
			$this->addInputWithLabelAndError("city", $c_data->city, "form-control", "city", "Your city", $error_msgs[3]);
			$this->addInputWithLabelAndError("zip", $c_data->zip, "form-control", "zip", "Your zip", $error_msgs[4]);
			$this->addInputWithLabelAndError("phone", $c_data->phone, "form-control", "phone", "Your phone number", $error_msgs[5]);
			$this->addInputWithLabelAndError("email", $c_data->email, "form-control", "email", "Your email address", $error_msgs[6]);
			
		}
		
		$this->addHidden("step02", "step02");
	
		echo "</div>";
		
		$this->addButton("submit", "btn btn-primary", "Contact Us");
		
		echo "</form>";
		
	}

	public function finalView($wishes, $customer) {
				
		$c_final = new Customer($customer);
		
		for ($i=0; $i < count($wishes); $i++) {
			
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
		
		}
		
		echo "<p><strong>Hello {$c_final->prename} {$c_final->surname}, thanks for your request.</strong></p>";
		echo "<p>Your wishes are: <strong>";
		
		if (!empty($w[0])) {
			if (empty($w[1])) {
				if (empty($w[2])) {
					echo "{$w[0]}.";
				}	
			} else {
				echo "{$w[0]}, ";	
			}
		}
		
		if (!empty($w[1])) {
			if (empty($w[2])) {
				echo "{$w[1]}.";
			} else {
				echo "{$w[1]}, ";	
			}
		}
		
		if (!empty($w[2])) {
			echo "{$w[2]}.";
		}
		
		echo "<strong></p>";
		echo "<p>We will contact you soon.</p>";
		
	}

}
?>