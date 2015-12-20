<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_quotes extends CI_Controller {

	public function index()
	{

	}
	public function remove($users_quote_id)
	{
		$this->load->model('user_quote');
		$this->user_quote->remove($users_quote_id);
		redirect('/welcome');
	}
	public function add_to_favorites($quote_id)
	{
		$this->load->model('user_quote');
		$this->user_quote->add_to_favorites($quote_id);
		redirect('/welcome');

	}
}
?>