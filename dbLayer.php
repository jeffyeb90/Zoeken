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
      case 3:
         sendRequest();	//if cmd=2 the change status
         break;
     case 4:
    sendFoodRequest();
     break;
     case 5:
    viewUsers();
     break;
     case 6:
    viewBankRequest();
     break;
     case 7:
    viewFoodRequest();
     break;
     case 8:
    adminLogin();
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


         $sender ="Zoeken";
         $smsmessage = "You have sucesssfully registered to use Zoeken App. Welcome to the world of innovation";
         $smsmessage =str_replace(' ','%20',$smsmessage);
         $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$phonenum&from=$sender&smsc=smsc&text=$smsmessage");
         //session_write_close();
         echo' {"result":1,"message":"User signed up Successfully';

          $response= curl_exec($ch);
        echo  '"}';

   return;

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
echo '{"result":0,"message":"Wrong Credentials. Enter correct username and password"}';
return;
}
}
else{
echo '{"result":0,"message":"Could not log in user. Try again!"}';
return;

}
}


function sendRequest(){
 if(empty($_REQUEST['requestType'])){
 echo '{"result":0,"message":"Enter requestType"}';
 exit();
 }
 if(empty($_REQUEST['bankName'])){
 echo '{"result":0,"message":"Enter Bank Name"}';
 exit();
 }
 if(empty($_REQUEST['client_name'])){
 echo '{"result":0,"message":"Enter Client Name"}';
 exit();
 }
 if(empty($_REQUEST['accNum'])){
 echo '{"result":0,"message":"Enter Account Number"}';
 exit();
 }
 if(empty($_REQUEST['date'])){
 echo '{"result":0,"message":"Enter Date"}';
 exit();
 }


//again use ios code to validate fields and use http post request to use these fields
      $req =$_REQUEST['requestType'];
      $bankName =$_REQUEST['bankName'];
      $clientN =$_REQUEST['client_name'];
      $accN= $_REQUEST['accNum'];
      $date= $_REQUEST['date'];


    include_once("functions.php");
    //create an object of users
    $obj=new users();
    // call get user method
      $check = $obj->sendRequest($req,$bankName,$clientN,$accN,$date);
      if($check==true){
        $sender ="Zoeken";
        $smsmessage = "Request made. Check Admin Page for details";
        $smsmessage =str_replace(' ','%20',$smsmessage);
        $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=233272430509&from=Zoeken&smsc=smsc&text=$smsmessage");
         echo' {"result":1,"message":"Bank Request sent Successfully ';
          $response= curl_exec($ch);
        echo  '"}';
           return;

        //session_write_close();


      }
     else{
        echo '{"result":0,"message":"Could not send request. Try again!"}';
        return;

      }
  }


  function sendFoodRequest(){
   if(empty($_REQUEST['foodType'])){
   echo '{"result":0,"message":"Enter foodType"}';
   exit();
   }
   if(empty($_REQUEST['customerName'])){
   echo '{"result":0,"message":"Enter Customer Name"}';
   exit();
   }
   if(empty($_REQUEST['restaurantName'])){
   echo '{"result":0,"message":"Enter Restaurant Name"}';
   exit();
   }
   if(empty($_REQUEST['accNum'])){
   echo '{"result":0,"message":"Enter Account Number"}';
   exit();
   }
   if(empty($_REQUEST['amount'])){
   echo '{"result":0,"message":"Enter Amount"}';
   exit();
   }


  //again use ios code to validate fields and use http post request to use these fields
        $food_type=$_REQUEST['foodType'];
        $customerN =$_REQUEST['customerName'];
        $restaurantN =$_REQUEST['restaurantName'];
        $accN= $_REQUEST['accNum'];
        $amount= $_REQUEST['amount'];


      include_once("functions.php");
      //create an object of users
      $obj=new users();
      // call get user method
        $check = $obj->sendFoodRequest($food_type,$customerN,$restaurantN,$accN,$amount);
        if($check==true){
          $sender ="Zoeken";
          $smsmessage = "Food Requested. Check Admin Page ";
          $smsmessage =str_replace(' ','%20',$smsmessage);
          $ch = curl_init("http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=233272430509&from=Zoeken&smsc=smsc&text=$smsmessage");
           echo' {"result":1,"message":"Food Request made Successfully ';
            $response= curl_exec($ch);
          echo  '"}';
              return;

        }
       else{
          echo '{"result":0,"message":"Could not send request. Try again!"}';
          return;

        }
    }
    function viewUsers(){
      include_once("functions.php");
      //create an object of users
      $obj=new users();
      // call get user method

        $check = $obj->viewUsers();
        if($check==false){
    header('Content-Type:application/json');
     echo '{"result":0,"message":"No users to view"}';
     return;
        }
      else{
    header('Content-Type:application/json');
    $array= array();
    while($res=$obj->fetch())
    {

      $array[]=$res;
    }
    echo json_encode($array);

      }

    }

    function viewBankRequest(){
      include_once("functions.php");
      //create an object of users
      $obj=new users();
      // call get user method

        $check = $obj->viewBankRequests();
        if($check==false){
    header('Content-Type:application/json');
     echo '{"result":0,"message":"No requests to view"}';
     return;
        }
      else{
    header('Content-Type:application/json');
    $array= array();
    while($res=$obj->fetch())
    {

      $array[]=$res;
    }
    echo json_encode($array);

      }

    }
    function viewFoodRequest(){
      include_once("functions.php");
      //create an object of users
      $obj=new users();
      // call get user method

        $check = $obj->viewFoodRequests();
        if($check==false){
    header('Content-Type:application/json');
     echo '{"result":0,"message":"No requests to view"}';
     return;
        }
      else{
    header('Content-Type:application/json');
    $array= array();
    while($res=$obj->fetch())
    {

      $array[]=$res;
    }
    echo json_encode($array);

      }

    }

    function adminLogin(){
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

    $result=$obj->alogin($username,$password);

    //print_r($result);
    if($result==1){
    $row = $obj->fetch();
    if($row==true){
    echo'{"result":1,"message":"Log In Successful"}';
    return;
    }
    else{
    echo '{"result":0,"message":"Wrong Credentials. Enter correct username and password"}';
    return;
    }
    }
    else{
    echo '{"result":0,"message":"Could not log in user. Try again!"}';
    return;

    }
    }




?>
