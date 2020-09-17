<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		if(($this->session->userdata('id'))==NULL){
			$this->load->view('auth/login');
		}else{
			$cek = $this->Main_model->getSelectedData('user_to_role a', 'b.route', array('a.user_id'=>$this->session->userdata('id'),'b.deleted'=>'0'), "",'','','',array(
				'table' => 'user_role b',
				'on' => 'a.role_id=b.id',
				'pos' => 'LEFT'
			))->result();
			if($cek!=NULL){
				foreach ($cek as $key => $value) {
					redirect($value->route);
				}
			}
			else{
				$this->load->view('auth/login');
			}
		}
	}
	public function login_process(){
		$cek = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'), "a.is_active" => '1', 'a.deleted' => '0'), 'a.username ASC')->result();
		if($cek!=NULL){
			$cek2 = $this->Main_model->getSelectedData('user a', '*', array("a.username" => $this->input->post('username'),'pass' => $this->input->post('password'), "a.is_active" => '1', 'deleted' => '0'), 'a.username ASC','','','','')->result();
			if($cek2!=NULL){
				foreach ($cek as $key => $value) {
					$total_login = ($value->total_login)+1;
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'total_login' => $total_login,
						'last_login' => date('Y-m-d H-i-s'),
						'last_activity' => date('Y-m-d H-i-s'),
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s'),
						'ip_address' => $this->input->ip_address()
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->Main_model->log_activity($value->id,'Login to system','Login via web browser',$this->input->post('location'));
					$role = $this->Main_model->getSelectedData('user_to_role a', 'b.route,a.user_id,a.role_id', array('a.user_id'=>$value->id,'b.deleted'=>'0'), "",'','','',array(
						'table' => 'user_role b',
						'on' => 'a.role_id=b.id',
						'pos' => 'LEFT'
					))->result();
					if($role==NULL){
						$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<strong>Ups! </strong>Akun Anda tidak dikenali sistem.
														</div>' );
						echo "<script>window.location='".base_url('login')."'</script>";
					}else{
						foreach ($role as $key => $value2) {
							$sess_data['id'] = $value2->user_id;
							$sess_data['role_id'] = $value2->role_id;
							$sess_data['location'] = $this->input->post('location');
							$this->session->set_userdata($sess_data);
							redirect($value2->route);
						}
					}
				}
			}else{
				foreach ($cek as $key => $value) {
					$login_attempts = ($value->login_attempts)+1;
					$data_log = array(
						'login_attempts' => $login_attempts,
						'last_login_attempt' => date('Y-m-d H-i-s')
					);
					$this->Main_model->updateData('user',$data_log,array('id'=>$value->id));
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Ups! </strong>Password yg Anda masukkan tidak valid.
												</div>' );
					echo "<script>window.location='".base_url('login')."'</script>";
				}
			}
		}
		else{
			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<strong>Ups! </strong>Username/ Email yang Anda masukkan tidak terdaftar.
										</div>' );
			echo "<script>window.location='".base_url('login')."'</script>";
		}
	}
	public function registration()
	{
		if(($this->session->userdata('id'))==NULL){
			$this->load->view('auth/register');
		}else{
			$cek = $this->Main_model->getSelectedData('user_to_role a', 'b.route', array('a.user_id'=>$this->session->userdata('id'),'b.deleted'=>'0'), "",'','','',array(
				'table' => 'user_role b',
				'on' => 'a.role_id=b.id',
				'pos' => 'LEFT'
			))->result();
			if($cek!=NULL){
				foreach ($cek as $key => $value) {
					redirect($value->route);
				}
			}
			else{
				$this->load->view('auth/register');
			}
		}
	}
	public function register_process(){
		$cek = $this->Main_model->getSelectedData('user a', 'a.*', array("a.username" => $this->input->post('nik')))->result();
		if($cek!=NULL){
			$this->session->set_flashdata('error','
			<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Ups! </strong>Akun ini telah digunakan.
			</div>' );
			echo "<script>window.location='".base_url('registrasi')."'</script>";
		}
		else{
			$this->db->trans_start();
			$user_id = $this->Main_model->getLastID('user','id');

			$data1 = array(
						'id' => $user_id['id']+1,
						'username' => $this->input->post('nik'),
						'pass' => $this->input->post('password'),
						'total_login' => '1',
						'last_login' => date('Y-m-d H-i-s'),
						'last_activity' => date('Y-m-d H-i-s'),
						'login_attempts' => '1',
						'last_login_attempt' => date('Y-m-d H-i-s'),
						'ip_address' => $this->input->ip_address(),
						'is_active' => '1',
						'created_at' => date('Y-m-d H:i:s'),
						'created_by' => $user_id['id']+1
					);
			// print_r($data1);
			$this->Main_model->insertData('user',$data1);

			$data2 = array(
				'user_id' => $user_id['id']+1,
				'fullname' => $this->input->post('username'),
				'nin' => $this->input->post('nik'),
				'number_phone' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
			);
			// print_r($data2);
			$this->Main_model->insertData('user_profile',$data2);

			$data3 = array(
				'user_id' => $user_id['id']+1,
				'role_id' => '2',
			);
			// print_r($data3);
			$this->Main_model->insertData('user_to_role',$data3);

			$this->Main_model->log_activity($user_id['id']+1,'Registration new account',"Creating data (".$this->input->post('username').")");
			$this->db->trans_complete();
			if($this->db->trans_status() === false){
				$this->session->set_flashdata('error','
				<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Ups! </strong>Harap ulangi.
				</div>' );
				echo "<script>window.location='".base_url('registrasi')."'</script>";
			}
			else{
				$sess_data['id'] = $user_id['id']+1;
				$sess_data['role_id'] = '2';
				$sess_data['location'] = $this->input->post('location');
				$this->session->set_userdata($sess_data);
				redirect('member_side/beranda');
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		echo "<script>window.location='".base_url()."'</script>";
	}
	public function forget_password() {
		$q1 = "SELECT a.*,b.fullname FROM user a LEFT JOIN user_profile b ON a.id=b.user_id WHERE b.email='".$this->input->post('email')."' AND a.deleted='0' LIMIT 1";
		$cek = $this->db->query($q1)->result();
        if($cek==NULL){
			$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Ups! </strong>Email tidak terdaftar.
												</div>' );
			echo "<script>window.location='".base_url()."'</script>";
		}
		else{
			foreach ($cek as $key => $value) {
				$this->db->trans_start();
				$new_pass = random_string('alnum', 16);
				// PHPMailer
				require_once(APPPATH.'libraries/class.phpmailer.php');
		
				$mail = new PHPMailer; 
				$mail->IsSMTP();
				$mail->SMTPSecure = 'ssl'; 
				$mail->Host = "mail.aplikasiku.online";
				$mail->SMTPDebug = 0;
				$mail->Port = 465;
				$mail->SMTPAuth = true;
				$mail->Username = "service@aplikasiku.online";
				$mail->Password = "Asbak425##";
				$mail->SetFrom("service@aplikasiku.online","Admin Dispendukcapil");
				$mail->Subject = "Kata Sandi";
				$mail->AddAddress($this->input->post('email'),$value->fullname);
				$mail->MsgHTML("Kata sandi baru Anda : ".$new_pass);
				$mail->Send();
				$this->Main_model->updateData('user',array('pass'=>$new_pass),array('id'=>$value->id));
				$this->db->trans_complete();
				if($this->db->trans_status() === false){
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Ups! </strong>Silahkan ulangi kembali.
												</div>' );
					echo "<script>window.location='".base_url()."'</script>";
				}
				else{
					$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify;">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<strong>Yeah! </strong>Sukses mengatur ulang kata sandi, silahkan cek inbox atau spam di email Anda!
												</div>' );
					echo "<script>window.location='".base_url()."'</script>";
				}
			}
		}
    }
}