<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Change_password extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
	}

	function index_post() {
		$cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->post('username'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC')->result();
		if($cek!=NULL){
			foreach ($cek as $key => $value) {
				$role = $this->Main_model->getSelectedData('user_to_role a', 'b.route', array('a.user_id'=>$value->id,'b.deleted'=>'0'), "",'','','',array(
					'table' => 'user_role b',
					'on' => 'a.role_id=b.id',
					'pos' => 'left'
				))->result();
				if($role==NULL){
					$hasil['status'] = 'Akun Anda tidak dikenali sistem';
					$this->response($hasil, 200);
				}else{
					$data_update = array(
						'pass' => $this->post('new_password')
					);
					$this->Main_model->updateData('user',$data_update,array('id'=>$value->id));
					$this->Main_model->log_activity($value->id,'Update password','Update password user (via mobile apps)');
					$hasil['status'] = 'Password telah berhasil diubah';
					$this->response($hasil, 200);
				}
			}
		}
		else{
			$hasil['status'] = 'Username/ Email yang Anda masukkan tidak terdaftar';
			$this->response($hasil, 200);
		}
	}

	function index_put() {
	}

	function index_delete() {
    }
}