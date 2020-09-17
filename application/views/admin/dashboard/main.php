<style>
	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map {
	height: 615px;
	}
	#capture {
	height: 360px;
	width: 480px;
	overflow: hidden;
	float: left;
	background-color: #ECECFB;
	border: thin solid #333;
	border-left: none;
	}
	/* Optional: Makes the sample page fill the window. */
	html, body {
	height: 100%;
	margin: 0;
	padding: 0;
	}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- <ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Laporan</span>
	</li>
</ul> -->
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> Data yang tersaji merupakan rekap dari Tahun 2019</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<div id="map" class="c-content-contact-1-gmap">
					<br>
					<hr>
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-12">

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU" type="text/javascript"></script>
<script>
	var map;
	var marker;

	function initMap() {
		// Variabel untuk menyimpan informasi (desc)
		var infoWindow = new google.maps.InfoWindow;

		//  Variabel untuk menyimpan peta Roadmap
		var mapOptions = {
		mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -6.994163, lng: 110.416438},
		zoom: 8
		});

		// Variabel untuk menyimpan batas kordinat
		var bounds = new google.maps.LatLngBounds();

		// Pengambilan data dari database
		<?php
			foreach ($data_all as $key => $value) {
				$nama = $value->nm_provinsi;
				$lat = $value->lintang;
				$lon = $value->bujur;
				$id = $value->id_provinsi;
				$nama_file = '';
				$style = 'style="text-align: center"';
				$style_td = 'style="text-align: left"';
				$class_table = 'class="table"';
				$id_enkrip = md5($id);
				$persentase_kube = "0.00";
				if($value->jumlah_kube=='0'){
					echo'';
				}else{
					$persentase_kube = number_format(($value->persentase_realisasi_kube)/($value->jumlah_kube),2);
				}
				$persentase_rutilahu = "0.00";
				if($value->jumlah_rutilahu=='0'){
					echo'';
				}else{
					$persentase_rutilahu = number_format(($value->persentase_realisasi_rutilahu)/($value->jumlah_rutilahu),2);
				}
				$persentase_sarling = "0.00";
				if($value->jumlah_sarling=='0'){
					echo'';
				}else{
					$persentase_sarling = number_format(($value->persentase_realisasi_sarling)/($value->jumlah_sarling),2);
				}
				echo ("addMarker($lat, $lon, '<div $style><h3><b>$nama</b></h3><br><table $class_table><tbody><tr><td $style_td> Persentase Realisasi KUBE </td><td> $persentase_kube% </td></tr><tr><td $style_td> Persentase Realisasi RUTILAHU </td><td> $persentase_rutilahu% </td></tr><tr><td $style_td> Persentase Realisasi SARLING </td><td> $persentase_sarling% </td></tr><tr><td></td><td></td></tr><tr></tbody></table><a href=peta_provinsi/$id_enkrip>Klik disini untuk data detail</a></div>');\n");
			}
		?>

		// Proses membuat marker
		function addMarker(lat, lng, info) {
			var lokasi = new google.maps.LatLng(lat, lng);
			bounds.extend(lokasi);
			var marker = new google.maps.Marker({
				map: map,
				position: lokasi
			});
			map.fitBounds(bounds);
			bindInfoWindow(marker, map, infoWindow, info);
		}

		// Menampilkan informasi pada masing-masing marker yang diklik
		function bindInfoWindow(marker, map, infoWindow, html) {
		google.maps.event.addListener(marker, 'click', function() {
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		});
		}
		var situs = 'http://pfm.demokode.com/assets/peta/';
		var nama_file = '<?php echo $nama_file ?>';
		var situs_full = situs.concat(nama_file);
		var kmldashboard = new google.maps.KmlLayer({

		url: situs_full,
		map: map
		});
	}
	google.maps.event.addDomListener(window, 'load', initMap);
</script>

