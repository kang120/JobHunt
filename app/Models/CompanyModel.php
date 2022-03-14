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

    public function getCompaniesByEmployerId($employer_id){
        $companies = $this->where("employer_id", $employer_id)->findAll();

        if(empty($companies)){
            return null;
        }

        return $companies;
    }

    public function createCompany($data){
        return $this->insert($data, true);
    }

    public function deleteCompany($company_id){
        return $this->delete($company_id);
    }

    public function updateCompany($company_id, $data){
        return $this->update($company_id, $data);
    }
}




?>