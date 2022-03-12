<?php namespace App\Models;

use CodeIgniter\Model;

class JobApplicationModel extends Model{
    protected $table = "job_application";
    protected $primaryKey = "application_id";
    protected $allowedFields = ["result", "job_id", "candidate_id", "company_id"];

    public function getJobsApplications(){
        return $this->findAll();
    }

    public function getJobsApplicants(){
        $jobsapplicants = $this->findAll();

        $db = \Config\Database::connect();
        $db = db_connect();

        foreach($jobsapplicants as $key => $jobsapplicant){
            $candidate_id = $jobsapplicant["CANDIDATE_ID"];

            $query = $db->query("SELECT FIRST_NAME,LAST_NAME,EMAIL FROM CANDIDATE WHERE CANDIDATE_ID=$candidate_id");

            $jobsapplicants[$key]["FIRST_NAME"] = $query->getResult()[0]->FIRST_NAME;
            $jobsapplicants[$key]["LAST_NAME"] = $query->getResult()[0]->LAST_NAME;
            $jobsapplicants[$key]["EMAIL"] = $query->getResult()[0]->EMAIL;

            $query1 = $db->query("SELECT PHONE FROM CANDIDATE_PROFILE WHERE CANDIDATE_ID=$candidate_id");   
              // foreach ($query1->getResult() as $row) {
              //   echo $row->PHONE."==";
              // }         
             $jobsapplicants[$key]["PHONE"] = $query1->getResult()[0]->PHONE;
        }

        return $jobsapplicants;
    }

   
}

?>