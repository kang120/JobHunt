<?php 

namespace App\Controllers;
//use App\Libraries\Utilities;

use App\Models\EmployerModel;
use App\Models\CompanyModel;
use App\Models\JobModel;
use App\Models\JobApplicationModel;

class EmployerController extends BaseController
{

	public function add_job()
	{

		$data["company_id"] = $_GET['company_id'];
		return view("employer/add_job",$data);
	}


	public function update_job()
	{
		$jobModel = new JobModel();
		$jobs = $jobModel->getJobsDetails();

		$data["jobs"] = $jobs;

		 if(isset($_GET["job_id"])){
			$data["job_id"]=$_GET['job_id'];

			return view("employer/update_job", $data);
		}

		//return redirect()->to(base_url() . "/employer/profile");
		return view("employer/update_job", $data); //use for self test page , delete this at the end
	}

	public function edit_applications()
	{
		$jobModel = new JobModel();
		$jobs = $jobModel->getJobsDetails();

		$jobApplicationModel = new JobApplicationModel();
		$applicants = $jobApplicationModel->getJobsApplicants();

		$data["jobs"] = $jobs;
		$data["applicants"] = $applicants;

		 if(isset($_GET["job_id"])){
			$data["job_id"]=$_GET['job_id'];

			return view("employer/edit_applications", $data);
		}
		
		//return redirect()->to(base_url() . "/employer/job_post");
		return view("employer/edit_applications", $data);//use for self test page , delete this at the end

	}

	public function job_post()
	{
		$jobModel = new JobModel();
		$jobs = $jobModel->getJobsDetails();

		$jobApplicationModel = new JobApplicationModel();
		$applicants = $jobApplicationModel->getJobsApplicants();

		$data["jobs"] = $jobs;
		$data["applicants"] = $applicants;

		 if(isset($_GET["job_id"])){
			$data["job_id"]=$_GET['job_id'];

			return view("employer/job_post", $data);
		}

		//return redirect()->to(base_url() . "/employer/profile");
		return view("employer/job_post", $data); //use for self test page , delete this at the end


	}	

	public function company_profile()
	{
		$jobModel = new JobModel();
		$jobs = $jobModel->getJobsDetails();
		$jobsresults = $jobModel->getJobsResults();

		$companyModel = new CompanyModel();
		$companies = $companyModel->getCompanies();

		$data["companies"] = $companies;
		$data["jobs"] = $jobs;
		$data["jobsresults"] = $jobsresults;


		 if(isset($_GET["company_id"])){
			$data["company_id"]=$_GET['company_id'];
			$data["employer_login_id"]=$_GET['employer_login_id'];
			
			return view("employer/company_profile", $data);
		}

		//return redirect()->to(base_url() . "/employer/profile");
		return view("employer/company_profile", $data); //use for self test page
	}	

	public function profile()
	{
		$employerModel = new EmployerModel();
		$employers = $employerModel->getEmployers();

		$companyModel = new CompanyModel();
		$companies = $companyModel->getCompanies();

		$data["companies"] = $companies;
		$data["employers"] = $employers;


		return view("employer/profile", $data);
	}	

	public function insert_new_company()
	{
	   $companyModel = new CompanyModel();

        $data = [
             "name"     =>$this->request->getPost("name"),
             "location" =>$this->request->getPost("location"),
             "industry" =>$this->request->getPost("industry"),
             "size"     =>$this->request->getPost("size"),
             "photo"    =>$this->request->getPost("photo"),
             "employer_id"=>$this->request->getPost("employer_id")  
        ];  

        $companyModel->save($data);
	   $employerLoginID=$this->request->getGet('employer_login_id');

	   return redirect()->to(base_url()."/employer/profile?employer_login_id=".$employerLoginID);
	}


