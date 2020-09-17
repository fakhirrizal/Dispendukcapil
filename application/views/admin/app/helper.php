<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Panduan Penggunaan Aplikasi</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<!-- <h3>Catatan</h3> -->
		<!-- <p> Hanya status <b>aktif</b> yang akan tampil di shop display pengguna</p> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<p style="text-align: justify;">Berikut adalah panduan yang dapat Anda gunakan untuk menggunakan Aplikasi ini, jika Anda akan membaca di lain waktu bisa diunduh dokumen ini melalui link yang tersedia.
					</p>
					<!-- <button class="btn btn-white btn-default btn-round">
							<i class="ace-icon fa fa-download"></i>
							<a href="#">Unduh</a>
					</button> -->
					<br>
					<br>
					<iframe height="600" width="1075" src="<?=base_url()?>assets/buku.pdf"></iframe>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>