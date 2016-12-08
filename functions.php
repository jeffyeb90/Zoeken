<?php
/**
*/
include_once("adb.php");
/**
*Users  class
*/
class users extends adb{
	function users(){
	}
function sign($name,$email,$phonenum,$nameOrg,$password,$confirmPassword){


	$str="Insert into users set name='$name',email='$email',passwordConfirmed='$confirmPassword',password='$password',OrganizationName='$nameOrg', phoneNumber='$phonenum'";
		return $this->query($str);

}
function checkUsername($email){

	$str="select * from users where  email = '$email'";

		return $this->query($str);

}
function login($email,$password){
	/**
	*@var string $strQuery should contain insert query
	*/
	$strQuery="SELECT * FROM `users` WHERE `password` LIKE '$password' AND `email` LIKE '$email'";
	return $this->query($strQuery);
}
function alogin($email,$password){
	/**
	*@var string $strQuery should contain insert query
	*/
	$strQuery="SELECT * FROM `adminLogins` WHERE `password` LIKE '$password' AND `email` LIKE '$email'";
	return $this->query($strQuery);
}
function sendRequest($req,$bankName,$clientN,$accN,$date){


	$str="Insert into request set type_request='$req',Org_name='$bankName',client_name='$clientN',accountNum='$accN',date='$date'";
		return $this->query($str);

}

function sendFoodRequest($food_type,$customerN,$restaurantN,$accN,$amount){


	$str="Insert into foodRequest set food_type='$food_type',customer_name='$customerN',restaurant_name='$restaurantN',acc_num='$accN',amount='$amount'";
		return $this->query($str);

}
function adminLogin($email,$password){
	/**
	*@var string $strQuery should contain insert query
	*/
	$strQuery="SELECT * FROM `adminLogin` WHERE `password` LIKE '$password' AND `email` LIKE '$email'";
	return $this->query($strQuery);
}
function viewUsers(){
	$str= "Select name,email,phoneNumber,organizationName from users";
	return $this->query($str);
}
function viewBankRequests(){
	$str= "Select type_request,Org_name,client_name,date,accountNum from request";
	return $this->query($str);
}
function viewFoodRequests(){
	$str= "Select food_type,customer_name,restaurant_name,acc_num,amount from foodRequest";
	return $this->query($str);
}
}
?>
