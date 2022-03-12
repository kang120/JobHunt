<?php

namespace App\Controllers;
use App\Models\CandidateModel;
use App\Models\ProfileModel;
use App\Libraries\Utilities;
use PDO;

class ProfileController extends BaseController{

    public function profile(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $candidate_id = $currentUser["CANDIDATE_ID"];

        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $educations = NULL;
        $experiences = NULL;
        $skills = NULL;
        $languages = NULL;

        if(!is_null($profile) && !is_null($profile["EDUCATION"])){
            $educations = $profileModel->getProfileEducation($candidate_id);
        }

        if(!is_null($profile) && !is_null($profile["EXPERIENCE"])){
            $experiences = $profileModel->getProfileExperience($candidate_id);
        }

        if(!is_null($profile) && !is_null($profile["SKILLS"])){
            $skills = $profileModel->getProfileSkill($candidate_id);
        }

        if(!is_null($profile) && !is_null($profile["LANGUAGES"])){
            $languages = $profileModel->getProfileLanguage($candidate_id);
        }

        $isEmptyProfile = true;

        if(!is_null($educations) || !is_null($experiences) || !is_null($skills) || !is_null($languages)){
            $isEmptyProfile = false;
        }

        $data = [
            "currentUser" => $currentUser,
            "tab" => "overview",
            "profile" => $profile,
            "educations" => $educations,
            "experiences" => $experiences,
            "skills" => $skills,
            "languages" => $languages,
            "isEmptyProfile" => $isEmptyProfile
        ];

        if(isset($_GET["tab"])){
            if($_GET["tab"] == "education"){
                $data["tab"] = "education";

                return view("candidate/profile/profile_education", $data);
            }else if($_GET["tab"] == "experience"){
                $data["tab"] = "experience";

                return view("candidate/profile/profile_experience", $data);
            }else if($_GET["tab"] == "skills"){
                $data["tab"] = "skills";

                return view("candidate/profile/profile_skills", $data);
            }else if($_GET["tab"] == "language"){
                $data["tab"] = "language";

                return view("candidate/profile/profile_language", $data);
            }
        }

        return view("candidate/profile/profile_overview", $data);
    }

    // always POST method
    public function update_picture(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $candidate_id = $currentUser["CANDIDATE_ID"];

        if(is_uploaded_file($_FILES["profile_picture"]["tmp_name"])){
            session()->set("profilepicture", $_FILES["profile_picture"]);

            $data = [
                "photo" => file_get_contents($_FILES["profile_picture"]["tmp_name"])
            ];
            
            $profileModel = new ProfileModel();

            $profile_id = $profileModel->getProfileByCandidateId($candidate_id);

            $profileModel->update($profile_id, $data);
        }

        return redirect()->to("candidate/profile");
    }

    // always POST method
    public function add_education(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $validation = $this->validate([
            'university_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'graduation_month' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'graduation_year' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'course' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'university_location' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ]
        ]);

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $educations = [];

        if(!is_null($profile) && !is_null($profile["EDUCATION"])){
            $educations = $profileModel->getProfileEducation($candidate_id);
        }

        // invalid input
        if(!$validation){            
            $data = [
                "currentUser" => $currentUser,
                "tab" => "education",
                "profile" => $profile,
                "educations" => $educations,
                "validation" => $this->validator,
                "university_name" => $_POST["university_name"],
                "graduation_month" => $_POST["graduation_month"],
                "graduation_year" => $_POST["graduation_year"],
                "course" => $_POST["course"],
                "university_location" => $_POST["university_location"]
            ];
            
            return view("candidate/profile/profile_education", $data);
        }else{
            // bind the month and year
            $date = Utilities::getDateString($_POST["graduation_month"], $_POST["graduation_year"]);
            $education = $_POST["university_name"] . ";" . $date . ";" . $_POST["course"] . ";" . $_POST["university_location"];
            
            $data = [
                "education" => $education
            ];

            if(is_null($profile)){
                // create a blank profile
                $profileModel->createProfile($candidate_id);
                $profile = $profileModel->getProfileByCandidateId($candidate_id);
            }else if(!is_null($profile["EDUCATION"])){
                $data["education"] = $profile["EDUCATION"] . "\n" . $education;
            }

            // update database
            $profileModel->updateProfile($profile["PROFILE_ID"], $data);

            return redirect()->to(base_url("candidate/profile?tab=education"));
        }
    }

