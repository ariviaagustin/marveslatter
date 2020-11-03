<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pegawai</h1>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Pegawai/'); ?>">Data Pegawai</a></li>
              <li class="breadcrumb-item active">Tambah Pegawai</li>
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
                <h3 class="card-title">Form Tambah Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Pegawai/aksi_tambah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <h6>A. Unit Kerja</h6>
                  <hr>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lembaga</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" style="width: 100%;" name="id_instansi" id="id_unit_kerja" onchange="get_unit_kerja()">
                        <option value="">--Pilih Lembaga--</option>
                        <?php foreach ($lembaga as $lem) { ?>
                          <option value="<?php echo $lem->id; ?>"><?php echo $lem->nama_instansi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Unit Kerja</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" style="width: 100%;" name="id_unit_kerja"  id="div_unit" onchange="get_bagian_unit()">
                          <option value="">--Pilih Unit Kerja--</option>
                      </select>
                    </div>
                  </div>                 

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" style="width: 100%;" name="jabatan" id="div_jabatan">
                        <option value="">--Pilih Jabatan--</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status PLT</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" style="width: 100%;" name="status_plt">
                        <option value="">--Pilih Status PLT--</option>
                        <option value="1">PLT</option>
                        <option value="2">Tidak PLT/Tetap</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">TMT Jabatan</label>
                    <div class="col-sm-4">
                      <input type="date" name="ref_tmt_jabatan" class="form-control">
                    </div>
                    <div class="col-sm-2" style="text-align: center;">
                      <label>s/d</label>
                    </div>
                    <div class="col-sm-4">
                      <input type="date" name="sampai_tmt" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Golongan</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="id_golongan">
                        <option value="">Pilih Golongan</option>
                        <?php foreach ($golongan as $g) { ?>
                          <option value="<?php echo $g->id_golongan; ?>"><?php echo $g->nama_golongan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">TMT Pangkat</label>
                    <div class="col-sm-10">
                      <input type="date" name="ref_tmt_pangkat" class="form-control">
                    </div>
                  </div>


                  <hr>
                  <h6>B. Identitas Diri</h6>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gelar Sebelum</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="gelar_sebelum" placeholder="Gelar Sebelum, Contoh : Dr.">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Lengkap Pegawai">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gelar Setelah</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="gelar_setelah" placeholder="Gelar Setelah, Contoh : ,S.Kom">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIP Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_pegawai" placeholder="NIP Pegawai">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nik" placeholder="NIK Pegawai">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="email" placeholder="email@gmail.com">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="gender_id">
                        <option value="1">Pilih Gender</option>
                        <option value="1">Laki - Laki</option>
                        <option value="2">Perempuan</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="agama_id">
                        <option value="">Pilih Agama</option>
                        <?php 
                          foreach ($agama as $aga) { ?>
                              <option value="<?php echo $aga->id_agama; ?>"><?php echo $aga->nama_agama; ?></option>
                        <?php }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="pendidikan_id">
                        <option value="">Pilih Pendidikan Terakhir</option>
                        <?php 
                          foreach ($pendidikan as $p) { ?>
                              <option value="<?php echo $p->id_pendidikan; ?>"><?php echo $p->nama_pendidikan; ?></option>
                        <?php }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir Pegawai">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Pegawai</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="provinsi" id="provinsi" onchange="myFunction()">
                        <option selected="selected">Pilih Provinsi</option>
                        <?php foreach ($prov as $key) { ?>
                          <option value="<?php echo $key->id_provinsi; ?>"><?php echo $key->nama_provinsi; ?></option>
                        <?php } ?>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kota" id="kabupaten" onchange="myFunction_2()">
                        <option selected="selected">Pilih Kabupaten / Kota</option>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kecamatan" id="kecamatan" onchange="myFunction_3()">
                        <option selected="selected">Pilih Kecamatan</option>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kelurahan" id="kelurahan">
                        <option selected="selected">Pilih Kelurahan</option>
                      </select><br>
                       <textarea class="form-control" name="alamat_pegawai" placeholder="Alamat Pegawai"></textarea><br>
                       <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto Pegawai</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="foto_pegawai" style="height: 100%">
                    </div>
                  </div>

                  <hr>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Pegawai</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-sm-2">
                          <input type="radio" name="status" value="1" checked> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status" value="0"> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
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
<script>
  function get_unit_kerja(){
                var id_instansi = $("#id_unit_kerja").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Pegawai/get_unit'); ?>", 
                    data:"id_instansi="+id_instansi, 
                    success: function(msg) {
                            $("#div_unit").html(msg);
                    }
                });
    }

    function get_bagian_unit(){
      var id_instansi = $("#id_unit_kerja").val();
      var id_unit_kerja = $("#div_unit").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Pegawai/get_bagian_unit'); ?>", 
                    data:{id_instansi: id_instansi, id_unit_kerja:id_unit_kerja},
                    success: function(msg) {
                            $("#div_jabatan").html(msg);
                    }
                });
            }

    function get_jabatan(){
    var id_instansi = $("#id_unit_kerja").val();
    var id_unit_kerja = $("#div_unit").val();
    var id_bagian_unit = $("#div_bagian").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Pegawai/get_jabatan'); ?>", 
                    data:{id_instansi: id_instansi, id_unit_kerja:id_unit_kerja, id_bagian_unit:id_bagian_unit},
                    success: function(msg) {
                            $("#jab").html(msg);
                    }
                });
            }

  function myFunction() 
  {
    var x = document.getElementById("provinsi").value;
    var url = "<?php echo site_url('Instansi/get_kabupaten');?>/"+x;
    $('#kabupaten').load(url);
    return false;
  }
  function myFunction_2() 
  {
    var x = document.getElementById("kabupaten").value;
    var url = "<?php echo site_url('Instansi/get_kecamatan');?>/"+x;
    $('#kecamatan').load(url);
    return false;
  }
  function myFunction_3() 
  {
    var x = document.getElementById("kecamatan").value;
    var url = "<?php echo site_url('Instansi/get_kelurahan');?>/"+x;
    $('#kelurahan').load(url);
    return false;
  }
  function myFunction_4() 
  {
    var x = document.getElementById("unit").value;
    var url = "<?php echo site_url('Pegawai/get_bag');?>/"+x;
    $('#bag').load(url);
    return false;
  }
  function myFunction_5() 
  {
    var x = document.getElementById("bag").value;
    var y = document.getElementById("unit").value;
    var url = "<?php echo site_url('Pegawai/get_jab');?>/"+x+"/"+y;
    $('#jab').load(url);
    return false;
  }
</script>