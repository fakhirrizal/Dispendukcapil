<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Master extends REST_Controller {

	function __construct()
	{
		parent::__construct();

		$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	}
	function index_get() {
		if($this->get('id_sarling')!=NULL){
			$hasil = $this->Main_model->getSelectedData('sarling a', 'a.id_sarling,a.nama_tim,a.alamat,a.rencana_anggaran,(SELECT COUNT(ak.id_anggota_sarling) FROM anggota_sarling ak WHERE ak.id_sarling=a.id_sarling) AS jumlah_anggota,e.jenis_sarling,f.nm_provinsi,b.nm_kabupaten,c.nm_kecamatan,d.nm_desa', array('id_sarling'=>$this->get('id_sarling'),'a.deleted'=>'0'),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'desa d',
					'on' => 'a.id_desa=d.id_desa',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'jenis_sarling e',
					'on' => 'a.id_jenis_sarling=e.id_jenis_sarling',
					'pos' => 'LEFT'
				)
			))->row();
			$this->response($hasil, 200);
		}else{
			$hasil = $this->Main_model->getSelectedData('sarling a', 'a.id_sarling,a.nama_tim,a.alamat,a.rencana_anggaran,(SELECT COUNT(ak.id_anggota_sarling) FROM anggota_sarling ak WHERE ak.id_sarling=a.id_sarling) AS jumlah_anggota,e.jenis_sarling,f.nm_provinsi,b.nm_kabupaten,c.nm_kecamatan,d.nm_desa', array('a.deleted'=>'0'),'','','','',array(
				array(
					'table' => 'provinsi f',
					'on' => 'a.id_provinsi=f.id_provinsi',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'kabupaten b',
					'on' => 'a.id_kabupaten=b.id_kabupaten',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'kecamatan c',
					'on' => 'a.id_kecamatan=c.id_kecamatan',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'desa d',
					'on' => 'a.id_desa=d.id_desa',
					'pos' => 'LEFT'
				),
				array(
					'table' => 'jenis_sarling e',
					'on' => 'a.id_jenis_sarling=e.id_jenis_sarling',
					'pos' => 'LEFT'
				)
			))->result();
			$this->response($hasil, 200);
		}
	}

	function index_post() {
	}

	function index_put() {
		$data = array(
			'jumlah_umkm'			=> $this->put('jumlah_umkm'),
			'bidang_usaha_terbesar'	=> $this->put('bidang_usaha_terbesar'));
		$this->db->where('id_desa', $this->put('id_desa'));
		$update = $this->db->update('desa', $data);
		if ($update) {
			// $this->response(array('status' => 'Update is successful', 200));
			// $this->response(array('status' => '1', 200));
			echo "success";
		} else {
			// $this->response(array('status' => 'Failed, please try again', 502));
			// $this->response(array('status' => '0', 502));
			echo "failed";
		}
	}

	function index_delete() {
    }
}