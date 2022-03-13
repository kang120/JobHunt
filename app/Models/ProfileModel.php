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

    public function getProfileByCandidateId($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];
        $profile["AGE"] = date("Y") - (int)$profile["BIRTHDAY"];

        return $profile;
    }

    public function createProfile($candidate_id){
        $file = file_get_contents(base_url("assets/blank_profile.png"));

        $profile = [
            "candidate_id" => $candidate_id,
            "photo" => $file
        ];

        return $this->insert($profile, true);
    }

    public function updateProfile($profile_id, $data){
        $this->update($profile_id, $data);
    }

    public function getProfileEducation($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];

        $educationArray = explode("\n", $profile["EDUCATION"]);
        $educations = [];

        foreach($educationArray as $education){
            $details = explode(";", $education);

            array_push($educations, [
                "universityName" => $details[0],
                "graduationDate" => $details[1],
                "course" => $details[2],
                "universityLocation" => $details[3],
            ]);
        }

        return $educations;
    }

    public function getProfileExperience($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];

        $experienceArray = explode("\n", $profile["EXPERIENCE"]);
        $experiences = [];

        foreach($experienceArray as $experience){
            $details = explode(";", $experience);

            array_push($experiences, [
                "jobTitle" => $details[0],
                "companyName" => $details[1],
                "startDate" => $details[2],
                "endDate" => $details[3],
                "specialization" => $details[4],
                "role" => $details[5],
                "salary" => $details[6],
            ]);
        }

        return $experiences;
    }

    public function getProfileSkill($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];

        $skillArray = explode("\n", $profile["SKILLS"]);
        $skills = [];

        foreach($skillArray as $skill){
            $details = explode(";", $skill);

            array_push($skills, [
                "skillName" => $details[0],
                "proficiency" => $details[1]
            ]);
        }

        return $skills;
    }

    public function getProfileLanguage($candidate_id){
        $profile = $this->where("candidate_id", $candidate_id)->findAll();

        if(empty($profile)){
            return null;
        }

        $profile = $profile[0];

        $languageArray = explode("\n", $profile["LANGUAGES"]);
        $languages = [];

        foreach($languageArray as $language){
            $details = explode(";", $language);

            array_push($languages, [
                "language" => $details[0],
                "speaking" => $details[1],
                "writing" => $details[2],
                "reading" => $details[3]
            ]);
        }

        return $languages;
    }
}

?>