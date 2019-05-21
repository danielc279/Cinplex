<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slot extends CC_Controller
{
	// Load the necessary libraries
	function __construct()
	{
		parent::__construct();

		// load the libraries after the code has been set.
		$this->load->model('slot_model');
		$this->load->model('movie_model');
		$this->load->helper('file');
	}

	public function index()
	{
		$data = [
			'slots'	=> $this->slot_model->get_slots()
		];

		$this->build('slot/index', $data);
	}

	public function create($submit = FALSE)
	{
		// If submit is not FALSE, we'll try checking the form.
		if ($submit !== FALSE)
		{
			return $this->_do_create();
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'room'	=> $this->slot_model->get_rooms_array(),
      'time'	=> $this->slot_model->get_times_array(),
			'movies'	=> $this->movie_model->get_titles_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('slot/create', $data);
	}

	public function delete($id = NULL)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$slot = $this->slot_model->get_slot($id))
		{
			show_404();
		}

		// Delete the file and redirect.
		$this->slot_model->delete_slot($slot['id']);

		redirect('slot');
	}

	public function edit($id = NULL, $submit = FALSE)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$slot = $this->slot_model->get_slot($id))
		{
			show_404();
		}

		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit($slot);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$slot['time'] = $this->slot_model->get_showing_time($slot['id']);

		$data = [
			'slot'  => $slot,
			'movies'		=> $this->movie_model->get_titles_array(),
			'room' => $this->slot_model->get_rooms_array(),
			'time'	=> $this->slot_model->get_times_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('slot/edit', $data);
	}

	// Process the creation form.
	private function _do_create()
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$this->fv->set_rules([
			[
				'field'	=> 'slot-movie',
				'label'	=> 'Movie',
				'rules' => 'required'
			],
			[
				'field'	=> 'slot-room',
				'label'	=> 'Room',
				'rules' => 'required'
			],
			[
				'field'	=> 'slot-date',
				'label'	=> 'Date',
				'rules' => 'required'
			]
		]);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->create();
		}

		// 4. Get the inputs from the form.
		$movie			= $this->input->post('slot-movie');
		$room				= $this->input->post('slot-room');
		$date				= $this->input->post('slot-date');
		$time				= $this->input->post('slot-time') ?: [];

		// 5. Try to insert the data in its tables, and get back the ID.
		$slot_id = $this->slot_model->create_slot($movie, $room, $date, $time);
		if ($slot_id === FALSE)
		{
			exit("Your movie could not be posted. Please go back and try again.");
		}

		redirect('slot');
	}

	// Process for the edit form.
	private function _do_edit($slot)
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$rules = [
			[
				'field'	=> 'slot-movie',
				'label'	=> 'Movie',
				'rules' => 'required'
			],
			[
				'field'	=> 'slot-room',
				'label'	=> 'Room',
				'rules' => 'required'
			],
			[
				'field'	=> 'slot-date',
				'label'	=> 'Date',
				'rules' => 'required'
			]
		];

		$this->fv->set_rules($rules);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->edit($slot['id']);
		}

		// 4. Get the inputs from the form.
		$movie			= $this->input->post('slot-movie');
		$room				= $this->input->post('slot-room');
		$date				= $this->input->post('slot-date');
		$time				= $this->input->post('slot-time') ?: [];

		// 5. Check if anything has changed in the form.
		if ($slot['movie_id'] != $movie || $slot['room_id'] != $room || $slot['date'] != $date)
		{
			// change the entry in the database.
			if (!$this->slot_model->update_showing($slot['id'], $movie, $room, $date))
			{
				exit("Your article could not be edited. Please go back and try again.");
			}
		}

		if (!$this->slot_model->replace_time($slot['id'], $time))
		{
			exit("Your article could not be edited. Please go back and try again.");
		}
		redirect('slot');
	}

	// Checks that the folder exists, creates it if not.
	private function _build_dir($dir)
	{
		// we don't need to do anything if the folder exists.
		if (file_exists($dir)) return;

		$segments = explode('/', $dir);
		$path = '';

		while (count($segments) > 0)
		{
			// array_shift -> removes the first element from $segments
			// and returns it as a string.
			$path .= array_shift($segments) . '/';
			if (!file_exists($path)) mkdir($path);
		}
	}
}
