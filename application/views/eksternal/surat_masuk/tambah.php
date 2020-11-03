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
            <h1>Tambah Surat Eksternal - Surat Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Surat_eksternal_masuk/'); ?>">Surat Eksternal Masuk</a></li>
              <li class="breadcrumb-item active">Tambah Surat Eksternal - Surat Masuk</li>
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
                <h3 class="card-title">Form Tambah Surat Eksternal - Surat Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start --> 
              <form class="form-horizontal" action="<?php echo site_url('Surat_eksternal_masuk/aksi_tambah'); ?>" method = "post" enctype="multipart/form-data">
                <div class="card-body">
                  <h6>A. Klasifikasi Surat</h6>
                  <hr>

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
                    <label class="col-sm-3 col-form-label">Keaslian Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="keaslian_surat">
                        <option value="">Pilih Keaslian Surat</option>
                        <?php foreach ($keaslian as $key) { ?>
                          <option value="<?php echo $key->id_keaslian ?>"><?php echo $key->nama_keaslian; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <hr>
                  <h6>B. Identitas Pengirim</h6>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pengirim / Asal Surat (Dari)</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="pengirim_surat" placeholder="Pengirim / Asal Surat">
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_surat" placeholder="Perihal">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_surat" placeholder="Lampiran" required>
                    </div>
                  </div>
                  
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                        <div class="col-sm-9">
                          <input type="hidden" name="jenis_tujuan_surat" value="2">
                          <input type="hidden" name="ket_tujuan_surat" value="Jabatan">
                          <select required select class="select2" multiple="multiple" data-placeholder="Pilih Tujuan Surat" style="width: 100%;" name="tujuan_surat_ke[]">
                            <?php foreach ($tembusan as $key1) { ?>
                            <option value="<?php echo $key1->id_jabatan; ?>"><?php echo $key1->nama_jabatan.' - '.$key1->nama_unit_kerja; ?></option>
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

                  <hr>
                  <h6>C. Lampiran Upload</h6>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tingkat Pengamanan Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="tingkat_pengamanan">
                        <option value="">Pilih Tingkat Pengamanan</option>
                        <?php foreach ($tingkat_pengamanan as $key) { ?>
                          <option value="<?php echo $key->id_tingkat_pengamanan ?>"><?php echo $key->nama_tingkat_pengamanan; ?></option>
                        <?php } ?>
                      </select>
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
                  <a href="<?php echo site_url('Surat_eksternal_masuk');?>" class="btn btn-danger">Cancel</a>
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

