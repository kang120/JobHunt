<?php

namespace App\Controllers;
use App\Models\CandidateModel;
use App\Models\ProfileModel;
use App\Libraries\Utilities;

class CandidateController extends BaseController
{
    public function login(){
        helper("url");

        if($_POST){
            $validation = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email|is_not_unique[candidate.email]',
                    'errors' => [
                        'required' => '* This field is required',
                        'valid_email' => '* Email is invalid',
                        'is_not_unique' => '* Account does not exist'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[20]|alpha_numeric_punct',
                    'errors' => [
                        'required' => '* This field is required',
                        'min_length' => '* Password must be 8-20 characters including numbers(0-9) and letters(a-z)',
                        'max_length' => '* Password must be 8-20 characters including numbers(0-9) and letters(a-z)'
                    ]
                ]
            ]);
            
            // invalid input
            if(!$validation){
                $data = [
                    "email" => $_POST["email"],
                    "validation" => $this->validator
                ];
    
                return view("candidate/login", $data);
            }else{   // valid input and check password
                $candidateModel = new CandidateModel();
                
                $email = $_POST["email"];
                $inputPassword = $_POST["password"];

                $currentUser = $candidateModel->getCandidateByEmail($email);

                if($inputPassword == $currentUser["PASSWORD"]){
                    session()->set("currentUser", $currentUser);
                    return redirect()->to(base_url());
                }else{
                    $data = [
                        "email" => $_POST["email"],
                        "passwordError" => "Incorrect password"
                    ];

                    return view("candidate/login", $data);
                }
            }
        }else{
            return view("candidate/login");
        }
    }

	public function signup()
	{
        helper("url");

        if($_POST){
            $validation = $this->validate([
                'firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* This field is required'
                    ]
                ],
                'lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* This field is required'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[candidate.email]',
                    'errors' => [
                        'required' => '* This field is required',
                        'valid_email' => '* Email is invalid',
                        'is_unique' => '* Email is already used'
                    ]
                ],
                'password' => [
                    'rules' => 'required|min_length[8]|max_length[20]|alpha_numeric_punct',
                    'errors' => [
                        'required' => '* This field is required',
                        'min_length' => '* Password must be 8-20 characters including numbers(0-9) and letters(a-z)',
                        'max_length' => '* Password must be 8-20 characters including numbers(0-9) and letters(a-z)'
                    ]
                ],
				'password2' => [
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => '* This field is required',
						'matches' => '* Passwords are not same'
					]
				]
            ]);
            
            // invalid input
            if(!$validation){
                $data = [
                    "firstname" => $_POST["firstname"],
                    "lastname" => $_POST["lastname"],
                    "email" => $_POST["email"],
                    "validation" => $this->validator
                ];
    
                return view("candidate/signup", $data);
            }else{   // valid input and go to email validation
                $email = $_POST["email"];

                $tempUser = [
                    "first_name" => $_POST["firstname"],
                    "last_name" => $_POST["lastname"],
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                ];

                session()->setTempdata("signup_email", $email, 1200);
                session()->set("tempUser", $tempUser);

                return redirect()->to(base_url() . "/candidate/signup/validation?email=".$email)->with("is_signup", true);
            }
        }else{
            return view("candidate/signup");
        }
	}

    public function signup_validation(){
        // first time entry
        if(session()->getFlashdata("is_signup")){
            $verificationNumber = Utilities::getValidationNumber();

            session()->setTempdata("signup_verification", $verificationNumber, 300);
    
            return view("candidate/signup_validation");
        }else if($_POST){    // check input or resend email
            if($_POST["status"] == "submit"){
                $verificationNumber = session()->getTempdata("signup_verification");
    
                // correct validation
                if($verificationNumber && $_POST["input"] == $verificationNumber){
                    $currentUser = session()->get("tempUser");
                    session()->remove("tempUser");

                    // create new user in database
                    $candidateModel = new CandidateModel();
                    $candidateId = $candidateModel->createCandidate($currentUser);

                    // set current user to session data
                    $currentUser = $candidateModel->getCandidateById($candidateId);
                    session()->set("currentUser", $currentUser);

                    return redirect()->to(base_url() . "/candidate/signup/setup_profile");
                }else{   // wrong validation
                    return view("candidate/signup_validation", ["send_email" => "no"]);
                }
            }else if($_POST["status"] == "resend"){   // resend email
                $verificationNumber = Utilities::getValidationNumber();

                session()->setTempdata("signup_verification", $verificationNumber, 300);
        
                return view("candidate/signup_validation");
            }
        }else{   // prevent access before sign up form
            return redirect()->to(base_url() . "/candidate/signup");
        }

        /*
        // prevent access before sign up form
        if(!session()->getFlashdata("is_signup")){
            return redirect()->to(base_url() . "/candidate/signup");
        }
        */

        /*
        // validate email successfully
        if(isset($_GET["result"]) && $_GET["result"] == "success"){
            session()->remove("is_signup");
            return redirect()->to(base_url() . "/candidate/signup/setup_profile");
        }
        */
    }

    public function setup_profile(){
        // first setup, so no profile in database
        $data = [
            "tab" => "overview",
            "profile" => null
        ];

        return view("candidate/profile/profile_overview", $data);
    }

    public function profile(){
        $currentUser = session()->get("currentUser");
        $userId = $currentUser["CANDIDATE_ID"];

        $profileModel = new ProfileModel();
        $profile = $profileModel->getProfile($userId);

        $data = [
            "tab" => "overview",
            "profile" => $profile
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
    public function add_education(){
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
        $profile = $profileModel->getProfile($candidate_id);

        // invalid input
        if(!$validation){
            $data = [
                "tab" => "education",
                "profile" => null,
                "validation" => $this->validator,
                "university_name" => $_POST["university_name"],
                "graduation_month" => $_POST["graduation_month"],
                "graduation_year" => $_POST["graduation_year"],
                "course" => $_POST["course"],
                "university_location" => $_POST["university_location"]
            ];
            
            return view("candidate/profile/profile_education", $data);
        }

        $data = [
            "tab" => "education",
            "profile" => null
        ];

        return view("candidate/profile/profile_education", $data);
    }
}
