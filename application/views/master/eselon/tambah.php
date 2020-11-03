<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Eselon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/eselon/'); ?>">Data Eselon</a></li>
              <li class="breadcrumb-item active">Tambah Eselon</li>
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
                <h3 class="card-title">Form Tambah Eselon</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_eselon_tambah'); ?>" method = "post">
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tingkat Eselon</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="tingkat_eselon">
                        <option value="">Pilih Tingkat Eselon</option>
                        <?php foreach ($tingkat as $t) { ?>
                          <option value="<?php echo $t->id_role; ?>"><?php echo $t->nama_role; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Eselon</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_eselon" placeholder="Contoh : Ia" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keterangan Eselon</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="ket_eselon" placeholder="Contoh : Eselon I">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Urutan Eselon</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="urutan_eselon" placeholder="Contoh : 1">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_eselon" value="1"> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_eselon" value="0"> Tidak Aktif
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
  <script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    });
  </script>
 