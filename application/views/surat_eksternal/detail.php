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
            <h1>Detail Surat Eksternal - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal/'); ?>">Surat Eksternal - Surat</a></li>
              <li class="breadcrumb-item active">Detail Surat Eksternal - Surat</li>
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
                    <a href="<?= site_url('Surat_eksternal/export/'.$se->id_daftar_surat); ?>" class="btn btn-primary"><i class = "fa fa-print"></i> Print</a>
                    <?php if($se->status_surat == 1){ ?>
                      <div class="btn btn-warning"><i class = "fa fa-archive"></i> Draft</div> 
                    <?php } ?>
                    <?php if($se->status_surat == 2){ ?>
                      <div class="btn btn-info"><i class = "fa fa-check"></i> Done</div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nomor Surat</th>
                  <td> : </td>
                  <td><?= $se->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?= indonesian_date($se->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($sifat as $a) 
                      {
                        if($a->id_sifat_surat ==  $se->sifat_surat)
                        {
                          echo $a->nama_sifat_surat;
                        }
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
                        if($key->id_data_pegawai == $se->penandatangan)
                        {
                          echo $key->nama_pegawai." - ".$key->nama_jabatan;
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
                        if($a->id_klasifikasi ==  $se->klasifikasi_surat)
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
                  <td><?= $se->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td><?= $se->tujuan_surat_ke; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td>
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
                  <th style="vertical-align: top">Isi Surat</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 15px 0px 15px 0px"><?= $se->isi_surat; ?></td>
                </tr>
                <?php if($se->file_surat != NULL || $se->file_surat != ''){ ?>
                  <tr>
                    <th>File</th>
                    <td> : </td>
                    <td><a href="<?= site_url('uploads/surat/'.$se->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a></td>
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
?>