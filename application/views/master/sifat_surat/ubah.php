<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Sifat Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/sifat_surat/'); ?>">Sifat Surat</a></li>
              <li class="breadcrumb-item active">Ubah Sifat Surat</li>
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
                <h3 class="card-title">Form Ubah Sifat Surat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_sifat_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Sifat Surat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_sifat_surat" placeholder="Nama Sifat Surat" value="<?= $sifat->nama_sifat_surat; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Digunakan Untuk</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="use_for">
                        <option value="1" <?php if($sifat->use_for == 1) { echo "selected"; } ?>>Surat Masuk</option>
                        <option value="2" <?php if($sifat->use_for == 2) { echo "selected"; } ?>>Surat Keluar</option>
                        <option value="3" <?php if($sifat->use_for == 3) { echo "selected"; } ?>>Surat Masuk dan Surat Keluar</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status_sifat_surat">
                        <option value="1" <?php if($sifat->status_sifat_surat == 1) { echo "selected"; } ?>>Aktif</option>
                        <option value="0" <?php if($sifat->status_sifat_surat == 0) { echo "selected"; } ?>>Tidak Aktif</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $sifat->id_sifat_surat; ?>">
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