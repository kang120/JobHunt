<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view("home");
	}

	public function home2(){
		return view("home2");
	}

	public function search_job(){
		return view("search_job");
	}
}
