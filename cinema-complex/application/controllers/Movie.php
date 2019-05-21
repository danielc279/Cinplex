<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CC_Controller
{
	// This is the folder path all text will upload to.
	var $desc_folder = 'uploads/movies/descriptions';

	// This is the folder path all text will upload to.
	var $images_folder = 'uploads/movies/images';

	// This is the folder path all text will upload to.
	var $posters_folder = 'uploads/movies/posters';

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
		$data = [
			'movies'	=> $this->movie_model->get_movies()
		];

		$this->build('movie/index', $data);
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
			'genre'	=> $this->movie_model->get_genres_array(),
			'ratings' => $this->movie_model->get_ratings_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('movie/create', $data);
	}

	public function delete($slug = NULL)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$movie = $this->movie_model->get_movie($slug))
		{
			show_404();
		}

		// Start by deleting the files for this article.
		$path = "{$this->desc_folder}/{$movie['id']}.txt";
		if (file_exists($path)) unlink($path);

		// Start by deleting the files for this article.
		$path2 = "{$this->posters_folder}/{$movie['id']}.jpg";
		if (file_exists($path2)) unlink($path2);

		// Start by deleting the files for this article.
		$path3 = "{$this->images_folder}/{$movie['id']}.jpg";
		if (file_exists($path3)) unlink($path3);

		// Delete the file and redirect.
		$this->movie_model->delete_movie_genre($movie['id']);
		$this->movie_model->delete_movie($movie['id']);

		redirect('movie');
	}

	public function edit($slug = NULL, $submit = FALSE)
	{
		// Check if the article exists, and if it does
		// assign it to a variable.
		if (!$movie = $this->movie_model->get_movie($slug))
		{
			show_404();
		}

		// Check that the form was sent, if so do another process.
		if ($submit !== FALSE)
		{
			return $this->_do_edit($movie);
		}

		// loads the user-agent library to identify platform/browser.
		$this->load->library(['user_agent' => 'ua']);

		$movie['desc'] = read_file("{$this->desc_folder}/{$movie['id']}.txt");
		$movie['genre'] = $this->movie_model->get_movie_genre($movie['id']);
		$movie['image'] = $this->_get_image_path($movie['id']);
		$movie['poster'] = $this->_get_poster_path($movie['id']);

		$data = [
			'movie'		=> $movie,
			'genre'	=> $this->movie_model->get_genres_array(),
			'ratings' => $this->movie_model->get_ratings_array(),
			'platform'		=> strtolower($this->ua->platform())
		];

		$this->build('movie/edit', $data);
	}

	// Process the creation form.
	private function _do_create()
	{
		// 1. Load the form_validation library.
		$this->load->library(['form_validation' => 'fv']);

		// 2. Set the validation rules.
		$this->fv->set_rules([
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
				'label'	=> 'Release',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-runtime',
				'label'	=> 'Runtime',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-rating',
				'label'	=> 'Rating',
				'rules' => 'required'
			],
			[
				'field'	=> 'movie-poster',
				'label' => 'Poster',
				'rules' => 'file_required|file_allowed_type[jpg]'
			],
			[
				'field'	=> 'movie-image',
				'label' => 'Image',
				'rules' => 'file_required|file_allowed_type[jpg]'
			]
		]);

		// 3. If the validation failed, we'll reload.
		if ($this->fv->run() === FALSE)
		{
			return $this->create();
		}

		// 4. Get the inputs from the form.
		$title			= $this->input->post('movie-title');
		$description	= $this->input->post('movie-desc');
		$release_date	= $this->input->post('movie-release');
		$runtime		= $this->input->post('movie-runtime');
		$rating			= $this->input->post('movie-rating');
		$genre			= $this->input->post('movie-genre') ?: [];

		// 5. Try to insert the data in its tables, and get back the ID.
		$movie_id = $this->movie_model->create_movie($title, $release_date, $runtime, $rating, $genre);
		if ($movie_id === FALSE)
		{
			exit("Your movie could not be posted. Please go back and try again.");
		}

		// 6. If the folder path is missing, create it.
		$this->_build_dir($this->desc_folder);
		if (!write_file("{$this->desc_folder}/{$movie_id}.txt", $description))
		{
			// delete the record.
			exit("Your movie could not be posted. Please go back and try again.");
		}

		$this->_upload_image($movie_id);
		$this->_upload_poster($movie_id);

		redirect('movie');
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

			if (!$this->movie_model->replace_genre($movie['id'], $genre))
			{
				exit("Your article could not be edited. Please go back and try again.");
			}

		// 6. If the folder path is missing, create it.
		$this->_build_dir($this->desc_folder);
		if (!write_file("{$this->desc_folder}/{$movie['id']}.txt", $description))
		{
			// delete the record.
			exit("Your article could not be posted. Please go back and try again.");
		}

		$this->_build_dir($this->images_folder);
		if ($_FILES['movie-image']['name'] != '') $this->_upload_image($movie['id']);
		redirect('movie');

		$this->_build_dir($this->posters_folder);
		if ($_FILES['movie-poster']['name'] != '') $this->_upload_poster($movie['id']);
		redirect('movie');
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

	// Uploads an image to a specific folder using the article id as name.
	private function _upload_image($name)
	{
		// Since we're using this function for the article edit page,
		// we also need to delete the existing files first.
		$files = glob("{$this->images_folder}/{$name}.*");
		foreach ($files as $file) unlink($file);

		// Create the images folder if it doesn't exist.
		$this->_build_dir($this->images_folder);

		// Set up the configuration for this file upload.
		$config['upload_path']			= $this->images_folder;
		$config['file_name']			= $name;
		$config['allowed_types']		= 'jpg';
		$config['max_size']				= 2048;
		$config['file_ext_tolower']		= TRUE;

		// Load the upload library and set its configuration.
		$this->load->library('upload');
		$this->upload->initialize($config);

		// Check if the file has uploaded, and show an error if not.
		if (!$this->upload->do_upload('movie-image'))
		{
			exit($this->upload->display_errors());
		}
	}

	private function _upload_poster($name)
	{
		// Since we're using this function for the article edit page,
		// we also need to delete the existing files first.
		$files = glob("{$this->posters_folder}/{$name}.*");
		foreach ($files as $file) unlink($file);

		// Create the images folder if it doesn't exist.
		$this->_build_dir($this->posters_folder);

		// Set up the configuration for this file upload.
		$config['upload_path']			= $this->posters_folder;
		$config['file_name']			= $name;
		$config['allowed_types']		= 'jpg';
		$config['max_size']				= 2048;
		$config['file_ext_tolower']		= TRUE;

		// Load the upload library and set its configuration.
		$this->load->library('upload');
		$this->upload->initialize($config);

		// Check if the file has uploaded, and show an error if not.
		if (!$this->upload->do_upload('movie-poster'))
		{
			exit($this->upload->display_errors());
		}
	}

	// Looks for an image with a particular ID and returns the path.
	private function _get_image_path($id, $to_array = FALSE)
	{
		// Use glob to get all the images matching this name.
		$files = glob("{$this->images_folder}/{$id}.*");
		if ($to_array) return $files;

		if (count($files) > 0) return $files[0];
		return '';
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
