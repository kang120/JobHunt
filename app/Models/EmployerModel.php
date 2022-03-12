<?php namespace App\Models;

use CodeIgniter\Model;

class EmployerModel extends Model{
    protected $table = "employer";
    protected $primaryKey = "employer_id";
    protected $allowedFields = ["first_name", "last_name", "birthday", "gender", "phone", "email", "password"];

    public function getEmployers(){
        return $this->findAll();
    }

}




?>