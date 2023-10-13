<?php 
namespace App\Auth;
class Register {
    private $email;
    private $name;
    private $password;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function save() {
        $customerData = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT)
        ];

        $jsonDB = './data/customer.json';

        $existingData = file_exists($jsonDB) ? json_decode(file_get_contents($jsonDB), true) : [];
        $existingData[] = $customerData;

        if (file_put_contents($jsonDB, json_encode($existingData, JSON_PRETTY_PRINT))) {
            return true; // Registration successful
        } else {
            return false; // Registration failed
        }
    }
}
