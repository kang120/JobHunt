<?php

namespace App\Libraries;

class Utilities{
    public static function getValidationNumber(){
        $numbers = "0123456789";
        $verificationNumber = "";
        settype($verificationNumber, "string");

        for($i = 0; $i < 6; $i++){
            $verificationNumber .= $numbers[rand(0, strlen($numbers) - 1)];
        }

        return $verificationNumber;
    }
}

?>