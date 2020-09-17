<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Report extends REST_Controller {

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
		$this->db->trans_start();
		$get_data_anggota = $this->Main_model->getSelectedData('anggota_kube a', 'a.*', array('a.id_anggota_kube'=>$this->post('id_anggota_kube')))->row();
		$get_id_laporan_kube = $this->Main_model->getLastID('laporan_kube','id_laporan_kube');
		$get_data_kube = $this->Main_model->getSelectedData('kube a', 'a.*', array('a.id_kube'=>$this->post('id_kube')))->row();
		$data_indikator = $this->Main_model->getSelectedData('indikator a', 'a.*')->result();

		$data_insert2 = array(
			'id_laporan_kube' => $get_id_laporan_kube['id_laporan_kube']+1,
			'id_master_indikator' => $this->post('id_tipe_indikator'),
			'indikator_progres_fisik' => $this->post('indikator'),
			'penjelasan_progres_fisik' => $this->post('penjelasan_progres_fisik'),
			'progres_keuangan' => $this->post('progres_keuangan')
		);
		// print_r($data_insert2);
		$this->Main_model->insertData('detail_laporan_kube',$data_insert2);

		$gabung_indikator = '';
		$cek_laporan_kube = $this->Main_model->getSelectedData('laporan_kube a', 'a.*', array('a.id_kube'=>$this->post('id_kube'),'a.deleted'=>'0'),'a.created_at DESC','1')->row();
		$explode_indikator = explode(',',$gabung_indikator);
		$get_status_laporan_kube = $this->Main_model->getSelectedData('status_laporan_kube a', 'a.*', array('a.id_kube'=>$this->post('id_kube')))->row();
		$persentase_fisik = (count($explode_indikator)/count($data_indikator))*100;
		if($cek_laporan_kube==NULL){
			$gabung_indikator = $this->post('indikator');
			$data_insert1 = array(
				'id_laporan_kube' => $get_id_laporan_kube['id_laporan_kube']+1,
				'id_anggota_kube' => $this->post('id_anggota_kube'),
				'user_id' => $get_data_anggota->user_id,
				'id_kube' => $this->post('id_kube'),
				'indikator' => $this->post('indikator'),
				'persentase_fisik' => $persentase_fisik,
				'anggaran' => $this->post('progres_keuangan'),
				'persentase_anggaran' => ($this->post('progres_keuangan')/$get_data_kube->rencana_anggaran)*100,
				'persentase_realisasi' => ((($this->post('progres_keuangan')/$get_data_kube->rencana_anggaran)*100)+$persentase_fisik)/2,
				'keterangan' => $this->post('keterangan'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $get_data_anggota->user_id
			);
			// print_r($data_insert1);
			$this->Main_model->insertData('laporan_kube',$data_insert1);
		}else{
			$a = $cek_laporan_kube->indikator;
			$b = $this->post('indikator');
			$array1 = explode(',',$a);
			$array2 = explode(',',$b);
			$result = array_merge($array1, $array2);
			$uniques = array_unique($result);
			// print_r($uniques);
			$string = implode(',',$uniques);
			$gabung_indikator = $string;
			$data_insert1 = array(
				'id_laporan_kube' => $get_id_laporan_kube['id_laporan_kube']+1,
				'id_anggota_kube' => $this->post('id_anggota_kube'),
				'user_id' => $get_data_anggota->user_id,
				'id_kube' => $this->post('id_kube'),
				'indikator' => $string,
				'persentase_fisik' => $persentase_fisik,
				'anggaran' => $this->post('progres_keuangan'),
				'persentase_anggaran' => ($this->post('progres_keuangan')/$get_data_kube->rencana_anggaran)*100,
				'persentase_realisasi' => ((($this->post('progres_keuangan')/$get_data_kube->rencana_anggaran)*100)+$persentase_fisik)/2,
				'keterangan' => $this->post('keterangan'),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $get_data_anggota->user_id
			);
			// print_r($data_insert1);
			$this->Main_model->insertData('laporan_kube',$data_insert1);
		}

		if($get_status_laporan_kube==NULL){
			$persentase_anggaran = ($this->post('progres_keuangan')/$get_data_kube->rencana_anggaran)*100;
			$persentase_realisasi = ($persentase_anggaran+$persentase_fisik)/2;
			$data_insert3 = array(
				'id_kube' => $this->post('id_kube'),
				'persentase_fisik' => $persentase_fisik,
				'anggaran' => $this->post('progres_keuangan'),
				'persentase_anggaran' => $persentase_anggaran,
				'persentase_realisasi' => $persentase_realisasi
			);
			// print_r($data_insert3);
			$this->Main_model->insertData('status_laporan_kube',$data_insert3);
		}else{
			$persentase_anggaran = (($this->post('progres_keuangan')+$get_status_laporan_kube->anggaran)/$get_data_kube->rencana_anggaran)*100;
			$persentase_realisasi = ($persentase_anggaran+$persentase_fisik)/2;
			$data_update1 = array(
				'persentase_fisik' => $persentase_fisik,
				'anggaran' => $this->post('progres_keuangan')+$get_status_laporan_kube->anggaran,
				'persentase_anggaran' => $persentase_anggaran,
				'persentase_realisasi' => $persentase_realisasi
			);
			// print_r($data_update1);
			$this->Main_model->updateData('status_laporan_kube',$data_update1,array('id_kube'=>$get_status_laporan_kube->id_kube));
		}
		$this->Main_model->log_activity($get_data_anggota->user_id,'Adding data',"Add kube's report data (".$get_data_kube->nama_tim.") via Mobile Apps");
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$hasil['status'] = 'Gagal';
			$this->response($hasil, 200);
		}
		else{
			$hasil['status'] = 'Sukses';
			$this->response($hasil, 200);
		}
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