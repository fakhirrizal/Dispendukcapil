<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		if (!$this->migration->current()) {
			show_error($this->migration->error_string());
		} else {
			echo 'Migration worked!';
		}
	}
}