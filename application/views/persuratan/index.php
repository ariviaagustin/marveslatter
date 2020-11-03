 <style type="text/css">
  th
  {
    text-align: center;
  }
</style>
 <div class="content-wrapper">
 	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Entry Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Entry Surat Masuk / </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="text-align: right;">
              	<!-- <a href="#" class="btn_tambah_srt btn btn-primary" style="float: right;"><i class="fa fa-plus"></i> Input Surat</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<?php echo $this->session->flashdata('msg2');?>
                <?php echo $this->session->flashdata('msg3');?>
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th style="width: 5%">No</th>
                      <th>Unik ID</th>
                      <th>Nomor Surat</th>
                      <th>Tanggal Surat</th>
                      <th>Pengirim Surat</th>
                      <th>Tujuan</th>
                      <th>Tanda Terima Surat</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    	<?php 
                          $no=1;
                          foreach ($data as $key) { ?>
                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $key->no_ticket; ?></td>
                              <td><?php echo $key->nomor_surat; ?></td>
                              <td><?php echo indonesian_date($key->tanggal_diterima); ?></td>
                              <td><?php echo $key->dari_pengirim; ?></td>
                              <td>
                                <?php 
                                  if($key->id_jenis_tujuan == NULL){
                                      echo $key->kepada_tujuan;
                                  }elseif($key->id_jenis_tujuan == 1){
                                      $a = json_decode($key->kepada_tujuan);
                                      foreach ($a as $key) {
                                        $key;
                                        $query=$this->M_surat->pegawai_jabatan($key);
                                        foreach ($query->result() as $orang) {
                                          echo $orang->nama_pegawai.' - '.$orang->nama_jabatan.'<br>';
                                        }
                                      }
                                  }elseif($key->id_jenis_tujuan == 2){
                                      $b = json_decode($key->kepada_tujuan);
                                      foreach ($b as $key2) {
                                        $key2;
                                        $where = array('id_jabatan'=>$key2);
                                        $query2=$this->M_all->selectX('master_jabatan',$where);
                                        foreach ($query2->result() as $jab) {
                                          echo $jab->nama_jabatan.'<br>';
                                        }
                                      }
                                  }elseif($key->id_jenis_tujuan == 3){

                                    $bag = json_decode($key->kepada_tujuan);
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

                                  }elseif($key->id_jenis_tujuan == 4){

                                    $unit_kerja = json_decode($key->kepada_tujuan);
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

                                  }else{
                                    echo "-";
                                  }  ?>
                              </td>
                              <td style="text-align: center;">
                                 <a href="<?php echo site_url('Entry_persuratan/cetak_tanda/').$key->id_daftar_input;?>" target="_blank" class = "btn btn-primary btn-sm" title = "Tanda Terima"><li class="fa fa-sticky-note"></li></a>
                                 <?php if($key->status_input==2 || $key->status_input==3){ ?>
                                  <a href="<?php echo site_url('Entry_persuratan/cetak_tanda_2/').$key->id_daftar_input;?>" target="_blank" class = "btn btn-warning btn-sm" title = "Tanda Terima"><li class="fa fa-sticky-note"></li></a>
                                <?php } ?>
                              </td>
                              <td style="text-align: center;">
                                <?php if($key->status_input==0){ ?>
                                  <span class="badge badge-warning">Menunggu Diteruskan</span>
                                <?php }elseif($key->status_input==1){ ?>
                                  <span class="badge badge-success"><i class="fa fa-eye"></i> Dibaca</span>
                                <?php }elseif($key->status_input==2){ ?>
                                  <span class="badge badge-primary"><i class="fa fa-check"></i> Diteruskan</span>
                                <?php }else{ ?>
                                  <span class="badge badge-info"><i class="fa fa-paper-plane"></i> Surat Dikirim</span>
                                <?php } ?>
                              </td>
                              <td style="text-align: center;">
                                <?php if($key->status_input==0){ ?>
                                  <a href="<?php echo site_url('Entry_persuratan/input/'.$key->id_daftar_input); ?>" class="btn btn-primary btn-sm" title="Input Identitas"><i class="fa fa-paper-plane"></i></a>
                                <?php }elseif($key->status_input==1){ ?>
                                  <a href="<?php echo site_url('Entry_persuratan/input_baca/'.$key->id_daftar_input); ?>" class="btn btn-success btn-sm" title="Input Identitas"><i class="fa fa-paper-plane"></i></a>
                                <?php }elseif($key->status_input==2){ ?>
                                  <a href="<?php echo site_url('Entry_persuratan/kirim_surat/'.$key->id_daftar_input); ?>" class="btn btn-danger btn-sm" title="Kirim Surat"><i class="fa fa-reply"></i></a>
                                <?php }else{ ?>
                                  <a href="<?php echo site_url('Entry_persuratan/detail/'.$key->id_daftar_input); ?>" class="btn btn-info btn-sm" title="Lihat Detail"><i class="fa fa-search"></i></a>
                                <?php } ?>
                              </td>
                            </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
 </div>
 

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
  $(function () {
    $("#table").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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