	public function edit_employer()
	{
    	helper(['form', 'url']);
        
        // $error = $this->validate([
        //     'name' 	=> 'required|min_length[3]',
        //     'email' => 'required|valid_email',
        //     'gender'=> 'required'
        // ]);

        $EmployerModel = new EmployerModel();

        $id = $this->request->getVar('employer_id'); //get from form

        // if(!$error)
        // {
        // 	$data['user_data'] = $crudModel->where('id', $id)->first();
        // 	$data['error'] = $this->validator;
        // 	echo view('edit_data', $data);
        // } 
        // else 
        // {
        $data = [
            'first_name' => $this->request->getVar('firstname'),
            'last_name'  => $this->request->getVar('lastname'),
            'birthday'  => $this->request->getVar('birthday'),
            'gender'  => $this->request->getVar('gender'),
            'phone'  => $this->request->getVar('phone'),
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password1'),

        ];

        $EmployerModel->update($id, $data);
        $employerLoginID = $this->request->getGet('employer_login_id'); //get from url, actually same

        return redirect()->to(base_url()."/employer/profile?employer_login_id=".$employerLoginID);
	}

	public function edit_company()
	{
    	helper(['form', 'url']);

        $CompanyModel = new CompanyModel();

        $id = $this->request->getVar('company_id');

        $data = [
            'name' => $this->request->getVar('name'),
            'location'  => $this->request->getVar('location'),
            'industry'  => $this->request->getVar('industry'),
            'size'  => $this->request->getVar('size'),
            'photo'  => $this->request->getVar('photo')

        ];

        	$CompanyModel->update($id, $data);

		$companyID=$this->request->getVar('company_id');
		$employerID=$this->request->getVar('employer_login_id');

        	return redirect()->to(base_url()."/employer/company_profile?company_id=".$companyID."&employer_login_id=".$employerID);
    
	}

	public function edit_job()
	{
    	helper(['form', 'url']);

        $JobModel = new JobModel();

        $id = $this->request->getVar('job_id');


        $data = [
        "title"     		=>$this->request->getPost("job-title"),
        "salary" 			=>$this->request->getPost("salary"),
        "description" 		=>$this->request->getPost("description"),
        "scope"     		=>$this->request->getPost("scope"),
        "requirement"    	=>$this->request->getPost("requirement"),
        "type"    			=>$this->request->getPost("type"),
        "specialization"   =>$this->request->getPost("specialization"),
        "qualification"    =>$this->request->getPost("qualification"),
        "career_level"   	=>$this->request->getPost("career"),             
        "company_id"		=>$this->request->getPost("company_id")
        ];

        	$JobModel->update($id, $data);



		$companyID=$this->request->getVar('company_id');
		$jobID=$this->request->getVar('job_id');

        	return redirect()->to(base_url()."/employer/job_post?job_id=".$jobID."&company_id=".$companyID);
       
	}


	public function delete_company()
	{

        $CompanyModel = new CompanyModel();
        $companyID=$this->request->getVar('company_id');
        $CompanyModel->where("company_id", $companyID)->delete();	

	   $employerLoginID=$this->request->getGet('employer_login_id');
        return redirect()->to(base_url()."/employer/profile?employer_login_id=".$employerLoginID);
	}


	public function delete_job()
	{

        $JobModel = new JobModel();
        $JobID=$this->request->getPost('job_id');
        $JobModel->where("job_id", $JobID)->delete();	

		$companyID=$this->request->getPost('company_id');
		$employerID=$this->request->getPost('employer_login_id');
        return redirect()->to(base_url()."/employer/company_profile?company_id=".$companyID."&employer_login_id=".$employerID);
       // }


	}

	public function update_applications()
	{

		$jobApplicationModel = new JobApplicationModel();
		$applicants = $jobApplicationModel->getJobsApplicants();

		$data["applicants"] = $applicants;



		echo $this->request->getPost('total-data');
		// echo $_POST['1'];
		echo "here";

		$total_applications = intval($this->request->getPost('total-data'));
		$jobID = $this->request->getPost("job_id");

		echo "start";
		$results = array("PENDING","SUCCESS", "REJECTED");
		foreach($results as $result){
		foreach($applicants as $applicant){
			if($applicant["JOB_ID"] == $jobID ){
				if($applicant["RESULT"]==$result){
				// echo $_POST[$applicant["APPLICATION_ID"]];


		        $id = $applicant["APPLICATION_ID"];

			        $data = ["result"=>$this->request->getPost($id),];

		        	$jobApplicationModel->update($id, $data);

				}	
			}
		}
		}
		echo "end";
		for ($i=0; $i < $total_applications; $i++) { 
			//echo var_dump($applicants);
		}

        return redirect()->to(base_url()."/employer/edit_applications?job_id=".$jobID);
      
	}		

}