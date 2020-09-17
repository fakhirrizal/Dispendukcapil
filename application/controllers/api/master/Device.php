<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Device extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('user_id')!=NULL){
			$hasil = $this->Main_model->getSelectedData('user a', 'a.verification_token AS device_id', array('a.id'=>$this->get('user_id'),'a.is_active'=>'1','a.deleted'=>'0'))->result();
			$this->response($hasil, 200);
		}else{
			$hasil = array();
			$this->response($hasil, 200);
		}
	}

	function index_post() {
		$cek = $this->Main_model->getSelectedData('user a', 'a.*,f.fullname', array("a.id" => $this->post('user_id'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC','','','',array(
			'table' => 'user_profile f',
			'on' => 'a.id=f.user_id',
			'pos' => 'left'
		))->row();
		if($cek==NULL){
			$hasil['status'] = 'User tidak ditemukan';
			$this->response($hasil, 200);
		}else{
			$data_update = array(
				'verification_token' => $this->post('device_id')
			);
			$this->Main_model->updateData('user',$data_update,array('id'=>$cek->id));
			$this->Main_model->log_activity($cek->id,'Updating data user','Update Device ID via mobile apps ('.$cek->fullname.')');
			$hasil['status'] = 'Device ID telah berhasil diubah';
			$this->response($hasil, 200);
		}
	}

	function index_put() {
		$cek = $this->Main_model->getSelectedData('user a', 'a.*,f.fullname', array("a.id" => $this->put('user_id'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC','','','',array(
			'table' => 'user_profile f',
			'on' => 'a.id=f.user_id',
			'pos' => 'left'
		))->row();
		if($cek==NULL){
			$hasil['status'] = 'User tidak ditemukan';
			$this->response($hasil, 200);
		}else{
			$data_update = array(
				'verification_token' => $this->put('device_id')
			);
			$this->Main_model->updateData('user',$data_update,array('id'=>$cek->id));
			$this->Main_model->log_activity($cek->id,'Updating data user','Update Device ID via mobile apps ('.$cek->fullname.')');
			$hasil['status'] = 'Device ID telah berhasil diubah';
			$this->response($hasil, 200);
		}
	}

	function index_delete() {
    }
}