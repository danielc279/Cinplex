<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookings extends CC_Controller
{

	// Load the necessary libraries
	function __construct()
	{
		parent::__construct();

		// load the libraries after the code has been set.
		$this->load->model('booking_model');
		$this->load->helper('file');

	}

	public function index()
	{
        $user_id = $this->session->userdata('id');

		$data = [
			'bookings'	=> $this->booking_model->get_bookings_by_user($user_id)
		];


    $this->build('bookings/index', $data);

	}
}
