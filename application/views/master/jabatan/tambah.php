<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Jabatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Master_data/jabatan/'); ?>">Data Jabatan</a></li>
              <li class="breadcrumb-item active">Tambah Jabatan</li>
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
                <h3 class="card-title">Form Tambah Jabatan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Master_data/aksi_jabatan_tambah'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lembaga</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_instansi" id="id_unit_kerja" onchange="get_unit_kerja()">
                        <option value="">Pilih Lembaga</option>
                        <?php foreach ($lembaga as $key) { ?>
                          <option value="<?php echo $key->id; ?>"><?php echo $key->nama_instansi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_unit_kerja" id="id_bagian_unit" onchange="get_bagian()">
                        <option value="">Pilih Unit Kerja</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_bagian_unit" id="id_sub_bagian" onchange="get_sub_bagian()">
                        <option value="">Pilih Bagian Unit Kerja</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sub Bagian Unit Kerja</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="id_sub_bagian" id="div_sub">
                        <option value="">Pilih Sub Bagian Unit Kerja</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama_jabatan" placeholder="Nama Jabatan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Jabatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="kode_jabatan" placeholder="Kode Jabatan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Eselon</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="eselon_id">
                        <option value="">Pilih Eselon</option>
                        <?php foreach ($eselon as $e) { ?>
                          <option value="<?php echo $e->id_eselon; ?>"><?php echo $e->nama_eselon.' - '.$e->ket_eselon; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Urutan Jabatan</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="jabatan_order" placeholder="Contoh : 1">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="radio" name="status_jabatan" value="1"> Aktif
                        </div>
                        <div class="col-sm-4">
                          <input type="radio" name="status_jabatan" value="0"> Tidak Aktif
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
  function get_unit_kerja(){
                var id_instansi = $("#id_unit_kerja").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_unit_kerja'); ?>", 
                    data:"id_instansi="+id_instansi, 
                    success: function(msg) {
                            $("#id_bagian_unit").html(msg);
                    }
                });
  } 

  function get_bagian(){
    var id_instansi = $("#id_unit_kerja").val();
    var id_unit_kerja = $("#id_bagian_unit").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_bagian'); ?>", 
                    data:{id_instansi: id_instansi, id_unit_kerja:id_unit_kerja},
                    success: function(msg) {
                            $("#id_sub_bagian").html(msg);
                    }
                });
            }

  function get_sub_bagian(){
    var id_instansi = $("#id_unit_kerja").val();
    var id_unit_kerja = $("#id_bagian_unit").val();
    var id_bagian_unit = $("#id_sub_bagian").val();
                $.ajax({ 
                    type: 'POST', 
                    url: "<?php echo site_url('Master_data/get_sub_bagian'); ?>", 
                    data:{id_instansi: id_instansi, id_unit_kerja:id_unit_kerja, id_bagian_unit:id_bagian_unit},
                    success: function(msg) {
                            $("#div_sub").html(msg);
                    }
                });
            }
</script>