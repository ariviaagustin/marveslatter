<style type="text/css">
  table
  {
    margin: 2%;
  }
  th
  {
    width: 20%;
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
            <h1>Detail Surat Eksternal - Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal_keluar'); ?>">Surat Eksternal - Surat Keluar</a></li>
              <li class="breadcrumb-item active">Detail Surat Eksternal - Surat Keluar</li>
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
                  <div class="col-sm-6"><h3 class="card-title">Detail Surat Eksternal - Surat Keluar</h3></div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nomor Surat</th>
                  <td> : </td>
                  <td><?= $sek->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Jenis Surat</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($jenis as $a) 
                      {
                        if($a->id_jenis_surat ==  $sek->jenis_surat)
                        {
                          echo $a->nama_jenis_surat;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($sifat as $a) 
                      {
                        if($a->id_sifat_surat ==  $sek->sifat_surat)
                        {
                          echo $a->nama_sifat_surat;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Klasifikasi Surat</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($klasifikasi as $a) 
                      {
                        if($a->id_klasifikasi ==  $sek->klasifikasi_surat)
                        {
                          echo $a->klasifikasi;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?= $sek->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?= indonesian_date($sek->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td><?= $sek->lampiran_surat." Lembar"; ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td><?= $sek->tujuan_surat_ke; ?></td>
                </tr>
                <tr>
                  <th>Alamat Tujuan</th>
                  <td> : </td>
                  <td><?= $sek->alamat_tujuan_surat; ?></td>
                </tr>
                <tr>
                  <th>Pengirim Surat</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($ttd as $key) 
                      {
                        if($key->id_data_pegawai == $sek->pengirim_surat)
                        {
                          echo $key->nama_pegawai." - ".$key->nama_jabatan;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Tembusan</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding-top: 15px; padding-bottom: 15px">
                    <?php
                      $tembusan = explode(";",$sek->tembusan_surat);
                      $no = 1;
                      foreach ($tembusan as $key) 
                      {
                        echo $no++.". ".$key."<br>";
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Penandatangan</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($ttd as $key) 
                      {
                        if($key->id_data_pegawai == $sek->penandatangan)
                        {
                          echo $key->nama_pegawai." - ".$key->nama_jabatan;
                        }
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>File Surat</th>
                  <td> : </td>
                  <?php if(!empty($sek->file_surat)){ ?>
                    <td><a href="<?= site_url('uploads/sek/'.$sek->file_surat); ?>" target = "_blank">Lihat File Surat</a></td>
                  <?php } ?>
                  <?php if(empty($sek->file_surat)){ ?>
                    <td>File Surat Belum Terlampir</td>
                  <?php } ?>
                </tr>
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
?>