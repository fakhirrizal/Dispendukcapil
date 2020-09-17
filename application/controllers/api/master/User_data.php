<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User_data extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('user_id')!=NULL){
			$hasil = $this->Main_model->getSelectedData('user a', 'a.id AS user_id,a.username,a.pass AS password,f.fullname AS nama_lengkap,f.nin AS nik,f.bdt_id AS id_bdt,f.pkh_id AS id_pkh,f.kks_id AS id_kks,f.birth_date AS tanggal_lahir,f.address AS alamat,f.photo AS foto', array('a.id'=>$this->get('user_id'),'a.is_active'=>'1','a.deleted'=>'0'),'','','','',array(
				'table' => 'user_profile f',
				'on' => 'a.id=f.user_id',
				'pos' => 'left'
			))->row();
			$this->response($hasil, 200);
		}else{
			$hasil = $this->Main_model->getSelectedData('user a', 'a.id AS user_id,a.username,a.pass AS password,f.fullname AS nama_lengkap,f.nin AS nik,f.bdt_id AS id_bdt,f.pkh_id AS id_pkh,f.kks_id AS id_kks,f.birth_date AS tanggal_lahir,f.address AS alamat,f.photo AS foto',array('a.id !='=>'1','a.is_active'=>'1','a.deleted'=>'0'),'','','','',array(
				'table' => 'user_profile f',
				'on' => 'a.id=f.user_id',
				'pos' => 'left'
			))->result();
			$this->response($hasil, 200);
		}
	}

	function index_post() {
	}

	function index_put() {
	}

	function index_delete() {
    }
}