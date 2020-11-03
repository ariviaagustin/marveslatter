<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Jabatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Jabatan/'); ?>">Data Jabatan</a></li>
              <li class="breadcrumb-item active">Ubah Jabatan</li>
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
                <h3 class="card-title">Form Ubah Jabatan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Jabatan/aksi_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_unit_kerja" id="unit" onchange="myFunction_1()">
                        <option selected="selected">Pilih Unit Kerja</option>
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>" <?php if($jabatan->id_unit_kerja == $key->id_unit_kerja){ echo "selected"; } ?>><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_bag_unit_kerja" id="bag">
                        <option selected="selected">Pilih Bagian Unit Kerja</option>
                        <?php foreach ($bagian as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>" <?php if($jabatan->id_bag_unit_kerja == $key->id_bag_unit_kerja){ echo "selected"; } ?>><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_jabatan" placeholder="Nama Jabatan" value="<?= $jabatan->nama_jabatan; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Bagian</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_jabatan" placeholder="Kode Bagian" value="<?= $jabatan->kode_jabatan; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_role">
                        <option selected="selected">Pilih Role</option>
                        <?php foreach ($role as $key) { ?>
                          <option value="<?php echo $key->id_role; ?>" <?php if($key->id_role == $jabatan->id_role){ echo "selected"; } ?>><?php echo $key->nama_role." - ".$key->nama_tingkat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_jabatan" value="1" <?php if($jabatan->status_jabatan == 1){ echo "checked"; } ?>> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_jabatan" value="2" <?php if($jabatan->status_jabatan == 2){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $jabatan->id_jabatan; ?>">
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
<script type="text/javascript">
  function myFunction_1() 
  {
    var x = document.getElementById("unit").value;
    var url = "<?php echo site_url('Pegawai/get_bag');?>/"+x;
    $('#bag').load(url);
    return false;
  }
</script>