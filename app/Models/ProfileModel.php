<?php namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model{
    protected $table = "profile";
    protected $primaryKey = "profile_id";
    protected $field = ["age", "gender", "phone", "address", "photo", "education", "experience", "skills", "languages", 
                        "candidate_id"];

    public function getProfiles(){
        return $this->findAll();
    }
}

?>