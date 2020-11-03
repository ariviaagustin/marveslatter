<?php
  header("Content-Type: application/force-download");
  header("Cache-Control: no-cache, must-revalidate");
  header("Expires: Sat, 26 Jul 2010 05:00:00 GMT");
  header("content-disposition: attachment;filename=".$nama_file);
?>
<table width="100%" align="center">
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
<hr>
<table width="100%">
  <tr>
    <td style="width: auto;">Nomor</td>
    <td> : </td>
    <td><?= $se->no_surat; ?></td>
    <td style="text-align: right;"><?= $kota.", ".tanggal_indo($se->tgl_surat); ?></td>
  </tr>
  <tr>
    <td>Sifat</td>
    <td> : </td>
    <td colspan="2">
      <?php
        foreach ($sifat as $key) 
        {
          if($se->sifat_surat == $key->id_sifat_surat)
          {
            echo $key->nama_sifat_surat;
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td>Lampiran</td>
    <td> : </td>
    <td colspan="2">
      <?php
        if(!empty($se->lampiran_surat))
        {
          echo $se->lampiran_surat;
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
    <td colspan="2"><?= $se->perihal_surat; ?></td>
  </tr>
</table>
<br><br>
<table>
  <tr>
    <td><?= $se->tujuan_surat_ke; ?></td>
  </tr>
  <tr>
    <td>
      <?php 
        if(!empty($se->alamat_tujuan_surat))
        {
          echo "Di ".$se->alamat_tujuan_surat;
        }
        else
        {
          echo "di tempat";
        }
      ?>
    </td>
  </tr>
</table>
<br><br>
<table>
  <tr>
    <td>Dengan hormat,</td>
  </tr>
  <tr>
    <td style="text-align: justify;"><?= $se->isi_surat; ?></td>
  </tr>
</table>
<br>
<table align="right">
  <tr>
    <td style="text-align: center;">Hormat kami,</td>
  </tr>
  <tr><td><br><br></td></tr>
  <?php
    foreach ($ttd as $key) 
    {
      if($key->id_data_pegawai == $se->penandatangan)
      {
        $a = $key->nama_pegawai;
        $b = $key->nama_jabatan;
      }
    }
  ?>
  <tr>
    <td style="text-align: center;"><?= $a; ?></td>
  </tr>
  <tr>
    <td style="text-align: center;"><?= $b; ?></td>
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