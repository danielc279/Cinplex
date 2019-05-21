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
			'cycles'	=> $this->date_model->get_dates()
		];

    $this->build('date/index', $data);

	}

	public function edit($id)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$date = $this->date_model->get_dates())
		{
			show_404();
		}

		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit($date);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'date'		=> $date,
		];

		$this->build('date/edit', $data);
	}

	// Process for the edit form.
	private function _do_edit($movie)
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$rules = [
			[
				'field'	=> 'movie-title',
				'label'	=> 'Title',
				'rules' => 'required|min_length[5]'
			],
			[
				'field'	=> 'movie-desc',
				'label'	=> 'Content',
				'rules' => 'required|min_length[50]'
			],
			[
				'field'	=> 'movie-release',
				'label'	=> 'Content',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-runtime',
				'label'	=> 'Content',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-rating',
				'label'	=> 'Content',
				'rules' => 'required'
			]
		];

		// if a file was uploaded, we'll add the rules to the array.
		if ($_FILES['movie-image']['name'] != '')
		{
			$rules[] = [
				'field'	=> 'movie-image',
				'label'	=> 'Image',
				'rules' => 'file_size_max[8mb]|file_allowed_type[jpg]'
			];
		}

		// if a file was uploaded, we'll add the rules to the array.
		if ($_FILES['movie-poster']['name'] != '')
		{
			$rules[] = [
				'field'	=> 'movie-poster',
				'label'	=> 'Poster',
				'rules' => 'file_size_max[2mb]|file_allowed_type[jpg]'
			];
		}

		$this->fv->set_rules($rules);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->edit($movie['id']);
		}

		// 4. Get the inputs from the form.
		$title			= $this->input->post('movie-title');
		$description	= $this->input->post('movie-desc');
		$release_date	= $this->input->post('movie-release');
		$runtime		= $this->input->post('movie-runtime');
		$rating			= $this->input->post('movie-rating');
		$genre			= $this->input->post('movie-genre') ?: [];

		// 5. Check if anything has changed in the form.
		if ($movie['title'] != $title || $movie['release_date'] != $release_date || $movie['runtime'] != $runtime || $movie['rating_id'] != $rating)
		{
			// change the entry in the database.
			if (!$this->movie_model->update_movie($movie['id'], $title, $release_date, $runtime, $rating))
			{
				exit("Your article could not be edited. Please go back and try again.");
			}
		}

	}

}
