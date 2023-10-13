<?php 
namespace App;
class Customer{
    private $name;
    private $email;
    private $password;



    public function __construct($name, $email, $password){
        $this->email = $email;
        $this->name  = $name;
        $this->password = $password;

        
    }

    public function getEmail(){
        return $this->email;
    }

    public function getName(){
        return $this->name;

    }

    public function getPassword(){
        return $this->password;
        
    }

}