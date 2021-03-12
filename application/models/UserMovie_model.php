<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserMovie_model extends CI_Model {
    
    function __construct()
	{
		parent::__construct();
    }
    
    function getMovieID($imbID)
    {
        $this->db->select('id');
        $this->db->from('movie');
        $this->db->where('imdbID', $imbID);
        $q = $this->db->get();

        return $q->result();
    }

	function checkDuplicate($userID, $imbID)
	{
		$this->db->select('*');
        $this->db->from('user_movie');
        $this->db->join('movie', 'movie.id = user_movie.movie_id');
        $this->db->where('user_movie.user_id', $userID);
        $this->db->where('movie.imdbID', $imbID);
        
		return $this->db->count_all_results();
    }

    function checkIfExistEntry($userID, $imbID)
    {
		$this->db->select('*');
		$this->db->from('user_movie');
        $this->db->where('user_id', $userID);
        $this->db->where('movie_id', $imbID);
        
		return $this->db->count_all_results();
    }

    function getAllMovieByUser($userID)
    {
        $this->db->select('movie.imdbID');
        $this->db->from('user_movie');
        $this->db->join('movie', 'movie.id = user_movie.movie_id');
        $this->db->where('user_id', $userID);

        return $this->db->get();
    }

	function insertUserMovie($data)
	{
        $moveID = $this->getMovieID($data['movie_id']);
        $data['movie_id'] = $moveID[0]->id;

		if($this->db->insert('user_movie', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	function deletedUserMovi($data)
	{
		if($this->db->delete('user_movie', $data))
		{
			return  $this->db->insert_id();
		}
		else
		{
			return false;
		}
    }
}