<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Pengajuan KK</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Detail Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<!-- <p> 1. Ketika mengklik <b>Atur Ulang Sandi</b>, maka kata sandi otomatis menjadi "<b>1234</b>"</p> -->
		<!-- <p> 2. Data ekspor berupa file excel (<b>.xls</b>)</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
						<?php
						if(isset($data_utama)){
							foreach($data_utama as $value)
							{
                                $id_data_kk = $value->id_data_kk;
                                $jenis_permohonan = '';
                                if($value->sub_jenis_permohonan==NULL){
                                    $jenis_permohonan = $value->jenis_permohonan;
                                }else{
                                    $jenis_permohonan = $value->jenis_permohonan.' - '.$value->sub_jenis_permohonan;
                                }
                                $status = '';
                                if($value->status=='Proses'){
                                    $status = '<span class="label label-warning"> Proses </span>&nbsp;&nbsp;&nbsp;<a data-toggle="modal" data-target="#edit"><i class="icon-note"></a>';
                                }elseif($value->status=='Selesai'){
                                    $status = '<span class="label label-success"> Selesai </span>';
                                }elseif($value->status=='Ditolak'){
                                    $status = '<span class="label label-danger"> Ditolak </span>';
                                }else{
                                    echo'';
                                }
                                $pecah_tanggal = explode(' ',$value->created_date);
                                $pengajuan = $this->Main_model->convert_tanggal($pecah_tanggal[0]).' '.substr($pecah_tanggal[1],0,5);
						?>
								<div class="col-md-6">
									<table class="table">
										<tbody>
                                            <tr>
												<td> Pemohon </td>
												<td> : </td>
												<td><?php echo $value->fullname; ?></td>
											</tr>
											<tr>
												<td> Jenis Permohonan </td>
												<td> : </td>
												<td><?php echo $jenis_permohonan; ?></td>
											</tr>
											<tr>
												<td> Waktu Pengajuan </td>
												<td> : </td>
												<td><?php echo $pengajuan; ?></td>
											</tr>
											<tr>
												<td> Status </td>
												<td> : </td>
												<td><?php echo $status; ?></td>
                                            </tr>
                                            <?php
                                            if($value->keterangan==NULL){
                                                echo'';
                                            }else{
                                                echo'
                                                <tr>
                                                    <td> Keterangan </td>
                                                    <td> : </td>
                                                    <td>'.$value->keterangan.'</td>
                                                </tr>
                                                ';
                                            }
                                            if($value->wa==NULL){
                                                echo'';
                                            }else{
                                                echo'
                                                <tr>
                                                    <td> Nomor WA </td>
                                                    <td> : </td>
                                                    <td>'.$value->wa.'</td>
                                                </tr>
                                                ';
                                            }
											?>
											<tr>
												<td colspan='3'> <a class='btn btn-success' href='<?= base_url().'admin/Report/download_file_kk/'.$id_data_kk; ?>'>Unduh semua file</a> </td>
                                            </tr>
											<tr>
												<td> </td>
												<td> </td>
												<td> </td>
											</tr>
										</tbody>
									</table>
								</div>
						<?php }} ?>
						<br>
						<br>
                        <br>
                        <div class="col-md-12" >
                        <div class="panel-group accordion" id="accordion3">
                            <?php
                            foreach ($data_detail as $key => $dd) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_<?= $dd->id_detail_data_kk; ?>" aria-expanded="false"> <?= $dd->keterangan; ?> </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_<?= $dd->id_detail_data_kk; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <iframe src="<?= base_url().'data_upload/'.$dd->file; ?>" frameborder="0" width='100%' height='1000px'></iframe>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        </div>
						<div class="col-md-12" >
						<hr><a href="<?php echo base_url()."admin_side/data_kk"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
                    </div>
                    
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Ubah Data Status</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary">
                    <form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_permohonan_kk');?>" method="post"  enctype='multipart/form-data'>
						<input type="hidden" name="id" value="<?=$this->uri->segment(3);?>">
						<div class="form-body">
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Status <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='stat' class="form-control select2-allow-clear" required>
											<option value=''></option>
											<option value='Ditolak'>Ditolak</option>
											<option value='Selesai'>Selesai</option>
										</select>
									</div>
								</div>
							</div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Keterangan </label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="ket" placeholder="Type something">
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							
						</div>
						<br>
						<div class="form-actions margin-top-10">
							<div class="row">
								<div class="col-md-offset-2 col-md-10">
									<button type="reset" class="btn default">Batal</button>
									<button type="submit" class="btn blue">Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>