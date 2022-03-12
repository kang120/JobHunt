<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use App\Models\JobModel;

class HomeController extends BaseController
{
	public function home(){
		if(isset($_GET["status"]) && $_GET["status"] == "signout"){
			session()->remove("currentUser");

			return redirect()->to(base_url());
		}

		$currentUser = session()->get("currentUser");

		$data = [
			"currentUser" => $currentUser
		];

		return view("home", $data);
	}

	public function search_job(){
		$jobModel = new JobModel();

		$title = null;
		$location = null;
		$jobtype = null;

		if(isset($_GET["title"]) && $_GET["title"] != ""){
			$title = $_GET["title"];
		}

		if(isset($_GET["location"]) && $_GET["location"] != ""){
			$location = $_GET["location"];
		}

		if(isset($_GET["jobtype"]) && $_GET["jobtype"] != ""){
			$jobtype = $_GET["jobtype"];
		}

		if($title == null && $location == null && $jobtype == null){
			$jobs = $jobModel->getJobsDetails();
		}else{
			$query = [
				"TITLE" => $title,
				"LOCATION" => $location,
				"TYPE" => $jobtype
			];

			$jobs = $jobModel->getJobsByQuery($query);
		}

		$currentUser = session()->get("currentUser");
		
		$data = [
			"currentUser" => $currentUser,
			"jobs" => $jobs,
			"title" => $title,
			"location" => $location,
			"jobtype" => $jobtype
		];

		return view("search_job", $data);
	}

	public function job_details(){
		$currentUser = session()->get("currentUser");

		$job_id = $_GET["job_id"];

		$jobModel = new JobModel();
		$job = $jobModel->getJobById($job_id);

		// check user has applied in the past
		$hasApply = false;

		if($currentUser != null){
			$candidate_id = $currentUser["CANDIDATE_ID"];
			$hasApply = $jobModel->candidateHasApplied($candidate_id, $job_id);
		}

		// user click button to apply
		if(isset($_GET["status"]) && $_GET["status"] == "apply"){
			if($currentUser == null){
				return redirect()->to(base_url("candidate/login"));
			}

			$hasApply = true;

			$applicationModel = new ApplicationModel();

			$data = [
				"result" => "Pending",
				"job_id" => $job_id,
				"candidate_id" => $candidate_id,
				"company_id" => $job["COMPANY_ID"]
			];

			$applicationModel->createApplication($data);
		}

		$data = [
			"currentUser" => $currentUser,
			"job" => $job,
			"hasApply" => $hasApply
		];

		return view("job_details", $data);
	}
}
