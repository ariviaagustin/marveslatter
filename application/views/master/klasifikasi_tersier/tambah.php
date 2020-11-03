<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Klasifikasi Tersier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/klasifikasi_tersier/'); ?>">Master Klasifikasi Tersier</a></li>
              <li class="breadcrumb-item active">Tambah Klasifikasi Tersier</li>
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
                <h3 class="card-title">Form Tambah Klasifikasi Tersier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_klasifikasi_tersiers_tambah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Klasifikasi Primer</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" name="id_klasifikasi" id="id_sekunder" onchange="get_sekunder()">
                          <option value="">--Pilih Klasifikasi Primer--</option>
                          <?php 
                              foreach ($primer as $key) { ?>
                                  <option value="<?php echo $key->id_klasifikasi?>"><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Klasifikasi Sekunder</label>
                    <div class="col-sm-10">
                      <select required class="form-control select2" name="id_sekunder" id="div_sekunder">
                          <option value="">--Pilih Klasifikasi Sekunder--</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Klasifikasi Tersier</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_tersier" placeholder="Klasifikasi Sekunder" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kode Tersier</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="kode_tersier" placeholder="Kode Klasifikasi" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="status_tersier">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                      </select>
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

   function get_sekunder(){
                var id_klasifikasi = $("#id_sekunder").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_sekunder'); ?>", 
                    data:"id_klasifikasi="+id_klasifikasi, 
                    success: function(msg) {
                            $("#div_sekunder").html(msg);
                    }
                });
  }
</script>