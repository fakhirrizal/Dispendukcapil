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
                                    $status = '<span class="label label-warning"> Proses </span>';
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
						<hr><a href="<?php echo base_url()."member_side/riwayat_pengajuan_kk"; ?>" class="btn btn-info" role="button"><i class="fa fa-angle-double-left"></i> Kembali</a></div>
                    </div>
                    
				</div>
			</div>
		</div>
	</div>
</div>