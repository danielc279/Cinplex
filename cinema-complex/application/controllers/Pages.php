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
		$this->load->model('slot_model');
		$this->load->model('movie_model');
		$this->load->helper('file');

	}

	public function index()
	{
		$movies = $this->slot_model->get_movies_showing();
		foreach ($movies as &$movie)
		{
		$movie['date'] = $this->slot_model->get_date_by_movie($movie['movie_id']);
		$movie['time'] = $this->slot_model->get_time_by_movie($movie['movie_id']);
		}

		$data = [
			'movies' => $movies

		];

		$this->build('pages/index', $data);

	}

	public function now_showing()
	{
		$movies = $this->slot_model->get_movies_showing();
		foreach ($movies as &$movie)
		{
		$movie['date'] = $this->slot_model->get_date_by_movie($movie['movie_id']);
		$movie['time'] = $this->slot_model->get_time_by_movie($movie['movie_id']);
		}

		$data = [
			'movies' => $movies

		];

		$this->build('pages/now_showing', $data);

	}

	public function coming_soon()
	{
		$data = [
			'movies'	=> $this->movie_model->get_movies()
		];

		$this->build('pages/coming_soon', $data);

	}

	public function ticket($id = NULL)
	{
		if (!$movie = $this->movie_model->get_movie_by_id($id))
		{
			show_404();
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$movie['poster'] = $this->_get_poster_path($movie['id']);

		$data = [
			'movie'		=> $movie,
			'slot'		=> $this->slot_model->get_slot($movie['id']),
			'room'		=> $this->slot_model->get_showing_room($movie['id']),
			'ratings' => $this->movie_model->get_ratings_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build("pages/ticket", $data);
	}

	public function seats()
	{

	}

	public function pay()
	{

	}

	public function receipt()
	{

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
