<?php
// namespace
namespace view;

// use classes from different namespaces
use model\Wish;
use model\Customer;

/**
 * Class Templates
 * Keeps all methods to generate specific views
 * @author Heiko John, 833099
 */
class Templates
{
	
	// properties to build specific form items
	private $label, $type, $class, $wish, $placeholder;
	
	// constructor
	public function __construct()
	{
		
	}
	
	// Form items
	
	/**
	 * Method addInputWithLabel(5 parameter)
	 * Generates a text input-field with a label-tag above
	 * Parameter are used as values of html-tags and attributes 
	 * @param wish - String for attributes for, id and name
	 * @param value - String for attribute value preset as empty
	 * @param class - String for attribute class
	 * @param label - String for content of label
	 * @param placerholder - String for attribute placeholder
	 */
	public function addInputWithLabel($wish, $value="", $class, $label, $placeholder)
	{
		// set first letter of label uppercase
		$label = ucfirst($label);
		
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" />";
	}
	
	/**
	 * Method addInputWithLabelAndError(6 parameter)
	 * Generates a text input-field with a label-Tag above and a error div-container below
	 * Parameter are used as values of html-tags and attributes 
	 * @param wish - String for attributes for, id and name
	 * @param value - String for attribute value
	 * @param class - String for attribute class
	 * @param label - String for content of label
	 * @param placerholder - String for attribute placeholder
	 * @param error_msg - String used as error-message
	 */
	public function addInputWithLabelAndError($wish, $value, $class, $label, $placeholder, $error_msg)
	{
		// set first letter of label uppercase
		$label = ucfirst($label);
		
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" />";
		echo "<div class=\"error\">{$error_msg}</div>";
	}
	
	/**
	 * Method addInputWithLabelReadonly(5 parameter)
	 * Generates a readonly text input-field with a label-tag above
	 * Parameter are used as values of html-tags and attributes 
	 * @param wish - String for attributes for, id and name
	 * @param value - String for attribute value preset as empty
	 * @param class - String for attribute class
	 * @param label - String for content of label
	 * @param placerholder - String for attribute placeholder
	 */
	public function addInputWithLabelReadonly($wish, $value="", $class, $label, $placeholder)
	{
		// set first letter of label uppercase
		$label = ucfirst($label);
			
		echo "<label for=\"{$wish}\">{$label}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"{$placeholder}\" readonly />";
	}
	
	/**
	 * Method addHidden(2 parameter)
	 * Generates a hidden input-field
	 * Parameter are used as values of attributes 
	 * @param name - String for attribute name
	 * @param value - String for attribute value
	 */
	public function addHidden($name, $value)
	{
		echo "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\" />";
	}
	
	/**
	 * Method addButton(3 parameter)
	 * Generates a form button
	 * Parameter are used as values of html-tags and attributes 
	 * @param type - String for attribute type
	 * @param class - String for attribute class
	 * @param label - String for content of button
	 */
	public function addButton($type, $class, $label)
	{
		echo "<button type=\"{$type}\" class=\"{$class}\">{$label}</button>";	
	}
	
	// Views
	
	/**
	 * Method defaultView()
	 * Generates default view for initial entrance of the wishlist project
	 * A form with 3 input-fields, a hidden field and a submit Button 
	 * User can start to fillin his wishes
	 */
	public function defaultView()
	{
		// start form
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		// three text input-fields 
		$this->addInputWithLabel("wish01", "", "form-control", "Wish #1", "Your wish #1");
		$this->addInputWithLabel("wish02", "", "form-control", "Wish #2", "Your wish #2");
		$this->addInputWithLabel("wish03", "", "form-control", "Wish #3", "Your wish #3");
		
		// a hidden field
		$this->addHidden("step01", "step01");
		
		echo "</div>";
		
		// a submit button
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		// end form
		echo "</form>";
	}
	
	/**
	 * Method wishesView(2 parameter)
	 * Generates form for wishes with error feedback after user hit submit button
	 * A form with 3 input-fields, occuring error messages, a hidden field and a submit Button
	 * User can correct his false inputs
	 * @param wishes - Array with Strings
	 * @param error_msgs - Array with Strings
	 */
	public function wishesView($wishes, $error_msgs)
	{
		// start form
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		$placeholder = "";
		
		// using parameter arrays to generate input-fields
		for ($i=0; $i < count($wishes); $i++) {
			
			// instance of Wish
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
			$j = $i+1;
			$label = "Wish #" . $j;
			$placeholder = "Your wish #" . $j;
			
			// use method to create text input-field with error feedback
			$this->addInputWithLabelAndError("wish0{$j}", $w[$i], "form-control", $label, $placeholder, $error_msgs[$i]);

		}
		
		// a hidden field
		$this->addHidden("step01", "step01");
		
		echo "</div>";
		
		// a submit button
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		// end form
		echo "</form>";
	}
	
