<style type="text/css">
  th
  {
    text-align: center;
  } 
  .box{
    background-color: #ff9900;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
  .kirim{
    background-color: #17a2b8;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: white;
    margin-bottom: 7px;
    text-align: center;
  }
  .blm_upload{
    background-color: #d4d4d4;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
  .sudah_upload{
    background-color: #6ae3ff;
    border-radius: 5px;
    width: fit-content;
    padding: 5px;
    font-size: 10pt;
    color: black;
    margin-bottom: 7px;
    text-align: center;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Surat Internal - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Surat Internal - Surat / </li>
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
                  <!-- <h3 class="card-title">Paket USMART</h3> -->
                  <a href="<?php echo site_url('Compose/surat_tambah'); ?>" class="btn btn-info"><li class = "fa fa-plus"></li> Tambah</a>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div style="overflow-x:auto;">
                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style="vertical-align: middle;">No</th>
                        <th style="vertical-align: middle;">Nomor Surat</th>
                        <th style="vertical-align: middle;">Tanggal Surat</th>
                        <th style="vertical-align: middle;">Sifat Surat</th>
                        <th style="vertical-align: middle;">Jenis Tujuan</th>
                        <th style="vertical-align: middle;">Tujuan Surat</th>
                        <th style="vertical-align: middle;">Status</th>
                        <th style="vertical-align: middle; width: 20%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $no=1;
                        foreach ($si as $key) { ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $key->no_surat; ?></td>
                            <td><?php echo indonesian_date($key->tgl_surat); ?></td>
                            <td><?php echo $key->nama_sifat_surat; ?></td>
                            <td><?php echo $key->ket_tujuan_surat; ?></td>
                            <td>
                              <?php
                                  if($key->jenis_tujuan_surat == 1){
                                    $no = 1;
                                    $tujuan=$this->M_surat->pegawai_jab()->result();
                                    $tujuan_surat=json_decode($key->tujuan_surat_ke);
                                    foreach ($tujuan_surat as $y) {
                                      $y;
                                      foreach ($tujuan as $a) {
                                          if($a->id_data_pegawai == $y){
                                            echo $no++.". ".$a->nama_pegawai." - ".$a->nama_jabatan."<br>";
                                          }
                                      }
                                    }

                                  }elseif($key->jenis_tujuan_surat == 2){
                                    $no = 1;
                                    $jabatan=$this->M_surat->jab_bag_unit()->result();
                                    $tujuan_surat=json_decode($key->tujuan_surat_ke);
                                    foreach ($tujuan_surat as $y) {
                                      $y;
                                      foreach ($jabatan as $b) {
                                          if($b->id_jabatan == $y){
                                            echo $no++.". ".$b->nama_jabatan." - ".$b->nama_bagian."<br>";
                                          }
                                      }
                                    }

                                  }elseif ($key->jenis_tujuan_surat == 3){
                                    $no = 1;
                                    $bag_unit=$this->M_surat->unit_bag_unit()->result();
                                    $tujuan_surat=json_decode($key->tujuan_surat_ke);
                                    foreach ($tujuan_surat as $y) {
                                      $y;
                                      foreach ($bag_unit as $c) {
                                          if($c->id_bag_unit_kerja == $y){
                                            echo $no++.". ".$c->nama_bagian." - ".$c->nama_unit_kerja."<br>";
                                          }
                                      }
                                    }
                                    
                                  }else{
                                    $no = 1;
                                    $unit=$this->M_all->selectSemua('master_unit_kerja')->result();
                                    $tujuan_surat=json_decode($key->tujuan_surat_ke);
                                    foreach ($tujuan_surat as $y) {
                                      $y;
                                      foreach ($unit as $d) {
                                          if($d->id_unit_kerja == $y){
                                            echo $no++.". ".$d->nama_unit_kerja."<br>";
                                          }
                                      }
                                    }

                                  }
                                ?>
                            </td>
                            <td>
                              <?php if($key->status_surat == 1){ ?>
                              <center><div class="box"><i class="fa fa-archive" aria-hidden="true"></i> Draft</div></center>
                              <?php } ?>
                              <?php if($key->status_surat == 2){ ?>
                                <center><div class="kirim"><i class="fa fa-paper-plane" aria-hidden="true"></i> Terkirim</div>
                                <a href="<?= site_url('uploads/surat/'.$key->file_surat); ?>" class = "btn btn-info btn-sm" target = "_blank"><i class="fa fa-file"></i></a>
                                </center>
                              <?php } ?>
                            </td>
                            <td style="text-align: center;">
                              <a href="<?php echo site_url('Compose/surat_detail/'.$key->id_daftar_surat); ?>" class = "btn btn-success btn-sm" title = "Detail"><li class="fa fa-search"></li></a>
                              <a href="<?php echo site_url('Compose/surat_export/'.$key->id_daftar_surat); ?>" class = "btn btn-primary btn-sm" title = "Unduh"><li class="fa fa-download"></li></a>
                              <?php if($key->status_surat == 1){ ?>
                                <a href="<?php echo site_url('Compose/surat_ubah/'.$key->id_daftar_surat); ?>" class = "btn btn-warning btn-sm" title = "Ubah"><li class="fa fa-pen"></li></a>
                                <a href="#" data-id = "<?= $key->id_daftar_surat; ?>" class = "hapus btn btn-danger btn-sm" title = "Hapus"><li class="fa fa-trash"></li></a>
                              <?php } ?>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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
    <!-- /.content -->
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
<script type="text/javascript">
    $(document).on('click','.hapus',function(e)

    {
        swal({
          title: "Hapus Data Ini ?",
          text: "",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            var id = $(this).attr('data-id');
        // alert(prov);
        swal("Data Terhapus", 
        {
            icon: "success",
            buttons: false
        });
        $.ajax({
          url: '<?php echo base_url('Compose/surat_hapus/'); ?>/'+id,
          success: function(data) {
            location.reload();
        }
    });
        
    } else {
        swal("Gagal Hapus Data");
    }
});
    });
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