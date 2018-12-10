<?php

namespace model;

/**
 * Class Customer
 */
class Customer 
{
	
	public $prename = "";
	public $surname = "";
	public $street = "";
	public $city = "";
	public $zip = "";
	public $phone = "";
	public $email = "";
	
	public function __construct($data) {
		$this->prename = $data[0];
		$this->surname = $data[1];
		$this->street = $data[2];
		$this->city = $data[3];
		$this->zip = $data[4];
		$this->phone = $data[5];
		$this->email = $data[6];
	}
	
	
	
}
