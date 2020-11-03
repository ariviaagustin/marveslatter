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
<link rel="stylesheet" href="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Nota Dinas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= site_url('Compose/'); ?>">Nota Dinas</a></li>
              <li class="breadcrumb-item active">Tambah Nota Dinas</li>
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
                <h3 class="card-title">Form Tambah Nota Dinas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="<?php echo site_url('Compose/notadinas_aksi'); ?>" method = "post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Surat</label>
                    <div class="col-sm-9">
                      <select class="form-control select2" style="width: 100%;" name="jenis_surat" readonly>
                        <?php foreach ($jenis_surat as $js) { ?>
                          <option selected value="<?php echo $js->id_jenis_surat; ?>" readonly><?php echo $js->nama_jenis_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ditandatangani Oleh</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="penandatangan_nota_dinas">
                        <option selected="selected" value="0">Pilih Penandatangan</option>
                        <?php foreach ($pegawai_jabatan as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai.' - '.$key->nama_jabatan; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perihal</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perihal_nota_dinas" placeholder="Perihal Nota Dinas" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tujuan Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="tujuan_nota_dinas">
                        <option selected="selected" value="0">Pilih Tujuan</option>
                        <?php foreach ($tembusan as $key) { ?>
                          <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_jabatan.' - '.$key->nama_unit_kerja; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tembusan</label>
                    <div class="col-sm-9">
                      <select select class="select2" multiple="multiple" data-placeholder="Pilih Tembusan" style="width: 100%;" name="tembusan_nota_dinas[]">
                        <?php foreach ($ttd as $key) { ?>
                          <option value="<?php echo $key->id_data_pegawai; ?>"><?php echo $key->nama_pegawai." - ".$key->nama_jabatan; ?></option>
                        <?php } ?>
                            <!-- <?php foreach ($tembusan as $key) { ?>
                            <option value="<?php echo $key->id_jabatan; ?>"><?php echo $key->nama_unit_kerja.' - '.$key->nama_jabatan; ?></option>
                          <?php } ?> -->
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Klasifikasi</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="klasifikasi_nota_dinas">
                        <option selected="selected">Pilih Klasifikasi</option>
                        <?php foreach ($klasifikasi_surat as $key) { ?>
                          <option value="<?php echo $key->id_klasifikasi; ?>"><?php echo $key->kode_klasifikasi.' - '.$key->klasifikasi; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sifat Surat</label>
                    <div class="col-sm-9">
                      <select required class="form-control select2" style="width: 100%;" name="sifat_nota_dinas">
                        <option selected="selected">Pilih Sifat Surat</option>
                        <?php foreach ($sifat_surat as $key) { ?>
                          <option value="<?php echo $key->id_sifat_surat; ?>"><?php echo $key->nama_sifat_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Nota Dinas</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="tanggal_nota_dinas" placeholder="Tanggal Nota Dinas">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No. Nota Dinas</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nomor_nota_dinas" placeholder="No. Nota Dinas">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Lampiran</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="lampiran_nota_dinas" placeholder="Lampiran">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Isi Nota Dinas</label>
                    <div class="col-sm-9">
                      <textarea name="isi_nota_dinas" class="textarea" placeholder="Isi Nota Dinas" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd;"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: right;">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <!-- <a href="" class="btn btn-warning">Draft</a> -->
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
<script src="<?php echo site_url(); ?>assets/new/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
