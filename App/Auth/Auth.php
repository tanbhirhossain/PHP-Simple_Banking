<?php 
namespace App\Auth;
use App\Auth\Register;
use Login;
class Auth {
    public function login($email, $password) {
        $login = new Login($email, $password);

        if ($login->authenticate()) {
            return "Login successful!";
        } else {
            return "Login failed.";
        }
    }

    public function register($name, $email, $password) {
        $register = new Register($name, $email, $password);

        if ($register->save()) {
            return "Registration successful!";
        } else {
            return "Registration failed.";
        }
    }
}


