<?php

namespace App\Controllers;

use App\Models\JobModel;

class HomeController extends BaseController
{
	public function home(){
		if(isset($_GET["status"]) && $_GET["status"] == "signout"){
			session()->remove("currentUser");

			return redirect()->to(base_url());
		}

		return view("home2");
	}

	public function search_job(){
		$jobModel = new JobModel();

		$jobs = $jobModel->getJobsDetails();
		
		$data = ["jobs" => $jobs];

		return view("search_job", $data);
	}

	public function test(){
		$jobModel = new JobModel();

		$jobs = $jobModel->getJobsDetails();
		
		$data = ["jobs" => $jobs];

		return view("test", $data);
	}
}