    // always POST method
    public function add_experience(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $validation = $this->validate([
            'job_title' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'company_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'start_month' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'start_year' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'end_month' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ],
            'end_year' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ],
            'specialization' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ],
            'salary' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required',
                ]
            ]
        ]);

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $experiences = NULL;

        if(!is_null($profile) && !is_null($profile["EXPERIENCE"])){
            $experiences = $profileModel->getProfileExperience($candidate_id);
        }

        // invalid input
        if(!$validation){            
            $data = [
                "currentUser" => $currentUser,
                "tab" => "experience",
                "profile" => $profile,
                "experiences" => $experiences,
                "validation" => $this->validator,
                "job_title" => $_POST["job_title"],
                "company_name" => $_POST["company_name"],
                "start_month" => $_POST["start_month"],
                "start_year" => $_POST["start_year"],
                "end_month" => $_POST["end_month"],
                "end_year" => $_POST["end_year"],
                "specialization" => $_POST["specialization"],
                "role" => $_POST["role"],
                "salary" => $_POST["salary"]
            ];
            
            return view("candidate/profile/profile_experience", $data);
        }else{
            // bind the month and year
            $startDate = Utilities::getDateString($_POST["start_month"], $_POST["start_year"]);
            $endDate = Utilities::getDateString($_POST["end_month"], $_POST["end_year"]);
            $experience = $_POST["job_title"] . ";" . $_POST["company_name"] . ";" . $startDate . ";" . $endDate . ";" . $_POST["specialization"] . ";" . 
                          $_POST["role"] . ";" . $_POST["salary"];
            
            $data = [
                "experience" => $experience
            ];

            if(is_null($profile)){
                // create a blank profile
                $profileModel->createProfile($candidate_id);
                $profile = $profileModel->getProfileByCandidateId($candidate_id);
            }else if(!is_null($profile["EXPERIENCE"])){
                $data["experience"] = $profile["EXPERIENCE"] . "\n" . $experience;
            }

            // update database
            $profileModel->updateProfile($profile["PROFILE_ID"], $data);

            return redirect()->to(base_url("candidate/profile?tab=experience"));
        }
    }

    // always POST method
    public function add_skills(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $validation = $this->validate([
            'skill_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'proficiency' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ]
        ]);

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $skills = NULL;

        if(!is_null($profile) && !is_null($profile["SKILLS"])){
            $skills = $profileModel->getProfileSkill($candidate_id);
        }

        // invalid input
        if(!$validation){            
            $data = [
                "currentUser" => $currentUser,
                "tab" => "skills",
                "profile" => $profile,
                "skills" => $skills,
                "validation" => $this->validator,
                "skill_name" => $_POST["skill_name"],
                "proficiency" => $_POST["proficiency"]
            ];
            
            return view("candidate/profile/profile_skills", $data);
        }else{
            $skills = $_POST["skill_name"] . ";" . $_POST["proficiency"];
            
            $data = [
                "skills" => $skills
            ];

            if(is_null($profile)){
                // create a blank profile
                $profileModel->createProfile($candidate_id);
                $profile = $profileModel->getProfileByCandidateId($candidate_id);
            }else if(!is_null($profile["SKILLS"])){
                $data["skills"] = $profile["SKILLS"] . "\n" . $skills;
            }

            // update database
            $profileModel->updateProfile($profile["PROFILE_ID"], $data);

            return redirect()->to(base_url("candidate/profile?tab=skills"));
        }
    }

    // always POST method
    public function add_language(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $validation = $this->validate([
            'language' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'speaking' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'writing' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ],
            'reading' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* This field is required'
                ]
            ]
        ]);

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $languages = NULL;

        if(!is_null($profile) && !is_null($profile["LANGUAGES"])){
            $languages = $profileModel->getProfileLanguage($candidate_id);
        }

        // invalid input
        if(!$validation){            
            $data = [
                "currentUser" => $currentUser,
                "tab" => "language",
                "profile" => $profile,
                "languages" => $languages,
                "validation" => $this->validator,
                "language" => $_POST["language"],
                "speaking" => $_POST["speaking"],
                "writing" => $_POST["writing"],
                "reading" => $_POST["reading"]
            ];
            
            return view("candidate/profile/profile_language", $data);
        }else{
            $languages = $_POST["language"] . ";" . $_POST["speaking"] . ";" . $_POST["writing"] . ";" . $_POST["reading"];
            
            $data = [
                "languages" => $languages
            ];

            if(is_null($profile)){
                // create a blank profile
                $profileModel->createProfile($candidate_id);
                $profile = $profileModel->getProfileByCandidateId($candidate_id);
            }else if(!is_null($profile["LANGUAGES"])){
                $data["languages"] = $profile["LANGUAGES"] . "\n" . $languages;
            }

            // update database
            $profileModel->updateProfile($profile["PROFILE_ID"], $data);

            return redirect()->to(base_url("candidate/profile?tab=language"));
        }
    }

    // always POST method
    public function update_bio(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        if($email == ""){
            $email = NULL;
        }

        if($phone == ""){
            $phone = NULL;
        }

        if($address == ""){
            $address = NULL;
        }

        $candidateModel = new CandidateModel();
        $profileModel = new ProfileModel();

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profile_id = $profileModel->getProfileByCandidateId($candidate_id)["PROFILE_ID"];

        $data = [
            "email" => $email
        ];

        $candidateModel->updateCandidate($candidate_id, $data);

        $data = [
            "currentUser" => $currentUser,
            "phone" => $phone,
            "address" => $address
        ];

        $profileModel->updateProfile($profile_id, $data);

        return redirect()->to(base_url("candidate/profile"));
    }

    // always POST method
    public function delete_education(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $index = $_POST["index"];

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $educations = [];

        if(!is_null($profile) && !is_null($profile["EDUCATION"])){
            $educations = $profileModel->getProfileEducation($candidate_id);
        }

        unset($educations[$index]);

        $educations_string = "";

        foreach($educations as $education){
            $educations_string .= $education["universityName"] . ";" . $education["graduationDate"] . ";" . $education["course"] . ";" . $education["universityLocation"] . "\n";
        }

        $educations_string = substr($educations_string, 0, strlen($educations_string)-1);

        $data = [
            "currentUser" => $currentUser,
            "education" => $educations_string
        ];

        $profile_id = $profile["PROFILE_ID"];
        $profileModel->updateProfile($profile_id, $data);

        return redirect()->to(base_url("candidate/profile?tab=education"));
    }

    // always POST method
    public function delete_experience(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $index = $_POST["index"];

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $experiences = [];

        if(!is_null($profile) && !is_null($profile["EXPERIENCE"])){
            $experiences = $profileModel->getProfileExperience($candidate_id);
        }

        unset($experiences[$index]);

        $experiences_string = "";

        foreach($experiences as $experience){
            $experiences_string .= $experience["jobTitle"] . ";" . $experience["companyName"] . ";" . $experience["startDate"] . ";" . $experience["endDate"] . ";"
                                   . $experience["specialization"] . ";" . $experience["role"] . ";" . $experience["salary"] . "\n";
        }

        $experiences_string = substr($experiences_string, 0, strlen($experiences_string)-1);

        $data = [
            "currentUser" => $currentUser,
            "experience" => $experiences_string
        ];

        $profile_id = $profile["PROFILE_ID"];
        $profileModel->updateProfile($profile_id, $data);

        return redirect()->to(base_url("candidate/profile?tab=experience"));
    }

    // always POST method
    public function delete_skill(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $index = $_POST["index"];

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $skills = [];

        if(!is_null($profile) && !is_null($profile["SKILLS"])){
            $skills = $profileModel->getProfileSkill($candidate_id);
        }

        unset($skills[$index]);

        $skills_string = "";

        foreach($skills as $skill){
            $skills_string .= $skill["skillName"] . ";" . $skill["proficiency"] . "\n";
        }

        $skills_string = substr($skills_string, 0, strlen($skills_string)-1);

        $data = [
            "currentUser" => $currentUser,
            "skills" => $skills_string
        ];

        $profile_id = $profile["PROFILE_ID"];
        $profileModel->updateProfile($profile_id, $data);

        return redirect()->to(base_url("candidate/profile?tab=skills"));
    }

    // always POST method
    public function delete_language(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login"); 
        }

        $index = $_POST["index"];

        $candidate_id = session()->get("currentUser")["CANDIDATE_ID"];
        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfileByCandidateId($candidate_id);

        $languages = [];

        if(!is_null($profile) && !is_null($profile["LANGUAGES"])){
            $languages = $profileModel->getProfileLanguage($candidate_id);
        }

        unset($languages[$index]);

        $languages_string = "";

        foreach($languages as $language){
            $languages_string .= $language["language"] . ";" . $language["speaking"] . ";" . $language["writing"] . ";" . $language["reading"] . "\n";
        }

        $languages_string = substr($languages_string, 0, strlen($languages_string)-1);

        $data = [
            "currentUser" => $currentUser,
            "languages" => $languages_string
        ];

        $profile_id = $profile["PROFILE_ID"];
        $profileModel->updateProfile($profile_id, $data);

        return redirect()->to(base_url("candidate/profile?tab=language"));
    }
}

?>