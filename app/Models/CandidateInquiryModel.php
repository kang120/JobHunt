<?php namespace App\Models;

use CodeIgniter\Model;

class CandidateInquiryModel extends Model{
    protected $table = "candidate_inquiry";
    protected $primaryKey = "inquiry_id";
    protected $field = ["question", "answer", "candidate_id", "admin_id"];
    protected $allowedFields = ["question", "answer", "candidate_id", "admin_id"];

    public function createInquiry($data){
        return $this->insert($data, true);
    }

    public function updateInquiry($inquiry_id, $data){
        return $this->update($inquiry_id, $data);
    }

    public function getInquiryByCandidateId($candidate_id){
        return $this->where("candidate_id", $candidate_id)->findAll();
    }
}

?>