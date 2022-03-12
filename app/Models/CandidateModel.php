<?php namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model{
    protected $table = "candidate";
    protected $primaryKey = "candidate_id";
    protected $field = ["first_name", "last_name", "email", "password"];
    protected $allowedFields = ["first_name", "last_name", "email", "password"];

    public function getCandidates(){
        return $this->findAll();
    }

    public function getCandidateById($candidate_id){
        return $this->where("candidate_id", $candidate_id)->findAll()[0];
    }

    public function getCandidateByEmail($email){
        return $this->where("email", $email)->findAll()[0];
    }

    public function getCandidatePassword($email){
        $db = \Config\Database::connect();
        $db = db_connect();

        $query = $db->query("SELECT PASSWORD FROM CANDIDATE WHERE EMAIL=$email");

        return $query->getResult()[0]->PASSWORD;
    }

    public function createCandidate($candidate){
        return $this->insert($candidate, true);
    }

    public function updateCandidate($candidate_id, $data){
        $this->update($candidate_id, $data);
    }
}

?>