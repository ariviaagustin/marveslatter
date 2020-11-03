<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Klasifikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/klasifikasi/'); ?>">Master Klasifikasi</a></li>
              <li class="breadcrumb-item active">Ubah Klasifikasi</li>
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
                <h3 class="card-title">Form Ubah Klasifikasi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_klasifikasi_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Klasifikasi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="klasifikasi" placeholder="Nama Klasifikasi" value="<?= $klasifikasi->klasifikasi; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Klasifikasi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="kode_klasifikasi" placeholder="Kode Klasifikasi" value="<?= $klasifikasi->kode_klasifikasi; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status_klasifikasi">
                        <option value="1" <?php if($klasifikasi->status_klasifikasi == 1) { echo "selected"; } ?>>Aktif</option>
                        <option value="0" <?php if($klasifikasi->status_klasifikasi == 0) { echo "selected"; } ?>>Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $klasifikasi->id_klasifikasi; ?>">
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