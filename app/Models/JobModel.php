<?php namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model{
    protected $table = "job";
    protected $primaryKey = "job_id";
    protected $allowedFields = ["title", "salary", "description", "scope", "requirement", "type", "specialization", "qualification", "career_level", "company_id", "company_name"];

    public function getJobs(){
        return $this->findAll();
    }

    public function getJobsDetails(){
        $jobs = $this->findAll();

        $db = \Config\Database::connect();
        $db = db_connect();

        foreach($jobs as $key => $job){
            $company_id = $job["COMPANY_ID"];

            $query = $db->query("SELECT NAME,PHOTO,LOCATION FROM COMPANY WHERE COMPANY_ID=$company_id");

            $jobs[$key]["JOB_ID"] = $job["JOB_ID"];
            $jobs[$key]["COMPANY_NAME"] = $query->getResult()[0]->NAME;
            $jobs[$key]["PHOTO"] = $query->getResult()[0]->PHOTO;
            $jobs[$key]["LOCATION"] = $query->getResult()[0]->LOCATION;
        }

        return $jobs;
    }

    public function getJobsResults(){
        $jobs = $this->findAll();

        $db = \Config\Database::connect();
        $db = db_connect();

        foreach($jobs as $key => $job){
            $job_id = $job["JOB_ID"];

            $query = $db->query("SELECT RESULT FROM JOB_APPLICATION WHERE JOB_ID=$job_id");

            $count = "";
            foreach ($query->getResult() as $row) {
                $count .= $row->RESULT." ";
              }
            
            $jobs1[$key]["JOB_ID"] = $job_id;
            $jobs1[$key]["RESULT"] = $count;


        }

        return $jobs1;
    }    
}

?>