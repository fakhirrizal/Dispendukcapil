<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link href="<?=base_url('assets/pages/css/about.min.css');?>" rel="stylesheet" type="text/css">
<div class="alert alert-info alert-dismissible" role="alert" style="text-align: justify;">
	<!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
	<i class="fa fa-warning"></i> <strong>Informasi lebih lanjut mengenai PENDAFTARAN DARING dapat menghubungi Sdr. Thanos 085712356904 (Tidak melayani konsultasi KK dan KTP)</strong></a>
</div>
<div class="page-content-inner">
	<!-- BEGIN MEMBERS SUCCESS STORIES -->
	<div class="row margin-bottom-40 stories-header" data-auto-height="true">
		<div class="col-md-12">
			<h1>-- Tulisan --</h1>
			<h2>Silahkan pilih menu yang tersedia</h2>
		</div>
	</div>
	<div class="row margin-bottom-20 stories-cont">
		<div class="col-lg-4 col-md-12">
			<div class="portlet light">
				<div class="photo">
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQMLYv4geOp1CIV11CZBwEdirSAzP0-SbhV9TiHs2ZNt1xupTHh" alt="" class="img-responsive"> </div>
				<div class="title">
					<span> Cek Antrean </span>
				</div>
				<div class="desc">
					<span> Deskripsi. </span>
				</div>
				<div class="desc">
					<a class='btn btn-danger' href='<?=base_url('member_side/riwayat_pengajuan_ktp');?>'>Pilih</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="portlet light">
				<div class="photo">
					<img src="<?=base_url('assets/ktp.png');?>" alt="" class="img-responsive"> </div>
				<div class="title">
					<span> Pendaftaran Cetak KTP </span>
				</div>
				<div class="desc">
					<span> Deskripsi. </span>
				</div>
				<div class="desc">
					<a class='btn btn-danger' href='<?=base_url('member_side/tambah_data_pengajuan_ktp');?>'>Pilih</a>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
			<div class="portlet light">
				<div class="photo">
					<img src="<?=base_url('assets/kk.png');?>" alt="" class="img-responsive"> </div>
				<div class="title">
					<span> Pengajuan KK </span>
				</div>
				<div class="desc">
					<span> Deskripsi. </span>
				</div>
				<div class="desc">
					<a class='btn btn-danger' href='<?=base_url('member_side/tambah_data_pengajuan_kk');?>'>Pilih</a>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<!-- <div class="portlet light">
				<div class="photo">
					<img src="../assets/pages/media/users/teambg8.jpg" alt="" class="img-responsive"> </div>
				<div class="title">
					<span> Tom Brady </span>
				</div>
				<div class="desc">
					<span> You have to accept whatever comes and the only important thing is that you meet it with courage and with the best that you have to give. Never give up, never surrender. Go all out or gain nothing. </span>
				</div>
			</div> -->
		</div>
	</div>
	<!-- <div class="row margin-bottom-40 stories-footer">
		<div class="col-md-12">
			<button type="button" class="btn btn-danger">Tombol</button>
		</div>
	</div> -->
</div>
<!-- <div class="modal fade" id="ktp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Input</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<form role="form" class="form-horizontal" action="<?=base_url('member_side/ajukan_cetak_ktp');?>" method="post"  enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">NIK </label>
								<div class="col-md-10">
								<?php
								$getdata = $this->Main_model->getSelectedData('user_profile a', 'a.*', array("a.user_id" => $this->session->userdata('id')))->row();
								echo '<input type="hidden" name="nik" value="'.$getdata->nin.'"/>';
								echo $getdata->nin;
								?>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Keterangan <span class="required"> * </span></label>
								<div class="col-md-9">
									<div class="input-icon">
										<select name='keterangan' class="form-control select2-allow-clear" required>
											<option value=''></option>
											<option value='Foto baru'>Foto baru</option>
											<option value='Perubahan'>Perubahan</option>
											<option value='Kehilangan'>Kehilangan</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-actions margin-top-10">
							<div class="row">
								<div class="col-md-offset-2 col-md-10">
									<button type="reset" class="btn default">Batal</button>
									<button type="submit" class="btn blue">Ajukan</button>
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> -->