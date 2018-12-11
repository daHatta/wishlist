<?php
// namespace
namespace model;

/**
 * Class Wish
 * Wishes set by Customers in the wishlist
 * @author Heiko John, 833099
 */
class Wish
{
	// a wish
	protected $wish = "";
	
	// constructor
	public function __construct() {
		
	}
	
	/**
	 * Method setWish(parameter)
	 * Sets content of property $wish
	 * @param String 
	 */
	public function setWish($wish)
	{
		$this->wish = $wish;
	}
	
	/**
	 * Method getWish()
	 * Returns content of the property $wish
	 * @return String
	 */
	public function getWish()
	{
		return $this->wish;
	}	
}
?>