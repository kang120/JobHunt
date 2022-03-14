<?php 

namespace App\Controllers;
//use App\Libraries\Utilities;

use App\Libraries\Utilities;
use App\Models\ApplicationModel;
use App\Models\CandidateModel;
use App\Models\EmployerModel;
use App\Models\CompanyModel;
use App\Models\EmployerInquiryModel;
use App\Models\JobModel;
use App\Models\JobApplicationModel;
use CodeIgniter\CLI\Commands;

class EmployerController extends BaseController
{

	public function login(){
		helper("url");

		if(isset($_GET["status"]) && $_GET["status"] == "signout"){
			session()->remove("currentEmployer");
		}

        if($_POST){
            $validation = $this->validate([
                'email' => [
                    'rules' => 'required|valid_email|is_not_unique[employer.email]',
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
                    "currentEmployer" => null,
                    "email" => $_POST["email"],
                    "validation" => $this->validator
                ];
    
                return view("employer/login", $data);
            }else{   // valid input and check password
                $employerModel = new EmployerModel();
                
                $email = $_POST["email"];
                $inputPassword = $_POST["password"];

                $currentEmployer = $employerModel->getEmployerByEmail($email);

                if($inputPassword == $currentEmployer["PASSWORD"]){
                    session()->set("currentEmployer", $currentEmployer);
                    return redirect()->to(base_url("employer/company/list"));
                }else{
                    $data = [
                        "currentEmployer" => null,
                        "email" => $_POST["email"],
                        "passwordError" => "Incorrect password"
                    ];

                    return view("employer/login", $data);
                }
            }
        }else{
            $data = [
                "currentEmployer" => null,
            ];

            return view("employer/login", $data);
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
                    'rules' => 'required|valid_email|is_unique[employer.email]',
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
                    "currentEmployer" => null,
                    "firstname" => $_POST["firstname"],
                    "lastname" => $_POST["lastname"],
                    "email" => $_POST["email"],
                    "validation" => $this->validator
                ];
    
                return view("employer/signup", $data);
            }else{   // valid input and go to email validation
                $email = $_POST["email"];

                $tempEmployer = [
                    "currentEmployer" => null,
                    "first_name" => $_POST["firstname"],
                    "last_name" => $_POST["lastname"],
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                ];

                session()->setTempdata("signup_email", $email, 1200);
                session()->set("tempEmployer", $tempEmployer);

                return redirect()->to(base_url() . "/employer/signup/validation?email=".$email)->with("is_signup", true);
            }
        }else{
            $data = [
                "currentEmployer" => null
            ];

            return view("employer/signup", $data);
        }
	}

	public function signup_validation(){
        $data = [
            "currentEmployer" => null
        ];

        // first time entry
        if(session()->getFlashdata("is_signup")){
            $verificationNumber = Utilities::getValidationNumber();

            session()->setTempdata("signup_verification", $verificationNumber, 300);
    
            return view("employer/signup_validation", $data);
        }else if($_POST){    // check input or resend email
            if($_POST["status"] == "submit"){
                $verificationNumber = session()->getTempdata("signup_verification");
    
                // correct validation
                if($verificationNumber && $_POST["input"] == $verificationNumber){
                    $currentEmployer = session()->get("tempEmployer");
                    session()->remove("tempEmployer");

                    // create new user in database
                    $employerModel = new EmployerModel();
                    $employerId = $employerModel->createEmployer($currentEmployer);

                    // set current employer to session data
                    $currentEmployer = $employerModel->getEmployerById($employerId);
                    session()->set("currentEmployer", $currentEmployer);

                    return redirect()->to(base_url("employer/company/list"));
                }else{   // wrong validation
                    $data["send_email"] = "no";
                    return view("employer/signup_validation", $data);
                }
            }else if($_POST["status"] == "resend"){   // resend email
                $verificationNumber = Utilities::getValidationNumber();

                session()->setTempdata("signup_verification", $verificationNumber, 300);
        
                return view("employer/signup_validation", $data);
            }
        }else{   // prevent access before sign up form
            return redirect()->to(base_url() . "/employer/signup");
        }
    }

	public function company_list(){
		$currentEmployer = session()->get("currentEmployer");

		if($currentEmployer == null){
			return redirect()->to(base_url("employer/login"));
		}

		$employerID = $currentEmployer["EMPLOYER_ID"];

		$companyModel = new CompanyModel();
		$companies = $companyModel->getCompaniesByEmployerId($employerID);

		$data = [
			"currentEmployer" => $currentEmployer,
			"companies" => $companies
		];

		if($_POST){
			$validation = $this->validate([
				"company_name" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"location" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"industry" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"min_employee" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				]	,
				"max_employee" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				]	
			]);
	
			if(!$validation){
				$data2 = [
					"currentEmployer" => $currentEmployer,
					"validation" => $this->validator,
					"company_name" => $_POST["company_name"],
					"location" => $_POST["location"],
					"industry" => $_POST["industry"],
					"min_employee" => $_POST["min_employee"],
					"max_employee" => $_POST["max_employee"]
				];

				$data = array_merge($data, $data2);

				if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
					$data["photo"] = file_get_contents($_FILES["photo"]["tmp_name"]);
					session()->set("tempPhoto", file_get_contents($_FILES["photo"]["tmp_name"]));
				}else if(isset($_POST["encode_photo"]) && $_POST["encode_photo"] == "1"){
					$data["photo"] = session()->get("tempPhoto");
				}
	
				return view("employer/company_list", $data);
			}

			$size = $_POST["min_employee"] . "-" . $_POST["max_employee"];
			$photo = null;
			
			if(is_uploaded_file($_FILES["photo"]["tmp_name"])){
				$photo = file_get_contents($_FILES["photo"]["tmp_name"]);
			}else{
				$photo = file_get_contents(base_url("assets/blank_building.jpg"));
			}

			$data = [
				"name" => $_POST['company_name'],
				"location" => $_POST['location'],
				"industry" => $_POST['industry'],
				"size" => $size,
				"photo" => $photo,
				"employer_id" => $currentEmployer["EMPLOYER_ID"]
			];

			$companyModel = new CompanyModel();
			$companyModel->createCompany($data);

			return redirect()->to(base_url("employer/company/list"));
		}

		return view("employer/company_list", $data);
	}

	public function view_company($index){
		$currentEmployer = session()->get("currentEmployer");

		if($currentEmployer == null){
			return redirect()->to(base_url("employer/login"));
		}

		$employer_id = $currentEmployer["EMPLOYER_ID"];

		// find company
		$companyModel = new CompanyModel();
		$companies = $companyModel->getCompaniesByEmployerId($employer_id);

		$company = $companies[$index];

		// find company job
		$jobModel = new JobModel();
		$jobs = $jobModel->getJobsByCompanyId($company["COMPANY_ID"]);
		
		$data = [
			"currentEmployer" => $currentEmployer,
			"company" => $company,
			"company_index" => $index,
			"jobs" => $jobs
		];

		if($_POST){
			$validation = $this->validate([
				"job_title" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"min_salary" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"max_salary" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"description" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"scope" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"requirement" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"type" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"specialization" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				],
				"qualification" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
					],
				"career_level" => [
					"rules" => "required",
					"errors" => [
						"required" => "* This field is required"
					]
				]
			]);

			if(!$validation){
				$data["validation"] = $this->validator;
				$data["min_salary"] = $_POST["min_salary"];
				$data["max_salary"] = $_POST["max_salary"];
				$data["description"] = $_POST["description"];
				$data["scope"] = $_POST["scope"];
				$data["requirement"] = $_POST["requirement"];
				$data["type"] = $_POST["type"];
				$data["specialization"] = $_POST["specialization"];
				$data["qualification"] = $_POST["qualification"];
				$data["career_level"] = $_POST["career_level"];

				return view("employer/view_company", $data);
			}else{
				$salary = "MYR " . $_POST["min_salary"] . " - " . $_POST["max_salary"] . " monthly";
				$scope = implode("\n", $_POST["scope"]);
				$requirement = implode("\n", $_POST["requirement"]);

				$data = [
					"title" => $_POST["job_title"],
					"salary" => $salary,
					"description" => $_POST["description"],
					"scope" => $scope,
					"requirement" => $requirement,
					"type" => $_POST["type"],
					"specialization" => $_POST["specialization"],
					"qualification" => $_POST["qualification"],
					"career_level" => $_POST["career_level"],
					"company_id" => $company["COMPANY_ID"]
				];

				$jobModel->createJob($data);

				return redirect()->to(base_url("employer/company/" . $index));
			}
		}

		return view("employer/view_company", $data);
	}

	// always POST method
	public function delete_job(){
		$currentEmployer = session()->get("currentEmployer");

		if($currentEmployer == null){
			return redirect()->to(base_url("employer/login"));
		}

		$job_id = $_POST["job_id"];
		$company_index = $_POST["company_index"];

		$jobModel = new JobModel();
		$jobModel->deleteJob($job_id);

		return redirect()->to(base_url("employer/company/" . $company_index));
	}

	// always POST method
	public function delete_company(){
		$currentEmployer = session()->get("currentEmployer");

		if($currentEmployer == null){
			return redirect()->to(base_url("employer/login"));
		}

		$company_id = $_POST["company_id"];

		$companyModel = new CompanyModel();
		$companyModel->deleteCompany($company_id);

		return redirect()->to(base_url("employer/company/list"));
	}

	// always POST method
	public function update_company(){
		$index = $_POST["index"];
		$company_id = $_POST["company_id"];
		$location = $_POST["location"];
		$industry = $_POST["industry"];
		$size = $_POST["size"];

		$data = [
			"company_id" => $company_id,
			"location" => $location,
			"industry" => $industry,
			"size" => $size
		];

		$companyModel = new CompanyModel();
		$companyModel->updateCompany($company_id, $data);

		return redirect()->to(base_url("employer/company/" . $index));
	}

	// always POST method
	public function edit_company_picture(){
		$currentEmployer = session()->get("currentEmployer");

		if($currentEmployer == null){
			return redirect()->to(base_url("employer/login"));
		}

		$employer_id = $currentEmployer["EMPLOYER_ID"];

		$photo = $_FILES["company_picture"]["tmp_name"];
		$company_index = $_POST["company_index"];

		// find company
		$companyModel = new CompanyModel();
		$company = $companyModel->getCompaniesByEmployerId($employer_id)[$company_index];
		$company_id = $company["COMPANY_ID"];

		$data = [
			"photo" => file_get_contents($photo)
		];

		$companyModel->updateCompany($company_id, $data);

		return redirect()->to(base_url("employer/company/$company_index"));
	}

	public function view_job($company_index, $job_index){
		$currentEmployer = session()->get("currentEmployer");

		$companyModel = new CompanyModel();
		$company = $companyModel->getCompaniesByEmployerId($currentEmployer["EMPLOYER_ID"])[$company_index];

		$jobModel = new JobModel();
		$job = $jobModel->getJobsByCompanyId($company["COMPANY_ID"])[$job_index];
		$job["SCOPE"] = explode("\n", $job["SCOPE"]);
		$job["REQUIREMENT"] = explode("\n", $job["REQUIREMENT"]);

		$applicationModel = new ApplicationModel();
		$applications = $applicationModel->getApplicationByJobId($job["JOB_ID"]);

		if($_POST){
			$status = $_POST["application_status"];
			$status_array = explode(",", $status);
			$id_array = [];
			
			foreach($applications as $application){
				array_push($id_array, $application["APPLICATION_ID"]);
			}

			$applicationModel->updateApplication($id_array, $status_array);

			return redirect()->to(base_url("employer/company/$company_index/job/$job_index"));
		}

		$applicants = [];
		$candidateModel = new CandidateModel();

		foreach($applications as $application){
			$candidate_id = $application["CANDIDATE_ID"];
			$candidate = $candidateModel->getCandidateById($candidate_id);
			$candidate["STATUS"] = $application["RESULT"];
			array_push($applicants, $candidate);
		}

		$data = [
			"currentEmployer" => $currentEmployer,
			"company" => $company,
			"job" => $job,
			"applicants" => $applicants
		];

		return view("employer/view_job", $data);
	}

	public function inquiry(){
		$currentEmployer = session()->get("currentEmployer");

        if($currentEmployer == null){
            return redirect()->to("employer/login");
        }

        $inquiryModel = new EmployerInquiryModel();

        if($_POST){
            $question = $_POST["question"];

            if($question != ""){
                $data = [
                    "question" => $question,
                    "employer_id" => $currentEmployer["EMPLOYER_ID"]
                ];

                $inquiryModel->createInquiry($data);
            }

            return redirect()->to("employer/inquiry");
        }
        
        $inquiries = $inquiryModel->getInquiryByEmployerId($currentEmployer["EMPLOYER_ID"]);

        $data = [
            "currentEmployer" => $currentEmployer,
            "inquiries" => $inquiries
        ];

        return view("employer/inquiry", $data);
	}
}