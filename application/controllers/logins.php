<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends CI_Controller {

	public function index()
	{
		$data = array(
			'errors' => $this->session->flashdata('error'),
			'logout' => $this->session->flashdata('logout'),
			'login' => $this->session->flashdata('login_message')
		);
		$this->load->view('login', $data);
	}
	public function welcome()
	{
		$this->load->model('user_quote');
		$user_id = $this->session->userdata('user_id');
		$favorites = $this->user_quote->get_user_quotes_by_user_id($user_id);
		$other_quotes = $this->user_quote->get_all_quotes_except_user($user_id);
		$error = $this->session->flashdata('error');
		$info = array(
			'favorites' => $favorites,
			'other_quotes' => $other_quotes,
			'error' => $error
		);
		$this->load->view('welcome', $info);
	}
	public function register()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "trim|required|alpha");
		$this->form_validation->set_rules("alias", "Alias", "trim|required");
		$this->form_validation->set_rules("email", "Email", "required|is_unique[users.email]|valid_email");
		$this->form_validation->set_rules("password", "Password", "required|min_length[8]");
		$this->form_validation->set_rules("confirm", "Confirm Password", "required|matches[password]");
		$this->form_validation->set_rules("birthday", "Birthday", "required");
		if($this->form_validation->run() === FALSE)
		{
			$data = validation_errors();
			$this->session->set_flashdata('error', $data);
			redirect('/');
		}	
		else
		{
			$this->output->enable_profiler(TRUE); 
			$this->load->model('login');
			$user_info = array(
				'name' => $this->input->post('name'),
				'alias' => $this->input->post('alias'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'birthday' =>$this->input->post('birthday')
			);
			$this->login->add_user($user_info);
			$this->session->set_flashdata('login_message', 'Registration complete. You may now login.');
			redirect('/');
		}	
	}
	public function login()
	{
		$this->output->enable_profiler(TRUE); 
		$this->load->model('login');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user_info = $this->login->get_user_by_email($email);
		if($user_info){
			if($user_info['password'] == $password){
				$this->session->set_userdata('alias', $user_info['alias']);
				$this->session->set_userdata('user_id', $user_info['id']);
				redirect('/welcome');
			}	
			else
			{
				$this->output->enable_profiler(TRUE); 
				$this->session->set_flashdata('error', 'incorrect password');
				redirect('/');
			}	
		}
		else{
			$this->session->set_flashdata('error', 'email does not exist');
			redirect('/');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout', 'you have successfully logged out');
		redirect('/');
	}
}
?>