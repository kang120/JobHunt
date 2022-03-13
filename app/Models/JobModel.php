<?php namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model{
    protected $table = "job";
    protected $primaryKey = "job_id";
    protected $field = ["title", "salary", "description", "scope", "requirement", "type", "specialization", "qualification", "career_level", "company_id", "company_name"];
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

    public function getJobsByQuery($query){
        $query_title = strtolower($query["TITLE"]);
        $query_location = strtolower($query["LOCATION"]);
        $query_jobtype = strtolower($query["TYPE"]);

        $jobs = $this->findAll();

        if($query_title != null){
            foreach($jobs as $key => $job){
                $jobTitle = strtolower($job["TITLE"]);
    
                if(strpos($jobTitle, $query_title) === false){
                    unset($jobs[$key]);
                }
            }
        }
        
        if($query_jobtype != null){
            foreach($jobs as $key => $job){
                $jobtype = strtolower($job["TYPE"]);
    
                if(strpos($jobtype, $query_jobtype) === false){
                    unset($jobs[$key]);
                }
            }
        }

        $db = \Config\Database::connect();
        $db = db_connect();

        foreach($jobs as $key => $job){
            $company_id = $job["COMPANY_ID"];

            $query = $db->query("SELECT NAME,PHOTO,LOCATION FROM COMPANY WHERE COMPANY_ID=$company_id");

            $jobs[$key]["COMPANY_NAME"] = $query->getResult()[0]->NAME;
            $jobs[$key]["PHOTO"] = $query->getResult()[0]->PHOTO;
            $jobs[$key]["LOCATION"] = $query->getResult()[0]->LOCATION;
        }

        if($query_location != null){
            foreach($jobs as $key => $job){
                $jobLocation = strtolower($job["LOCATION"]);
    
                if(strpos($jobLocation, $query_location) === false){
                    unset($jobs[$key]);
                }
            }
        }

        return $jobs;
    }

    public function getJobById($job_id){
        $job = $this->where("job_id", $job_id)->findAll();

        if(empty($job)){
            return null;
        }

        $job = $job[0];

        // get company information
        $db = \Config\Database::connect();
        $db = db_connect();

        $company_id = $job["COMPANY_ID"];

        $query = $db->query("SELECT COMPANY_ID, NAME,PHOTO,LOCATION FROM COMPANY WHERE COMPANY_ID=$company_id");

        $job["COMPANY_ID"] = $query->getResult()[0]->COMPANY_ID;
        $job["COMPANY_NAME"] = $query->getResult()[0]->NAME;
        $job["PHOTO"] = $query->getResult()[0]->PHOTO;
        $job["LOCATION"] = $query->getResult()[0]->LOCATION;


        // put job scope and requirement into array
        $job["SCOPE"] = explode("\n", $job["SCOPE"]);
        $job["REQUIREMENT"] = explode("\n", $job["REQUIREMENT"]);

        return $job;
    }

    public function candidateHasApplied($candidate_id, $job_id){
        $db = \Config\Database::connect();
        $db = db_connect();

        $query = $db->query("SELECT * FROM JOB_APPLICATION WHERE JOB_ID=$job_id AND CANDIDATE_ID=$candidate_id");

        if(empty($query->getResult())){
            return false;
        }else{
            return true;
        }
    }
}

?>