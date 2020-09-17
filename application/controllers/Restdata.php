<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . '/libraries/JWT/JWT.php';
// require APPPATH . '/libraries/JWT/BeforeValidException.php';
// require APPPATH . '/libraries/JWT/ExpiredException.php';
// require APPPATH . '/libraries/JWT/SignatureInvalidException.php';
use \Firebase\JWT\JWT;
class Restdata extends REST_Controller {
	private $secretkey = 'kode_rahasia';

	// mendapatkan token ketika login
	public function viewtoken_post(){
	$date = new DateTime();

	$username = $this->post('username',TRUE);
	$pass = $this->post('password',TRUE);

	$dataadmin = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$username."'")->result();

		if ($dataadmin) {

			if (password_verify($pass,$dataadmin->pass)) {

			$payload['id'] = $dataadmin->id;
			$payload['username'] = $dataadmin->username;
			$payload['iat'] = $date->getTimestamp(); //waktu di buat
			$payload['exp'] = $date->getTimestamp() + 3600; //satu jam

			$output['id_token'] = JWT::encode($payload,$this->secretkey);
			$this->response([
			'status'=>'Success',
			'Message'=>'Token will expired in one hour.',
			'Token'=>$output,
			],HTTP_OK);
			}else {
			$this->viewtokenfail($username,$pass);
			}
		}else {
			$this->viewtokenfail($username,$pass);
		}
	}

	// method untuk mengecek token setiap melakukan post, put, etc
	public function cektoken(){
	$jwt = $this->input->get_request_header('Authorization');

		try {

			$decode = JWT::decode($jwt,$this->secretkey,array('HS256'));
			//melakukan pengecekan database, jika username tersedia di database maka return true
			$cek = $this->db->query("SELECT a.* FROM user a WHERE a.username='".$decode->username."'")->result();
			if ($cek!=NULL) {
			return true;
			}

		} catch (Exception $e) {
			exit('Token is not valid');
		}
	}
}