	/**
	 * Method customerView(3 parameter)
	 * Generates form for customer data before user hit "contact us" button
	 * A form with 7 input-fields, a hidden field and a submit Button
	 * User can enter his/her contact data
	 * Generates form for customer data with error feedback after user hit "contact us" button
	 * A form with 7 input-fields, occuring error messages, a hidden field and a submit Button
	 * User can correct his/her false inputs
	 * @param wishes - Array with Strings
	 * @param customer - Array with Strings (NULL if empty)
	 * @param error_msgs - Array with Strings (NULL if empty)
	 */
	public function customerView($wishes, $customer = NULL, $error_msgs = NULL)
	{
		// start form
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		// using parameter arrays to generate input-fields
		for ($i=0; $i < count($wishes); $i++) {
			
			// instance of Wish
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
			$j = $i+1;
			$label = "Wish #" . $j;
			$placeholder = "Your wish #" . $j;
			
			// use method to create text input-field as readonly
			$this->addInputWithLabelReadonly("wish0{$j}", $w[$i], "form-control", $label, $placeholder);

		}
		
		echo "</div>";
		echo "<div class=\"form-group\">";
		
		if ($customer == NULL && $error_msgs == NULL) {
			
			// generate costumer view before user hit "contact us" button
			$this->addInputWithLabel("prename", "", "form-control", "prename", "Your prename");
			$this->addInputWithLabel("surname", "", "form-control", "surname", "Your surname");
			$this->addInputWithLabel("street", "", "form-control", "street", "Your street and number");
			$this->addInputWithLabel("city", "", "form-control", "city", "Your city");
			$this->addInputWithLabel("zip", "", "form-control", "zip code", "Your zip code");
			$this->addInputWithLabel("phone", "", "form-control", "phone", "Your phone number");
			$this->addInputWithLabel("email", "", "form-control", "email", "Your email address");
			
		} else {
			
			// instance of Customer filled with data
			$c_data = new Customer($customer);
			
			// generate costumer view after user hit "contact us" button and errors appeared
			$this->addInputWithLabelAndError("prename", $c_data->prename, "form-control", "prename", "Your prename", $error_msgs[0]);
			$this->addInputWithLabelAndError("surname", $c_data->surname, "form-control", "surname", "Your surname", $error_msgs[1]);
			$this->addInputWithLabelAndError("street", $c_data->street, "form-control", "street", "Your street and number", $error_msgs[2]);
			$this->addInputWithLabelAndError("city", $c_data->city, "form-control", "city", "Your city", $error_msgs[3]);
			$this->addInputWithLabelAndError("zip", $c_data->zip, "form-control", "zip", "Your zip", $error_msgs[4]);
			$this->addInputWithLabelAndError("phone", $c_data->phone, "form-control", "phone", "Your phone number", $error_msgs[5]);
			$this->addInputWithLabelAndError("email", $c_data->email, "form-control", "email", "Your email address", $error_msgs[6]);
			
		}
		
		// a hidden field
		$this->addHidden("step02", "step02");
	
		echo "</div>";
		
		// a submit button
		$this->addButton("submit", "btn btn-primary", "Contact Us");
		
		// end form
		echo "</form>";
	}
	
	/**
	 * Method finalView(2 parameter)
	 * Generates final view after all data were set correctly
	 * Greets user mentioning prename and surname and shows wishes  
	 * @param wishes - Array with Strings
	 * @param customer - Array with Strings
	 */
	public function finalView($wishes, $customer) {
		
		// instance of Customer filled with data
		$c_final = new Customer($customer);
		
		// generating wishes by using instances of Wish
		for ($i=0; $i < count($wishes); $i++) {
			
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
		
		}
		
		// greet user
		echo "<p><strong>Hello {$c_final->prename} {$c_final->surname}, thanks for your request.</strong></p>";
		echo "<p>Your wish(es) are: <strong>";
		
		// show wishes in correct order with or without comma or point
		// first wish
		if (!empty($w[0])) {
			if (empty($w[1])) {
				if (empty($w[2])) {
					echo "{$w[0]}.";
				}	
			} else {
				echo "{$w[0]}, ";	
			}
		}
		
		// second wish
		if (!empty($w[1])) {
			if (empty($w[2])) {
				echo "{$w[1]}.";
			} else {
				echo "{$w[1]}, ";	
			}
		}
		
		// third wish
		if (!empty($w[2])) {
			echo "{$w[2]}.";
		}
		
		echo "<strong></p>";
		echo "<p>We will contact you soon.</p>";
	}
}
?>