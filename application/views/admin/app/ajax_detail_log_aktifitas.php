<div class="page-content-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<div class='row'>
						<?php
						if(isset($data_utama)){
							foreach($data_utama as $row)
							{
								$pecah_datetime = explode(' ',$row->activity_time);
						?>
								<div class="col-md-6">
									<table class="table">
										<tbody>
											<tr>
												<td> Tipe Aktifitas </td>
												<td> : </td>
												<td><?php echo $row->activity_type; ?></td>
											</tr>
											<tr>
												<td> Aktifitas </td>
												<td> : </td>
												<td><?php echo $row->activity_data; ?></td>
											</tr>
											<tr>
												<td> Pengguna </td>
												<td> : </td>
												<td><?php echo $row->fullname; ?></td>
											</tr>
											<tr>
												<td> Waktu </td>
												<td> : </td>
												<td><?= $this->Main_model->convert_tanggal($pecah_datetime[0]).' '.$pecah_datetime[1]; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-6">
									<table class="table">
										<tbody>
											<tr>
												<td> Device </td>
												<td> : </td>
												<td><?php echo $row->activity_device; ?></td>
											</tr>
											<tr>
												<td> OS </td>
												<td> : </td>
												<td><?php echo $row->activity_os; ?></td>
											</tr>
											<tr>
												<td> Browser </td>
												<td> : </td>
												<td><?php echo $row->activity_browser; ?></td>
											</tr>
											<tr>
												<td> IP Address </td>
												<td> : </td>
												<td><?= $row->activity_ip_address; ?></td>
											</tr>
										</tbody>
									</table>
								</div>

								<div id="googleMap" style="width:100%;height:380px;"></div>
								<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize&key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU"></script>
								<script>
									function initialize() {
									<?php
										$get_location = explode(',',$row->activity_location);
									?>
									var propertiPeta = {
										center: {lat: <?= $get_location[0] ?>, lng: <?= $get_location[1] ?>},
										zoom:15,
										mapTypeId:google.maps.MapTypeId.ROADMAP
									};

									var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
									<?php
										echo ("addMarker($get_location[0], $get_location[1],);\n");
									?>

									function addMarker(lat, lng, info) {
										var lokasi = new google.maps.LatLng(lat, lng);
										var marker = new google.maps.Marker({
											map: peta,
											position: lokasi,
											animation: google.maps.Animation.BOUNCE
										});
									}

									}

									google.maps.event.addDomListener(window, 'load', initialize);
								</script>
						<?php }} ?>
					</div>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>