<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public $_module      = 'user';

	public function __construct() {
        parent::__construct();
    }
	
	// load index/root route
	public function index() {
		$data = [];
		$data['page_title'] 	= "User Resgistratin";
		$data['divisions'] 		= $this->global_model->get('divisions');
		$data['examinations'] 	= $this->global_model->get('examinations',['status'=>'active']);
		$data['universities'] 	= $this->global_model->get('universities',['status'=>'active']);
		$data['boards'] = $this->global_model->get('boards',['status'=>'active']);
		$data['layout'] = $this->load->view($this->_module . '/registration_form', $data, TRUE);
		$this->load->view('template', $data);
	}



}
