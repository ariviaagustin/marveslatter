<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Bagian Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/bagian_unit_kerja/'); ?>">Data Bagian Unit Kerja</a></li>
              <li class="breadcrumb-item active">Ubah Bagian Unit Kerja</li>
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
                <h3 class="card-title">Form Ubah Bagian Unit Kerja</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_bagian_ubah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_unit_kerja">
                        <option selected="selected">Pilih Unit Kerja</option>
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>" <?php if($bagian->id_unit_kerja == $key->id_unit_kerja){ echo "selected"; } ?>><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_bagian" placeholder="Nama Bagian Unit Kerja" value="<?= $bagian->nama_bagian; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Bagian</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_bagian" placeholder="Kode Bagian" value="<?= $bagian->kode_bagian; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_bagian" value="1" <?php if($bagian->status_bagian == 1){ echo "checked"; } ?>> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_bagian" value="0" <?php if($bagian->status_bagian == 0){ echo "checked"; } ?>> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Urutan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="order_bagian" placeholder="Urutan Bagian" value="<?= $bagian->order_bagian; ?>">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?= $bagian->id_bag_unit_kerja; ?>">
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