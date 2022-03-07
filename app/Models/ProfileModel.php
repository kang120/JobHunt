<?php namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model{
    protected $table = "candidate_profile";
    protected $primaryKey = "profile_id";
    protected $field = ["birthday", "gender", "phone", "address", "photo", "education", "experience", "skills", "languages", 
                        "candidate_id"];
    protected $allowedFields = ["birthday", "gender", "phone", "address", "photo", "education", "experience", "skills", "languages", 
                        "candidate_id"];

    public function getProfiles(){
        $profiles = $this->findAll();

        foreach($profiles as $key => $profile){
            $profiles[$key]["AGE"] = date("Y") - (int)$profile["BIRTHDAY"];
        }

        return $profiles;
    }

    public function getProfile($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];
        $profile["AGE"] = date("Y") - (int)$profile["BIRTHDAY"];

        return $profile;
    }

    public function createProfile($candidate_id){
        $profile = [
            "candidate_id" => $candidate_id
        ];

        $this->insert($profile);
    }
}

?>