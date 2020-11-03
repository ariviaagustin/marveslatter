<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<style type="text/css">
  body{margin-top:20px;}

ul.notes li {
  margin: 10px 40px 50px 0px;
  float: left;
}

ul.notes li, ul.tag-list li {
  list-style: none;
}

ul.notes li div small {
  position: absolute;
  top: 5px;
  right: 5px;
  font-size: 10px;
}

div.rotate-1 {
  -webkit-transform: rotate(-6deg);
  -o-transform: rotate(-6deg);
  -moz-transform: rotate(-6deg);
}

div.rotate-2 {
  -o-transform: rotate(0deg);
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  position: relative;
  top: 5px;
}

.lazur-bg {
  background-color: #8bcdcd;
  color: #ffffff;
}

.red-bg {
  background-color: #fa7f72;
  color: #ffffff;
}

.navy-bg {
  background-color: #1ab394;
  color: #ffffff;
}

.yellow-bg {
  background-color: #f8ac59;
  color: #ffffff;
}

ul.notes li div {
  text-decoration: none;
  color: #000;
  display: block;
  height: 410px;
  width: 210px;
  padding: 1em;
  -moz-box-shadow: 5px 5px 7px #212121;
  -webkit-box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);
  box-shadow: 5px 5px 7px rgba(33, 33, 33, 0.7);
  -moz-transition: -moz-transform 0.15s linear;
  -o-transition: -o-transform 0.15s linear;
  -webkit-transition: -webkit-transform 0.15s linear;
}


</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kirim Surat Eksternal Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Entry_persuratan/'); ?>">Input Identitas</a></li>
              <li class="breadcrumb-item active">Kirim Surat Eksternal Masuk</li>
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
                <h3 class="card-title">Form Kirim Surat Eksternal Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="row">
                <div class="col-md-3">

                      <ul class="notes">
                        <li>
                            <div class="rotate-2 red-bg">
                                <small te><?php echo $detail->created_date; ?></small>
                                <h4 style="margin-top: 20px; text-align: center;">Identitas Surat</h4>
                                <p style="margin-top: 10px;">
                                  Dari : <?php echo $detail->pengirim_surat.'<br>'; ?>
                                  Kepada : <?php 
                                            $no = 1;
                                            if($detail->jenis_tujuan_surat == 1)
                                            {
                                              $personal = json_decode($detail->tujuan_surat_ke);
                                              foreach ($personal as $a) 
                                              {
                                                foreach ($ttd as $key) 
                                                {
                                                  if($a == $key->id_data_pegawai)
                                                  {
                                                    echo $no++.". ".$key->nama_pegawai."<br>";
                                                  }
                                                }
                                              }
                                            }
                                            else if($detail->jenis_tujuan_surat == 2)
                                            {
                                              $jab = json_decode($detail->tujuan_surat_ke);
                                              foreach ($jab as $b) 
                                              {
                                                foreach ($jabatan as $key) 
                                                {
                                                  if($b == $key->id_jabatan)
                                                  {
                                                    echo $no++.". ".$key->nama_jabatan."<br>";
                                                  }
                                                }
                                              }
                                            }
                                            else if($detail->jenis_tujuan_surat == 3)
                                            {
                                              $bag = json_decode($detail->tujuan_surat_ke);
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
                                            }
                                            else if($detail->jenis_tujuan_surat == 4)
                                            {
                                              $unit_kerja = json_decode($detail->tujuan_surat_ke);
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
                                            }
                                          ?>
                                  No Surat : <?php echo $detail->no_surat.'<br>'; ?>
                                  Tgl Diterima : <?php echo indonesian_date($detail->tgl_surat_diterima).'<br>'; ?>
                                  Tgl Surat : <?php echo indonesian_date($detail->tgl_surat).'<br>'; ?>
                                  Perihal : <?php echo $detail->perihal_surat.'<br>'; ?>
                                </p>
                            </div>
                        </li>  
                      </ul>
                  </div>
                  <div class="col-md-9">
                    <form class="form-horizontal" action="<?php echo site_url('Entry_persuratan/aksi_kirim'); ?>" method = "post" enctype="multipart/form-data">
                      <div class="card-body">
                        <h6>A. Klasifikasi Surat</h6>
                  <hr>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <option value="">Pilih Jenis Surat</option>
                        <?php foreach ($jenis_surat as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>"><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_surat">
                        <option value="">Pilih Klasifikasi Surat</option>
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keaslian Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="keaslian_surat">
                        <option value="">Pilih Keaslian Surat</option>
                        <?php foreach ($keaslian as $key) { ?>
                          <option value="<?php echo $key->id_keaslian ?>"><?php echo $key->nama_keaslian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <HR>
                  <h6>B. Lampiran Upload</h6>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tingkat Pengamanan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="tingkat_pengamanan">
                        <option value="">Pilih Tingkat Pengamanan</option>
                        <?php foreach ($tingkat_pengamanan as $key) { ?>
                          <option value="<?php echo $key->id_tingkat_pengamanan ?>"><?php echo $key->nama_tingkat_pengamanan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Upload Attachment</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="file_surat" placeholder="Upload Attachment" required>
                    </div>
                  </div>
                        
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <input type="hidden" name="id_daftar_surat" value="<?php echo $detail->id_daftar_surat; ?>">
                        <input type="hidden" name="id_daftar_input" value="<?php echo $detail->id_daftar_input; ?>">
                        <button type="submit" class="btn btn-info float-right">Simpan</button>
                      </div>
                      <!-- /.card-footer -->
                    </form>
                  </div>
              </div>
              
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
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    var x = document.getElementById("id_jenis_tujuan").value;
  if(x == "0")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }

    if(x == "1")
    {
      $("#personal").show() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#per").attr('required',true);
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#jab").attr('required',true);
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
      $("#bag").attr('required',true);
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
      $("#u").attr('required',true);
    }
    return false;
  });
</script>

<script type="text/javascript">
    function myFunction() {
  var x = document.getElementById("id_jenis_tujuan").value;
  if(x == "0")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }

    if(x == "1")
    {
      $("#personal").show() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
    }
    return false;
}
  </script>
<script type="text/javascript">
    window.onload = function () {
        document.getElementById("pass").onchange = validatePassword;
        document.getElementById("konfirm").onchange = validatePassword;
    }
    function validatePassword(){
        var pass2=document.getElementById("pass").value;
        var pass1=document.getElementById("konfirm").value;
        if(pass1!=pass2)
            document.getElementById("konfirm").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("konfirm").setCustomValidity('');
    }
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