<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Controller {

	public function delete_report()
	{
        if($this->input->get('id_laporan_kube')!=NULL){
            $this->db->trans_start();
            $get_data = $this->Main_model->getSelectedData('laporan_kube a', 'a.*',array('a.id_laporan_kube'=>$this->input->get('id_laporan_kube')))->row();
            $get_status_laporan_kube = $this->Main_model->getSelectedData('status_laporan_kube a', 'a.*',array('a.id_kube'=>$get_data->id_kube))->row();
            $indikator_status = explode(',',$get_status_laporan_kube->indikator);
            $indikator_laporan = explode(',',$get_data->indikator);

            $array_indikator_update = array();
            $status = '';
            for ($i=0; $i < count($indikator_status); $i++) { 
                for ($j=0; $j < count($indikator_laporan); $j++) { 
                    if($indikator_laporan[$j]==$indikator_status[$i]){
                        $status = '0';
                        break;
                    }else{
                        $status = '1';
                    }	
                }
                if($status=='0'){
                    echo'';
                }else{
                    $array_indikator_update[] = $indikator_status[$i];
                }
            }

            $this->Main_model->updateData('laporan_kube',array('deleted'=>'1'),array('id_laporan_kube'=>$this->input->get('id_laporan_kube')));
            $data_update = array(
                'indikator' => implode(',',array_unique($array_indikator_update)),
                'persentase_fisik' => ($get_status_laporan_kube->persentase_fisik)-($get_data->persentase_fisik),
                'anggaran' => ($get_status_laporan_kube->anggaran)-($get_data->anggaran),
                'persentase_anggaran' => ($get_status_laporan_kube->persentase_anggaran)-($get_data->persentase_anggaran),
                'persentase_realisasi' => ($get_status_laporan_kube->persentase_realisasi)-($get_data->persentase_realisasi)
            );
            // print_r($data_update);
            $this->Main_model->updateData('status_laporan_kube',$data_update,array('id_kube'=>$get_status_laporan_kube->id_kube));

            $this->Main_model->log_activity($this->session->userdata('id'),"Deleting kube's report","Delete kube's report (from Mobile Apps)");
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $hasil['message'] = 'Failed';
                $this->response($hasil, 200);
            }
            else{
                $hasil['message'] = 'Success';
                $this->response($hasil, 200);
            }
        }elseif($this->input->get('id_laporan_rutilahu')!=NULL){
            $this->db->trans_start();
            $get_data = $this->Main_model->getSelectedData('laporan_rutilahu a', 'a.*',array('a.id_laporan_rutilahu'=>$this->input->get('id_laporan_rutilahu')))->row();
            $get_status_laporan_rutilahu = $this->Main_model->getSelectedData('status_laporan_rutilahu a', 'a.*',array('a.id_rutilahu'=>$get_data->id_rutilahu))->row();
            $indikator_status = explode(',',$get_status_laporan_rutilahu->indikator);
            $indikator_laporan = explode(',',$get_data->indikator);
    
            $array_indikator_update = array();
            $status = '';
            for ($i=0; $i < count($indikator_status); $i++) { 
                for ($j=0; $j < count($indikator_laporan); $j++) { 
                    if($indikator_laporan[$j]==$indikator_status[$i]){
                        $status = '0';
                        break;
                    }else{
                        $status = '1';
                    }	
                }
                if($status=='0'){
                    echo'';
                }else{
                    $array_indikator_update[] = $indikator_status[$i];
                }
            }
    
            $this->Main_model->updateData('laporan_rutilahu',array('deleted'=>'1'),array('id_laporan_rutilahu'=>$this->input->get('id_laporan_rutilahu')));
            $data_update = array(
                'indikator' => implode(',',array_unique($array_indikator_update)),
                'persentase_fisik' => ($get_status_laporan_rutilahu->persentase_fisik)-($get_data->persentase_fisik),
                'anggaran' => ($get_status_laporan_rutilahu->anggaran)-($get_data->anggaran),
                'persentase_anggaran' => ($get_status_laporan_rutilahu->persentase_anggaran)-($get_data->persentase_anggaran),
                'persentase_realisasi' => ($get_status_laporan_rutilahu->persentase_realisasi)-($get_data->persentase_realisasi)
            );
            // print_r($data_update);
            $this->Main_model->updateData('status_laporan_rutilahu',$data_update,array('id_rutilahu'=>$get_status_laporan_rutilahu->id_rutilahu));
    
            $this->Main_model->log_activity($this->session->userdata('id'),"Deleting rutilahu's report","Delete rutilahu's report",$this->session->userdata('location'));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $hasil['message'] = 'Failed';
                $this->response($hasil, 200);
            }
            else{
                $hasil['message'] = 'Success';
                $this->response($hasil, 200);
            }
        }elseif($this->input->get('id_laporan_sarling')!=NULL){
            $this->db->trans_start();
            $get_data = $this->Main_model->getSelectedData('laporan_sarling a', 'a.*',array('a.id_laporan_sarling'=>$this->input->get('id_laporan_sarling')))->row();
            $get_status_laporan_sarling = $this->Main_model->getSelectedData('status_laporan_sarling a', 'a.*',array('a.id_sarling'=>$get_data->id_sarling))->row();
            $indikator_status = explode(',',$get_status_laporan_sarling->indikator);
            $indikator_laporan = explode(',',$get_data->indikator);

            $array_indikator_update = array();
            $status = '';
            for ($i=0; $i < count($indikator_status); $i++) { 
                for ($j=0; $j < count($indikator_laporan); $j++) { 
                    if($indikator_laporan[$j]==$indikator_status[$i]){
                        $status = '0';
                        break;
                    }else{
                        $status = '1';
                    }	
                }
                if($status=='0'){
                    echo'';
                }else{
                    $array_indikator_update[] = $indikator_status[$i];
                }
            }

            $this->Main_model->updateData('laporan_sarling',array('deleted'=>'1'),array('id_laporan_sarling'=>$this->input->get('id_laporan_sarling')));
            $data_update = array(
                'indikator' => implode(',',array_unique($array_indikator_update)),
                'persentase_fisik' => ($get_status_laporan_sarling->persentase_fisik)-($get_data->persentase_fisik),
                'anggaran' => ($get_status_laporan_sarling->anggaran)-($get_data->anggaran),
                'persentase_anggaran' => ($get_status_laporan_sarling->persentase_anggaran)-($get_data->persentase_anggaran),
                'persentase_realisasi' => ($get_status_laporan_sarling->persentase_realisasi)-($get_data->persentase_realisasi)
            );
            // print_r($data_update);
            $this->Main_model->updateData('status_laporan_sarling',$data_update,array('id_sarling'=>$get_status_laporan_sarling->id_sarling));

            $this->Main_model->log_activity($this->session->userdata('id'),"Deleting sarling's report","Delete sarling's report",$this->session->userdata('location'));
            $this->db->trans_complete();
            if($this->db->trans_status() === false){
                $hasil['message'] = 'Failed';
                $this->response($hasil, 200);
            }
            else{
                $hasil['message'] = 'Success';
                $this->response($hasil, 200);
            }
        }
	}
}