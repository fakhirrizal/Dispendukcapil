<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_server extends CI_Controller {

	public function index()
    {
		$this->load->view('rest_server/rest_server');
		// $this->load->view('rest_server/documentation');
    }
	public function documentation()
    {
		// $this->load->view('rest_server/rest_server');
		$this->load->view('rest_server/documentation');
    }
}
