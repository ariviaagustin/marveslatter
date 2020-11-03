<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/unit_kerja/'); ?>">Data Unit Kerja</a></li>
              <li class="breadcrumb-item active">Ubah Unit Kerja</li>
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
                <h3 class="card-title">Form Ubah Unit Kerja</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_unit_kerja_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Unit Kerja</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_unit_kerja" placeholder="Nama Unit Kerja" value="<?= $unit->nama_unit_kerja; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Unit Kerja</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_unit_kerja" placeholder="Kode Unit Kerja" value="<?= $unit->kode_unit_kerja; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Urutan Unit Kerja</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="order_unit_kerja" placeholder="Urutan Unit Kerja" value="<?= $unit->order_unit_kerja; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_unit_kerja" value="1" <?php if($unit->status_unit_kerja == 1){ echo "checked"; } ?>> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_unit_kerja" value="2" <?php if($unit->status_unit_kerja == 2){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $unit->id_unit_kerja; ?>">
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