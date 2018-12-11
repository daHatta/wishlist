<?php
// namespace
namespace model;

/**
 * Class Customer
 * Contains all data set by Customer
 * @author Heiko John, 833099
 */
class Customer 
{
	// Prename (Vorname)
	public $prename = "";
	// Surname (Nachname)
	public $surname = "";
	// Street (Straße)
	public $street = "";
	// City (Stadt)
	public $city = "";
	// Postal Zip Code (Postleitzahl)
	public $zip = "";
	// Phone number (Telefonnummer)
	public $phone = "";
	// Email address (Email-Adresse)
	public $email = "";
	
	/**
	 * Constructor
	 * Gets an array with all data as parameter
	 * @param Array with Strings
	 */
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
?>