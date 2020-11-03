<style type="text/css">
  .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable 
  {
    height: 200px;
  }
  .note-editor.note-airframe, .note-editor.note-frame 
  {
    width: 82%;
    margin-left: 1%;
  }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Surat Internal - Surat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/surat'); ?>">Surat Internal - Surat</a></li>
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Form Tambah Surat Internal - Surat</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/aksi_surat_tambah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required="required" class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <?php foreach ($jenis as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>"><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required="required" class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_surat" placeholder="Tanggal Surat" required>
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required="required" class="form-control select2" style="width: 100%;" name="penandatangan_surat">
                        <option value="">Pilih Penandatangan</option>
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Surat</label>
                    <div class="col-sm-9">
                      <select required="required" class="form-control select2" style="width: 100%;" name="klasifikasi_surat">
                        <option value="">Pilih Klasifikasi Surat</option>
                        <?php foreach ($klasifikasi as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal Surat" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Unit Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="unit_tujuan" id="unit_tujuan" onchange="myFunction()">
                        <option value="">Pilih Unit Tujuan</option>
                        <option value="1">Perorangan</option>
                        <option value="2">Jabatan</option>
                        <option value="3">Bagian Unit Kerja</option>
                        <option value="4">Unit Kerja</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="personal">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat[]" multiple="multiple" id="per">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="jabatan">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat[]" multiple="multiple" id="jab">
                        <?php foreach ($jabatan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row" style="display: none;" id="bag_unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat[]" multiple="multiple" id="bag">
                        <?php foreach ($bag_unit as $key) { ?>
                          <option value="<?php echo $key->id_bag_unit_kerja; ?>"><?php echo $key->nama_bagian; ?></option>
                        <?php } ?>
                      </select>
                    </div> 
                  </div>
                  <div class="form-group row" style="display: none;" id="unit">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="tujuan_surat[]" multiple="multiple" id="u">
                        <?php foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->id_unit_kerja; ?>"><?php echo $key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Jumlah Lampiran">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Surat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control textarea" name="isi_surat" placeholder="Isi Surat"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_surat[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
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
    $(function () {
    // Summernote
    $('.textarea').summernote()
  })
  });
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("unit_tujuan").value;
  if(x == "")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
    }

    if(x == "1")
    {
      $("#personal").show() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#per").attr('required',true);
    }
    if(x == "2")
    {
      $("#personal").hide() ;
      $("#jabatan").show() ;
      $("#bag_unit").hide() ;
      $("#unit").hide() ;
      $("#jab").attr('required',true);
    }
    if(x == "3")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").show() ;
      $("#unit").hide() ;
      $("#bag").attr('required',true);
    }
    if(x == "4")
    {
      $("#personal").hide() ;
      $("#jabatan").hide() ;
      $("#bag_unit").hide() ;
      $("#unit").show() ;
      $("#u").attr('required',true);
    }
    return false;
}
</script>