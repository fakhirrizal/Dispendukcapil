<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	/* Administrator */
	public function administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_admin(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '1'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['username'] = $value->username;
			$isi['total_login'] = number_format($value->total_login,0).'x';
			$pecah_tanggal = explode(' ',$value->last_activity);
			$isi['last_activity'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_admin/'.md5($value->id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_admin/'.md5($value->id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_admin/'.md5($value->id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
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
	public function add_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_administrator_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'fullname' => $this->input->post('nama')
			);
			$this->Main_model->insertData('user_profile',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '1'
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Admin (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
		}
		
	}
	public function detail_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		// $data['data_utama'] =  $this->Main_model->getSelectedData('kube a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_pembayaran'] = $this->Main_model->getSelectedData('purchasing a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->result();
		// $data['riwayat_kehadiran'] = $this->Main_model->getSelectedData('presence a', 'a.*', array('md5(a.user_id)'=>$this->uri->segment(3)))->result_array();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/detail_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function edit_administrator_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'administrator';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.*', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_administrator_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_administrator_data(){
		if($this->input->post('un')!=NULL){
			$cek_ = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$this->input->post('un')."' AND md5(a.id) NOT IN ('".$this->input->post('user_id')."')")->row();
			if($cek_==NULL){
				$this->db->trans_start();
				if($this->input->post('ps')!=NULL){
					$data_insert1 = array(
						'username' => $this->input->post('un'),
						'pass' => $this->input->post('ps')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				else{
					$data_insert1 = array(
						'username' => $this->input->post('un')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}

				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/ubah_data_admin/".$this->input->post('user_id')."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
				}
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/ubah_data_admin/".$this->input->post('user_id')."'</script>";
			}
		}elseif($this->input->post('ps')!=NULL){
			$this->db->trans_start();

			$data_insert1 = array(
				'pass' => $this->input->post('ps')
			);
			$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
			// print_r($data_insert1);

			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/ubah_data_admin/".$this->input->post('user_id')."'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
			}
		}else{
			echo "<script>window.location='".base_url()."admin_side/ubah_data_admin/".$this->input->post('user_id')."'</script>";
		}
	}
	public function reset_password_administrator_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update admin's data","Reset password admin's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	public function download_admin_data(){
		$this->load->view('admin/master/cetak_data_admin');
	}
	public function delete_administrator_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_profile',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting admin's data","Delete admin's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
		}
	}
	/* Member */
	public function member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function json_member(){
		$get_data1 = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname,c.nin,c.email,c.number_phone',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
		$data_tampil = array();
		$no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['checkbox'] =	'
								<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
									<input type="checkbox" class="checkboxes" name="selected_id[]" value="'.$value->id.'"/>
									<span></span>
								</label>
								';
			$isi['number'] = $no++.'.';
			$isi['nama'] = $value->fullname;
			$isi['nik'] = $value->nin;
			$isi['email'] = $value->email;
			$isi['hp'] = $value->number_phone;
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_anggota/'.md5($value->id)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_anggota/'.md5($value->id)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
										<li class="divider"> </li>
										<li>
											<a href="'.site_url('admin_side/atur_ulang_kata_sandi_anggota/'.md5($value->id)).'">
												<i class="fa fa-refresh"></i> Atur Ulang Sandi
											</a>
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
	public function add_member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/add_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function save_member_data(){
		$cek_ = $this->Main_model->getSelectedData('user a', 'a.*',array('a.username'=>$this->input->post('un')))->row();
		if($cek_==NULL){
			$this->db->trans_start();
			$get_user_id = $this->Main_model->getLastID('user','id');

			$data_insert1 = array(
				'id' => $get_user_id['id']+1,
				'username' => $this->input->post('un'),
				'pass' => $this->input->post('ps'),
				'is_active' => '1',
				'created_by' => $this->session->userdata('id'),
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData('user',$data_insert1);
			// print_r($data_insert1);

			$data_insert2 = array(
				'user_id' => $get_user_id['id']+1,
				'fullname' => $this->input->post('nama'),
				'nin' => $this->input->post('nik'),
				'number_phone' => $this->input->post('no_hp'),
				'email' => $this->input->post('email')
			);
			$this->Main_model->insertData('user_profile',$data_insert2);
			// print_r($data_insert2);

			$data_insert3 = array(
				'user_id' => $get_user_id['id']+1,
				'role_id' => '2'
			);
			$this->Main_model->insertData('user_to_role',$data_insert3);
			// print_r($data_insert3);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data Pengguna (".$this->input->post('nama').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil ditambahkan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_anggota/'</script>";
		}
		
	}
	public function edit_member_data()
	{
		$data['parent'] = 'master';
		$data['child'] = 'member';
		$data['grand_child'] = '';
		$data['data_utama'] = $this->Main_model->getSelectedData('user a', 'a.*,b.nin,b.fullname,b.email,b.number_phone', array('md5(a.id)'=>$this->uri->segment(3),'a.deleted'=>'0'), '', '', '', '', array(
			'table' => 'user_profile b',
			'on' => 'a.id=b.user_id',
			'pos' => 'LEFT'
		))->row();
		$this->load->view('admin/template/header',$data);
		$this->load->view('admin/master/edit_member_data',$data);
		$this->load->view('admin/template/footer');
	}
	public function update_member_data(){
		if($this->input->post('un')!=NULL){
			$cek_ = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$this->input->post('un')."' AND md5(a.id) NOT IN ('".$this->input->post('user_id')."')")->row();
			if($cek_==NULL){
				$this->db->trans_start();
				if($this->input->post('ps')!=NULL){
					$data_insert1 = array(
						'username' => $this->input->post('un'),
						'pass' => $this->input->post('ps')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				else{
					$data_insert1 = array(
						'username' => $this->input->post('un')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				$data_insert2 = array(
					'fullname' => $this->input->post('fullname'),
					'nin' => $this->input->post('nin'),
					'number_phone' => $this->input->post('number_phone'),
					'email' => $this->input->post('email')
				);
				$this->Main_model->updateData('user_profile',$data_insert2,array('md5(user_id)'=>$this->input->post('user_id')));
				// print_r($data_insert2);
				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/ubah_data_anggota/".$this->input->post('user_id')."'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
				}
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/ubah_data_anggota/".$this->input->post('user_id')."'</script>";
			}
		}else{
			echo "<script>window.location='".base_url()."admin_side/ubah_data_anggota/".$this->input->post('user_id')."'</script>";
		}
	}
	public function reset_password_member_account(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->updateData('user',array('pass'=>'1234'),array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Update member's data","Reset password member's account (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	public function delete_member_data(){
		$this->db->trans_start();
		$user_id = '';
		$name = '';
		$get_data = $this->Main_model->getSelectedData('user_profile a', 'a.*',array('md5(a.user_id)'=>$this->uri->segment(3)))->row();
		$user_id = $get_data->user_id;
		$name = $get_data->fullname;

		$this->Main_model->deleteData('user_profile',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user_to_role',array('user_id'=>$user_id));
		$this->Main_model->deleteData('user',array('id'=>$user_id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting member's data","Delete member's data (".$name.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_anggota/'</script>";
		}
	}
	/* Data KK */
	public function antrean_kk(){
		$data['parent'] = 'master';
        $data['child'] = 'antrean';
        $data['grand_child'] = 'antrean_kk';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/antrean_kk',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_kk(){
		$get_data1 = $this->Main_model->getSelectedData('data_kk a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['no_kk'] = $value->no_kk;
			$isi['nik'] = $value->nik;
			$isi['jk'] = $value->jk;
			$isi['nama'] = $value->nama;
            $isi['ttl'] = $value->tempat_lahir.', '.$this->Main_model->convert_tanggal($value->tgl_lahir);
            $isi['status'] = '';
            if($value->status=='Proses'){
                $isi['status'] = '<span class="label label-warning"> Proses </span>';
            }elseif($value->status=='Selesai'){
                $isi['status'] = '<span class="label label-success"> Selesai </span>';
            }else{
                echo'';
            }
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_antrean_kk/'.md5($value->id_data_kk)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_antrean_kk/'.md5($value->id_data_kk)).'">
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
	public function tambah_data_kk(){
		$data['parent'] = 'master';
        $data['child'] = 'antrean';
		$data['grand_child'] = 'antrean_kk';
		$data['data_anggota'] = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname,c.nin,c.email,c.number_phone',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_data_kk',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_data_kk(){
		$this->db->trans_start();
		$created_by = '';
		if($this->input->post('created_by')==NULL){
			$created_by = $this->session->userdata('id');
		}else{
			$created_by = $this->input->post('created_by');
		}
		$get_last_id = $this->Main_model->getLastID('data_kk','id_data_kk');
		$data_insert = array(
			'id_data_kk' => $get_last_id['id_data_kk']+1,
			'jenis_permohonan' => $this->input->post('jenis1'),
			'sub_jenis_permohonan' => $this->input->post('jenis2'),
			'status' => 'Proses',
			'created_by' => $created_by,
			'created_date' => date('Y-m-d H:i:s'),
			'wa' => '+62'.$this->input->post('wa'),
			'displayed' => '1'
		);
		$this->Main_model->insertData("data_kk",$data_insert);
		for ($i=1; $i <= $this->input->post('jumlah_file'); $i++) { 
			$nmfile = "file_".time(); // nama file saya beri nama langsung dan diikuti fungsi time
			$config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/'; // path folder
			$config['allowed_types'] = 'pdf'; // type yang dapat diakses bisa anda sesuaikan
			$config['max_size'] = '3072'; // maksimum besar file 3M
			$config['file_name'] = $nmfile; // nama yang terupload nantinya
	
			$this->upload->initialize($config);
			$name_form = 'file'.$i;
			if(isset($_FILES[$name_form]['name']))
			{
				if(!$this->upload->do_upload($name_form))
				{
					echo'';
				}
				else
				{
					$gbr = $this->upload->data();
					$data_insert_file = array(
						'id_data_kk' => $get_last_id['id_data_kk']+1,
						'file' => $gbr['file_name'],
						'keterangan' => $this->input->post('ket'.$i)
					);
					$this->Main_model->insertData("detail_data_kk",$data_insert_file);
				}
			}else{echo'';}
		}

		$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data antrean KK",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_kk'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kk/'</script>";
		}
	}
	public function perbarui_permohonan_kk(){
		$this->db->trans_start();
		$data_insert1 = array(
			'status' => $this->input->post('stat'),
			'keterangan' => $this->input->post('ket'),
			'approval_date' => date('Y-m-d H:i:s')
		);
		$this->Main_model->updateData('data_kk',$data_insert1,array('md5(id_data_kk)'=>$this->input->post('id')));
		// print_r($data_insert1);

		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detil_data_pengajuan_kk/".$this->input->post('id')."'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/detil_data_pengajuan_kk/".$this->input->post('id')."'</script>";
		}
	}
	public function hapus_data_antrean_kk(){
		$this->db->trans_start();
		$id = '';
		$nama = '';
		$no_kk = '';
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*',array('md5(a.id_data_kk)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_data_kk;
		$nama = $get_data->nama;
		$no_kk = $get_data->no_kk;

		$this->Main_model->deleteData('data_kk',array('id_data_kk'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data antrean KK (".$no_kk." - ".$nama.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/antrean_kk/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/antrean_kk/'</script>";
		}
	}
	/* Data Antrean KTP */
	public function antrean_ktp(){
		$data['parent'] = 'master';
        $data['child'] = 'antrean';
		$data['grand_child'] = 'antrean_ktp';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/antrean_ktp',$data);
        $this->load->view('admin/template/footer');
	}
	public function json_ktp(){
		$get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nik'] = $value->nik;
            $isi['keterangan'] = $value->keterangan;
            $isi['status'] = '';
            if($value->status=='Proses'){
                $isi['status'] = '<span class="label label-warning"> Proses </span>';
            }elseif($value->status=='Selesai'){
                $isi['status'] = '<span class="label label-success"> Selesai </span>';
            }else{
                echo'';
            }
            $pecah_tanggal = explode(' ',$value->created_date);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
								<div class="btn-group" style="text-align: center;">
									<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="'.site_url('admin_side/ubah_data_antrean_ktp/'.md5($value->id_data_ktp)).'">
												<i class="icon-wrench"></i> Ubah Data </a>
										</li>
										<li>
											<a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_antrean_ktp/'.md5($value->id_data_ktp)).'">
												<i class="icon-trash"></i> Hapus Data </a>
										</li>
									</ul>
								</div>';
			$data_tampil[] = $isi;
		}
		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data_tampil),
			"iTotalDisplayRecords" => count($data_tampil),
			"aaData"=>$data_tampil);
		echo json_encode($results);
	}
	public function tambah_data_ktp(){
		$data['parent'] = 'master';
        $data['child'] = 'antrean';
		$data['grand_child'] = 'antrean_ktp';
		$data['data_anggota'] = $this->Main_model->getSelectedData('user a', 'a.*,c.fullname,c.nin,c.email,c.number_phone',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '2'),'','','','',array(
			array(
				'table' => 'user_to_role b',
				'on' => 'a.id=b.user_id',
				'pos' => 'LEFT'
			),
			array(
				'table' => 'user_profile c',
				'on' => 'a.id=c.user_id',
				'pos' => 'LEFT'
			)
		))->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/master/tambah_data_ktp',$data);
        $this->load->view('admin/template/footer');
	}
	public function simpan_data_ktp(){
		$q_cek = "SELECT a.* FROM data_ktp a WHERE a.nik='".$this->input->post('nik')."' AND (a.status='Menunggu Persetujuan' OR a.status='Masuk Antrean')";
		$cek = $this->db->query($q_cek)->result();
		if($cek==NULL){
			$this->db->trans_start();
			$created_by = '';
			if($this->input->post('created_by')==NULL){
				$created_by = $this->session->userdata('id');
			}else{
				$created_by = $this->input->post('created_by');
			}
			$get_last_id = $this->Main_model->getLastID('data_ktp','id_data_ktp');
			$data_insert1 = array(
				'id_data_ktp' => $get_last_id['id_data_ktp']+1,
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'wa' => '+62'.$this->input->post('wa'),
				'status' => 'Masuk Antrean',
				'created_by' => $created_by,
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->Main_model->insertData("data_ktp",$data_insert1);
			$data_insert2 = array(
				'id_data_ktp' => $get_last_id['id_data_ktp']
			);
			$this->Main_model->insertData("antrean_ktp",$data_insert2);

			$this->Main_model->log_activity($this->session->userdata('id'),'Adding data',"Menambahkan data antrean KTP (".$this->input->post('nik')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_ktp'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil disimpan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
			}
		}else{
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal disimpan.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/tambah_data_ktp'</script>";
		}
	}
	public function perbarui_data_antrean_ktp(){
		if($this->input->post('from')=='master'){
			$cek_ = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$this->input->post('un')."' AND md5(a.id) NOT IN ('".$this->input->post('user_id')."')")->row();
			if($cek_==NULL){
				$this->db->trans_start();
				if($this->input->post('ps')!=NULL){
					$data_insert1 = array(
						'username' => $this->input->post('un'),
						'pass' => $this->input->post('ps')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}
				else{
					$data_insert1 = array(
						'username' => $this->input->post('un')
					);
					$this->Main_model->updateData('user',$data_insert1,array('md5(id)'=>$this->input->post('user_id')));
					// print_r($data_insert1);
				}

				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
				}
				else{
					$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
					echo "<script>window.location='".base_url()."admin_side/administrator/'</script>";
				}
			}else{
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>Username telah digunakan.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/tambah_data_admin/'</script>";
			}
		}elseif($this->input->post('from')=='report'){
			$this->db->trans_start();

			$data_insert1 = array(
				'status' => $this->input->post('status')
			);
			$this->Main_model->updateData('data_ktp',$data_insert1,array('md5(id_data_ktp)'=>$this->input->post('id_data_ktp')));
			// print_r($data_insert1);

			$this->Main_model->log_activity($this->session->userdata('id'),'Updating data',"Mengubah data antrean KTP (".$this->input->post('nik')." - ".$this->input->post('keterangan').")",$this->session->userdata('location'));

			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
			}
			else{
				$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
				echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
			}
		}else{
			echo "";
		}
	}
	public function hapus_data_antrean_ktp(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$nik = '';
		$get_data = $this->Main_model->getSelectedData('data_ktp a', 'a.*',array('md5(a.id_data_ktp)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_data_ktp;
		$keterangan = $get_data->keterangan;
		$nik = $get_data->nik;

		$this->Main_model->deleteData('data_ktp',array('id_data_ktp'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data antrean KK (".$nik." - ".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/antrean_ktp/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/antrean_ktp/'</script>";
		}
	}
	/* Other Function */
	public function ajax_function(){
		if($this->input->post('modul')=='get_data_kabupaten_by_keterangan_admin'){
			if($this->input->post('id')=='6'){
				echo'
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="wilayah" id="id_kabupaten" class="form-control select2-allow-clear" required>
								<option value="">-- Pilih Kabupaten/ Kota --</option>
							</select>
						</div>
					</div>
				</div>
				';
			}else{echo'';}
		}
		elseif($this->input->post('modul')=='get_kabupaten_by_id_provinsi'){
			$data = $this->Main_model->getSelectedData('kabupaten a', 'a.*', array('a.id_provinsi'=>$this->input->post('id')))->result();
			echo'<option value="">-- Pilih Kabupaten/ Kota --</option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kabupaten.'">'.$value->nm_kabupaten.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_kecamatan_by_id_kabupaten'){
			$data = $this->Main_model->getSelectedData('kecamatan a', 'a.*', array('a.id_kabupaten'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_kecamatan.'">'.$value->nm_kecamatan.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_desa_by_id_kecamatan'){
			$data = $this->Main_model->getSelectedData('desa a', 'a.*', array('a.id_kecamatan'=>$this->input->post('id')))->result();
			echo'<option value=""></option>';
			foreach ($data as $key => $value) {
				echo'<option value="'.$value->id_desa.'">'.$value->nm_desa.'</option>';
			}
		}
		elseif($this->input->post('modul')=='get_data_form_by_jenis_permohonan'){
			if($this->input->post('id')=='Tambah Anak'){
				echo'
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Istri <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Istri">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Suami <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KTP Suami">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Kelahiran <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Kelahiran">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Pindah RT'){
				echo'
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pindah RT">Pindah RT</option>
								<option value="Pindah RW">Pindah RW</option>
								<option value="Pindah Kelurahan">Pindah Kelurahan</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something">
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something">
							<input type="hidden" name="ket2" value="KTP Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						Scan KTP Asli sekeluarga dimasukkan dalam 1 file
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something">
							<input type="hidden" name="ket3" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Pindah'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pindah RT">Pindah RT</option>
								<option value="Pindah RW">Pindah RW</option>
								<option value="Pindah Kelurahan">Pindah Kelurahan</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Pindah Kelurahan'){
				echo'
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah Dari Kelurahan Asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Pindah Dari Kelurahan Asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Permohonan Pembuatan KK Kelurahan Tujuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Permohonan Pembuatan KK Kelurahan Tujuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}elseif($this->input->post('id')=='Perubahan Data'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan">Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status">Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Perubahan Pisah KK'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai">Pisah KK Karena Cerai</option>
								<option value="Pisah KK Karena Kematian">Pisah KK Karena Kematian</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Buat KK Baru'){
				echo'
				<div id="form_pilihan2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis2" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				</div>';
			}elseif($this->input->post('id')=='Pindah Antar Kelurahan Membentuk Keluarga Baru'){
				echo'
				<input type="hidden" name="jumlah_file" value="6">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" class="form-control">
								<option value="">-- Pilih --</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah Dari Kelurahan Asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Pindah Dari Kelurahan Asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Permohonan Pembuatan KK Kelurahan Tujuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Surat Permohonan Pembuatan KK Kelurahan Tujuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli Pihak Laki-Laki <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli Pihak Laki-Laki">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli Pihak Perempuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file6" placeholder="Type something" required>
							<input type="hidden" name="ket6" value="KK Asli Pihak Perempuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				';
			}else{echo'';}
		}
		elseif($this->input->post('modul')=='get_data_form_by_sub_jenis_permohonan'){
			if($this->input->post('id')=='Nama, Tempat Tanggal Lahir, Pekerjaan'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan" selected>Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status">Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Data Dukung (Akta atau Ijazah) <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Data Dukung">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">SK</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="Data Dukung">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
					<b>*</b>Jika perubahan pekerjaan ke PNS, TNI, Polri, harap melampirkan SK
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Perubahan Status'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Nama, Tempat Tanggal Lahir, Pekerjaan">Nama, Tempat Tanggal Lahir, Pekerjaan</option>
								<option value="Perubahan Status" selected>Perubahan Status</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku nikah/ Surat Cerai/ Akte Kematian <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Buku nikah/ Surat Cerai/ Akte Kematian">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pisah KK Karena Cerai'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai" selected>Pisah KK Karena Cerai</option>
								<option value="Pisah KK Karena Kematian">Pisah KK Karena Kematian</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Cerai <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Surat Cerai">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pisah KK Karena Kematian'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai">Pisah KK Karena Cerai</option>
								<option value="Pisah KK Karena Kematian" selected>Pisah KK Karena Kematian</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Akte Kematian <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="Akte Kematian">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pisah KK'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="1">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="">-- Pilih --</option>
								<option value="Pisah KK Karena Cerai" selected>Pisah KK Karena Cerai</option>
								<option value="Pisah KK Karena Kematian">Pisah KK Karena Kematian</option>
								<option value="Pisah KK">Pisah KK</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindahan dari luar Kota atau Provinsi'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="2">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi" selected>Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat kedatangan dari Disdukcapil Batang <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat kedatangan dari Disdukcapil Batang">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindahan dari luar Kecamatan'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="3">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan" selected>Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat SKPWNI dari Kecamatan asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat SKPWNI dari Kecamatan asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindah dari Kecamatan membentuk keluarga baru'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru" selected>Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru">Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat SKPWNI dari Kecamatan asal <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat SKPWNI dari Kecamatan asal">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindah dari luar Kota membentuk keluarga baru'){
				echo'
				
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindahan dari luar Kota atau Provinsi">Pindahan dari luar Kota atau Provinsi</option>
								<option value="Pindahan dari luar Kecamatan">Pindahan dari luar Kecamatan</option>
								<option value="Pindah dari Kecamatan membentuk keluarga baru">Pindah dari Kecamatan membentuk keluarga baru</option>
								<option value="Pindah dari luar Kota membentuk keluarga baru" selected>Pindah dari luar Kota membentuk keluarga baru</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat kedatangan dari Disdukcapil Batang <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something" required>
							<input type="hidden" name="ket1" value="Surat kedatangan dari Disdukcapil Batang">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat permohonan pembuatan KK Kelurahan yang ditempati <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something" required>
							<input type="hidden" name="ket2" value="Surat permohonan pembuatan KK Kelurahan yang ditempati">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something" required>
							<input type="hidden" name="ket3" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something" required>
							<input type="hidden" name="ket4" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Pemohon <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something" required>
							<input type="hidden" name="ket5" value="KTP Pemohon">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				
				</div>';
			}elseif($this->input->post('id')=='Pindah RT'){
				echo'
				<input type="hidden" name="jumlah_file" value="4">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindah RT" selected>Pindah RT</option>
								<option value="Pindah RW">Pindah RW</option>
								<option value="Pindah Kelurahan">Pindah Kelurahan</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something">
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something">
							<input type="hidden" name="ket2" value="KTP Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						Scan KTP Asli sekeluarga dimasukkan dalam 1 file
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah dari Kelurahan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Surat Pindah dari Kelurahan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something">
							<input type="hidden" name="ket3" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>';
			}elseif($this->input->post('id')=='Pindah RW'){
				echo'
				<input type="hidden" name="jumlah_file" value="4">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindah RT" >Pindah RT</option>
								<option value="Pindah RW" selected>Pindah RW</option>
								<option value="Pindah Kelurahan">Pindah Kelurahan</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something">
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something">
							<input type="hidden" name="ket2" value="KTP Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						Scan KTP Asli sekeluarga dimasukkan dalam 1 file
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah dari Kelurahan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Surat Pindah dari Kelurahan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something">
							<input type="hidden" name="ket3" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>';
			}elseif($this->input->post('id')=='Pindah Kelurahan'){
				echo'
				<input type="hidden" name="jumlah_file" value="5">
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						<div class="input-icon">
							<select name="jenis2" id="jenis3" class="form-control" required>
								<option value="Pindah RT" >Pindah RT</option>
								<option value="Pindah RW" >Pindah RW</option>
								<option value="Pindah Kelurahan" selected>Pindah Kelurahan</option>
							</select>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KK Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file1" placeholder="Type something">
							<input type="hidden" name="ket1" value="KK Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">KTP Asli <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file2" placeholder="Type something">
							<input type="hidden" name="ket2" value="KTP Asli">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1"></label>
					<div class="col-md-10">
						Scan KTP Asli sekeluarga dimasukkan dalam 1 file
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Surat Pindah dari Kelurahan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file4" placeholder="Type something">
							<input type="hidden" name="ket4" value="Surat Pindah dari Kelurahan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Permohonan KK di Kelurahan Tujuan <span class="required"> * </span></label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file5" placeholder="Type something">
							<input type="hidden" name="ket5" value="Permohonan KK di Kelurahan Tujuan">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input has-danger">
					<label class="col-md-2 control-label" for="form_control_1">Buku Nikah</label>
					<div class="col-md-10">
						<div class="input-icon">
							<input type="file" accept="application/pdf" class="form-control" name="file3" placeholder="Type something">
							<input type="hidden" name="ket3" value="Buku Nikah">
							<div class="form-control-focus"> </div>
							<span class="help-block">Some help goes here...</span>
							<i class="icon-pin"></i>
						</div>
					</div>
				</div>';
			}
		}
	}
}