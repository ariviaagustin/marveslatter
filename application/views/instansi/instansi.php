<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil Instansi</h1>
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
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Beranda/aksi_ubah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Instansi</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="no_instansi" placeholder="Nomor Instansi" value="<?= $instansi->no_instansi; ?>" <?php if(!empty($instansi->no_instansi)) { echo "readonly"; } else { echo "required"; } ?>>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Instansi</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_instansi" placeholder="Nama Instansi" value="<?= $instansi->nama_instansi; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Provinisi Instansi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="provinsi_instansi" id="provinsi" onchange="myFunction()">
                        <option selected value="">Pilih Provinsi</option>
                        <?php foreach ($prov as $key) { ?>
                          <option value="<?php echo $key->id_provinsi; ?>" <?php if($instansi->provinsi_instansi == $key->id_provinsi){ echo "selected"; } ?>><?php echo $key->nama_provinsi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kabupaten / Kota Instansi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" name="kota_instansi" id="kabupaten" onchange="myFunction_2()">
                        <option selected value="">- Kabupaten / Kota -</option>
                        <?php foreach ($kab as $row) { ?>
                          <option value="<?php echo $row->id_kokab ?>" <?php if($row->id_kokab == $instansi->kota_instansi) { echo "selected"; } ?>><?php echo $row->nama_kokab; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kecamatan Instansi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" name="kecamatan_instansi" id="kecamatan" onchange="myFunction_3()">
                      <option selected value="">- Kecamatan -</option>
                      <?php foreach ($kec as $row) { ?>
                        <option value="<?php echo $row->id_kecamatan ?>" <?php if($row->id_kecamatan == $instansi->kecamatan_instansi) { echo "selected"; } ?>><?php echo $row->nama_kecamatan; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kelurahan / Desa Instansi</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" name="kelurahan_instansi" id="kelurahan">
                      <option selected value="">- Kelurahan / Desa -</option>
                      <?php foreach ($kel as $row) { ?>
                        <option value="<?php echo $row->id_deskel ?>" <?php if($row->id_deskel == $instansi->kelurahan_instansi) { echo "selected"; } ?>><?php echo $row->nama_deskel; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="alamat_instansi" placeholder="Alamat Instansi" required=""><?= $instansi->alamat_instansi; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Pos</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" value="<?= $instansi->kode_pos; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Logo Instansi</label>
                    <?php if($instansi->logo_instansi){ ?>
                      <div class="col-sm-9">
                        <div class="row">
                          <div class="col-sm-2">
                            <img src="<?= site_url('assets/img/logo_instansi/'.$instansi->logo_instansi); ?>" width = "100px">
                            <br><p style="text-align: center;">Logo saat ini</p>
                          </div>
                          <div class="col-sm-10" style="margin-top: 3%">
                            <input class="form-control" type="file" name="logo_instansi" style="height: auto;">
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $instansi->id; ?>">
                  <input type="hidden" name="logo_instansi_old" value="<?= $instansi->logo_instansi; ?>">
                  <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> SIMPAN</button>
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
    $('.select2').select2()

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
    var url = "<?php echo site_url('Beranda/get_kabupaten');?>/"+x;
    $('#kabupaten').load(url);
    return false;
  }
  function myFunction_2() 
  {
    var x = document.getElementById("kabupaten").value;
    var url = "<?php echo site_url('Beranda/get_kecamatan');?>/"+x;
    $('#kecamatan').load(url);
    return false;
  }
  function myFunction_3() 
  {
    var x = document.getElementById("kecamatan").value;
    var url = "<?php echo site_url('Beranda/get_kelurahan');?>/"+x;
    $('#kelurahan').load(url);
    return false;
  }
</script>