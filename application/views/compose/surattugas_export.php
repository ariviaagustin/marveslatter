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
    <td style="text-align: center; font-size: 15pt"><b><u>SURAT PENUGASAN</u></b></td>
  </tr>
  <tr>
    <td style="text-align: center;">Nomor: <?= $data->nomer_sti; ?></td>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <td colspan="3">Yang bertanda tangan di bawah ini:</td>
  </tr>
  <tr>
    <td width="32%">Nama</td>
    <td> : </td>
    <td><?= $data->nama_pegawai; ?></td>
  </tr>
  <tr>
    <td>ID Pegawai</td>
    <td> : </td>
    <td><?= $data->no_pegawai; ?></td>
  </tr>
  <tr>
    <td>Jabatan</td>
    <td> : </td>
    <td><?= $data->nama_jabatan; ?></td>
  </tr>
</table>
<br>
<table>
  <tr>
    <td colspan="4">Dengan ini menugaskan kepada:</td>
  </tr>
  <?php 
    $no = 1;
    foreach (json_decode($data->yang_diberi_tugas) as $key) 
    { 
      foreach ($peg_jab as $a) 
      {
        if($a->id_data_pegawai == $key)
        {
          $b = $a->nama_pegawai;
          $c = $a->nama_jabatan;
        }
      }
  ?>
    <tr>
      <td rowspan = "2" style="vertical-align: top;"><?= $no++.". "; ?></td>
      <td width="43%">Nama</td>
      <td> : </td>
      <td><?= $b; ?></td>
    </tr>
    <tr>
      <td>Jabatan</td>
      <td> : </td>
      <td><?= $c; ?></td>
    </tr>
  <?php } ?>
</table>
<br>
<table>
  <tr>
    <td colspan="3">Untuk mengikuti:</td>
  </tr>
  <tr>
    <td width="45%">Tujuan</td>
    <td> : </td>
    <td><?= $data->nama_kokab." - ".$data->nama_provinsi; ?></td>
  </tr>
  <tr>
    <td>Tanggal Bertugas</td>
    <td> : </td>
    <td><?= tanggal_indo($data->tanggal_mulai_bertugas)." - ".tanggal_indo($data->tanggal_selesai_bertugas); ?> </td>
  </tr>
  <tr>
    <td>Transportasi yang digunakan</td>
    <td> : </td>
    <td><?= $data->nama_moda; ?></td>
  </tr>
  <tr>
    <td>Sumber Biaya</td>
    <td> : </td>
    <td><?= $data->sumber_biaya; ?></td>
  </tr>
  <tr>
    <td>Jenis Tugas</td>
    <td> : </td>
    <td><?= $data->nama_jenis_tugas; ?></td>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <td style="text-align: justify;"><?= $data->kata_pembuka_sti; ?></td>
  </tr>
  <tr>
    <td style="text-align: justify;"><?= $data->dasar_sti; ?></td>
  </tr>
</table>
<br><br>
<table align="right">
  <tr>
    <td style="text-align: center;"><?= $kota.", ".tanggal_indo($data->tanggal_sti); ?></td>
  </tr>
  <tr><td><br><br></td></tr>
  <tr>
    <td style="text-align: center;"><?= $data->nama_pegawai; ?></td>
  </tr>
  <tr>
    <td style="text-align: center;"><?= $data->nama_jabatan; ?></td>
  </tr>
  <tr><td><br></td></tr>
</table>
<br>
<table width="100%">
  <tr>
    <td><b><u>Tembusan:</u></b></td>
  </tr>
  <tr>
    <td>
      <?php
        $no = 1;
        foreach (json_decode($data->tembusan_sti) as $tembusan) 
        {
          foreach ($jab_bag as $key) 
          {
            if($key->id_jabatan ==  $tembusan)
            {
              echo $no++.". ".$key->nama_jabatan." - ".$key->nama_bagian."<br>";
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