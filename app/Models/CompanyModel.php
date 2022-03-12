<?php namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model{
    protected $table = "company";
    protected $primaryKey = "company_id";
    // protected $field = ["name", "location", "industry", "size", "photo", "employer_id"];
    protected $allowedFields = ["name", "location", "industry", "size", "photo", "employer_id"];

    public function getCompanies(){
        return $this->findAll();
    }


}




?>