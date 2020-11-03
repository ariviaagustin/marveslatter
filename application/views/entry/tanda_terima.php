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
		
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Telah terima dokumen dari</strong> <?php echo $data->dari_pengirim; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Perihal</strong> Surat dengan Nomor <?php echo $data->nomor_surat; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Ditujukan kepada</strong> <?php echo $data->kepada_tujuan; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Hari/tanggal</strong>  <?php echo tanggal_indo($data->tanggal_diterima, true); ?></td>
		</tr>

		<tr>
			<td style="text-align:center" colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center;">&nbsp;</td>
			<td style="text-align:center">Yang Menyerahkan,</td>
			<td style="text-align:right;">Yang Menerima,</td>
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
				$da = $this->M_all->selectX('user', $where3)->row(); ?>
			<td style="text-align:center"><u><?php echo $data->yang_menyerahkan; ?></u></td>
			<td style="text-align:right;"><u><?php echo $da->nama_user; ?></u></td>
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
			<td style="text-align:right;"><img src="<?php echo base_url('uploads/qrcode/'.$data->barcode_input); ?>" style="width: 50px;"></td>
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
		
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Telah terima dokumen dari</strong> <?php echo $data->dari_pengirim; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Perihal</strong> Surat dengan Nomor <?php echo $data->nomor_surat; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Ditujukan kepada</strong> <?php echo $data->kepada_tujuan; ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:justify;" colspan="3"><strong>Hari/tanggal</strong>  <?php echo tanggal_indo($data->tanggal_diterima, true); ?></td>
		</tr>

		<tr>
			<td style="text-align:center" colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align:center;">&nbsp;</td>
			<td style="text-align:center">Yang Menyerahkan,</td>
			<td style="text-align:right;">Yang Menerima,</td>
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
				$da = $this->M_all->selectX('user', $where3)->row(); ?>
			<td style="text-align:center"><u><?php echo $data->yang_menyerahkan; ?></u></td>
			<td style="text-align:right;"><u><?php echo $da->nama_user; ?></u></td>
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
			<td style="text-align:right;"><img src="<?php echo base_url('uploads/qrcode/'.$data->barcode_input); ?>" style="width: 50px;"></td>
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