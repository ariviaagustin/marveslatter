<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Klasifikasi Sekunder</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/klasifikasi_sekunder/'); ?>">Master Klasifikasi Sekunder</a></li>
              <li class="breadcrumb-item active">Ubah Klasifikasi Sekunder</li>
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
                <h3 class="card-title">Form Ubah Klasifikasi Sekunder</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_klasifikasi_sekunder_ubah'); ?>" method = "post">
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Klasifikasi Primer</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="id_klasifikasi">
                            <?php 
                                foreach ($primer as $key) { ?>
                                    <option value="<?php echo $key->id_klasifikasi; ?>" <?php if($key->id_klasifikasi==$klasifikasi->id_klasifikasi){echo 'Selected';}?>> <?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Klasifikasi Sekunder</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_sekunder" placeholder="Nama Klasifikasi" value="<?php echo $klasifikasi->nama_sekunder; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Sekunder</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="kode_sekunder" placeholder="Kode Klasifikasi" value="<?php echo $klasifikasi->kode_sekunder; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status_sekunder">
                        <option value="1" <?php if($klasifikasi->status_sekunder == 1) { echo "selected"; } ?>>Aktif</option>
                        <option value="0" <?php if($klasifikasi->status_sekunder == 0) { echo "selected"; } ?>>Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id_sekunder" value="<?php echo $klasifikasi->id_sekunder; ?>">
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