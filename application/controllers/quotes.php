<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function index()
	{

	}
	public function add_quote()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("quoted_by", "Quoted_by", "trim|required|alpha");
		$this->form_validation->set_rules("quote", "Quote", "trim|required");
		if($this->form_validation->run() === FALSE)
		{
			$data = validation_errors();
			$this->session->set_flashdata('error', $data);
			redirect('/welcome');
		}	
		else{
			$quote = $this->input->post('quote');
			$quoted_by = $this->input->post('quoted_by');
			$this->load->model('quote');
			$quote_info = array(
				'quote' => $quote,
				'quoted_by' => $quoted_by
			);
			$this->quote->add_quote($quote_info);
			redirect('/welcome');
		}

	}

}
?>