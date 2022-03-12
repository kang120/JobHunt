<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\CandidateInquiryModel;
use App\Models\EmployerInquiryModel;

class AdminController extends BaseController
{
	public function home(){
        if(session()->get("currentAdmin") == null){
            return redirect()->to(base_url("admin/login"));
        }

		return redirect()->to(base_url("admin/dashboard"));
	}

    public function login(){
        if($_POST){
            $validation = $this->validate([
                'username' => [
                    'rules' => 'required|is_not_unique[admin.name]',
                    'errors' => [
                        'required' => '* This field is required',
                        'is_not_unique' => '* Account does not exist'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* This field is required'
                    ]
                ]
            ]);

            // invalid input
            if(!$validation){
                $data = [
                    "validation" => $this->validator,
                    "username" => $_POST["username"]
                ];

                return view("admin/login", $data);
            }else{
                $adminModel = new AdminModel();

                $inputName = $_POST["username"];
                $inputPassword = $_POST["password"];

                $admin = $adminModel->getAdminByName($inputName);

                // incorrect password
                if($inputPassword != $admin["PASSWORD"]){
                    $data = [
                        "username" => $inputName,
                        "passwordError" => "Incorrect password"
                    ];

                    return view("admin/login", $data);
                }

                // correct password
                session()->set("currentAdmin", $admin);

                return redirect()->to(base_url("/admin"));
            }
        }

        return view("admin/login");
    }

    public function logout(){
        session()->remove("currentAdmin");

        return redirect()->to(base_url("admin"));
    }

    public function dashboard(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "dashboard",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/dashboard", $data);
    }

    public function candidate_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "candidate",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/candidateDM", $data);
    }

    public function candidate_profile_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "candidateProfile",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/candidate_profileDM", $data);
    }

    public function employer_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "employer",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/employerDM", $data);
    }

    public function company_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "company",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/companyDM", $data);
    }

    public function job_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "job",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/jobDM", $data);
    }

    public function job_application_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "jobApplication",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/job_applicationDM", $data);
    }

    public function candidate_inquiry_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        if($_POST){
            $inquiry_id = $_POST["inquiry_id"];
            $reply = $_POST["reply"];
            $admin_id = $currentAdmin["ADMIN_ID"];

            $data = [
                "answer" => $reply,
                "admin_id" => $admin_id
            ];

            $inquiryModel = new CandidateInquiryModel();
            $inquiryModel->update($inquiry_id, $data);

            return redirect()->to("admin/candidate_inquiry");
        }

        $data = [
            "page" => "candidateInquiry",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/candidate_inquiryDM", $data);
    }

    public function employer_inquiry_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        if($_POST){
            $inquiry_id = $_POST["inquiry_id"];
            $reply = $_POST["reply"];
            $admin_id = $currentAdmin["ADMIN_ID"];

            $data = [
                "answer" => $reply,
                "admin_id" => $admin_id
            ];

            $inquiryModel = new EmployerInquiryModel();
            $inquiryModel->update($inquiry_id, $data);

            return redirect()->to("admin/employer_inquiry");
        }

        $data = [
            "page" => "employerInquiry",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/employer_inquiryDM", $data);
    }

    public function admin_management(){
        $currentAdmin = session()->get("currentAdmin");

        if($currentAdmin == null){
            return redirect()->to("admin/login");
        }

        $data = [
            "page" => "admin",
            "currentAdmin" => $currentAdmin
        ];

        return view("admin/adminDM", $data);
    }
}