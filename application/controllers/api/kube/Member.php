<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Member extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_kube')!=NULL){
			if($this->get('user_id')!=NULL){
				$get_data_anggota_kube = $this->Main_model->getSelectedData('anggota_kube a', 'a.id_anggota_kube', array('a.user_id'=>$this->get('user_id'),'a.id_kube'=>$this->get('id_kube')))->row();
				$this->response($get_data_anggota_kube, 200);
			}else{
			}
		}else{
		}
	}

	function index_post() {
	}

	function index_put() {
	}

	function index_delete() {
    }
}