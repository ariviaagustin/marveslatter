<html>
 <head>
  <title></title>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/dist/css/adminlte.min.css">
<style type="text/css">
	hr.new2 {
	  border-top: 1px dashed red;
	}
</style>
 </head>
 
  <?php
                                  $data = $dpX;
                                  ?>


 <body bgcolor="white">
 	
 	<table cellpadding="1" cellspacing="1" style="width:100%;background-color: #ffffff; filter: alpha(opacity=40); opacity: 0.95;border:1px black solid;" >
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td rowspan="3" style="text-align:center; width: 15%"><img class ="img-responsive" src="<?php echo base_url('assets/img/logo_instansi/'.$instansi->logo_instansi);?>" style="height:100px; width:100px" /></td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center"><strong>TANDA TERIMA SURAT</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<?php 
			$where = array('id_daftar_input'=>$data->id_daftar_input);
			$dt = $this->M_all->selectX('daftar_surat', $where)->row();
		?>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Telah terima dokumen dari</strong> <?php echo $dt->pengirim_surat; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Perihal</strong> <?php echo $dt->perihal_surat; ?> dengan <strong>Nomor</strong> <?php echo $dt->no_surat; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Ditujukan kepada</strong>
				<?php 
                      $no = 1;
                      if($dt->jenis_tujuan_surat == 1)
                      {
                        $personal = json_decode($dt->tujuan_surat_ke);
                        foreach ($personal as $a) 
                        {
                          foreach ($ttd as $key) 
                          {
                            if($a == $key->id_data_pegawai)
                            {
                              echo $no++.". ".$key->nama_pegawai."<br>";
                            }
                          }
                        }
                      }
                      else if($dt->jenis_tujuan_surat == 2)
                      {
                        $jab = json_decode($dt->tujuan_surat_ke);
                        foreach ($jab as $b) 
                        {
                          foreach ($jabatan as $key) 
                          {
                            if($b == $key->id_jabatan)
                            {
                              echo $no++.". ".$key->nama_jabatan."<br>";
                            }
                          }
                        }
                      }
                      else if($dt->jenis_tujuan_surat == 3)
                      {
                        $bag = json_decode($dt->tujuan_surat_ke);
                        foreach ($bag as $c) 
                        {
                          foreach ($bag_unit as $key) 
                          {
                            if($c == $key->id_bag_unit_kerja)
                            {
                              echo $no++.". ".$key->nama_bagian."<br>";
                            }
                          }
                        }
                      }
                      else if($dt->jenis_tujuan_surat == 4)
                      {
                        $unit_kerja = json_decode($dt->tujuan_surat_ke);
                        foreach ($unit_kerja as $d) 
                        {
                          foreach ($unit as $key) 
                          {
                            if($d == $key->id_unit_kerja)
                            {
                              echo $no++.". ".$key->nama_unit_kerja."<br>";
                            }
                          }
                        }
                      }
                    ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Tanggal Surat Diterima</strong>  <?php echo tanggal_indo($dt->tgl_surat_diterima, true); ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Tanggal Surat</strong>  <?php echo tanggal_indo($dt->tgl_surat, true); ?></td>
		</tr>

		<tr>
			<td style="text-align:center" colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center;">&nbsp;</td>
			<td style="text-align:center">Resepsionis,</td>
			<td style="text-align:right;">Admin Persuratan,</td>
			<td style="text-align:center;">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center;">&nbsp;</td>
			<?php
				$where3=array('id_user'=>$data->created_by);
				$da = $this->M_all->selectX('user', $where3)->row();
				$where4=array('id_user'=>$dt->created_by);
				$di = $this->M_all->selectX('user', $where4)->row(); ?>
			<td style="text-align:center"><u><?php echo $da->nama_user; ?></u></td>
			<td style="text-align:right;"><u><?php echo $di->nama_user; ?></u></td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
			<td style="text-align:center">&nbsp;</td>
		</tr>
	</tbody>
	</table>

<p>&nbsp;</p>
<hr class="new2">
<p>&nbsp;</p>

	
 </body>
 <script>

    window.print();
</script>
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
</html>