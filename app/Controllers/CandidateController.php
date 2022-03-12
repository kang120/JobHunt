<?php

namespace App\Controllers;
use App\Models\CandidateModel;
use App\Models\ProfileModel;
use App\Libraries\Utilities;
use App\Models\ApplicationModel;
use App\Models\CandidateInquiryModel;

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
                    "currentUser" => null,
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
                        "currentUser" => null,
                        "email" => $_POST["email"],
                        "passwordError" => "Incorrect password"
                    ];

                    return view("candidate/login", $data);
                }
            }
        }else{
            $data = [
                "currentUser" => null,
            ];

            return view("candidate/login", $data);
        }
    }

	public function signup(){
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
                    "currentUser" => null,
                    "firstname" => $_POST["firstname"],
                    "lastname" => $_POST["lastname"],
                    "email" => $_POST["email"],
                    "validation" => $this->validator
                ];
    
                return view("candidate/signup", $data);
            }else{   // valid input and go to email validation
                $email = $_POST["email"];

                $tempUser = [
                    "currentUser" => null,
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
            $data = [
                "currentUser" => null
            ];

            return view("candidate/signup", $data);
        }
	}

    public function signup_validation(){
        $data = [
            "currentUser" => null
        ];

        // first time entry
        if(session()->getFlashdata("is_signup")){
            $verificationNumber = Utilities::getValidationNumber();

            session()->setTempdata("signup_verification", $verificationNumber, 300);
    
            return view("candidate/signup_validation", $data);
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

                    // create user profile in database
                    $profileModel = new ProfileModel();
                    $profileModel->createProfile($candidateId);

                    return redirect()->to(base_url() . "/candidate/signup/setup_profile");
                }else{   // wrong validation
                    $data["send_email"] = "no";
                    return view("candidate/signup_validation", $data);
                }
            }else if($_POST["status"] == "resend"){   // resend email
                $verificationNumber = Utilities::getValidationNumber();

                session()->setTempdata("signup_verification", $verificationNumber, 300);
        
                return view("candidate/signup_validation", $data);
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
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to(base_url("candidate/login"));
        }

        $data = [
            "currentUser" => $currentUser
        ];

        return view("candidate/setup_profile", $data);
    }

    public function inquiry(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login");
        }

        $inquiryModel = new CandidateInquiryModel();

        if($_POST){
            $question = $_POST["question"];

            if($question != ""){
                $data = [
                    "question" => $question,
                    "candidate_id" => $currentUser["CANDIDATE_ID"]
                ];

                $inquiryModel->createInquiry($data);
            }

            return redirect()->to("candidate/inquiry");
        }
        
        $inquiries = $inquiryModel->getInquiryByCandidateId($currentUser["CANDIDATE_ID"]);

        $data = [
            "currentUser" => $currentUser,
            "inquiries" => $inquiries
        ];

        return view("candidate/inquiry", $data);
    }

    public function job_application(){
        $currentUser = session()->get("currentUser");

        if($currentUser == null){
            return redirect()->to("candidate/login");
        }

        $applicationModel = new ApplicationModel();

        if($_POST){
            $application_id = $_POST["application_id"];
            $applicationModel->deleteApplication($application_id);

            return redirect()->to(base_url("candidate/job/application"));
        }

        $applications = $applicationModel->getApplicationByCandidateId($currentUser["CANDIDATE_ID"]);

        $data = [
            "currentUser" => $currentUser,
            "applications" => $applications
        ];

        return view("candidate/job_application", $data);
    }
}
