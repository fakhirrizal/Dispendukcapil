<?php 
date_default_timezone_set('Asia/Jakarta');
?>
<div class='entry'>
  <table border='1' align='left'>
    <tr>
      <td colspan='5'>Tanggal perubahan terakhir : <font color='red'><?php echo $this->Main_model->convert_tanggal(date('Y-m-d'))?> | <?php echo date('H:i');?> WIB</font></td>
    </tr>
    <tr>
      <td colspan='5' style="text-align: center;">Rekap Data Admin Wilayah</td>
    </tr>
    <tr>
      <td bgcolor='gren' style="text-align: center;" width='10px'>No</td>
      <td bgcolor='gren' style="text-align: center;">Nama</td>
      <td bgcolor='gren' style="text-align: center;">Username</td>
      <td bgcolor='gren' style="text-align: center;">Wilayah</td>
      <td bgcolor='gren' style="text-align: center;">Keterangan</td>
    </tr>
    <?php
    $get_data1 = $this->Main_model->getSelectedData('user a', 'a.id,a.username,c.fullname,d.nm_provinsi',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '5'),'','','','',array(
      array(
        'table' => 'user_to_role b',
        'on' => 'a.id=b.user_id',
        'pos' => 'LEFT'
      ),
      array(
        'table' => 'user_profile c',
        'on' => 'a.id=c.user_id',
        'pos' => 'LEFT'
      ),
      array(
        'table' => 'provinsi d',
        'on' => 'c.wilayah=d.id_provinsi',
        'pos' => 'LEFT'
      )
    ))->result();
    $n=1;
    foreach ($get_data1 as $key => $value) {
      echo'
      <tr>
        <td style="text-align: center;">'.$n.'</td>
        <td>'.$value->fullname.'</td>
        <td style="text-align: center;">'.$value->username.'</td>
        <td style="text-align: center;">'.$value->nm_provinsi.'</td>
        <td style="text-align: center;">Admin Provinsi</td>
      </tr>
      ';
      $n++;
    }
    $get_data2 = $this->Main_model->getSelectedData('user a', 'a.id,a.username,c.fullname,d.nm_kabupaten',array("a.is_active" => '1','a.deleted' => '0','b.role_id' => '6'),'','','','',array(
      array(
        'table' => 'user_to_role b',
        'on' => 'a.id=b.user_id',
        'pos' => 'LEFT'
      ),
      array(
        'table' => 'user_profile c',
        'on' => 'a.id=c.user_id',
        'pos' => 'LEFT'
      ),
      array(
        'table' => 'kabupaten d',
        'on' => 'c.wilayah=d.id_kabupaten',
        'pos' => 'LEFT'
      )
    ))->result();
    foreach ($get_data2 as $key => $value) {
      echo'
      <tr>
        <td style="text-align: center;">'.$n.'</td>
        <td>'.$value->fullname.'</td>
        <td style="text-align: center;">'.$value->username.'</td>
        <td style="text-align: center;">'.$value->nm_kabupaten.'</td>
        <td style="text-align: center;">Admin Kabupaten/ Kota</td>
      </tr>
      ';
      $n++;
    }

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=rekap_data_admin.xls");
    ?>
  </table>
</div>