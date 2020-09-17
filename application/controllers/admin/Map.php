<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Provinsi */
	public function province()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'province';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/province',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_peta_provinsi(){
		$get_data = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id_provinsi.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nm_provinsi'] = $value->nm_provinsi;
			$wilayah = '';
			if($value->wilayah=='1'){
				$wilayah = 'Wilayah I';
			}elseif($value->wilayah=='2'){
				$wilayah = 'Wilayah II';
			}
			elseif($value->wilayah=='3'){
				$wilayah = 'Wilayah III';
			}
			$isi['wilayah'] = $wilayah;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_provinsi/'.md5($value->id_provinsi)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_provinsi/'.md5($value->id_provinsi)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_province()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'province';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/add_province',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_province(){
		$this->db->trans_start();
		$file_kml = '';
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$file_kml = $gbr['file_name'];
			}
		}
		$data_insert = array(
			'nm_provinsi' => $this->input->post('nm_provinsi'),
			'wilayah' => $this->input->post('wilayah'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude'),
			'kml' => $file_kml
		);
		$this->Main_model->insertData("provinsi",$data_insert);

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Add province data (".$this->input->post('nm_provinsi').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_provinsi'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_provinsi/'</script>";
		}
	}
	public function edit_province()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'province';
		$data['data_utama'] = $this->Main_model->getSelectedData('provinsi a', 'a.*', array('md5(a.id_provinsi)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/edit_province',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_province_data(){
		$this->db->trans_start();
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$this->Main_model->updateData("provinsi",array('kml'=>$gbr['file_name']),array('md5(id_provinsi)'=>$this->input->post('id_provinsi')));
			}
		}
		$data_update = array(
			'nm_provinsi' => $this->input->post('nm_provinsi'),
			'wilayah' => $this->input->post('wilayah'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude')
		);
		$this->Main_model->updateData("provinsi",$data_update,array('md5(id_provinsi)'=>$this->input->post('id_provinsi')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Update province data (".$this->input->post('nm_provinsi').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_provinsi/".$this->input->post('id_provinsi')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_provinsi/'</script>";
		}
	}
	public function delete_province(){
		$this->db->trans_start();
		$nama_provinsi = '';

		$get_data = $this->Main_model->getSelectedData('provinsi a', 'a.*',array('md5(a.id_provinsi)'=>$this->uri->segment(3)))->row();
		$nama_provinsi = $get_data->nm_provinsi;

		$this->Main_model->deleteData('provinsi',array('md5(id_provinsi)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting province","Delete province (".$nama_provinsi.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_provinsi'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_provinsi'</script>";
		}
	}
	/* Kabupaten/ Kota */
	public function city()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'city';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/city',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_peta_kabupaten(){
		$get_data = $this->Main_model->getSelectedData('kabupaten a', 'a.*,b.nm_provinsi','','','','','',array(
			'table' => 'provinsi b',
			'on' => 'a.id_provinsi=b.id_provinsi',
			'pos' => 'LEFT'
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id_kabupaten.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nm_provinsi'] = $value->nm_provinsi;
			$isi['nm_kabupaten'] = $value->nm_kabupaten;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_kabkot/'.md5($value->id_kabupaten)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_kabkot/'.md5($value->id_kabupaten)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_city()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'city';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/add_city',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_city(){
		$this->db->trans_start();
		$file_kml = '';
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta_kabupaten/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$file_kml = $gbr['file_name'];
			}
		}
		$data_insert = array(
			'id_provinsi' => $this->input->post('id_provinsi'),
			'nm_kabupaten' => $this->input->post('nm_kabupaten'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude'),
			'kml' => $file_kml
		);
		$this->Main_model->insertData("kabupaten",$data_insert);

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Add city data (".$this->input->post('nm_kabupaten').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_kabkot'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kabkot/'</script>";
		}
	}
	public function edit_city()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'city';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$data['data_utama'] = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('md5(a.id_kabupaten)'=>$this->uri->segment(3)))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/edit_city',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_city_data(){
		$this->db->trans_start();
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta_kabupaten/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$this->Main_model->updateData("kabupaten",array('kml'=>$gbr['file_name']),array('md5(id_kabupaten)'=>$this->input->post('id_kabupaten')));
			}
		}
		$data_update = array(
			'id_provinsi' => $this->input->post('id_provinsi'),
			'nm_kabupaten' => $this->input->post('nm_kabupaten'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude')
		);
		$this->Main_model->updateData("kabupaten",$data_update,array('md5(id_kabupaten)'=>$this->input->post('id_kabupaten')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Update city data (".$this->input->post('nm_kabupaten').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_kabkot/".$this->input->post('id_kabupaten')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kabkot/'</script>";
		}
	}
	public function delete_city(){
		$this->db->trans_start();
		$nama_kabupaten = '';

		$get_data = $this->Main_model->getSelectedData('kabupaten a', 'a.*',array('md5(a.id_kabupaten)'=>$this->uri->segment(3)))->row();
		$nama_kabupaten = $get_data->nm_kabupaten;

		$this->Main_model->deleteData('kabupaten',array('md5(id_kabupaten)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting city","Delete city (".$nama_kabupaten.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kabkot'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kabkot'</script>";
		}
	}
	/* Kecamatan */
	public function sub_district()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'sub_district';
		$data_kecamatan = $this->Main_model->getSelectedData('kecamatan a', 'a.*',array('md5(a.id_kecamatan)'=>$this->uri->segment(3)))->result();
		$kml = '';
		$wilayah = '';
		foreach ($data_kecamatan as $key => $value) {
			$kml = $value->kml;
			$wilayah = $value->nm_kecamatan;
		}
		$data['wilayah'] = $wilayah;
		$data['kml'] = $kml;
		$data['data_marker'] = $this->Main_model->getSelectedData('desa a', 'a.*',array('md5(a.id_kecamatan)'=>$this->uri->segment(3)))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/sub_district',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_peta_kecamatan(){
		$get_data = $this->Main_model->getSelectedData('kecamatan a', 'a.*,b.nm_provinsi,c.nm_kabupaten','','','','','',array(
			array(
				'table' => 'provinsi b',
				'on' => 'a.id_provinsi=b.id_provinsi',
				'pos' => 'left'
			),
			array(
				'table' => 'kabupaten c',
				'on' => 'a.id_kabupaten=c.id_kabupaten',
				'pos' => 'left'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id_kecamatan.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nm_provinsi'] = $value->nm_provinsi;
			$isi['nm_kabupaten'] = $value->nm_kabupaten;
			$isi['nm_kecamatan'] = $value->nm_kecamatan;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_kecamatan/'.md5($value->id_kecamatan)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_kecamatan/'.md5($value->id_kecamatan)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>
								';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function add_sub_district()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'sub_district';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/add_sub_district',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_sub_district(){
		$this->db->trans_start();
		$file_kml = '';
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta_kec/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$file_kml = $gbr['file_name'];
			}
		}
		$data_insert = array(
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'nm_kecamatan' => $this->input->post('nm_kecamatan'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude'),
			'kml' => $file_kml
		);
		$this->Main_model->insertData("kecamatan",$data_insert);

		$this->Main_model->log_activity($this->session->userdata('id'),'Tambah data',"Tambah data Kecamatan (".$this->input->post('nm_kecamatan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_kecamatan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kecamatan/'</script>";
		}
	}
	public function edit_sub_district()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'sub_district';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$data['data_utama'] = $this->Main_model->getSelectedData('kecamatan a', 'a.*,b.nm_kabupaten', array('md5(a.id_kecamatan)'=>$this->uri->segment(3)),'','','','',array(
			'table' => 'kabupaten b',
			'on' => 'a.id_kabupaten=b.id_kabupaten',
			'pos' => 'LEFT'
		))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/edit_sub_district',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_sub_district_data(){
		$this->db->trans_start();
		$nmfile = "file_".time();
		$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/assets/peta_kec/';
		$config['allowed_types'] = 'kml';
		$config['max_size'] = '9072';
		$config['file_name'] = $nmfile;

		$this->upload->initialize($config);

		if(isset($_FILES['kml']['name']))
		{
			if(!$this->upload->do_upload('kml'))
			{
				echo'';
			}
			else
			{
				$gbr = $this->upload->data();
				$this->Main_model->updateData("kecamatan",array('kml'=>$gbr['file_name']),array('md5(id_kecamatan)'=>$this->input->post('id_kecamatan')));
			}
		}
		$data_update = array(
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'nm_kecamatan' => $this->input->post('nm_kecamatan'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude')
		);
		$this->Main_model->updateData("kecamatan",$data_update,array('md5(id_kecamatan)'=>$this->input->post('id_kecamatan')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Update sub_district data (".$this->input->post('nm_kecamatan').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_kecamatan/".$this->input->post('id_kecamatan')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kecamatan/'</script>";
		}
	}
	public function delete_sub_district(){
		$this->db->trans_start();
		$nama_kecamatan = '';

		$get_data = $this->Main_model->getSelectedData('kecamatan a', 'a.*',array('md5(a.id_kecamatan)'=>$this->uri->segment(3)))->row();
		$nama_kecamatan = $get_data->nm_kecamatan;

		$this->Main_model->deleteData('kecamatan',array('md5(id_kecamatan)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Hapus data","Hapus data Kecamatan (".$nama_kecamatan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kecamatan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kecamatan'</script>";
		}
	}
	/* Kelurahan */
	public function village()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'village';
		$data_kecamatan = $this->Main_model->getSelectedData('kecamatan a', 'a.*',array('md5(a.id_kecamatan)'=>$this->uri->segment(3)))->result();
		$kml = '';
		$wilayah = '';
		foreach ($data_kecamatan as $key => $value) {
			$kml = $value->kml;
			$wilayah = $value->nm_kecamatan;
		}
		$data['wilayah'] = $wilayah;
		$data['kml'] = $kml;
		$data['data_marker'] = $this->Main_model->getSelectedData('desa a', 'a.*',array('md5(a.id_kecamatan)'=>$this->uri->segment(3)))->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/village',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_peta_kelurahan(){
		$return_on_click = "return confirm('Anda yakin?')";
		$action =	'<div class="btn-group">
						<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
							<i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="'.site_url('admin_side/ubah_data_kelurahan/$1').'">
									<i class="icon-wrench"></i> Ubah Data </a>
							</li>
							<li>
								<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_kelurahan/$1').'">
									<i class="icon-trash"></i> Hapus Data </a>
							</li>
						</ul>
					</div>';
		$this->load->library('datatables');
		$this->datatables->select('a.id_desa,b.nm_provinsi,c.nm_kabupaten,d.nm_kecamatan,a.nm_desa');
		$this->datatables->from('desa a');
		$this->datatables->join('provinsi b', 'a.id_provinsi = b.id_provinsi','LEFT');
		$this->datatables->join('kabupaten c', 'a.id_kabupaten = c.id_kabupaten','LEFT');
		$this->datatables->join('kecamatan d', 'a.id_kecamatan = d.id_kecamatan','LEFT');
		$this->datatables->add_column('action', $action, 'md5(id_desa)');
		echo $this->datatables->generate();
	}
	public function add_village()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'village';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/add_village',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_village(){
		$this->db->trans_start();
		$get_last_data = $this->Main_model->getSelectedData('desa a', 'a.*', array('a.id_kecamatan'=>$this->input->post('id_kecamatan'),'a.id_kabupaten'=>$this->input->post('id_kabupaten'),'a.id_provinsi'=>$this->input->post('id_provinsi')),'a.id_desa DESC',1)->row_array();
		$id_desa = '';
		if($get_last_data==NULL){
			$id_desa = $this->input->post('id_kecamatan').'001';
		}else{
			$id_desa = $get_last_data['id_desa']+1;
		}
		$data_insert = array(
			'id_desa' => $id_desa,
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'nm_desa' => $this->input->post('nm_desa'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude')
		);
		$this->Main_model->insertData("desa",$data_insert);

		$this->Main_model->log_activity($this->session->userdata('id'),'Tambah data',"Tambah data desa (".$this->input->post('nm_desa').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_kelurahan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kelurahan/'</script>";
		}
	}
	public function edit_village()
	{
		$data['parent'] = 'master';
		$data['child'] = 'map';
		$data['grand_child'] = 'village';
		$data['provinsi'] = $this->Main_model->getSelectedData('provinsi a', 'a.*')->result();
		$data['data_utama'] = $this->Main_model->getSelectedData('desa a', 'a.*,b.nm_kabupaten,c.nm_kecamatan', array('md5(a.id_desa)'=>$this->uri->segment(3)),'','','','',array(
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
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/map/edit_village',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_village_data(){
		$this->db->trans_start();
		$data_update = array(
			'id_provinsi' => $this->input->post('id_provinsi'),
			'id_kabupaten' => $this->input->post('id_kabupaten'),
			'id_kecamatan' => $this->input->post('id_kecamatan'),
			'nm_desa' => $this->input->post('nm_desa'),
			'bujur' => $this->input->post('longitude'),
			'lintang' => $this->input->post('latitude')
		);
		$this->Main_model->updateData("desa",$data_update,array('md5(id_desa)'=>$this->input->post('id_desa')));

		$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Update village data (".$this->input->post('nm_desa').")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/ubah_data_kelurahan/".$this->input->post('id_desa')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kelurahan/'</script>";
		}
	}
	public function delete_village(){
		$this->db->trans_start();
		$nama_desa = '';

		$get_data = $this->Main_model->getSelectedData('desa a', 'a.*',array('md5(a.id_desa)'=>$this->uri->segment(3)))->row();
		$nama_desa = $get_data->nm_desa;

		$this->Main_model->deleteData('desa',array('md5(id_desa)'=>$this->uri->segment(3)));

		$this->Main_model->log_activity($this->session->userdata('id'),"Hapus data","Hapus data desa (".$nama_desa.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kelurahan'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kelurahan'</script>";
		}
	}
}