<div class="page-content-inner">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
							<div class="col-md-12">
								<div class="tabbable-line">
									<table class="table table-striped table-bordered" id="tbl1">
										<thead>
											<tr>
												<th style="text-align: center;" width="4%"> # </th>
												<th style="text-align: center;"> Provinsi </th>
												<th style="text-align: center;"> Realisasi Kube </th>
												<th style="text-align: center;"> Realisasi Rutilahu </th>
												<th style="text-align: center;"> Realisasi Sarling </th>
												<th style="text-align: center;" width="7%"> Aksi </th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach ($data_all as $key => $value) {
												$persentase_kube = 0;
												$persentase_fisik_kube = 0;
												$anggaran_kube = 0;
												$persentase_anggaran_kube = 0;
												if($value->jumlah_kube=='0'){
													echo'';
												}else{
													$persentase_kube = ($value->persentase_realisasi_kube)/($value->jumlah_kube);
													$persentase_fisik_kube = ($value->persentase_fisik_kube)/($value->jumlah_kube);
													$anggaran_kube = ($value->anggaran_kube)/($value->jumlah_kube);
													$persentase_anggaran_kube = ($value->persentase_anggaran_kube)/($value->jumlah_kube);
												}
												$persentase_rutilahu = 0;
												$persentase_fisik_rutilahu = 0;
												$anggaran_rutilahu = 0;
												$persentase_anggaran_rutilahu = 0;
												if($value->jumlah_rutilahu=='0'){
													echo'';
												}else{
													$persentase_rutilahu = ($value->persentase_realisasi_rutilahu)/($value->jumlah_rutilahu);
													$persentase_fisik_rutilahu = ($value->persentase_fisik_rutilahu)/($value->jumlah_rutilahu);
													$anggaran_rutilahu = ($value->anggaran_rutilahu)/($value->jumlah_rutilahu);
													$persentase_anggaran_rutilahu = ($value->persentase_anggaran_rutilahu)/($value->jumlah_rutilahu);
												}
												$persentase_sarling = 0;
												$persentase_fisik_sarling = 0;
												$anggaran_sarling = 0;
												$persentase_anggaran_sarling = 0;
												if($value->jumlah_sarling=='0'){
													echo'';
												}else{
													$persentase_sarling = ($value->persentase_realisasi_sarling)/($value->jumlah_sarling);
													$persentase_fisik_sarling = ($value->persentase_fisik_sarling)/($value->jumlah_sarling);
													$anggaran_sarling = ($value->anggaran_sarling)/($value->jumlah_sarling);
													$persentase_anggaran_sarling = ($value->persentase_anggaran_sarling)/($value->jumlah_sarling);
												}
												echo'
												<tr>
													<td style="text-align: center;">'.$no++.'.</td>
													<td><a href="'.site_url().'admin_side/peta_provinsi/'.md5($value->id_provinsi).'">'.$value->nm_provinsi.'</a></td>
													<td style="text-align: center;">'.number_format($persentase_kube,2).'%</td>
													<td style="text-align: center;">'.number_format($persentase_rutilahu,2).'%</td>
													<td style="text-align: center;">'.number_format($persentase_sarling,2).'%</td>
													<td style="text-align: center;">
														<a class="btn btn-xs green" href="'.site_url().'admin_side/peta_provinsi/'.md5($value->id_provinsi).'">
														<i class="icon-eye"></i> Detail Data </a>
													</td>
												</tr>';
												// echo'<tr>
												// 	<td colspan="6">
												// 		<div class="panel-group accordion" id="accordion'.$value->id_provinsi.'">
												// 			<div class="panel panel-default">
												// 				<div class="panel-heading">
												// 					<h4 class="panel-title">
												// 						<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion'.$value->id_provinsi.'" href="#collapse_'.$value->id_provinsi.'_1" aria-expanded="false"> Detail Data </a>
												// 					</h4>
												// 				</div>
												// 				<div id="collapse_'.$value->id_provinsi.'_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
												// 					<div class="panel-body">
												// 					<h4><b>Kube (Kelompok Usaha Bersama)</b></h4>
												// 					- Jumlah Kube : '.number_format($value->jumlah_kube).' Kelompok<br>
												// 					- Rata-rata progres aspek fisik per kelompok '.number_format($persentase_fisik_kube,2).'%<br>
												// 					- Rata-rata penyerapan anggaran tiap kelompok sebesar Rp '.number_format($anggaran_kube,2).' ('.number_format($persentase_anggaran_kube,2).'%)
												// 					<h4><b>Rutilahu (Rumah Tidak Layak Huni)</b></h4>
												// 					- Jumlah Rutilahu : '.number_format($value->jumlah_rutilahu).' Kelompok<br>
												// 					- Rata-rata progres aspek fisik per kelompok '.number_format($persentase_fisik_rutilahu,2).'%<br>
												// 					- Rata-rata penyerapan anggaran tiap kelompok sebesar Rp '.number_format($anggaran_rutilahu,2).' ('.number_format($persentase_anggaran_rutilahu,2).'%)
												// 					<h4><b>Sarling (Sarana Lingkungan)</b></h4>
												// 					- Jumlah Sarling : '.number_format($value->jumlah_sarling).' Tim<br>
												// 					- Rata-rata progres aspek fisik per tim '.number_format($persentase_fisik_sarling,2).'%<br>
												// 					- Rata-rata penyerapan anggaran tiap tim sebesar Rp '.number_format($anggaran_sarling,2).' ('.number_format($persentase_anggaran_sarling,2).'%)
												// 					</div>
												// 				</div>
												// 			</div>
												// 		</div>
												// 	</td>
												// </tr>
												// ';
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</div>