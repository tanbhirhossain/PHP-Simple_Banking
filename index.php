<?php 
use App\Auth\Auth;
use App\Transaction;


require "vendor/autoload.php";


printf("1. Login\n2. Register\n");

$input = readLine("What do you want? : ");

if ($input == 1) {
   
    $login = new Auth();
    $login->login();
      



}else if($input==2){

  $register = new Auth();
  $register->register();

}else{
    printf("Wrong Number you entered");
}