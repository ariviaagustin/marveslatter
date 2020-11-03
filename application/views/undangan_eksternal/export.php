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
    <td><?= $ue->no_surat; ?></td>
    <td style="text-align: right;"><?= $kota.", ".tanggal_indo($ue->tgl_surat); ?></td>
  </tr>
  <tr>
    <td>Lampiran</td>
    <td> : </td>
    <td colspan="2">
      <?php
        if(!empty($ue->lampiran_surat))
        {
          echo $ue->lampiran_surat;
        }
        else
        {
          echo "-";
        }
      ?>
    </td>
  </tr>
  <tr>
    <td>Sifat</td>
    <td> : </td>
    <td colspan="2">
      <?php
            echo $ue->nama_sifat_surat;
      ?>
    </td>
  </tr>
  <tr>
    <td>Perihal</td>
    <td> : </td>
    <td colspan="2"><?= $ue->perihal_surat; ?></td>
  </tr>
</table>
<br>
<table>
  <tr>
    <td>Kepada Yth,</td>
  </tr>
  <tr>
    <td><?= $ue->tujuan_surat_ke; ?></td>
  </tr>
  <tr>
    <td>
      <?php 
        if(!empty($ue->alamat_tujuan_surat))
        {
          echo "Di ".$ue->alamat_tujuan_surat;
        }
        else
        {
          echo "di tempat";
        }
      ?> 
    </td>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <td>Dengan hormat,</td>
  </tr>
  <tr>
    <td style="text-align: justify;"><p style="text-align: justify;"><?= $ue->isi_surat; ?></p></td>
  </tr>
  <tr>
    <td style="text-align: justify;">
      <p style="text-align: justify;">Maka dari itu, berdasarkan klasifikasi <?php echo $ue->klasifikasi; ?> bersama dengan ini kami mengharap kehadiran Bapak /Ibu untuk dapat menghadiri dan mengikuti acara tersebut yang akan diselenggarakan pada:</p>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td>Hari / Tanggal</td>
    <td> : </td>
    <td><?= tanggal_indo($ue->tanggal_dimulai_acara)." - ".tanggal_indo($ue->tanggal_selesai_acara); ?></td>
  </tr>
  <tr>
    <td>Waktu</td>
    <td> : </td>
    <td>
      <?php 
        if($ue->jam_selesai_acara != '00:00:00')
        {
          $jam = "- ".date('H:i', strtotime($ue->jam_selesai_acara))." WIB";
        }
        else
        {
          $jam = "WIB - Selesai";
        }
      ?>
      <?= date('H:i', strtotime($ue->jam_dimulai_acara))." ".$jam; ?>
    </td>
  </tr>
  <tr>
    <td>Tempat</td>
    <td> : </td>
    <td><?= $ue->lokasi_acara; ?></td>
  </tr>
</table>
<table width="100%">
  <tr>
    <td>
      <p style="text-align: justify;">Demikian surat undangan ini kami buat sebagai mana mestinya, atas perhatian dan juga partisipasi serta kehadirannya kami ucapkan terima kasih.</p>
    </td>
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
      if($key->id_data_pegawai == $ue->penandatangan)
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
<br><br><br><br><br><br><br>
<table width="100%">
  <tr>
    <td><b><u>Tembusan:</u></b></td>
  </tr>
  <tr>
    <td>
      <?php
        $no = 1;
        foreach (json_decode($ue->tembusan_surat) as $tembusan) 
        {
          foreach ($ttd as $key) 
          {
            if($key->id_data_pegawai ==  $tembusan)
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