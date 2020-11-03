<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Sub Bagian Unit Kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/sub_bagian_unit/'); ?>">Data Sub Bagian Unit Kerja</a></li>
              <li class="breadcrumb-item active">Tambah Sub Bagian Unit Kerja</li>
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
                <h3 class="card-title">Form Tambah Sub Bagian Unit Kerja</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_sub_bagian_tambah'); ?>" method = "post">
                <div class="card-body">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lembaga</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="id_instansi" id="id_unit_kerja" onchange="get_unit_kerja()">
                        <option value="">Pilih Lembaga</option>
                        <?php foreach ($lembaga as $lem) { ?>
                          <option value="<?php echo $lem->id; ?>"><?php echo $lem->nama_instansi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="id_unit_kerja"  id="div_unit" onchange="get_bagian_unit()">
                          <option value="">--Pilih Unit Kerja--</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="id_bagian_unit"  id="div_bagian" >
                          <option value="">--Pilih Bagian Unit Kerja--</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Sub Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_sub_bagian" placeholder="Nama Sub Bagian Unit Kerja" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Sub Bagian</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_sub_bagian" placeholder="Kode Sub Bagian">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_sub_bagian" value="1"> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_sub_bagian" value="0"> Tidak Aktif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Urutan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="order_sub_bagian" placeholder="Urutan">
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

    function get_unit_kerja(){
                var id_instansi = $("#id_unit_kerja").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_unit_sub'); ?>", 
                    data:"id_instansi="+id_instansi, 
                    success: function(msg) {
                            $("#div_unit").html(msg);
                    }
                });
    }

    function get_bagian_unit(){
      var id_instansi = $("#id_unit_kerja").val();
      var id_unit_kerja = $("#div_unit").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_bagian_unit'); ?>", 
                    data:{id_instansi: id_instansi, id_unit_kerja:id_unit_kerja},
                    success: function(msg) {
                            $("#div_bagian").html(msg);
                    }
                });
            }
  </script>
 