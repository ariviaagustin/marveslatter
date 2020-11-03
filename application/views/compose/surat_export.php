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
    <td><?= $si->no_surat; ?></td>
    <td style="text-align: right;"><?= $kota.", ".tanggal_indo($si->tgl_surat); ?></td>
  </tr>
  <tr>
    <td>Sifat</td>
    <td> : </td>
    <td colspan="2">
      <?php
        foreach ($sifat as $key) 
        {
          if($si->sifat_surat == $key->id_sifat_surat)
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
        if(!empty($si->lampiran_surat))
        {
          echo $si->lampiran_surat;
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
    <td colspan="2"><?= $si->perihal_surat; ?></td>
  </tr>
</table>
<br><br>
<table width="100%">
  <tr>
    <td>Kepada Yth.</td>
  </tr>
  <tr>
    <td>
      <?php
        $no = 1;
        $z = json_decode($si->tujuan_surat_ke);
        $y = count($z);
        foreach ($z as $key) 
        {
          if($si->jenis_tujuan_surat == 1)
          {
            foreach ($ttd as $a) 
            {
              if($a->id_data_pegawai == $key)
              {
                $x = $no++;
                echo $x.". ".$a->nama_pegawai." - ".$a->nama_jabatan;
                if($x < $y)
                {
                  echo "<br>";
                }
              }
            }
          }
          else if($si->jenis_tujuan_surat == 2)
          {
            foreach ($jabatan as $b) 
            {
              if($b->id_jabatan == $key)
              {
                $x = $no++;
                echo $x.". ".$b->nama_jabatan." - ".$b->nama_bagian;
                if($x < $y)
                {
                  echo "<br>";
                }
              }
            }
          }
          else if($si->jenis_tujuan_surat == 3)
          {
            foreach ($bag_unit as $c) 
            {
              if($c->id_bag_unit_kerja == $key)
              {
                $x = $no++;
                echo $x.". ".$c->nama_bagian." - ".$c->nama_unit_kerja;
                if($x < $y)
                {
                  echo "<br>";
                }
              }
            }
          }
          else if($si->jenis_tujuan_surat == 4)
          {
            foreach ($unit as $d) 
            {
              if($d->id_unit_kerja == $key)
              {
                $x = $no++;
                echo $x.". ".$d->nama_unit_kerja;
                if($x < $y)
                {
                  echo "<br>";
                }
              }
            }
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td>di tempat</td>
  </tr>
</table>
<br><br>
<table width="100%">
  <tr>
    <td>Dengan hormat,</td>
  </tr>
  <tr>
    <td style="text-align: justify;"><?= $si->isi_surat; ?></td>
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
      if($key->id_data_pegawai == $si->penandatangan)
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