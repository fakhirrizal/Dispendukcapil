<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Apps</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
		<link href="https://sitri.online/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/pages/css/blog.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
		<link href="https://sitri.online/assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
		<link href="https://sitri.online/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
		<link href="http://dispendukcapil.batangkab.go.id:80/pelayanan/assets/img/logo_prov_mail.png" rel="icon" type="image/x-icon">
	</head>

		<body class="page-container-bg-solid page-md">
		<div class="page-container">
			<div class="page-content-wrapper">
				<div class="page-head">
					<div class="container">
						<div class="page-title">
							<h1>Dashboard
								<small>Sistem Informasi</small>
							</h1>
						</div>
					</div>
				</div>
				<div class="page-content">
					<div class="container">
						<div class="page-content-inner">
							<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
								<h2>Dokumentasi API</h2>
								<p><strong>Note:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="portlet light ">
										<div class="portlet-body">
											<h2>User Authentification</h2>
											<div class="panel-group accordion" id="accordion1">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_1"> <span class="label label-info">POST</span>&nbsp;{url}/login </a>
														</h4>
													</div>
													<div id="collapse_1_1" class="panel-collapse in">
														<div class="panel-body">
															<p> Fungsi untuk bisa masuk ke sistem, berikut parameter yang harus dipenuhi. </p>
															<code>
																{<br>&nbsp; &nbsp; &nbsp;
																	"username": "string",<br>&nbsp; &nbsp; &nbsp;
																	"password": "string"<br>
																}
															</code>
															<p> Berikut data balikannya jika parameter yang dihantarkan terdaftar di database. </p>
															<code>
																{<br>&nbsp; &nbsp; &nbsp;
																	"user_id": "int",<br>&nbsp; &nbsp; &nbsp;
																	"nama": "string",<br>&nbsp; &nbsp; &nbsp;
																	"nik": "string",<br>&nbsp; &nbsp; &nbsp;
																	"tanggal_lahir": "YYYY-mm-dd",<br>&nbsp; &nbsp; &nbsp;
																	"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																	"foto": "base64",<br>&nbsp; &nbsp; &nbsp;
																	"id_anggota_{kegiatan}": "int",<br>&nbsp; &nbsp; &nbsp;
																	"id_{kegiatan}": "int"<br>
																}
															</code>
															<br>
															<br>
															<p>
															Keterangan:
															<ol>
																<li>Kegiatan disini bisa berisi kube/ rutilahu/ sarling</li>
															</ol>
															<p>
														</div>
													</div>
												</div>
											</div>
											<div class="panel-group accordion" id="accordion1">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1_2"> <span class="label label-info">POST</span>&nbsp;{url}/change_password </a>
														</h4>
													</div>
													<div id="collapse_1_2" class="panel-collapse in">
														<div class="panel-body">
															<p> Fungsi untuk mengubah kata sandi, berikut parameter yang harus dipenuhi. </p>
															<code>
																{<br>&nbsp; &nbsp; &nbsp;
																	"username": "string",<br>&nbsp; &nbsp; &nbsp;
																	"new_password": "string"<br>
																}
															</code>
														</div>
													</div>
												</div>
											</div>
											<h2>Data Master</h2>
											<div class="portlet box red">
												<div class="portlet-title">
													<div class="caption">
														<i></i>User Data </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_3">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_3" href="#collapse_2_3_1"> <span class="label label-success">GET</span>&nbsp;{url}/user_data </a>
																</h4>
															</div>
															<div id="collapse_2_3_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data user, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"username": "string",<br>&nbsp; &nbsp; &nbsp;
																			"password": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nama_lengkap": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nik": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_bdt": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_pkh": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_kks": "string",<br>&nbsp; &nbsp; &nbsp;
																			"tanggal_lahir": "YYYY-mm-dd",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"foto": "base64"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_3" href="#collapse_2_3_2"> <span class="label label-success">GET</span>&nbsp;{url}/user_data?user_id={$user_id} </a>
																</h4>
															</div>
															<div id="collapse_2_3_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data user berdasarkan id yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"username": "string",<br>&nbsp; &nbsp; &nbsp;
																			"password": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nama_lengkap": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nik": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_bdt": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_pkh": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_kks": "string",<br>&nbsp; &nbsp; &nbsp;
																			"tanggal_lahir": "YYYY-mm-dd",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"foto": "base64"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box green">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Data Indikator </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_2">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_2" href="#collapse_2_2_1"> <span class="label label-success">GET</span>&nbsp;{url}/indikator </a>
																</h4>
															</div>
															<div id="collapse_2_2_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data indikator (kaitannya dengan laporan), berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"tipe": "string",<br>&nbsp; &nbsp; &nbsp;
																			"program": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Program (1: Kube; 2: Rutilahu; 3: Sarling) </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_2" href="#collapse_2_2_2"> <span class="label label-success">GET</span>&nbsp;{url}/indikator?id_tipe={$id_tipe} </a>
																</h4>
															</div>
															<div id="collapse_2_2_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data indikator berdasarkan id_tipe yang dipilih (1: Pengadaan; 2: Proses; 3: Benefit), berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"tipe": "string",<br>&nbsp; &nbsp; &nbsp;
																			"program": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Program (1: Kube; 2: Rutilahu; 3: Sarling) </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_2" href="#collapse_2_2_3"> <span class="label label-success">GET</span>&nbsp;{url}/indikator?id_indikator={$id_indikator} </a>
																</h4>
															</div>
															<div id="collapse_2_2_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data indikator berdasarkan id_indikator tertentu, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"tipe": "string",<br>&nbsp; &nbsp; &nbsp;
																			"program": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Program (1: Kube; 2: Rutilahu; 3: Sarling) </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_2" href="#collapse_2_2_4"> <span class="label label-success">GET</span>&nbsp;{url}/indikator?program={$program} </a>
																</h4>
															</div>
															<div id="collapse_2_2_4" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data indikator berdasarkan program yang dipilih (1: Kube; 2: Rutilahu; 3: Sarling), berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"tipe": "string",<br>&nbsp; &nbsp; &nbsp;
																			"indikator": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box yellow">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Data Kube (Kelompok Usaha Bersama) </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_1">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_1" href="#collapse_2_1_1"> <span class="label label-success">GET</span>&nbsp;{url}/kube </a>
																</h4>
															</div>
															<div id="collapse_2_1_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data kube, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_kelompok": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
																			"jenis_usaha": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_1" href="#collapse_2_1_2"> <span class="label label-success">GET</span>&nbsp;{url}/kube?id_kube={$id_kube} </a>
																</h4>
															</div>
															<div id="collapse_2_1_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kube berdasarkan id_kube yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_kelompok": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
																			"jenis_usaha": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_1" href="#collapse_2_1_3"> <span class="label label-success">GET</span>&nbsp;{url}/anggota_kube?user_id={$user_id}&id_kube={$id_kube} </a>
																</h4>
															</div>
															<div id="collapse_2_1_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_anggota_kube, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_kube": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box grey-salsa">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Data Rutilahu (Rumah Tidak Layak Huni) </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_5">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_5" href="#collapse_2_5_1"> <span class="label label-success">GET</span>&nbsp;{url}/rutilahu </a>
																</h4>
															</div>
															<div id="collapse_2_5_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data rutilahu, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_kelompok": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_5" href="#collapse_2_5_2"> <span class="label label-success">GET</span>&nbsp;{url}/rutilahu?id_rutilahu={$id_rutilahu} </a>
																</h4>
															</div>
															<div id="collapse_2_5_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data rutilahu berdasarkan id_rutilahu yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_kelompok": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_5" href="#collapse_2_5_3"> <span class="label label-success">GET</span>&nbsp;{url}/anggota_rutilahu?user_id={$user_id}&id_rutilahu={$id_rutilahu} </a>
																</h4>
															</div>
															<div id="collapse_2_5_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_anggota_rutilahu, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_rutilahu": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box green-jungle">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Data Sarling (Sarana Lingkungan) </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_6">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_6" href="#collapse_2_6_1"> <span class="label label-success">GET</span>&nbsp;{url}/sarling </a>
																</h4>
															</div>
															<div id="collapse_2_6_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data sarling, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_tim": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
                                                                            "jenis_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_6" href="#collapse_2_6_2"> <span class="label label-success">GET</span>&nbsp;{url}/sarling?id_sarling={$id_sarling} </a>
																</h4>
															</div>
															<div id="collapse_2_6_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data sarling berdasarkan id_sarling yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nama_kelompok": "string",<br>&nbsp; &nbsp; &nbsp;
																			"alamat": "string",<br>&nbsp; &nbsp; &nbsp;
																			"rencana_anggaran": "string",<br>&nbsp; &nbsp; &nbsp;
																			"jumlah_anggota": "int",<br>&nbsp; &nbsp; &nbsp;
                                                                            "jenis_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_6" href="#collapse_2_6_3"> <span class="label label-success">GET</span>&nbsp;{url}/anggota_sarling?user_id={$user_id}&id_sarling={$id_sarling} </a>
																</h4>
															</div>
															<div id="collapse_2_6_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_anggota_sarling, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_sarling": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box purple">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Wilayah </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion2_4">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_1"> <span class="label label-success">GET</span>&nbsp;{url}/provinsi </a>
																</h4>
															</div>
															<div id="collapse_2_4_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data provinsi, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_provinsi": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_2"> <span class="label label-success">GET</span>&nbsp;{url}/provinsi?id_provinsi={$id_provinsi} </a>
																</h4>
															</div>
															<div id="collapse_2_4_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data provinsi berdasarkan id yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_provinsi": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_3"> <span class="label label-success">GET</span>&nbsp;{url}/kabupaten </a>
																</h4>
															</div>
															<div id="collapse_2_4_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data kabupaten, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kabupaten": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_4"> <span class="label label-success">GET</span>&nbsp;{url}/kabupaten?id_kabupaten={$id_kabupaten} </a>
																</h4>
															</div>
															<div id="collapse_2_4_4" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kabupaten berdasarkan id_kabupaten yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kabupaten": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_5"> <span class="label label-success">GET</span>&nbsp;{url}/kabupaten?id_provinsi={$id_provinsi} </a>
																</h4>
															</div>
															<div id="collapse_2_4_5" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kabupaten berdasarkan provinsi tertentu, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kabupaten": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_6"> <span class="label label-success">GET</span>&nbsp;{url}/kecamatan </a>
																</h4>
															</div>
															<div id="collapse_2_4_6" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data kecamatan, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kecamatan": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_7"> <span class="label label-success">GET</span>&nbsp;{url}/kecamatan?id_kecamatan={$id_kecamatan} </a>
																</h4>
															</div>
															<div id="collapse_2_4_7" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kecamatan berdasarkan id_kecamatan yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kecamatan": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_8"> <span class="label label-success">GET</span>&nbsp;{url}/kecamatan?id_kabupaten={$id_kabupaten} </a>
																</h4>
															</div>
															<div id="collapse_2_4_8" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kecamatan berdasarkan id_kabupaten yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kecamatan": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_9"> <span class="label label-success">GET</span>&nbsp;{url}/kecamatan?id_provinsi={$id_provinsi} </a>
																</h4>
															</div>
															<div id="collapse_2_4_9" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kecamatan berdasarkan id_provinsi yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_kecamatan": "int",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_10"> <span class="label label-success">GET</span>&nbsp;{url}/desa </a>
																</h4>
															</div>
															<div id="collapse_2_4_10" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat semua data kelurahan/ desa, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_11"> <span class="label label-success">GET</span>&nbsp;{url}/desa?id_desa={$id_desa} </a>
																</h4>
															</div>
															<div id="collapse_2_4_11" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kelurahan/ desa berdasarkan id_desa yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_12"> <span class="label label-success">GET</span>&nbsp;{url}/desa?id_kecamatan={$id_kecamatan} </a>
																</h4>
															</div>
															<div id="collapse_2_4_12" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kelurahan/ desa berdasarkan kecamatan yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_13"> <span class="label label-success">GET</span>&nbsp;{url}/desa?id_kabupaten={$id_kabupaten} </a>
																</h4>
															</div>
															<div id="collapse_2_4_13" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kelurahan/ desa berdasarkan kabupaten yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion2_4" href="#collapse_2_4_14"> <span class="label label-success">GET</span>&nbsp;{url}/desa?id_provinsi={$id_provinsi} </a>
																</h4>
															</div>
															<div id="collapse_2_4_14" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk melihat data kelurahan/ desa berdasarkan provinsi yang dipilih, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_desa": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kecamatan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_kabupaten": "string",<br>&nbsp; &nbsp; &nbsp;
																			"nm_provinsi": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<h2>Data Laporan</h2>
											<!-- <div class="panel-group accordion" id="accordion3">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 class="panel-title">
															<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3_1"> Fungsi #1 </a>
														</h4>
													</div>
													<div id="collapse_3_1" class="panel-collapse in">
														<div class="panel-body">
															<p> Duis autem vel eum iriure dolor in hendrerit in vulputate. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut. </p>
															<p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
																eiusmod. </p>
														</div>
													</div>
												</div>
											</div> -->
											<!-- <div class="portlet box red">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Laporan Kube </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion3_1">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_1"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan laporan kube, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"penjelasan_progres_fisik": "string",<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": "string",<br>&nbsp; &nbsp; &nbsp;
																			"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"keterangan": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Jika akan melaporkan beberapa indikator, pisahkan dengan tanda koma "<b>,</b>"</li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div> -->
											<div class="portlet box red-soft">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Laporan Kube </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion3_1">
														<!-- <div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_1"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_laporan_kube, yg berguna untuk menyimpan data kube. Berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_kube": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_2"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data utama laporan kube, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"keterangan": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_3"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan kube aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;
																			"penjelasan_progres_fisik": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data</li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_4"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_4" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan kube aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": "int"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div> -->
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_9"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_9" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data laporan kube, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_anggota_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_5"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_kube?id_kube={$id_kube} </a>
																</h4>
															</div>
															<div id="collapse_3_1_5" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok kube yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"data_laporan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>data_laporan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_6"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_kube?id_laporan_kube={$id_laporan_kube} </a>
																</h4>
															</div>
															<div id="collapse_3_1_6" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok kube yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> di array <b>data_utama</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>progres_fisik</b> dan <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_8"> <span class="label label-warning">PUT</span>&nbsp;{url}/laporan_kube </a>
																</h4>
															</div>
															<div id="collapse_3_1_8" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mengubah data laporan kube, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_kube": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>id_laporan_kube</b> digunakan sebagai parameter untuk mengubah data lain </li>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_1" href="#collapse_3_1_7"> <span class="label label-danger">GET</span>&nbsp;{url}/hapus_laporan?id_laporan_kube={$id_laporan_kube} </a>
																</h4>
															</div>
															<div id="collapse_3_1_7" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menghapus data laporan Kube, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"message": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Keluaran dari field "<b>Message</b>" yaitu "<b>Success</b>", dan "<b>Failed</b>"</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box yellow-saffron">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Laporan Rutilahu </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion3_2">
														<!-- <div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_1"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_laporan_rutilahu, yg berguna untuk menyimpan data rutilahu. Berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_rutilahu": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_2"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data utama laporan rutilahu, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"keterangan": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_3"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan rutilahu aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;
																			"penjelasan_progres_fisik": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data</li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_4"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_4" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan rutilahu aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": "int"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div> -->
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_9"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_9" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data laporan rutilahu, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_anggota_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_5"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_rutilahu?id_rutilahu={$id_rutilahu} </a>
																</h4>
															</div>
															<div id="collapse_3_2_5" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok rutilahu yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"data_laporan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>data_laporan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_6"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_rutilahu?id_laporan_rutilahu={$id_laporan_rutilahu} </a>
																</h4>
															</div>
															<div id="collapse_3_2_6" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok rutilahu yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> di array <b>data_utama</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>progres_fisik</b> dan <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_8"> <span class="label label-warning">PUT</span>&nbsp;{url}/laporan_rutilahu </a>
																</h4>
															</div>
															<div id="collapse_3_2_8" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mengubah data laporan rutilahu, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_rutilahu": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>id_laporan_rutilahu</b> digunakan sebagai parameter untuk mengubah data lain </li>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_7"> <span class="label label-danger">GET</span>&nbsp;{url}/hapus_laporan?id_laporan_rutilahu={$id_laporan_rutilahu} </a>
																</h4>
															</div>
															<div id="collapse_3_2_7" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menghapus data laporan Rutilahu, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"message": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Keluaran dari field "<b>Message</b>" yaitu "<b>Success</b>", dan "<b>Failed</b>"</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="portlet box green-haze">
												<div class="portlet-title">
													<div class="caption">
														<i></i>Laporan Sarling </div>
													<div class="tools">
														<a href="javascript:;" class="collapse"> </a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="panel-group accordion" id="accordion3_3">
														<!-- <div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_1"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_3_1" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan id_laporan_sarling, yg berguna untuk menyimpan data sarling. Berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_sarling": "int"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_2"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_3_2" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data utama laporan sarling, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_anggota_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"keterangan": "string"<br>
																		}
																	</code>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_3"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_3_3" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan sarling aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;
																			"penjelasan_progres_fisik": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data</li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_4"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_3_4" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan detail data laporan sarling aspek fisik, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;
																			"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": "int"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit)</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div> -->
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_2" href="#collapse_3_2_9"> <span class="label label-info">POST</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_2_9" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menyimpan data laporan sarling, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_anggota_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_5"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_sarling?id_sarling={$id_sarling} </a>
																</h4>
															</div>
															<div id="collapse_3_3_5" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok sarling yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"data_laporan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>data_laporan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_6"> <span class="label label-success">GET</span>&nbsp;{url}/laporan_sarling?id_laporan_sarling={$id_laporan_sarling} </a>
																</h4>
															</div>
															<div id="collapse_3_3_6" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mendapatkan rekap dari suatu kelompok sarling yg telah melaporkan aktifitasnya, berikut data balikannya, </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"pelapor": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_anggaran": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"persentase_realisasi": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"created_at": "YYYY-mm-dd HH:ii:ss"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"tipe": "string",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>indikator</b> di array <b>data_utama</b> berupa kumpulan id_indikator yang dipisahkan "<b>,</b>" </li>
																		<li>Array <b>progres_fisik</b> dan <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_8"> <span class="label label-warning">PUT</span>&nbsp;{url}/laporan_sarling </a>
																</h4>
															</div>
															<div id="collapse_3_3_8" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk mengubah data laporan sarling, berikut parameter yang harus dipenuhi. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"data_utama": {<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"id_laporan_sarling": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				"keterangan": "string"<br>&nbsp; &nbsp; &nbsp;
																			},<br>&nbsp; &nbsp; &nbsp;
																			"progres_fisik": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"indikator_progres_fisik": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"penjelasan_progres_fisik": "string"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			],<br>&nbsp; &nbsp; &nbsp;
																			"progres_keuangan": [<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				{<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"id_tipe_indikator": "int",<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																					"progres_keuangan": "int"<br>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
																				}<br>&nbsp; &nbsp; &nbsp;
																			]<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Field <b>id_laporan_sarling</b> digunakan sebagai parameter untuk mengubah data lain </li>
																		<li>Array <b>progres_fisik</b> bisa memiliki lebih dari satu array </li>
																		<li>Field <b>indikator_progres_fisik</b> hanya bisa 1 id_indikator sekali kirim data </li>
																		<li>Indikator harus sesuai dengan id_tipe_indikator (1: Pengadaan; 2: Proses; 3: Benefit) </li>
																		<li>Array <b>progres_keuangan</b> bisa memiliki lebih dari satu array </li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
														<div class="panel panel-default">
															<div class="panel-heading">
																<h4 class="panel-title">
																	<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3_3" href="#collapse_3_3_7"> <span class="label label-danger">GET</span>&nbsp;{url}/hapus_laporan?id_laporan_sarling={$id_laporan_sarling} </a>
																</h4>
															</div>
															<div id="collapse_3_3_7" class="panel-collapse in">
																<div class="panel-body">
																	<p> Fungsi untuk menghapus data laporan Sarling, berikut data balikannya. </p>
																	<code>
																		{<br>&nbsp; &nbsp; &nbsp;
																			"message": "string"<br>
																		}
																	</code>
																	<br>
																	<br>
																	<p>
																	Keterangan:
																	<ol>
																		<li>Keluaran dari field "<b>Message</b>" yaitu "<b>Success</b>", dan "<b>Failed</b>"</li>
																	</ol>
																	</p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="page-prefooter">
			<div class="container">
				<div class="row">
				</div>
			</div>
		</div>
		<div class="page-footer">
			<div class="container">2019 © Dispermasdesdukcapil Prov. Jateng.
			</div>
		</div>
		<div class="scroll-to-top">
		<img src='http://icons.iconarchive.com/icons/custom-icon-design/pretty-office-5/256/navigate-up-icon.png' width='20%' />
		</div>
		<script src="https://sitri.online/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/global/scripts/app.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
		<script src="https://sitri.online/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
	</body>

</html>