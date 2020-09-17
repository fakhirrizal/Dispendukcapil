<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> Tampilan standar adalah rekap data Tahun <?= date('Y'); ?></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="table-toolbar">
						<div class="row">
                            <div class="col-md-12">
                                <form action="<?=base_url('admin_side/dasbor_grafik_kabupaten/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>" method="post">
                                    <div class="form-group form-md-line-input has-danger">
                                        <label class="col-md-4 control-label" for="form_control_1"></label>
                                        <label class="col-md-1 control-label" for="form_control_1">Tahun</label>
                                        <div class="col-md-2">
                                            <div class="input-icon">
                                                <select name='tahun' class="form-control select2-allow-clear">
                                                    <option value=''>-- Pilih --</option>
                                                    <option value='2016'>2016</option>
                                                    <option value='2017'>2017</option>
                                                    <option value='2018'>2018</option>
                                                    <option value='2019'>2019</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type='submit' class="btn btn-info">Proses</button>
                                        </div>
                                    </div>
                                </form>
							</div>
                            <div class="col-md-12">
                            <?php
                            if(isset($data_utama_1)){
                                $a = 0;
                                $b = 0;
                                $c = 0;
                                foreach ($data_utama_1 as $key => $value) {
                                    if($value->jumlah_kube=='0'){
                                        echo'';
                                    }else{
                                        $a += $value->jumlah_kube;
                                    }
                                    if($value->jumlah_rutilahu=='0'){
                                        echo'';
                                    }else{
                                        $b += $value->jumlah_rutilahu;
                                    }
                                    if($value->jumlah_sarling=='0'){
                                        echo'';
                                    }else{
                                        $c += $value->jumlah_sarling;
                                    }
                                }
                            ?>
                            <hr>
                            <div style='text-align: center'>
                            <h3><b>Jumlah Kube, RLTH, dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?></b></h3><br>
                            </div>
                            <div class="row widget-row">
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#32C5D2">
                                        <h4 class="widget-thumb-heading"><font color='white'>Jumlah KUBE</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-green icon-grid"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'>Kelompok</font></span>
                                                <span class="widget-thumb-body-stat" ><font color='white'><?= number_format($a); ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#E7505A">
                                        <h4 class="widget-thumb-heading"><font color='white'>Jumlah RUTILAHU</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red icon-home"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'>Kelompok</font></span>
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format($b); ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#8E44AD">
                                        <h4 class="widget-thumb-heading"><font color='white'>Jumlah Sarling</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple icon-layers"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'>Tim</font></span>
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format($c); ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grafik" style="width:100%; height:400px;"></div>
                            <div class="tabbable-line">
                                <table class="table table-striped table-bordered" id="tbl1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%"> # </th>
                                            <th style="text-align: center;"> Kecamatan </th>
                                            <th style="text-align: center;"> Jumlah Kube </th>
                                            <th style="text-align: center;"> Jumlah Rutilahu </th>
                                            <th style="text-align: center;"> Jumlah Sarling </th>
                                            <th style="text-align: center;" width="7%"> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_utama_1 as $key => $value) {
                                            $jumlah_kube = 0;
                                            $jumlah_rutilahu = 0;
                                            $jumlah_sarling = 0;
                                            $persentase_anggaran_kube = 0;
                                            if($value->jumlah_kube=='0'){
                                                echo'';
                                            }else{
                                                $jumlah_kube = $value->jumlah_kube;
                                            }
                                            if($value->jumlah_rutilahu=='0'){
                                                echo'';
                                            }else{
                                                $jumlah_rutilahu = $value->jumlah_rutilahu;
                                            }
                                            if($value->jumlah_sarling=='0'){
                                                echo'';
                                            }else{
                                                $jumlah_sarling = $value->jumlah_sarling;
                                            }
                                            echo'
                                            <tr>
                                                <td style="text-align: center;">'.$no++.'.</td>
                                                <td><a href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">'.$value->nm_kecamatan.'</a></td>
                                                <td style="text-align: center;">'.number_format($jumlah_kube,0).' Kelompok</td>
                                                <td style="text-align: center;">'.number_format($jumlah_rutilahu,0).' Kelompok</td>
                                                <td style="text-align: center;">'.number_format($jumlah_sarling,0).' Tim</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-xs green" href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">
                                                    <i class="icon-eye"></i> Detail Data </a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">
                                $('.grafik').highcharts({
                                    chart: {
                                        type: 'line',
                                        marginTop: 80
                                    },
                                    credits: {
                                        enabled: false
                                    }, 
                                    tooltip: {
                                        shared: true,
                                        crosshairs: true,
                                        headerFormat: '<b>{point.key}</b><br/>'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    // subtitle: {
                                    //     text: 'Jumlah Kube, RLTH, dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?>'
                                    // },
                                    xAxis: {
                                        categories: [
                                                        <?php
                                                        foreach ($data_utama_1 as $key => $value) {
                                                            echo "'".$value->nm_kecamatan."',";
                                                        }
                                                        ?>
                                                    ],
                                        labels: {
                                            rotation: 0,
                                            align: 'right',
                                            style: {
                                                fontSize: '10px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Kelompok/ Tim'
                                        }
                                    },
                                    legend: {
                                        enabled: true
                                    },
                                    series:[
                                                {
                                                    name: 'Kube',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_1 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_kube=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = $fff->jumlah_kube;
                                                                }
                                                                echo number_format($persentase,0).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Rutilahu',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_1 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_rutilahu=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = $fff->jumlah_rutilahu;
                                                                }
                                                                echo number_format($persentase,0).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Sarling',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_1 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_sarling=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = $fff->jumlah_sarling;
                                                                }
                                                                echo number_format($persentase,0).",";
                                                            }
                                                        ?>
                                                    ],
                                                }
                                            ]
                                });
                            </script>
                            <?php
                            }elseif(isset($data_utama_2)){
                                $d1 = 0;
                                $d2 = 0;
                                $e1 = 0;
                                $e2 = 0;
                                $f1 = 0;
                                $f2 = 0;
                                foreach ($data_utama_2 as $key => $value) {
                                    if($value->jumlah_kube=='0'){
                                        echo'';
                                    }else{
                                        $d1 += $value->jumlah_kube;
                                        $d2 += $value->persentase_realisasi_kube;
                                    }
                                    if($value->jumlah_rutilahu=='0'){
                                        echo'';
                                    }else{
                                        $e1 += $value->jumlah_rutilahu;
                                        $e2 += $value->persentase_realisasi_rutilahu;
                                    }
                                    if($value->jumlah_sarling=='0'){
                                        echo'';
                                    }else{
                                        $f1 += $value->jumlah_sarling;
                                        $f2 += $value->persentase_realisasi_sarling;
                                    }
                                }
                            ?>
                            <hr>
                            <div style='text-align: center'>
                            <h3><b>Rekap Realisasi Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?></b></h3><br>
                            </div>
                            <div class="row widget-row">
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#32C5D2">
                                        <h4 class="widget-thumb-heading"><font color='white'>Realisasi KUBE</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-green icon-grid"></i>
                                            <div class="widget-thumb-body">
                                                <!-- <span class="widget-thumb-subtitle"><font color='white'>Kelompok</font></span> -->
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($d2/$d1)/(count($data_utama_2))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#E7505A">
                                        <h4 class="widget-thumb-heading"><font color='white'>Realisasi RUTILAHU</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red icon-home"></i>
                                            <div class="widget-thumb-body">
                                                <!-- <span class="widget-thumb-subtitle"><font color='white'>Kelompok</font></span> -->
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($e2/$e1)/(count($data_utama_2))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb text-uppercase margin-bottom-20 " style="background-color:#8E44AD">
                                        <h4 class="widget-thumb-heading"><font color='white'>Realisasi Sarling</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple icon-layers"></i>
                                            <div class="widget-thumb-body">
                                                <!-- <span class="widget-thumb-subtitle"><font color='white'>Tim</font></span> -->
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($f2/$f1)/(count($data_utama_2))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grafik" style="width:100%; height:400px;"></div>
                            <div class="tabbable-line">
                                <table class="table table-striped table-bordered" id="tbl1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%"> # </th>
                                            <th style="text-align: center;"> Kecamatan </th>
                                            <th style="text-align: center;"> Realisasi Kube </th>
                                            <th style="text-align: center;"> Realisasi Rutilahu </th>
                                            <th style="text-align: center;"> Realisasi Sarling </th>
                                            <th style="text-align: center;" width="7%"> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_utama_2 as $key => $value) {
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
                                                <td><a href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">'.$value->nm_kecamatan.'</a></td>
                                                <td style="text-align: center;">'.number_format($persentase_kube,2).'%</td>
                                                <td style="text-align: center;">'.number_format($persentase_rutilahu,2).'%</td>
                                                <td style="text-align: center;">'.number_format($persentase_sarling,2).'%</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-xs green" href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">
                                                    <i class="icon-eye"></i> Detail Data </a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">
                                $('.grafik').highcharts({
                                    chart: {
                                        type: 'line',
                                        marginTop: 80
                                    },
                                    credits: {
                                        enabled: false
                                    }, 
                                    tooltip: {
                                        shared: true,
                                        crosshairs: true,
                                        headerFormat: '<b>{point.key}</b><br/>'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    // subtitle: {
                                    //     text: 'Rekap Realisasi Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?>'
                                    // },
                                    xAxis: {
                                        categories: [
                                                        <?php
                                                        foreach ($data_utama_2 as $key => $value) {
                                                            echo "'".$value->nm_kecamatan."',";
                                                        }
                                                        ?>
                                                    ],
                                        labels: {
                                            rotation: 0,
                                            align: 'right',
                                            style: {
                                                fontSize: '10px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Persentase Realisasi (%)'
                                        }
                                    },
                                    legend: {
                                        enabled: true
                                    },
                                    series:[
                                                {
                                                    name: 'Kube',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_2 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_kube=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_realisasi_kube)/($fff->jumlah_kube);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Rutilahu',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_2 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_rutilahu=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_realisasi_rutilahu)/($fff->jumlah_rutilahu);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Sarling',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_2 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_sarling=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_realisasi_sarling)/($fff->jumlah_sarling);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],
                                                }
                                            ]
                                });
                            </script>
                            <?php
                            }elseif(isset($data_utama_3)){
                                $g1 = 0;
                                $g2 = 0;
                                $g3 = 0;
                                $h1 = 0;
                                $h2 = 0;
                                $h3 = 0;
                                $i1 = 0;
                                $i2 = 0;
                                $i3 = 0;
                                foreach ($data_utama_3 as $key => $value) {
                                    if($value->jumlah_kube=='0'){
                                        echo'';
                                    }else{
                                        $g1 += $value->anggaran_kube;
                                        $g2 += $value->persentase_anggaran_kube;
                                        $g3 += $value->jumlah_kube;
                                    }
                                    if($value->jumlah_rutilahu=='0'){
                                        echo'';
                                    }else{
                                        $h1 += $value->anggaran_rutilahu;
                                        $h2 += $value->persentase_anggaran_rutilahu;
                                        $h3 += $value->jumlah_rutilahu;
                                    }
                                    if($value->jumlah_sarling=='0'){
                                        echo'';
                                    }else{
                                        $i1 += $value->anggaran_sarling;
                                        $i2 += $value->persentase_anggaran_sarling;
                                        $i3 += $value->jumlah_sarling;
                                    }
                                }
                            ?>
                            <hr>
                            <div style='text-align: center'>
                            <h3><b>Rekap Serapan Bantuan Keuangan untuk Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?></b></h3><br>
                            </div>
                            <div class="row widget-row">
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#32C5D2">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Serapan Anggaran KUBE</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-green icon-grid"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'><?= 'Rp '.number_format((($g1)),2); ?></font></span>
                                                <span class="widget-thumb-body-stat"><font color='white'><?php if($g3=='0' OR count($data_utama_3)=='0'){echo'0.00%';}else{ echo number_format((($g2/$g3)/(count($data_utama_3))),2).'%';} ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#E7505A">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Serapan Anggaran RUTILAHU</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red icon-home"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'><?= 'Rp '.number_format((($h1)),2); ?></font></span>
                                                <span class="widget-thumb-body-stat"><font color='white'><?php if($h3=='0' OR count($data_utama_3)=='0'){echo'0.00%';}else{ echo number_format((($h2/$h3)/(count($data_utama_3))),2).'%';} ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#8E44AD">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Serapan Anggaran Sarling</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple icon-layers"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"><font color='white'><?= 'Rp '.number_format((($i1)),2); ?></font></span>
                                                <span class="widget-thumb-body-stat"><font color='white'><?php if($i3=='0' OR count($data_utama_3)=='0'){echo'0.00%';}else{ echo number_format((($i2/$i3)/(count($data_utama_3))),2).'%';} ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grafik" style="width:100%; height:400px;"></div>
                            <div class="tabbable-line">
                                <table class="table table-striped table-bordered" id="tbl1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%"> # </th>
                                            <th style="text-align: center;"> Kecamatan </th>
                                            <th style="text-align: center;"> Serapan Anggaran Kube </th>
                                            <th style="text-align: center;"> Serapan Anggaran Rutilahu </th>
                                            <th style="text-align: center;"> Serapan Anggaran Sarling </th>
                                            <th style="text-align: center;" width="7%"> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_utama_3 as $key => $value) {
                                            $anggaran_kube = 0;
                                            $persentase_anggaran_kube = 0;
                                            if($value->jumlah_kube=='0'){
                                                echo'';
                                            }else{
                                                $anggaran_kube += ($value->anggaran_kube);
                                                $persentase_anggaran_kube = ($value->persentase_anggaran_kube)/($value->jumlah_kube);
                                            }
                                            $anggaran_rutilahu = 0;
                                            $persentase_anggaran_rutilahu = 0;
                                            if($value->jumlah_rutilahu=='0'){
                                                echo'';
                                            }else{
                                                $anggaran_rutilahu += ($value->anggaran_rutilahu);
                                                $persentase_anggaran_rutilahu = ($value->persentase_anggaran_rutilahu)/($value->jumlah_rutilahu);
                                            }
                                            $anggaran_sarling = 0;
                                            $persentase_anggaran_sarling = 0;
                                            if($value->jumlah_sarling=='0'){
                                                echo'';
                                            }else{
                                                $anggaran_sarling += ($value->anggaran_sarling);
                                                $persentase_anggaran_sarling = ($value->persentase_anggaran_sarling)/($value->jumlah_sarling);
                                            }
                                            echo'
                                            <tr>
                                                <td style="text-align: center;">'.$no++.'.</td>
                                                <td><a href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">'.$value->nm_kecamatan.'</a></td>
                                                <td style="text-align: center;">Rp '.number_format($anggaran_kube,2).' ('.number_format($persentase_anggaran_kube,2).'%)</td>
                                                <td style="text-align: center;">Rp '.number_format($anggaran_rutilahu,2).' ('.number_format($persentase_anggaran_rutilahu,2).'%)</td>
                                                <td style="text-align: center;">Rp '.number_format($anggaran_sarling,2).' ('.number_format($persentase_anggaran_sarling,2).'%)</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-xs green" href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">
                                                    <i class="icon-eye"></i> Detail Data </a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">
                                $('.grafik').highcharts({
                                    chart: {
                                        type: 'line',
                                        marginTop: 80
                                    },
                                    credits: {
                                        enabled: false
                                    }, 
                                    tooltip: {
                                        shared: true,
                                        crosshairs: true,
                                        headerFormat: '<b>{point.key}</b><br/>'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    // subtitle: {
                                    //     text: 'Rekap Serapan Bantuan Keuangan untuk Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?>'
                                    // },
                                    xAxis: {
                                        categories: [
                                                        <?php
                                                        foreach ($data_utama_3 as $key => $value) {
                                                            echo "'".$value->nm_kecamatan."',";
                                                        }
                                                        ?>
                                                    ],
                                        labels: {
                                            rotation: 0,
                                            align: 'right',
                                            style: {
                                                fontSize: '10px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Persentase Serapan (%)'
                                        }
                                    },
                                    legend: {
                                        enabled: true
                                    },
                                    series:[
                                                {
                                                    name: 'Kube',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_3 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_kube=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_anggaran_kube)/($fff->jumlah_kube);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Rutilahu',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_3 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_rutilahu=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_anggaran_rutilahu)/($fff->jumlah_rutilahu);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Sarling',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_3 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_sarling=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_anggaran_sarling)/($fff->jumlah_sarling);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],
                                                }
                                            ]
                                });
                            </script>
                            <?php
                            }elseif(isset($data_utama_4)){
                                $j1 = 0;
                                $j2 = 0;
                                $k1 = 0;
                                $k2 = 0;
                                $l1 = 0;
                                $l2 = 0;
                                foreach ($data_utama_4 as $key => $value) {
                                    if($value->jumlah_kube=='0'){
                                        echo'';
                                    }else{
                                        $j1 += ($value->persentase_fisik_kube);
                                        $j2 += ($value->jumlah_kube);
                                    }
                                    if($value->jumlah_rutilahu=='0'){
                                        echo'';
                                    }else{
                                        $k1 += ($value->persentase_fisik_rutilahu);
                                        $k2 += ($value->jumlah_rutilahu);
                                    }
                                    if($value->jumlah_sarling=='0'){
                                        echo'';
                                    }else{
                                        $l1 += ($value->persentase_fisik_sarling);
                                        $l2 += ($value->jumlah_sarling);
                                    }
                                }
                            ?>
                            <hr>
                            <div style='text-align: center'>
                            <h3><b>Rekap Progress Fisik Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?></b></h3><br>
                            </div>
                            <div class="row widget-row">
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#32C5D2">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Progres Fisik KUBE</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-green icon-grid"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($j1/$j2)/(count($data_utama_4))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#E7505A">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Progres Fisik RUTILAHU</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-red icon-home"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($k1/$k2)/(count($data_utama_4))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget-thumb margin-bottom-20 " style="background-color:#8E44AD">
                                        <h4 class="widget-thumb-heading text-uppercase"><font color='white'>Progres Fisik Sarling</font></h4>
                                        <div class="widget-thumb-wrap">
                                            <i class="widget-thumb-icon bg-purple icon-layers"></i>
                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-body-stat"><font color='white'><?= number_format((($l1/$l2)/(count($data_utama_4))),2).'%'; ?></font></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grafik" style="width:100%; height:400px;"></div>
                            <div class="tabbable-line">
                                <table class="table table-striped table-bordered" id="tbl1">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;" width="4%"> # </th>
                                            <th style="text-align: center;"> Kecamatan </th>
                                            <th style="text-align: center;"> Progres Fisik Kube </th>
                                            <th style="text-align: center;"> Progres Fisik Rutilahu </th>
                                            <th style="text-align: center;"> Progres Fisik Sarling </th>
                                            <th style="text-align: center;" width="7%"> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($data_utama_4 as $key => $value) {
                                            $persentase_fisik_kube = 0;
                                            if($value->jumlah_kube=='0'){
                                                echo'';
                                            }else{
                                                $persentase_fisik_kube = ($value->persentase_fisik_kube)/($value->jumlah_kube);
                                            }
                                            $persentase_fisik_rutilahu = 0;
                                            if($value->jumlah_rutilahu=='0'){
                                                echo'';
                                            }else{
                                                $persentase_fisik_rutilahu = ($value->persentase_fisik_rutilahu)/($value->jumlah_rutilahu);
                                            }
                                            $persentase_fisik_sarling = 0;
                                            if($value->jumlah_sarling=='0'){
                                                echo'';
                                            }else{
                                                $persentase_fisik_sarling = ($value->persentase_fisik_sarling)/($value->jumlah_sarling);
                                            }
                                            echo'
                                            <tr>
                                                <td style="text-align: center;">'.$no++.'.</td>
                                                <td><a href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">'.$value->nm_kecamatan.'</a></td>
                                                <td style="text-align: center;">'.number_format($persentase_fisik_kube,2).'%</td>
                                                <td style="text-align: center;">'.number_format($persentase_fisik_rutilahu,2).'%</td>
                                                <td style="text-align: center;">'.number_format($persentase_fisik_sarling,2).'%</td>
                                                <td style="text-align: center;">
                                                    <a class="btn btn-xs green" href="'.site_url().'admin_side/dasbor_grafik_kecamatan/'.md5($value->id_kecamatan).'/'.$penanda.'">
                                                    <i class="icon-eye"></i> Detail Data </a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">
                                $('.grafik').highcharts({
                                    chart: {
                                        type: 'line',
                                        marginTop: 80
                                    },
                                    credits: {
                                        enabled: false
                                    }, 
                                    tooltip: {
                                        shared: true,
                                        crosshairs: true,
                                        headerFormat: '<b>{point.key}</b><br/>'
                                    },
                                    title: {
                                        text: ''
                                    },
                                    // subtitle: {
                                    //     text: 'Rekap Progress Fisik Program Kube, RLTH dan Sarling <?= $data_kabupaten->nm_kabupaten; ?> Tahun <?= $periode; ?>'
                                    // },
                                    xAxis: {
                                        categories: [
                                                        <?php
                                                        foreach ($data_utama_4 as $key => $value) {
                                                            echo "'".$value->nm_kecamatan."',";
                                                        }
                                                        ?>
                                                    ],
                                        labels: {
                                            rotation: 0,
                                            align: 'right',
                                            style: {
                                                fontSize: '10px',
                                                fontFamily: 'Verdana, sans-serif'
                                            }
                                        }
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Persentase Progress Fisik (%)'
                                        }
                                    },
                                    legend: {
                                        enabled: true
                                    },
                                    series:[
                                                {
                                                    name: 'Kube',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_4 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_kube=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_fisik_kube)/($fff->jumlah_kube);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Rutilahu',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_4 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_rutilahu=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_fisik_rutilahu)/($fff->jumlah_rutilahu);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],

                                                },
                                                {
                                                    name: 'Sarling',
                                                    data: [
                                                        <?php
                                                            foreach ($data_utama_4 as $key => $fff) {
                                                                $persentase = 0;
                                                                if($fff->jumlah_sarling=='0'){
                                                                    echo'';
                                                                }else{
                                                                    $persentase = ($fff->persentase_fisik_sarling)/($fff->jumlah_sarling);
                                                                }
                                                                echo number_format($persentase,2).",";
                                                            }
                                                        ?>
                                                    ],
                                                }
                                            ]
                                });
                            </script>
                            <?php
                            }
                            ?>
							<script>
							$(document).ready( function () {
								$('#tbl1').DataTable();
							} );
							</script>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>