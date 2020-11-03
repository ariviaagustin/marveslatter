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
            <h1>Detail Surat Tugas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/surattugas'); ?>">Daftar Surat Tugas</a></li>
              <li class="breadcrumb-item active">Detail Surat Tugas</li>
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
                  <div class="col-sm-6"><h3 class="card-title">Detail Surat Tugas</h3></div>
                  <div class="col-sm-6" style="text-align: right;">
                    <a href="<?php echo site_url('Compose/surattugas_print/'.$data->id_daftar_surat); ?>" class="btn btn-primary"><i class = "fa fa-print"></i> Print</a>
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
                <table border="0">
                <tbody>
                  <tr>
                    <td rowspan="5" style="text-align:center"><img alt="logo" src="<?php echo site_url('assets/img/logo_instansi/'.$instansi->logo_instansi); ?>" style="height:120px; width:120px" /></td>
                    <td style="text-align:center"><span style="font-size:18px"><strong><?php echo $instansi->nama_instansi; ?></strong></span></td>
                  </tr>
                </tbody>
              </table>

              <table border="0" cellpadding="1" cellspacing="1" style="border: none;">
                <tbody>
                  <tr>
                    <td style="text-align:center"><strong>SURAT TUGAS/SURAT PERINTAH</strong></td>
                  </tr>
                  <tr>
                    <td style="text-align:center"><strong>NOMOR: <?php echo $data->no_surat; ?></strong></td>
                  </tr>
                </tbody>
              </table>

              <table border="0" cellpadding="1" cellspacing="1" >
                <tbody>
                  <tr>
                    <td style="width: 10%; vertical-align: top;">Menimbang</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td><?php
                        $menimbang=json_decode($data->kata_pembuka_sti);
                        foreach ($menimbang as $key) {
                          $key;
                          $id_daftar_surat=$data->id_daftar_surat;
                          $where = array('id_daftar_surat'=>$id_daftar_surat,'ket_menimbang'=>$key);
                          $data_menimbang = $this->M_all->selectX('data_menimbang', $where)->result();
                          $no='a';
                          foreach ($data_menimbang as $dm) {
                            echo $no++.'. '.$dm->ket_menimbang.';<br>';
                          }
                        }
                    ?></td>
                  </tr>
                  <tr>
                    <td style="width: 10%; vertical-align: top;">Dasar</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td><?php
                        $dasar=json_decode($data->dasar_sti);
                        foreach ($dasar as $key2) {
                          $key2;
                          $id_daftar_surat=$data->id_daftar_surat;
                          $where2 = array('id_daftar_surat'=>$id_daftar_surat,'ket_dasar'=>$key2);
                          $data_dasar = $this->M_all->selectX('data_dasar', $where2)->result();
                          $no1='1';
                          foreach ($data_dasar as $dd) {
                            echo $no1++.'. '.$dd->ket_dasar.';<br>';
                          }
                        }
                    ?></td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" style="text-align: center;">Memberi Tugas</td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="width: 10%; vertical-align: top;">Kepada</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td><?php
                        $kepada=json_decode($data->yang_diberi_tugas);
                        foreach ($kepada as $key3) {
                          $key3;
                          $where3 = array('id_data_pegawai'=>$key3);
                          $data_kepada = $this->M_all->selectX('data_pegawai', $where3)->result();
                          $no2='1';
                          foreach ($data_kepada as $dk) {
                            echo $no2++.'. Nama : '.$dk->nama_pegawai.';<br>';
                            echo 'Jabatan : '.$dk->nama_jabatan.';<br>';
                          }
                        }
                    ?></td>
                  </tr>
                  <tr>
                    <td style="width: 10%; vertical-align: top;">Untuk</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td>1. <?php echo $data->maksud_tugas.', dengan ketentuan sebagai berikut '?>
                      <br>
                      <?php 
                          $no4='a';
                          $pecah = $data->tanggal_mulai_bertugas;
                          $pecah2 = $data->tanggal_selesai_bertugas;
                          $number = range($pecah,$pecah2);
                          $ib = count($number);

                          echo $no4++.'. Lamanya Perjalanan : '.$ib.' Hari<br>';
                          echo $no4++.'. Pada Tanggal : '.indonesian_date($data->tanggal_mulai_bertugas).' s/d '.indonesian_date($data->tanggal_selesai_bertugas).'<br>';
                          echo $no4++.'. Tempat : '.$data->tempat_tugas.' - '.$data->nama_kokab.'<br>';
                      ?>
                      2. Melaksanakan tugas – tugas yang harus dilaksanakan.
                      <br>
                      3.  Mempersiapkan segala sesuatunya yang berkaitan dengan kegiatan tersebut.
                      <br>
                      4.  Melaporkan hasil kegiatan kepada Pimpinan/Atasan.
                    </td>
                  </tr>
                  
                </tbody>
              </table>

              <p>&nbsp;</p>

              <table border="0" cellpadding="1" cellspacing="1">
                <tbody>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="text-align:center; width:30%">Jakarta, <?php echo indonesian_date($data->tgl_surat); ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: center;"><?php echo $data->nama_jabatan; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="text-align:center"><?php echo $data->nama_pegawai; ?></td>
                  </tr>
                </tbody>
              </table>

              <hr>
              <table>
                
                <tr>
                  <th>Klasifikasi</th>
                  <td> : </td>
                  <td><?php echo $data->kode_klasifikasi.' - '.$data->klasifikasi; ?></td>
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
                  <th>Jenis Tugas</th>
                  <td> : </td>
                  <td><?php echo $data->nama_jenis_tugas; ?></td>
                </tr>
                <tr>
                  <th>Moda Tranportasi</th>
                  <td> : </td>
                  <td><?php echo $data->nama_moda; ?></td>
                </tr>

                <tr>
                  <th>Sumber Pembiayaan</th>
                  <td> : </td>
                  <td><?php echo $data->sumber_biaya; ?></td>
                </tr>
               
                <?php if($data->file_surat != NULL || $data->file_surat != ''){ ?>
                  <tr>
                    <th>File</th>
                    <td> : </td>
                    <td><a href="<?= site_url('uploads/surat_tugas/'.$data->file_surat); ?>" class = "btn btn-info" target = "_blank">Lihat File</a></td>
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