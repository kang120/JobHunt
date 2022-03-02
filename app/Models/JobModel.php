<?php namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model{
    protected $table = "job";
    protected $primaryKey = "company_id";
    protected $field = ["title", "salary", "description", "scope", "requirement", "type", "specialization", "qualification", "career_level", "company_id", "company_name"];

    public function getJobs(){
        return $this->findAll();
    }

    public function getJobsDetails(){
        $jobs = $this->findAll();

        $db = \Config\Database::connect();
        $db = db_connect();

        foreach($jobs as $key => $job){
            $company_id = $job["COMPANY_ID"];

            $query = $db->query("SELECT PHOTO,LOCATION FROM COMPANY WHERE COMPANY_ID=$company_id");

            $jobs[$key]["PHOTO"] = $query->getResult()[0]->PHOTO;
            $jobs[$key]["LOCATION"] = $query->getResult()[0]->LOCATION;
        }

        return $jobs;
    }
}

?>