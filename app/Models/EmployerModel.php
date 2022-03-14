<?php namespace App\Models;

use CodeIgniter\Model;

class EmployerModel extends Model{
    protected $table = "employer";
    protected $primaryKey = "employer_id";
    protected $allowedFields = ["first_name", "last_name", "birthday", "gender", "phone", "email", "password"];

    public function getEmployers(){
        return $this->findAll();
    }

    public function getEmployerById($employer_id){
        $employer = $this->where("employer_id", $employer_id)->findAll();

        if(empty($employer)){
            return null;
        }else{
            return $employer[0];
        }
    }

    public function getEmployerByEmail($email){
        $employer = $this->where("email", $email)->findAll();

        if(empty($employer)){
            return null;
        }else{
            return $employer[0];
        }
    }

    public function createEmployer($data){
        return $this->insert($data, true);
    }
}




?>