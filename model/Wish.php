<?php

namespace model;

/**
 * Class Wish
 */
class Wish
{
	protected $wish = "";
	
	public function __construct() {
		
	}
	
	public function setWish($wish)
	{
		$this->wish = $wish;
	}
	
	public function getWish()
	{
		return $this->wish;
	}
	
}

?>