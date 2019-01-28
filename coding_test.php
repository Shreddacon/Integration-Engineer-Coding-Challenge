<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Integration Engineer Coding Challenge</title>
</head>

<body>

<?php

$xml=simplexml_load_file("https://www.senate.gov/general/contact_information/senators_cfm.xml") or die("Error: Cannot create object");

foreach($xml->children() as $contacts) {

	if ($contacts->first_name <> '') {
		$firstName = (string)$contacts->first_name;
		$lastName = (string)$contacts->last_name;
		$full_name = $contacts->first_name." ".$contacts->last_name; 
		$chartId = (string)$contacts->bioguide_id;
		$mobile = (string)$contacts->phone;
		
		$street_len = strrpos($contacts->address, ' ', -12);
		$city_pos = strrpos($contacts->address, ' ', -10) + 1;
		$city_len = strlen($contacts->address) - $street_len - 10;
		$zip_pos = strrpos($contacts->address, ' ');
		$state_pos = strrpos($contacts->address, ' ', -8);	
		
		$street = substr($contacts->address, 0, $street_len);
		$city = substr($contacts->address, $street_len +1 , $city_len);
		$state = substr($contacts->address, $state_pos + 1, 2);
		$zip = substr($contacts->address, $zip_pos + 1, 5);
		
		$addr = array (
			'street' => $street,
			'city' => $city,
			'state' => $state,
			'postal' => $zip
		);
		
		$json_contacts = array (
			'firstName' => $firstName,
			'lastName' => $lastName,
			'fullName' => $full_name,
			'chartId' => $chartId,
			'mobile' => $mobile,
			'address' => $addr
		);
		
		echo json_encode($json_contacts);
	
		echo "<br>";
	}
} 

?> 

</body>
</html>
