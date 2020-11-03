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
            <h1>Tambah Surat Internal - Surat Keluar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_internal/'); ?>">Surat Internal Keluar</a></li>
              <li class="breadcrumb-item active">Tambah Surat Internal - Surat Keluar</li>
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
                <h3 class="card-title">Form Tambah Surat Internal - Surat Keluar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start --> 
              <form class="form-horizontal" action="<?php echo site_url('Surat_internal/aksi_tambah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_surat">
                        <option value="">Pilih Jenis Surat</option>
                        <?php foreach ($jenis_surat as $key) { ?>
                          <option value="<?php echo $key->id_jenis_surat; ?>"><?php echo $key->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Dari</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="pengirim_surat">
                        <option value="">Pilih Dari</option>
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penandatangan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan">
                        <option value="">Pilih Penandatangan</option>
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Tujuan</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="jenis_tujuan_sik" id = "tampil" onchange="myFunction()">
                        <option value="">Pilih Jenis Tujuan</option>
                        <option value="1">Perorangan</option>
                        <option value="2">Jabatan</option>
                      </select>
                    </div>
                  </div>

                  <div style="display: none;" id="tampil_orang">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                        <div class="col-sm-9">
                          <select select class="select2" multiple="multiple" data-placeholder="Pilih Tujuan Perorangan" style="width: 100%;" name="tujuan_sik[]">
                            <?php foreach ($pegawai_jabatan as $key) { ?>
                            <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                  </div>

                  <div style="display: none;" id="tampil_jabatan">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                        <div class="col-sm-9">
                          <select select class="select2" multiple="multiple" data-placeholder="Pilih Tujuan Jabatan" style="width: 100%;" name="tujuan_sik[]">
                            <?php foreach ($tembusan as $key1) { ?>
                            <option value="<?php echo $key1->id_jabatan; ?>"><?php echo $key1->nama_unit_kerja.' - '.$key1->nama_jabatan; ?></option>
                          <?php } ?>
                      </select>
                        </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Tujuan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="alamat_tujuan_surat" placeholder="Alamat Tujuan">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_surat[]">
                            <?php foreach ($tembusan as $key) { ?>
                            <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_unit_kerja.' - '.$key->nama_jabatan; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_surat">
                        <option value="">Pilih Klasifikasi Surat</option>
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomer Surat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="no_surat" placeholder="Nomer Surat" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tgl_surat" placeholder="Tanggal Surat" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Surat Diterima</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tgl_surat_diterima" placeholder="Tanggal Surat Diterima" required>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_surat">
                        <option value="">Pilih Sifat Surat</option>
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Lampiran" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Upload Attachment</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="file_surat" placeholder="Upload Attachment">
                    </div>
                  </div>

                  
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
function myFunction() {
  var x = document.getElementById("tampil").value;
  if(x == "")
    {
      $("#tampil_orang").hide() ;
      $("#tampil_jabatan").hide() ;
    }

    if(x == "1")
    {
      $("#tampil_orang").show() ;
      $("#tampil_jabatan").hide() ;
    }
    if(x == "2")
    {
      $("#tampil_jabatan").show() ;
      $("#tampil_orang").hide() ;
    }
    return false;
}
</script>

