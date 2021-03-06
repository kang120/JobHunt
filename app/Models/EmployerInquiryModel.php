<?php namespace App\Models;

use CodeIgniter\Model;

class EmployerInquiryModel extends Model{
    protected $table = "employer_inquiry";
    protected $primaryKey = "inquiry_id";
    protected $field = ["question", "answer", "employer_id", "admin_id"];
    protected $allowedFields = ["question", "answer", "employer_id", "admin_id"];

    public function createInquiry($data){
        return $this->insert($data, true);
    }

    public function updateInquiry($inquiry_id, $data){
        return $this->update($inquiry_id, $data);
    }

    public function getInquiryByEmployerId($employer_id){
        return $this->where("employer_id", $employer_id)->findAll();
    }
}

?>