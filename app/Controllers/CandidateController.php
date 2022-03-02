<?php

namespace App\Controllers;
use App\Models\ProfileModel;
use App\Libraries\Utilities;

class CandidateController extends BaseController
{
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
                    'rules' => 'required|valid_email',
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
                    "validation" => $this->validator
                ];
    
                return view("candidate/signup", $data);
            }else{   // valid input and go to email validation
                $email = $_POST["email"];

                session()->setTempdata("signup_email", $email, 1200);

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
        echo session()->get("signup_verification");
    }

    public function profile(){
        $profileModel = new ProfileModel();

        $profiles = $profileModel->getProfiles();

        $data = ["profiles" => $profiles];

        return view("candidate/profile", $data);
    }
}
