<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CC_Controller
{

	// Load the necessary libraries
	function __construct()
	{
		parent::__construct();

		// load the libraries after the code has been set.
		$this->load->model('movie_model');
		$this->load->helper('file');

	}

	public function index()
	{
    $this->build('pages/index');

	}

	public function now_showing()
	{

		$this->build('pages/now_showing');

	}

	public function coming_soon()
	{
		$data = [
			'movies'	=> $this->movie_model->get_movies()
		];

		$this->build('pages/coming_soon', $data);

	}
}
