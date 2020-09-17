<script src="<?=base_url('assets/global/plugins/jquery.min.js');?>" type="text/javascript"></script>
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
		<span><a href='<?= site_url('/admin_side/data_provinsi'); ?>'>Data Provinsi</a></span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Ubah Data</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> 1. Kolom isian dengan tanda bintang (<font color='red'>*</font>) adalah wajib untuk di isi</p>
		<p> 2. Ekstensi file berupa <b>.kml</b></p>
		<p> 3. Untuk marker disini merupakan titik ibu kota dari suatu Provinsi</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<form role="form" class="form-horizontal" action="<?=base_url('admin_side/perbarui_data_provinsi');?>" method="post"  enctype='multipart/form-data'>
						<input type="hidden" name="id_provinsi" value="<?= md5($data_utama->id_provinsi); ?>">
						<div class="form-body">
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Nama Provinsi <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<input type="text" class="form-control" name="nm_provinsi" value="<?= $data_utama->nm_provinsi; ?>" required>
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="fa fa-map"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Wilayah <span class="required"> * </span></label>
								<div class="col-md-10">
									<div class="input-icon">
										<select name='wilayah' class="form-control select2-allow-clear" required>
											<option value='1' <?php if($data_utama->wilayah=='1'){echo'selected';}else{echo'';} ?>>Wilayah I</option>
											<option value='2' <?php if($data_utama->wilayah=='2'){echo'selected';}else{echo'';} ?>>Wilayah II</option>
											<option value='3' <?php if($data_utama->wilayah=='3'){echo'selected';}else{echo'';} ?>>Wilayah III</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">Marker <span class="required"> * </span></label>
								<div class="col-md-10">
									<div id="map"></div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1"></label>
								<div class="col-md-5">
									<div class="input-icon">
										<input type="text" class="form-control" name='latitude' id='latitude' >
										<div class="form-control-focus"> </div>
										<span class="help-block">Garis lintang</span>
										<i class="icon-pin"></i>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-icon">
									<input type="text" class="form-control" name='longitude' id='longitude' >
										<div class="form-control-focus"> </div>
										<span class="help-block">Garis Bujur</span>
										<i class="icon-pin"></i>
									</div>
								</div>
							</div>
							<div class="form-group form-md-line-input has-danger">
								<label class="col-md-2 control-label" for="form_control_1">File KML</label>
								<div class="col-md-5">
									<div class="input-icon">
										<input type="file" class="form-control" name="kml">
										<div class="form-control-focus"> </div>
										<span class="help-block">Some help goes here...</span>
										<i class="icon-paper-clip"></i>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="form-actions margin-top-10">
							<div class="row">
								<div class="col-md-offset-2 col-md-10">
									<button type="reset" class="btn default">Batal</button>
									<button type="submit" class="btn blue">Perbarui</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	#map {
		height: 300px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize&key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU"></script>

<script type="text/javascript">
	function updateMarkerPosition(latLng) {
		document.getElementById('latitude').value = [latLng.lat()]
		document.getElementById('longitude').value = [latLng.lng()]
	}

	var map = new google.maps.Map(document.getElementById('map'), {
	zoom: 7,
	center: new google.maps.LatLng(<?= $data_utama->lintang.','.$data_utama->bujur; ?>),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var latLng = new google.maps.LatLng(<?= $data_utama->lintang.','.$data_utama->bujur; ?>);

	var marker = new google.maps.Marker({
		position : latLng,
		title : 'lokasi',
		map : map,
		draggable : true
	});

	var situs = 'http://pfm.demokode.com/assets/peta/';
	var nama_file = '<?php echo $data_utama->kml; ?>';
	var situs_full = situs.concat(nama_file);
	var kmldashboard = new google.maps.KmlLayer({
		url: situs_full,
		map: map
	});

	updateMarkerPosition(latLng);
	google.maps.event.addListener(marker, 'drag', function() {
		updateMarkerPosition(marker.getPosition());
	});
</script>