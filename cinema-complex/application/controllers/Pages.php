<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CC_Controller
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
		$this->load->model('booking_model');
		$this->load->helper('file');

	}

	public function index($date = NULL)
	{
		$movies = $this->slot_model->get_movies_showing();
		foreach ($movies as &$movie)
		{
		$movie['date'] = $this->slot_model->get_date_by_movie($movie['movie_id']);
		$movie['time'] = $this->slot_model->get_time_by_movie($movie['movie_id']);
		}

		$data = [
			'movies' => $movies,
			'weekdates' => $this->date_model->get_dates(),
			'datecode'	=> $date
		];

		$this->build('pages/index', $data);

	}

	public function now_showing($date = NULL)
	{
		$movies = $this->slot_model->get_movies_showing();
		foreach ($movies as &$movie)
		{
		$movie['date'] = $this->slot_model->get_date_by_movie($movie['movie_id']);
		$movie['time'] = $this->slot_model->get_time_by_movie($movie['movie_id']);
		}

		$data = [
			'movies' => $movies,
			'weekdates' => $this->date_model->get_dates(),
			'datecode'	=> $date
		];

		$this->build('pages/now_showing', $data);

	}

	public function coming_soon()
	{
		$data = [
			'movies'	=> $this->movie_model->get_movies(),
			'datecode'	=> $this->date_model->get_date()
		];

		$this->build('pages/coming_soon', $data);

	}

	public function seats($date = NULL, $slot = NULL, $id = NULL, $submit = FALSE)
	{
		$movie = $this->slot_model->get_movies_showing($id);
		$seats = $this->slot_model->get_showing_room($id);
		$user_id = $this->session->userdata('id');

		$movie['date'] = $date;
		$movie['time'] = $slot;

		if ($submit !== FALSE)
		{
			return $this->_do_ticket_create($date, $slot, $id);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'movie'		=> $movie,
			'slots'		=> $this->slot_model->get_slot($id),
			'seats'		=> 	$seats,
			'taken'		=> $this->booking_model->get_seats_taken($id, $slot),
			'ratings' => $this->movie_model->get_ratings_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build("pages/seats", $data);
	}

	// Process the creation form.
	private function _do_ticket_create($date, $slot, $id)
	{
		$seats = $this->input->post('seat') ?: [];

		if (count($seats) == 0)
		{
			$this->seats($date, $slot, $id);
		}

		$user_id = $this->session->userdata('id');
		$this->load->library('encryption');
		$code = bin2hex($this->encryption->create_key(32));

		$this->booking_model->create_ticket($user_id, $id, $slot, $seats, $code);

		redirect("ticket/{$code}");
	}

	private function _go_to_receipt()
	{
		$this->load->library('encryption');
        $code = bin2hex($this->encryption->create_key(32));

        // inserting the ticket in the database.

        redirect("process/receipt/{$code}");
	}

	public function ticket($code = NULL)
	{
		$this->load->library(['user_agent' => 'ua']);

		$data = [
			'booking'		=> $this->booking_model->get_bookings_by_code($code),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build("pages/ticket", $data);
	}

	// Looks for an image with a particular ID and returns the path.
	private function _get_poster_path($id, $to_array = FALSE)
	{
		// Use glob to get all the images matching this name.
		$files = glob("{$this->posters_folder}/{$id}.*");
		if ($to_array) return $files;

		if (count($files) > 0) return $files[0];
		return '';
	}
}
