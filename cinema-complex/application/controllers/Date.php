<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Date extends CC_Controller
{

	// This is the folder path all text will upload to.
	var $posters_folder = 'uploads/movies/posters';

	// Load the necessary libraries
	function __construct()
	{
		parent::__construct();

		// load the libraries after the code has been set.
		$this->load->model('date_model');
		$this->load->model('slot_model');
		$this->load->model('movie_model');
		$this->load->helper('file');

	}

	public function index()
	{
		$data = [
			'dates'	=> $this->date_model->get_dates()
		];


    $this->build('date/index', $data);

	}

	public function edit($submit = FALSE)
	{
		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit();
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'date' => $this->date_model->get_date(),
			'dates' => $this->date_model->get_dates()
		];

		$this->build('date/edit', $data);
	}

	// Process for the edit form.
	private function _do_edit()
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$rules = [
			[
				'field'	=> 'cycle-date',
				'label'	=> 'Date',
				'rules' => 'required'
			]
		];

		$this->fv->set_rules($rules);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->edit();
		}

		// 4. Get the inputs from the form.
		$date	= $this->input->post('cycle-date');

		for ($i = 0; $i < 7; $i++)
		{
			// can be used to check the day: $day = date('D', strtotime($date));
			$day = date('Y-m-d', strtotime($date . "+{$i} days"));
			$this->date_model->update_dates($i, $day);
		}

		redirect('date');
	}

}
