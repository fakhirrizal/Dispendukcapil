<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    /* Data KK */
    public function data_kk(){
        $data['parent'] = 'rekap_data';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/data_kk',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_kk(){
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*,b.fullname', array('a.displayed'=>'1'), 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user_profile b',
            'on' => 'a.created_by=b.user_id',
            'pos' => 'LEFT'
        ))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data as $key => $value) {
            $isi['no'] = $no++.'.';
            $isi['nama'] = $value->fullname;
            $jenis_permohonan = '';
            if($value->sub_jenis_permohonan==NULL){
                $jenis_permohonan = $value->jenis_permohonan;
            }else{
                $jenis_permohonan = $value->jenis_permohonan.' - '.$value->sub_jenis_permohonan;
            }
            $isi['keterangan'] = $jenis_permohonan;
            $isi['status'] = '';
            if($value->status=='Proses'){
                $isi['status'] = '<span class="label label-warning"> Proses </span>';
            }elseif($value->status=='Selesai'){
                $isi['status'] = '<span class="label label-success"> Selesai </span>';
            }elseif($value->status=='Ditolak'){
                $isi['status'] = '<span class="label label-danger"> Ditolak </span>';
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
											<a href="https://api.whatsapp.com/send?phone='.$value->wa.'&text=pesan_kamu" target="_blank">
												<i class="icon-bubble"></i> Chat WA </a>
										</li>
                                    <li>
                                        <a href="'.site_url('admin_side/detil_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
                                            <i class="icon-action-redo"></i> Detail Data </a>
                                    </li>
                                    <li>
                                        <a onclick="'.$return_on_click.'" href="'.site_url('admin_side/hapus_data_pengajuan_kk/'.md5($value->id_data_kk)).'">
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
    public function download_file_kk($id=''){
        $data = $this->Main_model->getSelectedData('detail_data_kk a', 'a.*', array('a.id_data_kk'=>$id))->result();
        foreach ($data as $key => $value) {
            $file_dok = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/'.$value->file;
            $this->zip->read_file($file_dok);
        }
        // $filepath1 = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/file_1579780396.pdf';
        // $filepath2 = dirname($_SERVER["SCRIPT_FILENAME"]).'/data_upload/file_1579794373.pdf';

        // $this->zip->read_file($filepath1);
        // $this->zip->read_file($filepath2);

        $filename = "files.zip";
        $this->zip->download($filename);
    }
    public function detil_data_pengajuan_kk(){
		$data['parent'] = 'rekap_data';
        $data['child'] = 'data_kk';
        $data['grand_child'] = '';
        $data['data_utama'] = $this->Main_model->getSelectedData('data_kk a', 'a.*,b.fullname', array('md5(a.id_data_kk)'=>$this->uri->segment(3)), 'a.id_data_kk DESC', '', '', '', array(
            'table' => 'user_profile b',
            'on' => 'a.created_by=b.user_id',
            'pos' => 'LEFT'
        ))->result();
        $data['data_detail'] = $this->Main_model->getSelectedData('detail_data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->uri->segment(3)))->result();
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/detil_data_pengajuan_kk',$data);
        $this->load->view('admin/template/footer');
    }
    public function hapus_data_pengajuan_kk(){
		$this->db->trans_start();
		$id = '';
		$keterangan = '';
		$get_data = $this->Main_model->getSelectedData('data_kk a', 'a.*',array('md5(a.id_data_kk)'=>$this->uri->segment(3)))->row();
		$id = $get_data->id_data_kk;
		if($get_data->sub_jenis_permohonan==NULL){
            $keterangan = $get_data->jenis_permohonan;
        }else{
            $keterangan = $get_data->jenis_permohonan.' - '.$get_data->sub_jenis_permohonan;
        }

		$this->Main_model->deleteData('data_kk',array('id_data_kk'=>$id));
		$this->Main_model->deleteData('detail_data_kk',array('id_data_kk'=>$id));

		$this->Main_model->log_activity($this->session->userdata('id'),"Deleting data","Menghapus data permohonan KK (".$keterangan.")",$this->session->userdata('location'));
		$this->db->trans_complete();
		if($this->db->trans_status() === false){
			$this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kk/'</script>";
		}
		else{
			$this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil dihapus.<br /></div>' );
			echo "<script>window.location='".base_url()."admin_side/data_kk/'</script>";
		}
    }
    /* Data KTP */
    public function data_ktp(){
        $data['parent'] = 'rekap_data';
        $data['child'] = 'data_ktp';
        $data['grand_child'] = '';
        $this->load->view('admin/template/header',$data);
        $this->load->view('admin/report/data_ktp',$data);
        $this->load->view('admin/template/footer');
    }
    public function json_ktp_all(){
		$get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*')->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nik'] = $value->nik;
			$isi['nama'] = $value->nama;
            $isi['keterangan'] = $value->keterangan;
            $isi['status'] = '';
            if($value->status=='Masuk Antrean'){
                $isi['status'] = '<span class="label label-warning"> Masuk Antrean </span>';
            }elseif($value->status=='Tercetak'){
                $isi['status'] = '<span class="label label-success"> Tercetak </span>';
            }elseif($value->status=='Ditolak'){
                $isi['status'] = '<span class="label label-danger"> Ditolak </span>';
            }elseif($value->status=='Menunggu Persetujuan'){
                $isi['status'] = '<span class="label label-default"> Menunggu Persetujuan </span>';
            }else{
                echo'';
            }
            $pecah_tanggal = explode(' ',$value->created_date);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$isi['action'] =	'
                                <a class="btn btn-xs green" href="https://api.whatsapp.com/send?phone='.$value->wa.'&text=pesan_kamu" target="_blank"> Chat WA </a>
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
    public function json_ktp(){
		$get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('a.status'=>'Menunggu Persetujuan'))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nik'] = $value->nik;
			$isi['nama'] = $value->nama;
            $isi['keterangan'] = $value->keterangan;
            // $isi['status'] = '';
            // if($value->status=='Proses'){
            //     $isi['status'] = '<span class="label label-warning"> Proses </span>';
            // }elseif($value->status=='Selesai'){
            //     $isi['status'] = '<span class="label label-success"> Selesai </span>';
            // }else{
            //     echo'';
            // }
            $pecah_tanggal = explode(' ',$value->created_date);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$return_on_click = "return confirm('Anda yakin?')";
			$isi['action'] =	'
                                <a class="btn btn-xs green detaildata" data-toggle="modal" data-target="#detaildata" id="'.md5($value->id_data_ktp).'"> Ubah Status </a>
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
    public function json_ktp_antrean(){
		$get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('a.status'=>'Masuk Antrean'), 'b.id_antrean_ktp ASC', '', '', '', array(
            'table' => 'antrean_ktp b',
            'on' => 'a.id_data_ktp=b.id_data_ktp',
            'pos' => 'left'
        ))->result();
        $data_tampil = array();
        $no = 1;
		foreach ($get_data1 as $key => $value) {
			$isi['no'] = $no++.'.';
			$isi['nik'] = $value->nik;
			$isi['nama'] = $value->nama;
            $isi['keterangan'] = $value->keterangan;
            // $isi['status'] = '';
            // if($value->status=='Proses'){
            //     $isi['status'] = '<span class="label label-warning"> Proses </span>';
            // }elseif($value->status=='Selesai'){
            //     $isi['status'] = '<span class="label label-success"> Selesai </span>';
            // }else{
            //     echo'';
            // }
            $pecah_tanggal = explode(' ',$value->created_date);
            $isi['pengajuan'] = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
			$isi['action'] =	'
                                <a class="btn btn-xs green" href="'.base_url().'admin_side/ubah_status_tercetak/'.md5($value->id_data_ktp).'"> Tercetak </a>
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
    public function cetak_nik(){
        // $namaFile = "datanik.txt";
        
        // $separator = "\t";
        
        // header("Content-type: text/plain");
        // header("Content-Disposition: attachment; filename=".$namaFile);
        
        $data['get_data'] = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('a.status'=>'Masuk Antrean'), 'b.id_antrean_ktp ASC', '', '', '', array(
            'table' => 'antrean_ktp b',
            'on' => 'a.id_data_ktp=b.id_data_ktp',
            'pos' => 'left'
        ))->result();
        // foreach ($get_data as $key => $value) {
        //     echo $value->nik."\r\n";
        // }
        $this->load->view('admin/report/cetak_nik',$data);
    }
    public function perbarui_data_antrean_ktp(){
        $this->db->trans_start();
        if($this->input->post('status')=='Masuk Antrean'){
            $data_insert1 = array(
                'status' => $this->input->post('status')
            );
            $this->Main_model->updateData('data_ktp',$data_insert1,array('id_data_ktp'=>$this->input->post('id_data_ktp')));
            // print_r($data_insert1);
            $data_insert2 = array(
				'id_data_ktp' => $this->input->post('id_data_ktp')
			);
            $this->Main_model->insertData('antrean_ktp',$data_insert2);
            // print_r($data_insert2);
        }
        else{
            $data_insert1 = array(
                'status' => $this->input->post('status')
            );
            $this->Main_model->updateData('data_ktp',$data_insert1,array('id_data_ktp'=>$this->input->post('id_data_ktp')));
            // print_r($data_insert1);
        }
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
    }
    public function ubah_status_tercetak(){
        $this->db->trans_start();
        $data_insert1 = array(
            'status' => 'Tercetak'
        );
        $this->Main_model->updateData('data_ktp',$data_insert1,array('md5(id_data_ktp)'=>$this->uri->segment(3)));
        // print_r($data_insert1);
        $this->Main_model->deleteData('antrean_ktp',array('md5(id_data_ktp)'=>$this->uri->segment(3)));
        $this->db->trans_complete();
        if($this->db->trans_status() === false){
            $this->session->set_flashdata('gagal','<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Oops! </strong>data gagal diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
        else{
            $this->session->set_flashdata('sukses','<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong></i>Yeah! </strong>data telah berhasil diubah.<br /></div>' );
            echo "<script>window.location='".base_url()."admin_side/data_ktp/'</script>";
        }
    }
    /* Other Function */
	public function ajax_function(){
		if($this->input->post('modul')=='modul_ubah_data_status_antrean_ktp'){
            $get_data1 = $this->Main_model->getSelectedData('data_ktp a', 'a.*', array('md5(a.id_data_ktp)'=>$this->input->post('id')))->row();
            $waktu = explode(' ',$get_data1->created_date);
            echo'
            <form role="form" class="form-horizontal" action="'.base_url('admin_side/perbarui_data_antrean_ktp').'" method="post" >
                <input type="hidden" name="id_data_ktp" value="'.$get_data1->id_data_ktp.'">
                <input type="hidden" name="nik" value="'.$get_data1->nik.'">
                <input type="hidden" name="keterangan" value="'.$get_data1->keterangan.'">
                <input type="hidden" name="from" value="report">
                <div class="form-body">
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">NIK</label>
                        <div class="col-md-10">
                            '.$get_data1->nik.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nama</label>
                        <div class="col-md-10">
                            '.$get_data1->nama.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Keterangan</label>
                        <div class="col-md-10">
                            '.$get_data1->keterangan.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Waktu Pengajuan</label>
                        <div class="col-md-10">
                            '.$this->Main_model->convert_tanggal($waktu[0]).' '.substr($waktu[1],0,5).'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <select name="status" class="form-control select2-allow-clear" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Masuk Antrean">Masuk Antrean</option>
                                    <option value="Ditolak">Ditolak</option>';
                            echo'</select>
                                <i class="icon-pin"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-actions margin-top-9">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="reset" class="btn default">Batal</button>
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </div>
            </form>
            ';
		}
		elseif($this->input->post('modul')=='modul_ubah_data_status_antrean_kk'){
            $get_data1 = $this->Main_model->getSelectedData('data_kk a', 'a.*', array('md5(a.id_data_kk)'=>$this->input->post('id')))->row();
            echo'
            <form role="form" class="form-horizontal" action="'.base_url('admin_side/perbarui_data_antrean_kk').'" method="post" >
                <input type="hidden" name="id_data_kk" value="'.md5($get_data1->id_data_kk).'">
                <input type="hidden" name="no_kk" value="'.$get_data1->no_kk.'">
                <input type="hidden" name="nama" value="'.$get_data1->nama.'">
                <input type="hidden" name="from" value="report">
                <div class="form-body">
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">NIK</label>
                        <div class="col-md-10">
                            '.$get_data1->nik.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nomor KK</label>
                        <div class="col-md-10">
                            '.$get_data1->no_kk.'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Nama</label>
                        <div class="col-md-10">
                            '.$get_data1->nama.' ('.$get_data1->jk.')
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">TTL</label>
                        <div class="col-md-10">
                            '.$get_data1->tempat_lahir.', '.$this->Main_model->convert_tanggal($get_data1->tgl_lahir).'
                        </div>
                    </div>
                    <div class="form-group form-md-line-input has-danger">
                        <label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
                        <div class="col-md-10">
                            <div class="input-icon">
                                <select name="status" class="form-control select2-allow-clear" required>
                                    <option value="">-- Pilih --</option>';
                                    if($get_data1->status=='Proses'){
                                        echo'<option value="Proses" selected>Proses</option>
                                            <option value="Selesai">Selesai</option>';
                                    }elseif($get_data1->status=='Selesai'){
                                        echo'<option value="Proses">Proses</option>
                                            <option value="Selesai" selected>Selesai</option>';
                                    }else{
                                        echo'<option value="Proses">Proses</option>
                                            <option value="Selesai">Selesai</option>';
                                    }
                            echo'</select>
                                <i class="icon-pin"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-actions margin-top-9">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="reset" class="btn default">Batal</button>
                            <button type="submit" class="btn blue">Perbarui</button>
                        </div>
                    </div>
                </div>
            </form>
            ';
		}
	}
}