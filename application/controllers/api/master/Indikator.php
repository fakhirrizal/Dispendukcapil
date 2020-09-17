<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Indikator extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_tipe')!=NULL){
			$hasil = $this->Main_model->getSelectedData('indikator a', 'a.id_indikator,f.master_indikator AS tipe,a.program,a.indikator', array('a.id_master_indikator'=>$this->get('id_tipe')),'','','','',array(
				'table' => 'master_indikator f',
				'on' => 'a.id_master_indikator=f.id_master_indikator',
				'pos' => 'left'
			))->result();
			$this->response($hasil, 200);
		}elseif($this->get('id_indikator')!=NULL){
			$hasil = $this->Main_model->getSelectedData('indikator a', 'a.id_indikator,f.master_indikator AS tipe,a.program,a.indikator', array('a.id_indikator'=>$this->get('id_indikator')),'','','','',array(
				'table' => 'master_indikator f',
				'on' => 'a.id_master_indikator=f.id_master_indikator',
				'pos' => 'left'
			))->row();
			$this->response($hasil, 200);
		}elseif($this->get('program')!=NULL){
			$hasil = $this->Main_model->getSelectedData('indikator a', 'a.id_indikator,f.master_indikator AS tipe,a.indikator', array('a.program'=>$this->get('program')),'','','','',array(
				'table' => 'master_indikator f',
				'on' => 'a.id_master_indikator=f.id_master_indikator',
				'pos' => 'left'
			))->row();
			$this->response($hasil, 200);
		}else{
			$hasil = $this->Main_model->getSelectedData('indikator a', 'a.id_indikator,f.master_indikator AS tipe,a.program,a.indikator','','','','','',array(
				'table' => 'master_indikator f',
				'on' => 'a.id_master_indikator=f.id_master_indikator',
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