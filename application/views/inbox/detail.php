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
            <h1>Detail Inbox - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Inbox'); ?>">Inbox - Surat</a></li>
              <li class="breadcrumb-item active">Detail Inbox - Surat</li>
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
                  <div class="col-sm-6"><h3 class="card-title">Detail Inbox - Surat</h3></div>
                  <div class="col-sm-6" style="text-align: right;">
                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <table>
                <tr>
                  <th>Nomor Surat</th>
                  <td> : </td>
                  <td><?= $si->no_surat; ?></td>
                </tr>
                <tr>
                  <th>Tanggal Surat</th>
                  <td> : </td>
                  <td><?= indonesian_date($si->tgl_surat); ?></td>
                </tr>
                <tr>
                  <th>Sifat Surat</th>
                  <td> : </td>
                  <td><?php echo $si->nama_sifat_surat; ?></td>
                </tr>
                <tr>
                  <th>Jenis Surat</th>
                  <td> : </td>
                  <td><?php echo $si->nama_jenis_surat; ?></td>
                </tr>
                <tr>
                  <th>Penandatangan</th>
                  <td> : </td>
                  <td>
                    <?php
                      foreach ($ttd as $key) 
                      {
                        if($key->id_data_pegawai == $si->penandatangan)
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
                  <td><?php echo $si->klasifikasi; ?></td>
                </tr>
                <tr>
                  <th>Perihal</th>
                  <td> : </td>
                  <td><?= $si->perihal_surat; ?></td>
                </tr>
                <tr>
                  <th>Jenis Tujuan</th>
                  <td> : </td>
                  <td>
                    <?php
                      if($si->jenis_tujuan_surat == 1){ echo "Personal"; }
                      else if($si->jenis_tujuan_surat == 2){ echo "Jabatan"; }
                      else if($si->jenis_tujuan_surat == 3){ echo "Bagian Unit Kerja"; }
                      if($si->jenis_tujuan_surat == 4){ echo "Unit Kerja"; }
                    ?>
                  </td>
                </tr>
                <tr>
                  <th style="vertical-align: top">Tujuan Surat</th>
                  <td style="vertical-align: top; padding-top: 15px"> : </td>
                  <td style="padding: 15px 0px 15px 0px">
                    <?php 
                        if($si->jenis_tujuan_surat=='1'){ ?>
                          <?php 
                            $a = json_decode($si->tujuan_surat_ke);
                        foreach ($a as $key) { ?>
                          <?php 
                              $key;
                              $query=$this->M_surat->pegawai_jabatan($key);
                              foreach ($query->result() as $orang) { ?>
                                <?php echo $orang->nama_pegawai.' - '.$orang->nama_jabatan; ?>
                                <br>
                             <?php } ?>
                        <?php } ?>
                    <?php }elseif($si->jenis_tujuan_surat=='2'){ ?>
                        <?php 
                            $b = json_decode($si->tujuan_surat_ke);
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
                    <?php }else{
                      echo $si->tujuan_surat_ke;
                    } ?> 

                  </td>
                </tr>
                <tr>
                  <th>Lampiran</th>
                  <td> : </td>
                  <td>
                    <?php
                      if(!empty($si->lampiran_surat))
                      {
                        echo $si->lampiran_surat;
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
                  <td style="padding: 15px 0px 15px 0px"></td>
                </tr>
                  <tr>
                    <th>File</th>
                    <td> : </td>
                    <td></td>
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