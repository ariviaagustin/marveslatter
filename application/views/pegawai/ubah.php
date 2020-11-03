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
              <form class="form-horizontal" action="<?php echo site_url('Pegawai/aksi_ubah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Lengkap Pegawai" value="<?= $pegawai->nama_pegawai; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">ID Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="no_pegawai" placeholder="ID Pegawai" value="<?= $pegawai->no_pegawai; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nik" placeholder="NIK Pegawai" value="<?= $pegawai->nik; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat Pegawai</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="provinsi" id="provinsi" onchange="myFunction()">
                        <option selected="selected">Pilih Provinsi</option>
                        <?php foreach ($prov as $key) { ?>
                          <option value="<?php echo $key->id_provinsi; ?>" <?php if($pegawai->provinsi == $key->id_provinsi){ echo "selected"; } ?>><?php echo $key->nama_provinsi; ?></option>
                        <?php } ?>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kota" id="kabupaten" onchange="myFunction_2()">
                        <option>Pilih Kota / Kabupaten</option>
                        <?php foreach ($kab as $key) { ?>
                          <option value="<?php echo $key->id_kokab; ?>" <?php if($pegawai->kota == $key->id_kokab){ echo "selected"; } ?>><?php echo $key->nama_kokab; ?></option>
                        <?php } ?>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kecamatan" id="kecamatan" onchange="myFunction_3()">
                        <option>Pilih Kecamatan</option>
                        <?php foreach ($kec as $key) { ?>
                          <option value="<?php echo $key->id_kecamatan; ?>" <?php if($pegawai->kecamatan == $key->id_kecamatan){ echo "selected"; } ?>><?php echo $key->nama_kecamatan; ?></option>
                        <?php } ?>
                      </select><br>
                      <select class="form-control select2" style="width: 100%;" name="kelurahan" id="kelurahan">
                        <option>Pilih Kelurahan</option>
                        <?php foreach ($kel as $key) { ?>
                          <option value="<?php echo $key->id_deskel; ?>" <?php if($pegawai->kelurahan == $key->id_deskel){ echo "selected"; } ?>><?php echo $key->nama_deskel; ?></option>
                        <?php } ?>
                      </select><br>
                       <textarea class="form-control" name="alamat_pegawai" placeholder="Alamat Pegawai"><?= $pegawai->alamat_pegawai; ?></textarea><br>
                       <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" value="<?= $pegawai->kode_pos; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir Pegawai" value="<?= $pegawai->tempat_lahir; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= $pegawai->tanggal_lahir; ?>">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Unit Kerja</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="unit_kerja" id="unit" onchange="myFunction_4()">
                        <option selected="selected">Pilih Unit Kerja</option>
                        <?php foreach ($unit_kerja as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>" <?php if($pegawai->unit_kerja == $key->id_unit_kerja){ echo "selected"; } ?>><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bagian Unit Kerja</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="bagian_unit_kerja" id="bag" onchange="myFunction_5()">
                        <option selected="selected">Pilih Bagian Unit Kerja</option>
                        <?php foreach ($bagian as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>" <?php if($pegawai->bagian_unit_kerja == $key->id_bag_unit_kerja){ echo "selected"; } ?>><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="jabatan" id="jab">
                        <option selected="selected">Pilih Jabatan</option>
                        <?php foreach ($jabatan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>" <?php if($pegawai->jabatan == $key->id_jabatan){ echo "selected"; } ?>><?php echo $key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-sm-2">
                          <input type="radio" name="status" value="1" <?php if($pegawai->status == 1){ echo "checked"; } ?>> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status" value="0" <?php if($pegawai->status == 0){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Foto Pegawai</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="foto_pegawai" style="height: 100%">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $pegawai->id_data_pegawai; ?>">
                  <input type="hidden" name="foto_pegawai_old" value="<?= $pegawai->foto_pegawai; ?> ">
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