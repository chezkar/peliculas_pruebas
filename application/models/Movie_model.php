<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movie_model extends CI_Model {
    
    function __construct()
	{
		parent::__construct();
	}

	function checkDuplicate($data)
	{
		$this->db->select('id');
		$this->db->from('movie');
		$this->db->where('imdbID', $data);
		
		return $this->db->count_all_results();
	}

	function insertMovie($data)
	{
		if($this->db->insert('movie', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function insertMovieWithUser($data, $userID)
	{
		if($this->db->insert('movie', $data))
		{
			$um['movie_id'] = $this->db->insert_id();
			$um['user_id'] = $userID;

			if($this->db->insert('user_movie', $um))
			{
				return $this->db->insert_id();
			}
		}
		else
		{
			return false;
		}
	}

	function getMovieID($imbID)
    {
        $this->db->select('id');
        $this->db->from('movie');
		$this->db->where('imdbID', $imbID);
		$q = $this->db->get();

        return $q->result();
	}
	
	function getMovieByID($id)
	{
		$this->db->select('id');
        $this->db->from('movie');
		$this->db->where('id', $id);
		$q = $this->db->get();

        return $q->result();
	}
}