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
		<span>Peta</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Data Kelurahan/ Desa</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form action="#" method="post" onsubmit="return deleteConfirm();"/>
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-6">
								<div class="btn-group">
									<!-- <button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button> -->
								</div>
									<!-- <span class="separator">|</span> -->
									<a href="<?=base_url('admin_side/tambah_data_kelurahan');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover order-column" id="mytable">
						<thead>
							<tr>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> Provinsi </th>
								<th style="text-align: center;"> Kabupaten/ Kota </th>
								<th style="text-align: center;"> Kecamatan </th>
								<th style="text-align: center;"> Nama Kelurahan/ Desa </th>
								<th style="text-align: center;" width="7%"> Aksi </th>
							</tr>
						</thead>
					</table>
					</form>
					<script type="text/javascript">
						$(document).ready(function() {
							$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
							{
								return {
									"iStart": oSettings._iDisplayStart,
									"iEnd": oSettings.fnDisplayEnd(),
									"iLength": oSettings._iDisplayLength,
									"iTotal": oSettings.fnRecordsTotal(),
									"iFilteredTotal": oSettings.fnRecordsDisplay(),
									"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
									"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
								};
							};

							var t = $("#mytable").dataTable({
								initComplete: function() {
									var api = this.api();
									$('#mytable_filter input')
											.off('.DT')
											.on('keyup.DT', function(e) {
												if (e.keyCode == 13) {
													api.search(this.value).draw();
										}
									});
								},
								oLanguage: {
									sProcessing: "Loading..."
								},
								processing: true,
								serverSide: true,
								ajax: {"url":"<?= site_url('admin/Map/json_peta_kelurahan'); ?>", "type": "POST"},
								columns: [
									{
										"data": "id_desa",
										"orderable": false, sClass: "alignCenter"
									},
									{"data": "nm_provinsi", sClass: "alignCenter"},
									{"data": "nm_kabupaten", sClass: "alignCenter"},
									{"data": "nm_kecamatan", sClass: "alignCenter"},
									{"data": "nm_desa", sClass: "alignCenter"},
									{"data": "action","orderable": false}
								],
								order: [[1, 'asc']],
								rowCallback: function(row, data, iDisplayIndex) {
									var info = this.fnPagingInfo();
									var page = info.iPage;
									var length = info.iLength;
									var index = page * length + (iDisplayIndex + 1);
									$('td:eq(0)', row).html(index);
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