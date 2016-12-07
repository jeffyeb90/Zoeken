<?php

 //initialize

 /**
 *@author Jeffrey Takyi-Yeboah

 */
 //Create connection

   //check command
   if(!isset($_REQUEST['cmd'])){
     echo "cmd is not provided";
     exit();
   }
   /*get command*/
   $cmd=$_REQUEST['cmd'];
   switch($cmd){
     case 1:
       sign();		//if cmd=1 the call delete
       break;
     case 2:
       login();	//if cmd=2 the change status
       break;

     default:
       echo "wrong cmd";	//change to json message
       break;
   }

 function sign(){
  if(empty($_REQUEST['email'])){
  echo '{"result":0,"message":"Enter email"}';
  exit();
  }
  if(empty($_REQUEST['name'])){
  echo '{"result":0,"message":"Enter Name"}';
  exit();
  }
  if(empty($_REQUEST['Orgname'])){
  echo '{"result":0,"message":"Enter Organization Name"}';
  exit();
  }
  if(empty($_REQUEST['password'])){
  echo '{"result":0,"message":"Enter password"}';
  exit();
  }
  if(empty($_REQUEST['password_confirmation'])){
  echo '{"result":0,"message":"Confirm password"}';
  exit();
  }
  if(empty($_REQUEST['phonenum'])){
  echo '{"result":0,"message":"Enter phonenumber"}';
  exit();
  }

 //again use ios code to validate fields and use http post request to use these fields
       $name =$_REQUEST['name'];
       $nameOrg =$_REQUEST['Orgname'];
       $email =$_REQUEST['email'];
       $password= $_REQUEST['password'];
       $phonenum= $_REQUEST['phonenum'];
       $confirmPassword= $_REQUEST['password_confirmation'];

     include_once("functions.php");
     //create an object of users
     $obj=new users();
     // call get user method
       $check = $obj->sign($name,$email,$phonenum,$nameOrg,$password,$confirmPassword);
       if($check==true){
          echo' {"result":1,"message":"Sign Up  Successful"}';
             return;
         $sender ="Zoeken";
         $smsmessage = "You have sucesssfully registered to use Zoeken App. Welcome to the world of innovation";
         $smsmessage =str_replace(' ','%20',$smsmessage);
         $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$phonenum&from=$sender&smsc=smsc&text=$smsmessage");
         //session_write_close();
         curl_exec($ch);



       }
      else{
         echo '{"result":0,"message":"Could not sign up user. Try again!"}';
         return;

       }
   }


function login(){
  if(empty($_REQUEST['login'])){
  echo '{"result":0,"message":"Enter username or email"}';
  exit();
  }
  if(empty($_REQUEST['password'])){
  echo '{"result":0,"message":"Enter password"}';
  exit();
  }


$username =$_REQUEST['login'];
$password= $_REQUEST['password'];

include_once("functions.php");
//create an object of users
$obj=new users();
// call get user method

$result=$obj->login($username,$password);

//print_r($result);
if($result==1){
$row = $obj->fetch();
if($row==true){
echo'{"result":1,"message":"Log In Successful"}';
return;
}
else{
echo '{"result":1,"message":"Wrong Credentials. Enter correct username and password"}';
return;
}
}
else{
echo '{"result":0,"message":"Could not log in user. Try again!"}';
return;

}
}








?>
