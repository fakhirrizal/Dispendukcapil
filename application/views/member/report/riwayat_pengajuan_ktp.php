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
		<span>Pengajuan Cetak KTP</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Rekap Data</span>
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
					<!-- <div class="form-group select2-bootstrap-prepend" >
						<label class="control-label col-md-2">Opsi pencarian berdasarkan <b>Status</b></label>
						<div class="col-md-5">
							<select id='pilihan' class="form-control select2-allow-clear">
								<option value=""></option>
								<option value="2">Pendaftaran</option>
								<option value="0">Sedang Berlangsung</option>
								<option value="19">Tutup</option>
							</select>
						</div>
					</div>
					<br>
					<hr> -->
					<form action="#" method="post" onsubmit="return deleteConfirm();"/>
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-8">
								<div class="btn-group">
									<!-- <button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button> -->
								</div>
									<!-- <span class="separator">|</span> -->
									<a href="<?=base_url('member_side/tambah_data_pengajuan_ktp');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
							<!-- <div class="col-md-4" style='text-align: right;'>
								<a href="<?=base_url('admin/Master/download_admin_data');?>" class="btn btn-default">Ekspor Data <i class="fa fa-cloud-download"></i></a>
							</div> -->
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="tbl">
						<thead>
							<tr>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> NIK </th>
								<th style="text-align: center;"> Nama </th>
								<th style="text-align: center;"> Keterangan </th>
								<th style="text-align: center;"> Status </th>
								<th style="text-align: center;"> No. Antrean </th>
								<th style="text-align: center;"> Waktu Pengajuan </th>
								<!-- <th style="text-align: center;" width="7%"> Aksi </th> -->
							</tr>
						</thead>
					</table>
					</form>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 0, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									url:"<?= site_url('member/Report/json_ktp'); ?>"
								},
								"aoColumns": [
											{ mData: 'no', sClass: "alignCenter" },
											{ mData: 'nik', sClass: "alignCenter" },
											{ mData: 'nama', sClass: "alignCenter" },
											{ mData: 'keterangan', sClass: "alignCenter" },
											{ mData: 'status', sClass: "alignCenter" },
											{ mData: 'antrean', sClass: "alignCenter" },
											{ mData: 'pengajuan', sClass: "alignCenter" }
											// ,{ mData: 'action' }
										],
								"drawCallback": function(data) {
                                    // console.log('f');
                                    $('.detaildata').click(function(){
                                    var id = $(this).attr("id");
                                    var modul = 'modul_ubah_data_status_pengajuan_ktp';
                                    var nilai_token = '<?php echo $this->security->get_csrf_hash();?>';
                                    $.ajax({
                                        type:"POST",
                                        url: "<?php echo site_url(); ?>member/Report/ajax_function",
                                        cache: false,
                                        data: {id:id,modul:modul,<?php echo $this->security->get_csrf_token_name();?>:nilai_token},
                                        success:function(data){
                                        $('#formdetaildata').html(data);
                                        $('#detaildata').modal("show");
                                        }
                                    });
                                    });
                                }
							});

						});
					</script>
					<script type="text/javascript">
					function deleteConfirm(){
						var result = confirm("Yakin akan menghapus data ini?");
						if(result){
							return true;
						}else{
							return false;
						}
					}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="detaildata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Ubah Data</h4>
			</div>
			<div class="modal-body">
				<div class="box box-primary" id='formdetaildata' >
				</div>
			</div>
		</div>
	</div>
</div>