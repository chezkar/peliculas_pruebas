<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Film extends CI_Controller {
	private $kapi = '55dbf5d0';

	function __construct()
	{
		parent::__construct();
		$this->check_login();
		$this->load->model('Movie_model');
		$this->load->model('UserMovie_model');
	}

	function index()
	{
		$this->output->delete_cache();
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	function seachFilm()
	{
		$this->output->delete_cache();
		$userID = $this->session->userdata('id');
		$ids = $this->UserMovie_model->getAllMovieByUser($userID);
		$imgEmpty = 'https://dilavr.com.ua/image/catalog/empty-img.png';
		$num_files = 0;
		$num_rows = 0;

		$i = 1;
		$j = 1;
		$kl = 0;
		$words = str_replace(' ', '+', $this->input->post('txt'));
        $client = 'http://www.omdbapi.com';
        $res = '/?s='.$words.'&apikey='.$this->kapi;
		
		// set HTTP header
		$headers = array('Content-Type: application/json',);
		// the url of the API you are contacting to 'consume' 
		$url = $client.$res; 
		// Open connection
		$ch = curl_init();

		// Set the url, number of GET vars, GET data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// Execute request
		$result = curl_exec($ch);

		// Close connection
		curl_close($ch);

		// get the result and parse to JSON
		$items = json_decode($result);
		$films = get_object_vars($items);

		if($films['Response'] == 'True')
		{
			$num_files = count($films['Search']);
			$num_rows = floor($num_files/2);
			$remainder = $num_files%1;
			
			$data['thmls'] = $films['Search'];
			$data['num_files'] = $num_files;
			$data['num_rows'] = $num_rows;
			$data['imgEmpty'] = $imgEmpty;
			$data['ids'] = $ids;
			
			$data['i'] = $i;
			$data['j'] = $j;
			$data['k'] = $kl;
		}elseif ($films['Response'] == 'False') {
			$data['error'] = true;
		}

		$this->load->view('search', $data);
	}

	function saveFilm()
	{
		$imbID = $this->input->post('imbID');
		$userID = $this->session->userdata('id');
		$getMovieID = $this->Movie_model->getMovieID($imbID);

		if($this->UserMovie_model->checkDuplicate($userID, $imbID))
		{
			echo 'DP';
		}else{
			if($this->Movie_model->checkDuplicate($imbID)){
				$insertMovie = $this->UserMovie_model->insertUserMovie(['movie_id' => $imbID, 'user_id' => $userID]);

				echo 'SC';
			}else{
				$insertMovie = $this->Movie_model->insertMovieWithUser(['imdbID' => $imbID], $userID);

				echo 'SC';
			}
		}
	}

	function deleteFilm()
	{
		$imbID = $this->input->post('imbID');
		$userID = $this->session->userdata('id');
		$getMovieID = $this->Movie_model->getMovieID($imbID);

		if(isset($getMovieID[0]))
		{
			$data['user_id'] = $userID;
			$data['movie_id'] = $getMovieID[0]->id;

			if($this->UserMovie_model->checkIfExistEntry($userID, $getMovieID[0]->id))
			{
				$this->UserMovie_model->deletedUserMovi($data);
				echo 'SC';
			}else{
				echo 'NA';
			}
		}else{
			echo 'NA';
		}
	}

	function check_login()
	{
		$user = $this->session->userdata('email');

		if(!$user)
		{
			redirect('login');
		}
	}

}