<?php namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model{
    protected $table = "job_application";
    protected $primaryKey = "application_id";
    protected $field = ["result", "job_id", "candidate_id", "company_id"];
    protected $allowedFields = ["result", "job_id", "candidate_id", "company_id"];

    public function getApplicationByCandidateId($candidate_id){
        $jobApplications = $this->where("candidate_id", $candidate_id)->findAll();

        $db = db_connect();

        foreach($jobApplications as $key => $application){
            $company_id = $application["COMPANY_ID"];
            $query = $db->query("SELECT NAME FROM COMPANY WHERE COMPANY_ID=$company_id");

            if(empty($query)){
                $jobApplications[$key]["COMPANY_NAME"] = null;
            }else{
                $jobApplications[$key]["COMPANY_NAME"] = $query->getResult()[0]->NAME;
            }
            
            $job_id = $application["JOB_ID"];
            $query = $db->query("SELECT TITLE FROM JOB WHERE JOB_ID=$job_id");
            
            if(empty($query)){
                $jobApplications[$key]["JOB_TITLE"] = null;
            }else{
                $jobApplications[$key]["JOB_TITLE"] = $query->getResult()[0]->TITLE;
            }
        }

        return $jobApplications;
    }

    public function createApplication($data){
        return $this->insert($data, true);
    }

    public function deleteApplication($application_id){
        return $this->delete($application_id);
    }
}

?>