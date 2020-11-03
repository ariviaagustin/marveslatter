<html>
 <head>
  <title></title>
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/dist/css/adminlte.min.css">
 </head>
 
  <?php
                                  $data = $dpX;
                                  ?>


 <body bgcolor="white">
 	
 	<table border="0" cellpadding="1" cellspacing="1" style="width:100%; border-bottom: double;">
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td rowspan="4" style="text-align:center"><img class ="img-responsive" src="<?php echo base_url('assets/img/logo_instansi/'.$instansi->logo_instansi);?>" style="height:170px; width:120px" /></td>
			<td style="text-align:center"><span style="font-size:18px"><strong><?php echo $instansi->nama_instansi; ?></strong></span></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center"><?php echo $instansi->alamat_instansi.' '.$instansi->nama_deskel.' '.$instansi->nama_kecamatan.', '.$instansi->nama_kokab.' - '.$instansi->nama_provinsi.' '.$instansi->kode_pos;?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">Telepon. <?php echo $instansi->telp; ?>. Faksimile <?php echo $instansi->fax; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td style="text-align:center">Website:<?php echo $instansi->web; ?></td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<p style="text-align:center"><strong>AGENDA EKSTERNAL SURAT MASUK</strong><br>
	<?php echo 'NOMOR. '.$data->no_surat; ?>
</p>

<p style="text-align:center">&nbsp;</p>

<table border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="width:20%">Lampiran</td>
			<td style="width:2%">:</td>
			<td><?php echo $data->lampiran_surat; ?></td>
		</tr>
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td><?php echo $data->perihal_surat; ?></td>
		</tr>
		<tr>
			<td>Jenis Surat</td>
			<td>:</td>
			<td><?php echo $data->nama_jenis_surat; ?></td>
		</tr>
		<tr>
			<td>Klasifikasi Surat</td>
			<td>:</td>
			<td><?php echo $data->kode_klasifikasi.' - '.$data->klasifikasi; ?></td>
		</tr>
		<tr>
			<td>Sifat Surat</td>
			<td>:</td>
			<td><?php echo $data->nama_sifat_surat; ?></td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="text-align:center; width:3%"><strong>No.</strong></td>
			<td style="text-align:center"><strong>TANGGAL DITERIMA</strong></td>
			<td style="text-align:center;"><strong>NO. SURAT</strong></td>
			<td style="text-align:center;"><strong>TANGGAL SURAT</strong></td>
			<td style="text-align:center; width: 20%;"><strong>DARI</strong></td>
			<td style="text-align:center; width: 20%;"><strong>KEPADA</strong></td>
			<td style="text-align:center;"><strong>FILE</strong></td>
		</tr>
		<tr>
			<td style="text-align:center"><strong>1</strong></td>
			<td style="text-align:center"><strong>2</strong></td>
			<td style="text-align:center"><strong>3</strong></td>
			<td style="text-align:center"><strong>4</strong></td>
			<td style="text-align:center"><strong>5</strong></td>
			<td style="text-align:center"><strong>6</strong></td>
			<td style="text-align:center"><strong>7</strong></td>
		</tr>
		<tr>
			<td style="text-align:center"><?php echo "1";?></td>
			<td style="text-align:center"><?php echo indonesian_date($data->tgl_surat_diterima);?></td>
			<td style="text-align:center"><?php echo $data->no_surat;?></td>
			<td style="text-align:center"><?php echo indonesian_date($data->tgl_surat);?></td>
			<td style="text-align:center"><?php echo $data->pengirim_surat; ?></td>
			<td style="text-align:justify;">
				<?php 
                        if($data->jenis_tujuan_surat=='1'){ ?>
                          <?php 
                            $a = json_decode($data->tujuan_surat_ke);
                        foreach ($a as $key) { ?>
                          <?php 
                              $key;
                              $query=$this->M_surat->pegawai_jabatan($key);
                              foreach ($query->result() as $orang) { ?>
                                <?php echo $orang->nama_pegawai.' - '.$orang->nama_jabatan; ?>
                                <br>
                             <?php } ?>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php 
                            $b = json_decode($data->tujuan_surat_ke);
                        foreach ($b as $key2) { ?>
                          <?php 
                              $key2;
                              $where = array('id_jabatan'=>$key2);
                              $query2=$this->M_all->selectX('master_jabatan',$where);
                              foreach ($query2->result() as $jab) { ?>
                                <?php echo $jab->nama_jabatan; ?>
                                <br>
                             <?php } ?>
                        <?php } ?>
                    <?php } ?>
			</td>
			<td style="text-align:center">
				<?php if($data->file_surat==NULL || $data->file_surat==""){echo "-";}else{echo $data->file_surat;} ?>
			</td>
		</tr>
	</tbody>
</table>





 

  
 </body>
 <script>

    window.print();
</script>
<?php
   function indonesian_date ($timestamp = '', $date_format = 'd F Y ', $suffix = '') {
      //$timestamp = '', $date_format = 'l, d F Y | H:i', $suffix = 'WIB'
          if (trim ($timestamp) == '')
          {
                  $timestamp = time ();
          }
          elseif (!ctype_digit ($timestamp))
          {
              $timestamp = strtotime ($timestamp);
          }
          # remove S (st,nd,rd,th) there are no such things in indonesia :p
          $date_format = preg_replace ("/S/", "", $date_format);
          $pattern = array (
              '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
              '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
              '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
              '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
              '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
              '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
              '/April/','/June/','/July/','/August/','/September/','/October/',
              '/November/','/December/',
          );
          $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
              'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
              'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
              'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
              'Oktober','November','Desember',
          );
          $date = date ($date_format, $timestamp);
          $date = preg_replace ($pattern, $replace, $date);
          $date = "{$date} {$suffix}";
          return $date;
      }
?>
</html>