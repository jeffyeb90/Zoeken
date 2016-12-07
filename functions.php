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
}
?>
