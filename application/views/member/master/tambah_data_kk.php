<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <script src="<?=base_url('assets/pages/scripts/components-editors.min.js');?>" type="text/javascript"></script> -->
<script type="text/javascript">

	$(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url('/member/Master/ajax_function')?>",
			cache: false,
		});
		$("#jenis1").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_data_form_by_jenis_permohonan'},
				success: function(respond){
                    $("#form_pilihan1").html(respond);
                    $("#jenis2").change(function(){
                        var value=$(this).val();
                        $.ajax({
                            data:{id:value,modul:'get_data_form_by_sub_jenis_permohonan'},
                            success: function(respond){
                                $("#form_pilihan2").html(respond);
                                $("#jenis3").change(function(){
                                    var value=$(this).val();
                                    $.ajax({
                                        data:{id:value,modul:'get_data_form_by_sub_jenis_permohonan'},
                                        success: function(respond){
                                            $("#form_pilihan2").html(respond);
                                        }
                                    })
                                });
                            }
                        })
                    });
				}
			})
		});
	})

</script>
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
		<span>Tambah Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi.</p>
		<p> 2. Ketentuan file yang diupload:</p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Format berupa file <b>.pdf</b></p>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Ukuran maksimum file <b>3 MB</b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('member_side/ajukan_permohonan_kk');?>" method="post"  enctype='multipart/form-data'>
						<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Jenis Permohonan <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='jenis1' id='jenis1' class="form-control" required>
											<option value=''>-- Pilih --</option>
											<option value='Tambah Anak'>Tambah Anak</option>
											<option value='Pindah'>Pindah</option>
											<option value='Pindah Kelurahan'>Pindah Kelurahan</option>
											<option value='Perubahan Data'>Perubahan Data</option>
											<option value='Perubahan Pisah KK'>Perubahan Pisah KK</option>
											<option value='Buat KK Baru'>Buat KK Baru</option>
											<option value='Pindah Antar Kelurahan Membentuk Keluarga Baru'>Pindah Antar Kelurahan Membentuk Keluarga Baru</option>
                                        </select>
                                        <i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            <div id='form_pilihan1'>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select class="form-control">
											<option value=''>-- Pilih --</option>
                                        </select>
                                        <i class="icon-pin"></i>
									</div>
								</div>
                            </div>
                            </div>
                            <div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nomor WA <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="number" class="form-control" name="wa" placeholder="Format : 85696xxxxxx" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-phone"></i>
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
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>