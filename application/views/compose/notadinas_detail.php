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
            <h1>Detail Nota Dinas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose'); ?>">Daftar Nota Dinas</a></li>
              <li class="breadcrumb-item active">Detail Nota Dinas</li>
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
                  <div class="col-sm-6"><h3 class="card-title">Detail Nota Dinas</h3></div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a href="<?= site_url('Compose/export_notadinas/'.$data->id_daftar_surat); ?>" class="btn btn-primary"><i class = "fa fa-print"></i> Print</a>
                    <?php if($data->status_surat == 1){ ?>
                      <div class="btn btn-warning"><i class = "fa fa-archive"></i> Draft</div>
                    <?php } ?>
                    <?php if($data->status_surat == 2){ ?>
                      <div class="btn btn-info"><i class = "fa fa-paper-plane"></i> Terkirim</div>
                    <?php } ?>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                    <th>Nomor Surat</th>
                    <td> : </td>
                    <td><?php echo $data->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?php echo $data->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td>
                    <?php
                      if(!empty($data->lampiran_surat))
                      {
                        echo $data->lampiran_surat;
                      }
                      else
                      {
                        echo "-";
                      }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td><?php echo $data->nama_sifat_surat; ?></td>
                </tr>
                <tr>
                  <th>Klasifikasi</th>
                  <td> : </td>
                  <td><?php echo $data->kode_klasifikasi.' - '.$data->klasifikasi; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?php echo indonesian_date($data->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Tujuan Surat</th>
                  <td> : </td>
                  <td>
                    <?php 
                        $where=array('id_jabatan'=>$data->tujuan_surat_ke);
                        $dt = $this->M_all->selectX('master_jabatan', $where)->row();
                        echo $dt->nama_jabatan;
                    ?>
                  </td>
                </tr>
                <tr>
                  <th>Penandatangan</th>
                  <td> : </td>
                  <td><?php echo $data->nama_pegawai; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Tembusan</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 15px 0px 15px 0px">
                  <?php
                      $no = 1;
                      if($data->tembusan_surat != "null")
                      {
                        $tembusan = json_decode($data->tembusan_surat);
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
                  <th style="vertical-align: top;">Isi Nota Dinas</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 15px 0px 15px 0px"><?php echo $data->isi_surat; ?></td>
                </tr>
                <?php if($data->file_surat != NULL || $data->file_surat != ''){ ?>
                  <tr>
                    <th>File</th>
                    <td> : </td>
                    <td><a href="<?= site_url('uploads/notadinas/'.$data->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a></td>
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