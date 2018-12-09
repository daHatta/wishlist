<?php

namespace view;

use model\Wish;
use model\Customer;

/**
 * Class Templates
 */
class Templates
{
	
	private $type, $class, $label, $wish, $no;	
	
	public function __construct()
	{
		
	}
	
	public function addInputWithLabel($wish, $value="", $class, $no)
	{
		echo "<label for=\"{$wish}\">Wish #{$no}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"Your wish #{$no}\" />";
	}
	
	public function addInputWithLabelAndError($wish, $value, $class, $no, $error_msg)
	{
		echo "<label for=\"{$wish}\">Wish #{$no}:</label>";
		echo "<input type=\"text\" id=\"{$wish}\" name=\"{$wish}\" value=\"{$value}\" class=\"{$class}\" placeholder=\"Your wish #{$no}\" />";
		echo "<div class=\"error\">{$error_msg}</div>";
	}
	
	public function addHidden($type, $name, $value)
	{
		echo "<input type=\"{$type}\" name=\"{$name}\" value=\"{$value}\" />";
	}
	
	public function addButton($type, $class, $label)
	{
		echo "<button type=\"{$type}\" class=\"{$class}\">{$label}</button>";	
	}
	
	
	public function defaultView()
	{
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		$this->addInputWithLabel("wish01", "", "form-control", "1");
		$this->addInputWithLabel("wish02", "", "form-control", "2");
		$this->addInputWithLabel("wish03", "", "form-control", "3");
		$this->addHidden("hidden", "step01", "step01");
		
		echo "</div>";
		
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		echo "</form>";
	}
	
	public function wishesView($wishes, $error_msgs)
	{
		
		echo "<form method=\"post\" action=\"index.php\">";
		echo "<div class=\"form-group\">";
		
		for ($i=0; $i < count($wishes); $i++) {
			
			$wishItem[$i] = new Wish();
			$wishItem[$i]->setWish($wishes[$i]);
			$w[$i] = $wishItem[$i]->getWish();
			$j = $i+1;
			
			$this->addInputWithLabelAndError("wish0{$j}", $w[$i], "form-control", $i+1, $error_msgs[$i]);

		}
		
		$this->addHidden("hidden", "step01", "step01");
		
		echo "</div>";
		
		$this->addButton("submit", "btn btn-primary", "Submit");
		
		echo "</form>";
	}
	
	
}
?>