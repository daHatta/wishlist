<?php

namespace model;

/**
 * Class Customer
 */
class Customer 
{
	
	protected $prename = "";
	protected $surname = "";
	protected $street = "";
	protected $city = "";
	protected $zip = "";
	protected $phone = "";
	protected $email = "";
	
	public function __construct($prename, $surname, $street, $city, $zip, $phone, $email) {
		$this->prename = $prename;
		$this->surname = $surname;
		$this->street = $street;
		$this->city = $city;
		$this->zip = $zip;
		$this->phone = $phone;
		$this->email = $email;
	}
	
	
	
}
