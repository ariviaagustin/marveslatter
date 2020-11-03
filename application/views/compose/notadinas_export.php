<?php
header("Content-Type: application/force-download");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 2010 05:00:00 GMT");
header("content-disposition: attachment;filename=".$nama_file);
?>
<table width="100%">
  <tr>
    <td rowspan="3" width="5%">
      <img src="<?= site_url('assets/img/logo_instansi/'.$instansi[0]->logo_instansi); ?>" width = "70" height = "70">
    </td>
    <td style="text-align: center;"><b><?= $instansi[0]->nama_instansi; ?></b></td>
  </tr>
  
  <tr>
    <td style="text-align: center;"><?= $instansi[0]->alamat_instansi; ?></td>
  </tr>
   <tr>
    <td style="text-align: center; vertical-align: top;"><?= $kota; ?></td>
  </tr>
</table>
<hr style="height: 2px; background: black"><br>
<table width="100%">
  <tr>
    <td style="text-align: center;"><h3><b><u>NOTA DINAS</u></b></h3></td>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <td width="15%">Kepada Yth</td>
    <td> : </td>
    <td>
      <?php 
        foreach ($jab as $key) 
        {
          if($key->id_jabatan == $data->tujuan_nota_dinas)
          {
            echo $key->nama_jabatan;
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td>Dari</td>
    <td> : </td>
    <td>
      <?php 
        foreach ($pegawai as $j) 
        {
          if($j->id_data_pegawai == $data->penandatangan_nota_dinas)
          {
            echo $j->nama_jabatan;
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td style="width: auto;">Nomor</td>
    <td> : </td>
    <td><?php echo  $data->nomor_nota_dinas; ?></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td> : </td>
    <td><?php echo  tanggal_indo($data->tanggal_nota_dinas); ?></td>
  </tr>
  <tr>
    <td>Sifat</td>
    <td> : </td>
    <td><?php echo  $data->nama_sifat_surat; ?></td>
  </tr>
  <tr>
    <td>Lampiran</td>
    <td> : </td>
    <td>
      <?php
        if(!empty($data->lampiran_nota_dinas))
        {
          echo $data->lampiran_nota_dinas;
        }
        else
        {
          echo "-";
        }
      ?>
  </td>
  </tr>
  <tr>
    <td>Perihal</td>
    <td> : </td>
    <td><?php echo  $data->perihal_nota_dinas; ?></td>
  </tr>
</table>
<hr><br>
<table width="100%">
  <tr>
    <td>Dengan hormat,</td>
  </tr>
  <tr>
    <td style="text-align: justify;"><p style="text-align: justify;"><?php echo  $data->isi_nota_dinas; ?></p> </td>
  </tr>
</table>
<br>
<table align="right">
  <tr>
    <td style="text-align: center;">Hormat kami,</td>
  </tr>
  <tr><td><br><br></td></tr>
  <?php 
        foreach ($pegawai as $j) 
        {
          if($j->id_data_pegawai == $data->penandatangan_nota_dinas)
          { ?>
          <tr>
            <td style="text-align: center;"><?php echo '<br><br>'.$j->nama_pegawai; ?></td>
          </tr>
          <tr>
              <td style="text-align: center;"><?php echo $j->nama_jabatan; ?></td>
          </tr>
  <?php   }
        }
  ?>
  <tr><td><br></td></tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="100%">
  <tr>
    <td><b><u>Tembusan:</u></b></td>
  </tr>
  <tr>
    <td>
      <?php
        $no = 1;
        foreach (json_decode($data->tembusan_nota_dinas) as $tembusan) 
        {
          foreach ($jab_bag as $key) 
          {
            if($key->id_jabatan ==  $tembusan)
            {
              echo $no++.". ".$key->nama_jabatan."<br>";
            }
          }
        }
      ?>
    </td>
  </tr>
</table>
<?php
  function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array ( 1 =>    'Senin',
      'Selasa',
      'Rabu',
      'Kamis',
      'Jumat',
      'Sabtu',
      'Minggu'
    );
  
    $bulan = array (1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
    );
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }
?>