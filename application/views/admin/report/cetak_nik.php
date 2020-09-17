<?php 
date_default_timezone_set('Asia/Jakarta');
?>
<div class='entry'>
    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" border='1'>
        <thead>
            <tr>
                <th style="text-align: center;vertical-align: middle;" colspan='4'>Rekap Data <?= $this->Main_model->convert_tanggal(date('Y-m-d')); ?></th>
            </tr>
            <tr>
                <th style="text-align: center;vertical-align: middle;">NIK</th>
                <th style="text-align: center;vertical-align: middle;">Nama</th>
                <th style="text-align: center;vertical-align: middle;">Keterangan</th>
                <th style="text-align: center;vertical-align: middle;">WA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($get_data as $key => $value) {
                echo'
                <tr class="odd gradeX">
                    <td style="text-align: center;">'.$value->nik.'</td>
                    <td style="text-align: center;">'.$value->nama.'</td>
                    <td style="text-align: center;">'.$value->keterangan.'</td>
                    <td style="text-align: center;">'.$value->wa.'</td>
                </tr>';
            }
            ?>
        </tbody>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=rekap_data.xls");
        ?>
    </table>
</div>