<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Desa extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_provinsi')!=NULL){
			$hasil = $this->Main_model->getSelectedData('desa a', 'a.id_desa,a.nm_desa,c.nm_kecamatan,b.nm_kabupaten,f.nm_provinsi', array('a.id_provinsi'=>$this->get('id_provinsi')),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'left'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'left'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'left'
				)
			))->result();
			$this->response($hasil, 200);
		}elseif($this->get('id_kabupaten')!=NULL){
			$hasil = $this->Main_model->getSelectedData('desa a', 'a.id_desa,a.nm_desa,c.nm_kecamatan,b.nm_kabupaten,f.nm_provinsi', array('a.id_kabupaten'=>$this->get('id_kabupaten')),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'left'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'left'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'left'
				)
			))->result();
			$this->response($hasil, 200);
		}elseif($this->get('id_kecamatan')!=NULL){
			$hasil = $this->Main_model->getSelectedData('desa a', 'a.id_desa,a.nm_desa,c.nm_kecamatan,b.nm_kabupaten,f.nm_provinsi', array('a.id_kecamatan'=>$this->get('id_kecamatan')),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'left'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'left'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'left'
				)
			))->result();
			$this->response($hasil, 200);
		}elseif($this->get('id_desa')!=NULL){
			$hasil = $this->Main_model->getSelectedData('desa a', 'a.id_desa,a.nm_desa,c.nm_kecamatan,b.nm_kabupaten,f.nm_provinsi', array('a.id_desa'=>$this->get('id_desa')),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'left'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'left'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'left'
				)
			))->row();
			$this->response($hasil, 200);
		}else{
			$hasil = $this->Main_model->getSelectedData('desa a', 'a.id_desa,a.nm_desa,c.nm_kecamatan,b.nm_kabupaten,f.nm_provinsi','','','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'left'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'left'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'left'
				)
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