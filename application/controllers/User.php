<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index()
    {
        $data['data_marker'] = $this->Main_model->getSelectedData('provinsi a', 'a.*,(SELECT SUM(s.persentase_realisasi) FROM kube k LEFT JOIN status_laporan_kube s ON k.id_kube=s.id_kube WHERE k.id_provinsi=a.id_provinsi) AS persentase_realisasi_kube,(SELECT COUNT(k.id_kube) FROM kube k WHERE k.id_provinsi=a.id_provinsi) AS jumlah_kube,(SELECT SUM(s.persentase_realisasi) FROM rutilahu k LEFT JOIN status_laporan_rutilahu s ON k.id_rutilahu=s.id_rutilahu WHERE k.id_provinsi=a.id_provinsi) AS persentase_realisasi_rutilahu,(SELECT COUNT(k.id_rutilahu) FROM rutilahu k WHERE k.id_provinsi=a.id_provinsi) AS jumlah_rutilahu,(SELECT SUM(s.persentase_realisasi) FROM sarling k LEFT JOIN status_laporan_sarling s ON k.id_sarling=s.id_sarling WHERE k.id_provinsi=a.id_provinsi) AS persentase_realisasi_sarling,(SELECT COUNT(k.id_sarling) FROM sarling k WHERE k.id_provinsi=a.id_provinsi) AS jumlah_sarling',array('a.wilayah'=>'2'))->result();
        $this->load->view('guest/dashboard/main_map',$data);
    }
}