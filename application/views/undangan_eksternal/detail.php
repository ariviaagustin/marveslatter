<style type="text/css">
  table
  {
    margin: 2%;
  }
  th
  {
    width: 25%;
    padding: 15px;
    border-top: 1px solid black;
    border-bottom: 1px solid black;
  }
  td
  {
    border-top: 1px solid black;
    border-bottom: 1px solid black;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Surat Eksternal - Undangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Undangan_eksternal'); ?>">Surat Eksternal - Undangan</a></li>
              <li class="breadcrumb-item active">Detail Surat Eksternal - Undangan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-6"><h3 class="card-title">Detail Surat Eksternal - Surat</h3></div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a href="<?= site_url('Undangan_eksternal/print_undangan/'.$ue->id_daftar_surat); ?>" class="btn btn-primary"><i class = "fa fa-print"></i> Print</a>
                    <?php if($ue->status_surat == 1){ ?>
                      <div class="btn btn-warning"><i class = "fa fa-archive"></i> Draft</div>
                    <?php } ?>
                    <?php if($ue->status_surat == 2){ ?>
                      <div class="btn btn-info"><i class = "fa fa-check"></i> Done</div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nomor Undangan</th>
                  <td> : </td>
                  <td><?= $ue->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Undangan</th>
                  <td> : </td>
                  <td><?= indonesian_date($ue->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Sifat Undangan</th>
                  <td> : </td>
                  <td><?php echo $ue->nama_sifat_surat;?></td>
                </tr>
                <tr>
                  <th>Penandatangan</th>
                  <td> : </td>
                  <td><?php echo $ue->nama_pegawai." - ".$ue->nama_jabatan;?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Tembusan</th>
                  <td style="vertical-align: top; padding: 15px 0px 15px 0px"> : </td>
                  <td>
                    <?php
                      $no = 1;
                      if($ue->tembusan_surat != "null")
                      {
                        $tembusan = json_decode($ue->tembusan_surat);
                        foreach ($tembusan as $a) 
                        {
                          foreach ($ttd as $key) 
                          {
                            if($key->id_data_pegawai == $a)
                            {
                              echo $no++.". ".$key->nama_pegawai." - ".$key->nama_jabatan."<br>";
                            }
                          }
                        }
                      }
                      else
                      {
                        echo "Tidak Ada Tembusan";
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Klasifikasi Undangan</th>
                  <td> : </td>
                  <td><?php echo $ue->klasifikasi;?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?= $ue->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td>
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
                  <th>Tujuan Undangan</th>
                  <td> : </td>
                  <td><?= $ue->tujuan_surat_ke; ?></td>
                </tr>
                <tr>
                  <th>Alamat Tujuan Undangan</th>
                  <td> : </td>
                  <td><?= $ue->alamat_tujuan_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Acara</th>
                  <td> : </td>
                  <td>
                    <?= tanggal_indo($ue->tanggal_dimulai_acara, true)." - ".tanggal_indo($ue->tanggal_selesai_acara, true); ?>
                  </td>
                </tr>
                <tr>
                  <th>Waktu Acara</th>
                  <td> : </td>
                  <td>
                    <?php 
                      if($ue->jam_selesai_acara != '00:00:00')
                      {
                        $jam = date('H:i', strtotime($ue->jam_selesai_acara))." WIB";
                      }
                      else
                      {
                        $jam = "Selesai";
                      }
                    ?>
                    <?= date('H:i', strtotime($ue->jam_dimulai_acara))." - ".$jam; ?>
                  </td>
                </tr>
                <tr>
                  <th>Lokasi Acara</th>
                  <td> : </td>
                  <td><?= $ue->lokasi_acara; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Isi Undangan</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 15px 0px 15px 0px"><?= $ue->isi_surat; ?></td>
                </tr>
                <?php if($ue->file_surat != NULL || $ue->file_surat != ''){ ?>
                  <tr>
                    <th>File</th>
                    <td> : </td>
                    <td><a href="<?= site_url('uploads/undangan/'.$ue->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a></td>
                  </tr>
                <?php } ?>
              </table>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
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