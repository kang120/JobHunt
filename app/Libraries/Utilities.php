<?php

namespace App\Libraries;

use PDO;

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
    
    public static function getDateString($month, $year){
        $month = (int)$month;
        $date = "";

        if($month == 1){
            $date = "Jan";
        }else if($month == 2){
            $date = "Feb";
        }else if($month == 3){
            $date = "Mar";
        }else if($month == 4){
            $date = "Apr";
        }else if($month == 5){
            $date = "May";
        }else if($month == 6){
            $date = "Jun";
        }else if($month == 7){
            $date = "Jul";
        }else if($month == 8){
            $date = "Aug";
        }else if($month == 9){
            $date = "Sep";
        }else if($month == 10){
            $date = "Oct";
        }else if($month == 11){
            $date = "Nov";
        }else if($month == 12){
            $date = "Dec";
        }

        return $date . " " . $year;
    }

    public static function sortEducation($educations){
        $monthString = ["January"];

        $sortedEducations = [];

        for($i = 0; $i < sizeof($educations); $i++){
            
        }
    }
}
?>