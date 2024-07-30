<?php

class Blogs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		// tedy 
		$this->load->view("v_dashboard");
	}
}
